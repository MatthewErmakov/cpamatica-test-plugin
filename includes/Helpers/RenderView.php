<?php 

namespace Cpamatica\Includes\Helpers;

class RenderView
{
    private string $template_part;
    private array  $args;

    public function __construct( $template_part, $args = array( ) )
    {
        $this->template_part = $template_part;
        $this->args          = $args;
    }

    public function render( )
    {
        $args = $this->args;

        ob_start();

        foreach ( $args as $key => $argument ) {
            if ($this->is_valid_variable_name($key) ) {
                $$key = $argument;
            } else {
                return esc_html('Error: Invalid name for the variable: ' . $key);
            }
        }

        include $this->template_part . ".php";

        $output = ob_get_clean();

        ob_end_flush();

        return strval($output);
    }

    private function is_valid_variable_name( $name )
    {
        return preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $name);
    }
}