<?php 

namespace Cpamatica\Includes\Handlers;

use \Cpamatica\Includes\External\API;

class Post
{
    public static function update_posts( ) : void
    {
        $api_instance = new API("https://my.api.mockaroo.com/posts.json", "413dfbf0");
        $posts        = $api_instance->get_result();

        $users_instance = new User(
            [
            'role' => 'administrator'
            ]
        );
        $users = $users_instance->get_users_by_role();

        // Fix issues bonded with undefined WP functions
        include_once ABSPATH . "wp-includes/pluggable.php";

        foreach ($posts as $post) {
            $post_title         = sanitize_text_field($post->title);
            $post_content       = wp_kses_post($post->content);
            $post_category      = sanitize_text_field($post->category);

            $find_post_by_title = get_page_by_title($post_title, OBJECT, 'post');
            
            if (is_null($find_post_by_title) ) {
                $category_instance = new Category($post_category);

                // Check if category exists by its name
                // If it doesn't create new one
                if (! ( $category = $category_instance->get_by_name() )) {
                    $category = $category_instance->create();
                }

                // Calculate the publication date
                $publication_date = date('Y-m-d H:i:s', strtotime('-1 month'));

                // Define the new post
                $new_post = array(
                    'post_title' => $post_title,
                    'post_content' => $post_content,
                    'post_status' => 'publish',
                    'post_author' => intval($users->ID),
                    'post_category' => [ $category->term_id ],
                    'post_date' => $publication_date
                );

                // Create uploaded media instance
                $image = new Media($post->image);
                
                // Create the new post
                $post_id       = wp_insert_post($new_post);
                $attachment_id = $image->upload_media();

                // Update rating 
                if (! is_null($post->rating) ) {
                    update_post_meta($post_id, '_post_rating_average', $post->rating);
                }

                if (! is_null($post->site_link) ) {
                    update_post_meta($post_id, '_post_site_link', $post->site_link);
                }

                // Set the featured image
                set_post_thumbnail($post_id, $attachment_id);
            }
        } 
    }
}
