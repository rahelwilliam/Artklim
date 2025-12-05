<?php 

function custom_mime_types($mime_types) {
    $mime_types['svg']  = 'image/svg+xml'; // Permitir svg

    return $mime_types;
}

add_filter('upload_mimes', 'custom_mime_types');
