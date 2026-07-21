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


// Registrar custom post type para formularios y solicitudes
add_action( 'init', function() {
    register_post_type( 'formulario_solicitud', array(
        'labels' => array(
            'name' => 'Formularios y Solicitudes',
            'singular_name' => 'Formulario',
            'all_items' => 'Todos los formularios',
            'add_new_item' => 'Agregar nuevo formulario',
            'edit_item' => 'Editar formulario',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'formularios-solicitudes' ),
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'menu_icon' => 'dashicons-clipboard',
        'show_in_rest' => true,
        'capability_type' => array( 'formulario_solicitud', 'formulario_solicitudes' ),
        'map_meta_cap' => true,
    ) );

    // Registrar taxonomía para categorizar formularios
    register_taxonomy( 'tipo_formulario', 'formulario_solicitud', array(
        'labels' => array(
            'name' => 'Tipo de Solicitud',
            'singular_name' => 'Tipo',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'tipo-solicitud' ),
    ) );

    // Registrar custom post type para normativas de secretarías
    register_post_type( 'normativa', array(
        'labels' => array(
            'name' => 'Normativas',
            'singular_name' => 'Normativa',
            'all_items' => 'Todas las normativas',
            'add_new_item' => 'Agregar nueva normativa',
            'edit_item' => 'Editar normativa',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'normativas' ),
        'supports' => array( 'title', 'editor', 'excerpt' ),
        'menu_icon' => 'dashicons-media-document',
        'show_in_rest' => true,
        'capability_type' => array( 'normativa', 'normativas' ),
        'map_meta_cap' => true,
    ) );
} );


function fcfmyn_get_secretaria_pages() {
    $parent = get_page_by_path('secretarias');
    if (! $parent) {
        return array();
    }

    return get_pages(array(
        'post_type' => 'page',
        'post_parent' => $parent->ID,
        'sort_column' => 'menu_order',
    ));
}

function fcfmyn_render_user_secretaria_field($user) {
    $secretarias = fcfmyn_get_secretaria_pages();
    $selected = get_user_meta($user->ID, 'secretaria_relacionada', true);
    ?>
    <h2>Secretaría asignada</h2>
    <table class="form-table">
        <tr>
            <th><label for="secretaria_relacionada">Secretaría</label></th>
            <td>
                <select name="secretaria_relacionada" id="secretaria_relacionada">
                    <option value="">Ninguna</option>
                    <?php foreach ($secretarias as $secretaria) : ?>
                        <option value="<?php echo esc_attr($secretaria->ID); ?>" <?php selected($selected, $secretaria->ID); ?>><?php echo esc_html($secretaria->post_title); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="description">Selecciona la secretaría con la que este usuario trabaja.</p>
            </td>
        </tr>
    </table>
    <?php
}

add_action('show_user_profile', 'fcfmyn_render_user_secretaria_field');
add_action('edit_user_profile', 'fcfmyn_render_user_secretaria_field');

function fcfmyn_save_user_secretaria_field($user_id) {
    if (! current_user_can('edit_user', $user_id)) {
        return;
    }

    if (isset($_POST['secretaria_relacionada'])) {
        update_user_meta($user_id, 'secretaria_relacionada', sanitize_text_field($_POST['secretaria_relacionada']));
    }
}

add_action('personal_options_update', 'fcfmyn_save_user_secretaria_field');
add_action('edit_user_profile_update', 'fcfmyn_save_user_secretaria_field');

function fcfmyn_restrict_admin_secretaria_content($query) {
    if (!is_admin() || ! $query->is_main_query()) {
        return;
    }

    $post_type = $query->get('post_type');
    if (! in_array($post_type, array('normativa', 'formulario_solicitud'), true)) {
        return;
    }

    if (current_user_can('manage_options')) {
        return;
    }

    $user_secretaria = get_user_meta(get_current_user_id(), 'secretaria_relacionada', true);
    if (! $user_secretaria) {
        return;
    }

    $meta_query = $query->get('meta_query');
    if (! is_array($meta_query)) {
        $meta_query = array();
    }

    $meta_query[] = array(
        'key' => 'secretaria_relacionada',
        'value' => $user_secretaria,
        'compare' => '=',
    );

    $query->set('meta_query', $meta_query);
}
add_action('pre_get_posts', 'fcfmyn_restrict_admin_secretaria_content');
?>