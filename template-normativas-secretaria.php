<?php
/**
 * Template Name: Normativas de Secretaría (En Vivo Digesto)
 * Description: Página de normativas que consulta en tiempo real al Digesto de la UNSL.
 */
get_header();
get_template_part('template-parts/navbar');

$current_page = get_post();

if ( isset($_GET['year']) && ! isset($_GET['filter_year']) ) {
    $new_qs = $_GET;
    $new_qs['filter_year'] = $new_qs['year'];
    unset($new_qs['year']);

    $base = get_permalink( $current_page->ID );
    $redirect_to = $base . ( ! empty( $new_qs ) ? ('?' . http_build_query( $new_qs )) : '' );
    wp_safe_redirect( esc_url_raw( $redirect_to ), 301 );
    exit;
}

$secretaria_id = wp_get_post_parent_id($current_page->ID);
$secretaria = $secretaria_id ? get_post($secretaria_id) : null;

$search_query = '';
if (isset($_GET['q'])) {
    $search_query = sanitize_text_field($_GET['q']);
} elseif (isset($_GET['s'])) {
    $search_query = sanitize_text_field($_GET['s']);
}
$filter_year = '';
if (isset($_GET['filter_year'])) {
    $filter_year = sanitize_text_field($_GET['filter_year']);
} elseif (isset($_GET['year'])) {
    $filter_year = sanitize_text_field($_GET['year']);
}
$paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);


function fcfmyn_obtener_normativas_en_vivo() {
    $cached_data = get_transient('fcfmyn_digesto_normativas_v2');
    if ( false !== $cached_data ) {
        return $cached_data;
    }

    $url = 'http://digesto.unsl.edu.ar/busav.php3';
    $body = array(
        'tipo'   => 'Ordenanzas',
        'origen' => 'Facultad de Ciencias Fisicas Matematicas y Naturales',
        'emisor' => 'Sin Seleccion',
        'area'   => 'Sin Seleccion',
        'fecha1' => '',
        'codigo' => '',
        'clave'  => '',
        'busca2' => 'Buscar'
    );

    $args = array(
        'body'    => $body,
        'timeout' => 15,
        'headers' => array(
            'Content-Type' => 'application/x-www-form-urlencoded',
            'User-Agent'   => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Referer'      => 'http://digesto.unsl.edu.ar/busav.php3'
        )
    );

    $response = wp_remote_post( $url, $args );

    if ( is_wp_error( $response ) ) {
        return array();
    }

    $html = wp_remote_retrieve_body( $response );
    $normativas = array();

    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    @$dom->loadHTML( mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8') );
    libxml_clear_errors();
    
    $xpath = new DOMXPath( $dom );
    $filas = $xpath->query('//tr[descendant::a[contains(@href, "docs/") or contains(@href, "wrapper.php")]]');

    foreach ( $filas as $fila ) {
        $columnas = $xpath->query('.//td', $fila);
        
        if ( $columnas->length >= 3 ) {
            $enlace_nodo = $xpath->query('.//a', $columnas->item(0))->item(0);
            $link = $enlace_nodo ? $enlace_nodo->getAttribute('href') : '';
            $nombre = $enlace_nodo ? trim($enlace_nodo->nodeValue) : '';

            if ( $link && strpos($link, 'http') === false ) {
                $link = 'http://digesto.unsl.edu.ar/' . ltrim($link, '/');
            }

            $fecha = trim($columnas->item(1)->nodeValue);
            $descripcion = trim($columnas->item(2)->nodeValue);

            $year_formatted = '';
            $sort_date = '';
            $date_parts = explode('/', $fecha);
            if(count($date_parts) == 3) {
                $dia = str_pad(trim($date_parts[0]), 2, '0', STR_PAD_LEFT);
                $mes = str_pad(trim($date_parts[1]), 2, '0', STR_PAD_LEFT);
                $y = trim($date_parts[2]);
                
                if(strlen($y) == 2) {
                    $year_formatted = ((int)$y > 50) ? '19'.$y : '20'.$y;
                } else {
                    $year_formatted = $y;
                }

                $sort_date = $year_formatted . $mes . $dia; // Ejemplo: 20250307
            }

            if ( ! empty($nombre) ) {
                $normativas[] = array(
                    'nombre'      => $nombre,
                    'link'        => $link,
                    'fecha'       => $fecha,
                    'year'        => $year_formatted,
                    'sort_date'   => $sort_date,
                    'descripcion' => $descripcion
                );
            }
        }
    }

    // Guardar en caché por 1 hora
    set_transient('fcfmyn_digesto_normativas_v2', $normativas, 3600);

    return $normativas;
}


$todas_normativas = fcfmyn_obtener_normativas_en_vivo();
$filtered_normativas = array();
$years_array = array();

$ano_actual = (int) date('Y');
$ano_limite = $ano_actual - 10;

foreach ( $todas_normativas as $norma ) {
    $norma_year = (int) $norma['year'];

    if ( $norma_year < $ano_limite ) {
        continue;
    }

    if ( !empty($norma['year']) ) {
        $years_array[$norma['year']] = $norma['year'];
    }

    if ( $filter_year && $norma['year'] !== $filter_year ) {
        continue;
    }

    if ( $search_query ) {
        $search_lower = mb_strtolower($search_query, 'UTF-8');
        $nombre_lower = mb_strtolower($norma['nombre'], 'UTF-8');
        $desc_lower   = mb_strtolower($norma['descripcion'], 'UTF-8');
        
        if ( mb_strpos($nombre_lower, $search_lower) === false && 
             mb_strpos($desc_lower, $search_lower) === false ) {
            continue;
        }
    }

    $filtered_normativas[] = $norma;
}


usort($filtered_normativas, function($a, $b) {
    return strcmp($b['sort_date'], $a['sort_date']); 
});

rsort($years_array);


$posts_per_page = 10;
$total_items = count($filtered_normativas);
$total_pages = ceil($total_items / $posts_per_page);
$offset = ($paged - 1) * $posts_per_page;
$paged_normativas = array_slice($filtered_normativas, $offset, $posts_per_page);

?>
<main class="bg-[#fdfbfb] pb-24">
    <section class="relative bg-[#75232c] pt-20 pb-40 overflow-hidden fondo-svg">
        
    
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10">
            <nav class="flex text-base font-bold  uppercase text-white/50 mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="<?php echo home_url(); ?>" class="hover:text-white transition-colors">Inicio</a></li>
                    <?php if ($secretaria_id): ?>
                        <li><span class="text-white/30">/</span></li>
                        <li><a href="<?php echo get_permalink($secretaria_id); ?>" class="hover:text-white transition-colors"><?php echo esc_html($secretaria->post_title); ?></a></li>
                        <li><span class="text-white/30">/</span></li>
                    <?php endif; ?>
                    <li class="text-[#dd7859]">Normativas</li>
                </ol>
            </nav>
            <div class="max-w-3xl">
                <span class="inline-block border border-[#dd7859] text-[#dd7859] text-xs font-bold tracking-widest uppercase px-4 py-1.5 mb-5 rounded-sm bg-[#75232c]/50">
                    Normativas (Digesto)</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight mb-4">
                    Normativas de <?php echo esc_html($secretaria ? $secretaria->post_title : get_the_title()); ?>
                </h1>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 lg:px-10 -mt-16 relative z-20">
        <div class="bg-white border border-slate-200 rounded-sm shadow-xl p-6 mb-8">
            <form method="get" action="<?php echo esc_url( get_permalink( $current_page->ID ) ); ?>" class="grid gap-4 md:grid-cols-3 items-end">
                <div>
                    <label for="q" class="block text-sm font-semibold text-slate-700 mb-2">Buscar</label>
                    <input type="search" id="q" name="q" value="<?php echo esc_attr($search_query); ?>" placeholder="Ordenanza, descripción, nombre" class="w-full border border-slate-200 rounded-sm px-4 py-3 focus:border-[#75232c] focus:ring-[#75232c]/20 focus:outline-none" />
                </div>
                <div>
                    <label for="year" class="block text-sm font-semibold text-slate-700 mb-2">Año</label>
                    <select id="filter_year" name="filter_year" class="w-full border border-slate-200 rounded-sm px-4 py-3 focus:border-[#75232c] focus:ring-[#75232c]/20 focus:outline-none">
                        <option value="">Últimos 10 años</option>
                        <?php foreach ($years_array as $year): ?>
                            <option value="<?php echo esc_attr($year); ?>" <?php selected($filter_year, $year); ?>><?php echo esc_html($year); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center justify-center rounded-sm bg-[#75232c] text-white px-6 py-3 font-semibold hover:bg-[#9c323f] transition-colors w-full">Filtrar</button>
                    <a href="<?php echo esc_url(get_permalink($current_page->ID)); ?>" class="inline-flex items-center justify-center rounded-sm bg-slate-100 text-slate-700 px-6 py-3 font-semibold hover:bg-slate-200 transition-colors w-full">Limpiar</a>
                </div>
            </form>
        </div>

        <div class="bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Ordenanza</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Fecha</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Descripción</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    <?php if ( !empty($paged_normativas) ) : ?>
                        <?php foreach ( $paged_normativas as $norma ) : ?>
                            <tr>
                                <td class="px-6 py-5 align-top">
                                    <?php if ( !empty($norma['link']) ) : ?>
                                        <a href="<?php echo esc_url($norma['link']); ?>" target="_blank" rel="noopener noreferrer" class="font-semibold text-[#75232c] hover:text-[#9c323f] transition-colors">
                                            <?php echo esc_html($norma['nombre']); ?>
                                        </a>
                                        <div class="text-xs text-slate-400 mt-1">Fuente: Digesto UNSL</div>
                                    <?php else: ?>
                                        <span class="font-semibold text-slate-800"><?php echo esc_html($norma['nombre']); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-5 align-top text-slate-600 whitespace-nowrap"><?php echo esc_html($norma['fecha']); ?></td>
                                <td class="px-6 py-5 align-top text-slate-600"><?php echo esc_html($norma['descripcion']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-slate-500">No se encontraron normativas para estos filtros en el Digesto.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            <?php
            if ( $total_pages > 1 ) {
                $big = 999999999;

                $add_args = array();
                if ( $search_query !== '' ) {
                    $add_args['q'] = $search_query;
                }
                if ( $filter_year !== '' ) {
                    $add_args['filter_year'] = $filter_year;
                }

                $links = paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, intval( $paged ) ),
                    'total' => $total_pages,
                    'prev_text' => '&laquo; Anterior',
                    'next_text' => 'Siguiente &raquo;',
                    'add_args' => $add_args,
                    'type' => 'array',
                    'show_all' => false,
                    'end_size' => 1,
                    'mid_size' => 1,
                ) );

                if ( is_array( $links ) && ! empty( $links ) ) :
                    
                    ?>
                    <nav class="inline-flex items-center gap-2 bg-white border border-slate-200 rounded-sm shadow-sm p-2" role="navigation" aria-label="Paginación de normativas">
                        <ul class="inline-flex items-center gap-2">
                            <?php foreach ( $links as $link ) :
                                
                                $is_current = ( strpos( $link, 'current' ) !== false ) || ( strpos( $link, 'class="page-numbers current"' ) !== false );
                                
                                $is_dots = ( strpos( $link, 'dots' ) !== false ) || ( strpos( $link, '...' ) !== false );

                                if ( $is_dots ) : ?>
                                    <li class="px-3 py-2 text-slate-500">&hellip;</li>
                                <?php else :
                                    if ( $is_current ) : ?>
                                        <li>
                                            <span class="inline-flex items-center justify-center px-4 py-2 bg-[#75232c] text-white text-sm font-semibold rounded-sm"><?php echo strip_tags( $link ); ?></span>
                                        </li>
                                    <?php else :
                                    
                                        $link_html = $link;
                                    
                                        $link_html = preg_replace('/<a([^>]+)>/i', '<a$1 class="inline-flex items-center justify-center px-3 py-2 rounded-sm border border-slate-100 text-sm text-slate-600 hover:bg-[#f5f0ef] hover:text-[#75232c] transition-colors">', $link_html);
                                        
                                        $link_html = str_replace('page-numbers', '', $link_html);
                                        ?>
                                        <li><?php echo $link_html;  ?></li>
                                    <?php endif;
                                endif;
                            endforeach; ?>
                        </ul>
                    </nav>
                <?php endif;
            }
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>