<?php
function fcfmyn_theme_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menus(array(
        'primary' => 'Menú principal',
    ));
}
add_action('after_setup_theme', 'fcfmyn_theme_setup');


function fcfmyn_get_disciplinas_carreras()
{
    return array(
        'electronica' => array(
            'label' => 'Electrónica',
            'carreras' => array(
                'maestria-en-sistemas-embebidos' => 'Maestría en Sistemas Embebidos',
                'maestria-en-diseno-de-sistemas-electronicos-aplicados-a-la-agronomia' => 'Maestría en Diseño de Sistemas Electrónicos Aplicados a la Agronomía',
                'especializacion-en-sistemas-embebidos' => 'Especialización en Sistemas Embebidos',
                'ingenieria-electronica-con-orientacion-en-sistemas-digitales' => 'Ingeniería Electrónica con Orientación en Sistemas Digitales',
                'profesorado-en-tecnologia-electronica' => 'Profesorado en Tecnología Electrónica',
                'tecnicatura-universitaria-en-electronica' => 'Tecnicatura Universitaria en Electrónica',
                'tecnicatura-universitaria-en-telecomunicaciones' => 'Tecnicatura Universitaria en Telecomunicaciones',
            ),
        ),
        'fisica' => array(
            'label' => 'Física',
            'carreras' => array(
                'doctorado-en-fisica' => 'Doctorado en Física',
                'maestria-en-ciencias-de-superficies-y-medios-porosos' => 'Maestría en Ciencias de Superficies y Medios Porosos',
                'especializacion-en-ensenanza-de-la-fisica' => 'Especialización en Enseñanza de la Física',
                'licenciatura-en-fisica' => 'Licenciatura en Física',
                'profesorado-en-fisica' => 'Profesorado en Física',
                'tecnicatura-universitaria-en-energias-renovables' => 'Tecnicatura Universitaria en Energías Renovables',
                'tecnicatura-universitaria-en-fotografia' => 'Tecnicatura Universitaria en Fotografía',
            ),
        ),
        'geologia' => array(
            'label' => 'Geología',
            'carreras' => array(
                'doctorado-en-ciencias-geologicas' => 'Doctorado en Ciencias Geológicas',
                'licenciatura-en-ciencias-geologicas' => 'Licenciatura en Ciencias Geológicas',
                'tecnicatura-universitaria-en-teledeteccion-y-sistemas-de-informacion-geografica-t-sig' => 'Tecnicatura Universitaria en Teledetección y Sistemas de Información Geográfica (T-SIG)',
            ),
        ),
        'informatica' => array(
            'label' => 'Informática',
            'carreras' => array(
                'doctorado-en-ciencias-de-la-computacion' => 'Doctorado en Ciencias de la Computación',
                'doctorado-en-ingenieria-en-informatica' => 'Doctorado en Ingeniería en Informática',
                'maestria-en-calidad-del-software' => 'Maestría en Calidad del Software',
                'maestria-en-ciencias-de-la-computacion' => 'Maestría en Ciencias de la Computación',
                'maestria-en-ensenanza-en-escenarios-digitales' => 'Maestría en Enseñanza en Escenarios Digitales',
                'maestria-en-ingenieria-de-software' => 'Maestría en Ingeniería de Software',
                'especializacion-en-ingenieria-de-software' => 'Especialización en Ingeniería de Software',
                'ingenieria-en-computacion' => 'Ingeniería en Computación',
                'ingenieria-en-informatica' => 'Ingeniería en Informática',
                'licenciatura-en-ciencias-de-la-computacion' => 'Licenciatura en Ciencias de la Computación',
                'profesorado-en-ciencias-de-la-computacion' => 'Profesorado en Ciencias de la Computación',
                'tecnicatura-universitaria-en-redes-de-computadoras' => 'Tecnicatura Universitaria en Redes de Computadoras',
                'tecnicatura-universitaria-en-web' => 'Tecnicatura Universitaria en Web',
            ),
        ),
        'matematica' => array(
            'label' => 'Matemática',
            'carreras' => array(
                'doctorado-en-ciencias-matematicas' => 'Doctorado en Ciencias Matemáticas',
                'maestria-en-matematica' => 'Maestría en Matemática',
                'especializacion-en-didactica-matematica' => 'Especialización en Didáctica Matemática',
                'licenciatura-en-ciencias-matematicas' => 'Licenciatura en Ciencias Matemáticas',
                'licenciatura-en-matematica-aplicada' => 'Licenciatura en Matemática Aplicada',
                'profesorado-en-matematica' => 'Profesorado en Matemática',
            ),
        ),
        'mineria' => array(
            'label' => 'Minería',
            'carreras' => array(
                'especializacion-en-simulacion-discreta-aplicada-a-la-planificacion-minera' => 'Especialización en Simulación Discreta Aplicada a la Planificación Minera',
                'ingenieria-en-minas' => 'Ingeniería en Minas',
                'tecnicatura-universitaria-en-mineria' => 'Tecnicatura Universitaria en Minería',
                'tecnicatura-universitaria-en-obras-viales' => 'Tecnicatura Universitaria en Obras Viales',
            ),
        ),
    );
}

function fcfmyn_get_nivel_carrera($class_list)
{
    if (! is_array($class_list)) {
        return '';
    }

    if (in_array('nivel-pregrado', $class_list, true)) {
        return 'Pregrado';
    }

    if (in_array('nivel-posgrado', $class_list, true)) {
        return 'Posgrado';
    }

    if (in_array('nivel-grado', $class_list, true)) {
        return 'Grado';
    }

    return '';
}

function fcfmyn_get_nivel_carrera_badge_classes($nivel)
{
    switch ($nivel) {
        case 'Pregrado':
            return array('bg' => 'bg-[#dd7859]/10', 'text' => 'text-[#dd7859]');
        case 'Posgrado':
            return array('bg' => 'bg-[#dc5d34]/10', 'text' => 'text-[#dc5d34]');
        case 'Grado':
            return array('bg' => 'bg-[#75232c]/10', 'text' => 'text-[#75232c]');
        default:
            return array('bg' => 'bg-slate-200/50', 'text' => 'text-slate-700');
    }
}

function fcfmyn_get_nivel_carrera_from_slug($slug)
{
    if (preg_match('/\b(doctorado|maestria|especializacion)\b/i', $slug)) {
        return 'Posgrado';
    }

    if (strpos($slug, 'tecnicatura-universitaria') !== false || strpos($slug, 'tecnicatura') !== false) {
        return 'Pregrado';
    }

    return 'Grado';
}

function fcfmyn_render_disciplinas_header_menu($is_mobile = false)
{
    $disciplinas = fcfmyn_get_disciplinas_carreras();

    if ($is_mobile) {
        echo '<div class="border-t border-white/10 pt-6">';
        echo '<p class="text-white/70 uppercase tracking-widest text-xs mb-3">Disciplinas</p>';
        foreach ($disciplinas as $disciplina_slug => $disciplina) {
            echo '<div class="mb-4">';  
            echo '<a href="' . esc_url(home_url('/disciplina/' . $disciplina_slug . '/')) . '" class="block text-white font-semibold uppercase tracking-wide mb-2 hover:text-[#dd7859]">' . esc_html($disciplina['label']) . '</a>';
            echo '<div class="space-y-2 pl-4">';
            foreach ($disciplina['carreras'] as $carrera_slug => $carrera_title) {
                $nivel = fcfmyn_get_nivel_carrera_from_slug($carrera_slug);
                $badge = fcfmyn_get_nivel_carrera_badge_classes($nivel);
                echo '<div class="mb-2">';
                echo '<a href="' . esc_url(home_url('/carrera/' . $carrera_slug . '/')) . '" class="block text-sm text-white/70 hover:text-[#dd7859] transition-colors">' . esc_html($carrera_title) . '</a>';
                echo '<span class="inline-flex items-center mt-1 px-2 py-0.5 rounded-full text-[10px] uppercase tracking-[0.18em] font-semibold ' . esc_attr($badge['bg'] . ' ' . $badge['text']) . '">' . esc_html($nivel) . '</span>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        return;
    }

    echo '<div class="relative group">';
    echo '<a href="' . esc_url(home_url('/disciplinas/')) . '" class="relative text-white/80 hover:text-white text-sm font-semibold uppercase transition-colors duration-300 group/link inline-flex items-center gap-2">';
    echo 'Disciplinas';
    echo '<svg class="w-3 h-3 text-white/80 transition-transform duration-200 group-hover:-rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" /></svg>';
    echo '</a>';
    echo '<div class="absolute left-0 top-full mt-2 w-[40rem] max-w-screen-xl bg-white border border-slate-200 rounded-b-md shadow-[0_15px_40px_-10px_rgba(0,0,0,0.1)] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">';
    echo '<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 p-8">';
    foreach ($disciplinas as $disciplina_slug => $disciplina) {
        echo '<div>';
        echo '<a href="' . esc_url(home_url('/disciplina/' . $disciplina_slug . '/')) . '" class="text-slate-900 font-semibold text-sm uppercase tracking-wider hover:text-[#dd7859]">' . esc_html($disciplina['label']) . '</a>';
        echo '<ul class="mt-4 space-y-2">';
        foreach ($disciplina['carreras'] as $carrera_slug => $carrera_title) {
            $nivel = fcfmyn_get_nivel_carrera_from_slug($carrera_slug);
            $badge = fcfmyn_get_nivel_carrera_badge_classes($nivel);
            echo '<li>';
            echo '<a href="' . esc_url(home_url('/carrera/' . $carrera_slug . '/')) . '" class="block text-slate-500 text-sm hover:text-[#75232c] transition-colors">' . esc_html($carrera_title) . '</a>';
            echo '<span class="inline-flex items-center mt-1 px-2 py-0.5 rounded-full text-[10px] uppercase tracking-[0.18em] font-semibold ' . esc_attr($badge['bg'] . ' ' . $badge['text']) . '">' . esc_html($nivel) . '</span>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

function fcfmyn_menu_has_disciplinas_item()
{
    if (! has_nav_menu('primary')) {
        return false;
    }

    $locations = get_nav_menu_locations();
    $menu_id = isset($locations['primary']) ? $locations['primary'] : false;
    if (! $menu_id) {
        return false;
    }

    $items = wp_get_nav_menu_items($menu_id);
    if (! is_array($items)) {
        return false;
    }

    foreach ($items as $item) {
        if (empty($item->url) || empty($item->title)) {
            continue;
        }

        $url = trailingslashit(rtrim($item->url, '/'));
        if ($url === trailingslashit(home_url('/disciplinas/')) || strcasecmp(trim($item->title), 'Disciplinas') === 0) {
            return true;
        }
    }

    return false;
}

function fcfmyn_menu_item_is_disciplinas($item)
{
    if (empty($item->url) || empty($item->title)) {
        return false;
    }

    $title = strtolower(trim($item->title));
    $url = trailingslashit(rtrim($item->url, '/'));
    $disciplinas_url = trailingslashit(home_url('/disciplinas/'));

    return $title === 'disciplinas' || $url === $disciplinas_url;
}


class FCFMyN_Walker_Nav_Menu extends Walker_Nav_Menu
{
    private $mobile;

    public function __construct($mobile = false)
    {
        $this->mobile = $mobile;
    }

    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        if ($this->mobile) {
            $output .= "\n$indent<ul class=\"pl-4 space-y-2\">\n";
        } else {
            if ($depth === 0) {

            $output .= "\n$indent<ul class=\"absolute left-0 w-full top-full bg-white border border-slate-200 rounded-b-md shadow-[0_15px_40px_-10px_rgba(0,0,0,0.1)] z-50 hidden group-hover:grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 p-8 gap-8 border-t-4 border-t-[#dd7859]\">\n";
            } else {

            $output .= "\n$indent<ul class=\"mt-4 space-y-5\">\n";
            }
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = array('menu-item');

        if (!empty($args->has_children)) {
            $classes[] = 'menu-item-has-children';
        }


        if ($depth === 0) {
            $classes[] = 'group';

            $classes[] = 'flex items-center h-[70px] cursor-default';
        } else if ($depth === 1 && !empty($args->has_children)) {

        $classes[] = 'flex flex-col';
        }

        $class_names = implode(' ', array_filter($classes));
        $output .= "$indent<li class=\"{$class_names}\">";

        if ($depth === 0 && fcfmyn_menu_item_is_disciplinas($item)) {
            if ($this->mobile) {
                $output .= '<a href="' . esc_url(home_url('/disciplinas/')) . '" class="block text-white text-base font-semibold uppercase tracking-wider py-3 px-4 hover:text-[#dd7859] transition-colors">' . esc_html($item->title) . '</a>';
                $output .= '<div class="border-t border-white/10 pt-4">';
                foreach (fcfmyn_get_disciplinas_carreras() as $disciplina_slug => $disciplina) {
                    $output .= '<div class="mb-4">';
                    $output .= '<a href="' . esc_url(home_url('/disciplina/' . $disciplina_slug . '/')) . '" class="block text-white font-semibold uppercase tracking-wide mb-2 hover:text-[#dd7859]">' . esc_html($disciplina['label']) . '</a>';
                    foreach ($disciplina['carreras'] as $carrera_slug => $carrera_title) {
                        $output .= '<a href="' . esc_url(home_url('/carrera/' . $carrera_slug . '/')) . '" class="block text-sm text-white/70 hover:text-[#dd7859] transition-colors pl-4">' . esc_html($carrera_title) . '</a>';
                    }
                    $output .= '</div>';
                }
                $output .= '</div>';
            } else {
                $output .= '<a href="' . esc_url(home_url('/disciplinas/')) . '" class="relative text-white/80 hover:text-white text-sm font-semibold uppercase transition-colors duration-300 group/link inline-flex items-center gap-2">';
                $output .= esc_html($item->title);
                $output .= '<svg class="w-3 h-3 text-white/80 transition-transform duration-200 group-hover:-rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" /></svg>';
                $output .= '</a>';
                $output .= '<div class="absolute left-0 top-full mt-2 w-full max-w-screen-7xl bg-white border border-slate-200 rounded-b-md shadow-[0_15px_40px_-10px_rgba(0,0,0,0.1)] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">';
                $output .= '<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 p-8">';
                foreach (fcfmyn_get_disciplinas_carreras() as $disciplina_slug => $disciplina) {
                    $output .= '<div>';
                    $output .= '<a href="' . esc_url(home_url('/disciplina/' . $disciplina_slug . '/')) . '" class="text-slate-900 font-semibold text-sm uppercase tracking-wider hover:text-[#dd7859]">' . esc_html($disciplina['label']) . '</a>';
                    $output .= '<ul class="mt-4 space-y-2">';
                    foreach ($disciplina['carreras'] as $carrera_slug => $carrera_title) {
                        $output .= '<li><a href="' . esc_url(home_url('/carrera/' . $carrera_slug . '/')) . '" class="block text-slate-500 text-sm hover:text-[#75232c] transition-colors">' . esc_html($carrera_title) . '</a></li>';
                    }
                    $output .= '</ul>';
                    $output .= '</div>';
                }
                $output .= '</div>';
                $output .= '</div>';
            }
            $output .= "</li>\n";
            return;
        }

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '#';

        if ($this->mobile) {
            $atts['class'] = 'block text-white text-base font-semibold uppercase tracking-wider py-3 px-4 hover:text-[#dd7859] transition-colors';
        } else {
            if ($depth === 0) {

            $atts['class'] = 'relative text-white/80 hover:text-white text-sm font-semibold uppercase transition-colors duration-300 flex items-center gap-1 h-full px-2 cursor-pointer';
            } elseif ($depth === 1 && !empty($args->has_children)) {

            $atts['class'] = 'block text-slate-500 text-xs font-semibold uppercase tracking-wider mb-2 border-b border-slate-100 pb-2 pointer-events-none';
            } else {

            $atts['class'] = 'block group/link';
            }
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = esc_attr($value);
                $attributes .= " $attr=\"$value\"";
            }
        }

        $item_output = $args->before;


        if (!$this->mobile && $depth === 1 && !empty($args->has_children) && $atts['href'] === '#') {
            $item_output .= "<span$attributes>";
        } else {
            $item_output .= "<a$attributes>";
        }


        if (!$this->mobile && $depth > 0 && (empty($args->has_children) || $depth >= 2)) {
            $title = apply_filters('the_title', $item->title, $item->ID);
            $desc = !empty($item->description) ? "<span class=\"block text-xs text-slate-500 mt-1 group-hover/link:text-slate-600 transition-colors font-normal leading-relaxed\">" . esc_html($item->description) . "</span>" : "";

            $item_output .= "<span class=\"block text-[15px] font-semibold text-slate-900 group-hover/link:text-[#dd7859] transition-colors duration-200\">" . $title . "</span>";
            $item_output .= $desc;
        } else {
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        }


        if (!$this->mobile && $depth === 0 && !empty($args->has_children)) {
            $item_output .= ' <svg class="w-3 h-3 text-white/80 transition-transform duration-200 group-hover:-rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" /></svg>';
        }

        if (!$this->mobile && $depth === 1 && !empty($args->has_children) && $atts['href'] === '#') {
            $item_output .= '</span>';
        } else {
            $item_output .= '</a>';
        }

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>\n";
    }
}


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

function fcfmyn_get_secretaria_pages()
{
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

function fcfmyn_render_page_tree($parent_id, $level = 0)
{
    $children = get_pages(array(
        'post_type' => 'page',
        'post_parent' => $parent_id,
        'sort_column' => 'menu_order',
        'post_status' => 'publish',
    ));

    if (empty($children)) {
        return;
    }

    $list_classes = $level === 0 ? 'grid gap-4 md:grid-cols-2' : 'space-y-2';
    echo '<div class="' . esc_attr($list_classes) . '">';

    foreach ($children as $child) {
        $child_link = get_permalink($child);
        $child_title = esc_html($child->post_title);

        $has_children = get_pages(array(
            'post_type' => 'page',
            'post_parent' => $child->ID,
            'post_status' => 'publish',
            'number' => 1,
        ));

        echo '<div class="space-y-3">';
        echo '<a href="' . esc_url($child_link) . '" class="block text-sm font-semibold text-slate-900 hover:text-[#75232c]">' . $child_title . '</a>';

        if (!empty($has_children)) {
            echo '<div class="mt-2 pl-4 border-l border-slate-200">';
            fcfmyn_render_page_tree($child->ID, $level + 1);
            echo '</div>';
        }

        echo '</div>';
    }

    echo '</div>';
}

add_filter('query_vars', function ($vars) {
    $vars[] = 'carrera_api_slug';
    return $vars;
});


add_action('init', function () {

    add_rewrite_rule(
        '^carrera/([^/]+)/?$',
        'index.php?carrera_api_slug=$matches[1]',
        'top'
    );
});


add_action('template_include', function ($template) {
    $slug = get_query_var('carrera_api_slug');
    if ($slug) {

        $new_template = locate_template(array('single-api-carrera.php'));
        if (! empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
});



add_action('init', function () {
    register_post_type('formulario_solicitud', array(
        'labels' => array(
            'name' => 'Formularios y Solicitudes',
            'singular_name' => 'Formulario',
            'all_items' => 'Todos los formularios',
            'add_new_item' => 'Agregar nuevo formulario',
            'edit_item' => 'Editar formulario',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'formularios-solicitudes'),
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-clipboard',
        'show_in_rest' => true,
    ));


    register_taxonomy('tipo_formulario', 'formulario_solicitud', array(
        'labels' => array(
            'name' => 'Tipo de Solicitud',
            'singular_name' => 'Tipo',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'tipo-solicitud'),
    ));

    
    register_post_type('normativa', array(
        'labels' => array(
            'name' => 'Normativas',
            'singular_name' => 'Normativa',
            'all_items' => 'Todas las normativas',
            'add_new_item' => 'Agregar nueva normativa',
            'edit_item' => 'Editar normativa',
        ),

        'public' => false,
        'publicly_queryable' => false,
        'has_archive' => false,
        'rewrite' => false,
        'supports' => array('title', 'editor', 'excerpt'),
        'menu_icon' => 'dashicons-media-document',
        'show_in_rest' => true,
        'show_ui' => true,
        'show_in_menu' => true,
    ));
});


function fcfmyn_render_user_secretaria_field($user)
{
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

function fcfmyn_save_user_secretaria_field($user_id)
{
    if (! current_user_can('edit_user', $user_id)) {
        return;
    }

    if (isset($_POST['secretaria_relacionada'])) {
        update_user_meta($user_id, 'secretaria_relacionada', sanitize_text_field($_POST['secretaria_relacionada']));
    }
}

add_action('personal_options_update', 'fcfmyn_save_user_secretaria_field');
add_action('edit_user_profile_update', 'fcfmyn_save_user_secretaria_field');

function fcfmyn_restrict_admin_secretaria_content($query)
{
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