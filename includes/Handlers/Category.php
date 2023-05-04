<?php 

namespace Cpamatica\Includes\Handlers;

class Category
{
    private string $category_name;
    private string $taxonomy_name;

    public function __construct( $category_name, $taxonomy_name = 'category' )
    {
        $this->category_name = $category_name ? sanitize_text_field($category_name) : '';
        $this->taxonomy_name = sanitize_text_field($taxonomy_name);
    }

    public function get_by_name( ) : mixed
    {
        $category = get_term_by('name', $this->category_name, $this->taxonomy_name);

        return $category;
    }

    public function create( ) : object
    {
        $result = wp_insert_term($this->category_name, $this->taxonomy_name);

        if (! is_wp_error($result) ) {
            $category_id = $result['term_id'];
            $category = get_term($category_id, $this->taxonomy_name);
        }

        return $category;
    } 
}
