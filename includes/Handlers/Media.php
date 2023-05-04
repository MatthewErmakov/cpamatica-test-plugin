<?php

namespace Cpamatica\Includes\Handlers;

class Media
{
    private int $id;
    private string $desc;

    private string $media_url;

    public function __construct( $media_url, $desc = '' )
    {
        $this->media_url = sanitize_url($media_url);
        $this->desc      = wp_kses_post($desc);
    }

    public function upload_media( ) : int
    {
        if(is_null($this->media_url) ) {
            return esc_html('Error: media url is not set');
        }

        include_once ABSPATH . "wp-includes/pluggable.php";
        include_once ABSPATH . "wp-admin/includes/file.php";
        include_once ABSPATH . "wp-admin/includes/image.php";
        include_once ABSPATH . "wp-admin/includes/media.php";

        $file_array = [ 
            'name'     => wp_basename($this->media_url) . ".png", // Added this crutch to avoid 'You are not allowed to download this file type' error
            'tmp_name' => download_url($this->media_url) 
        ];

        // If error storing temporarily, return the error
        if (is_wp_error($file_array['tmp_name']) ) {
            return -1;
        }

        // Do the validation and storage stuff
        $attachment_id = media_handle_sideload($file_array, 0, $this->desc);

        // If error storing permanently, unlink
        if (is_wp_error($attachment_id) ) {
            @unlink($file_array['tmp_name']);
        }

        $this->id = intval($attachment_id);

        return $this->id;
    }
}
