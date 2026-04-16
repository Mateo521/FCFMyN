<?php
function fcfmyn_theme_setup()
{

    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'fcfmyn_theme_setup');


function fcfmyn_reading_time()
{
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $readingtime = ceil($word_count / 200);
    return $readingtime . ' min de lectura';
}


function fcfmyn_theme()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'fcfmyn_theme');




add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'carrera_api_slug';
    return $vars;
} );


add_action( 'init', function() {

    add_rewrite_rule(
        '^carrera/([^/]+)/?$',
        'index.php?carrera_api_slug=$matches[1]',
        'top'
    );
} );


add_action( 'template_include', function( $template ) {
    $slug = get_query_var( 'carrera_api_slug' );
    if ( $slug ) {

        $new_template = locate_template( array( 'single-api-carrera.php' ) );
        if ( ! empty( $new_template ) ) {
            return $new_template;
        }
    }
    return $template;
} );
?>