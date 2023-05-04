<?php 

namespace Cpamatica\Shortcodes\PostsOutput;

use Cpamatica\Includes\Helpers\RenderView;

class Loader
{
    public function __construct( )
    {
        $this->load_shortcodes();
    }

    public function load_shortcodes( )
    {
        \add_shortcode('posts_output', [ $this, 'render_posts_output' ]);
    }

    public function render_posts_output( $atts = [], $content = null )
    {
        $this->enqueue_main_script_for_render_posts_output();

        $args = shortcode_atts(
            array(
            'title' => '',
            'count' => 5,
            'sort'  => 'date',
            'ids'   => -1
            ), $atts
        ); 

        $posts = get_posts(
            [
            'post_type'      => 'post',
            'numberposts'    => intval($args['count']),
            'orderby'        => $args['sort'],
            'post__in'       => explode(',', strval($args['ids']))
            ]
        );

        $posts_parsed = [];

        // Prettify data output to the file
        foreach ( $posts as $key => $post ) {
            $posts_parsed[$key]['title']     = $post->post_title; 
            $posts_parsed[$key]['url']       = get_permalink($post->ID); 
            $posts_parsed[$key]['category']  = get_the_category($post->ID); 
            $posts_parsed[$key]['image_url'] = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
            $posts_parsed[$key]['rating']    = reset(get_post_meta($post->ID, '_post_rating_average')); 
            $posts_parsed[$key]['site_link'] = reset(get_post_meta($post->ID, '_post_site_link')); 
        }

        return (new RenderView( 
            plugin_dir_path(__FILE__) . "view/template",
            [
                'posts' => $posts_parsed,
                'title' => $args['title']
            ]
        ))->render();
    }

    private function enqueue_main_script_for_render_posts_output( )
    {
        wp_register_script('main-script', plugins_url('view/assets/js/main.min.js',  __FILE__), [ 'jquery' ], fileatime(plugin_dir_path(__FILE__) . 'view/assets/js/main.min.js'), true);
            
        wp_enqueue_script('main-script');
    }
}
