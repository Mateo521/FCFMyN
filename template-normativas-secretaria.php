<?php
/**
 * Template Name: Normativas de Secretaría
 * Description: Página de normativas para una secretaría específica.
 */
get_header();
get_template_part('template-parts/navbar');

$current_page = get_post();
$secretaria_id = wp_get_post_parent_id($current_page->ID);
$secretaria = $secretaria_id ? get_post($secretaria_id) : null;

$search_query = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
$filter_year = isset($_GET['year']) ? sanitize_text_field($_GET['year']) : '';

$meta_query = array(
    array(
        'key' => 'secretaria_relacionada',
        'value' => $secretaria_id,
        'compare' => '=',
    ),
);

if ($filter_year) {
    $meta_query[] = array(
        'key' => 'fecha_normativa',
        'value' => $filter_year,
        'compare' => 'LIKE',
    );
}

$args = array(
    'post_type' => 'normativa',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'meta_key' => 'fecha_normativa',
    'order' => 'DESC',
    'meta_query' => $meta_query,
    's' => $search_query,
);

$query = new WP_Query($args);

$years = array();
$year_args = array(
    'post_type' => 'normativa',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'secretaria_relacionada',
            'value' => $secretaria_id,
            'compare' => '=',
        ),
    ),
);
$year_posts = get_posts($year_args);
foreach ($year_posts as $post_item) {
    $date_value = get_field('fecha_normativa', $post_item->ID);
    if ($date_value) {
        $date = DateTime::createFromFormat('Y-m-d', $date_value) ?: DateTime::createFromFormat('d/m/Y', $date_value);
        if ($date) {
            $years[$date->format('Y')] = $date->format('Y');
        }
    }
}
ksort($years);
?>

<main class="bg-[#fdfbfb] pb-24">
    <section class="relative bg-[#75232c] pt-20 pb-40 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10">
            <nav class="flex text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 mb-8" aria-label="Breadcrumb">
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
                    Normativas</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight mb-4">
                    Normativas de <?php echo esc_html($secretaria ? $secretaria->post_title : get_the_title()); ?>
                </h1>
                <p class="text-white/80 leading-relaxed max-w-2xl">
                    Aquí puedes filtrar órdenes, enlaces y descripciones según año, fecha y nombre.
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 lg:px-10 -mt-16 relative z-20">
        <div class="bg-white border border-slate-200 rounded-sm shadow-xl p-6 mb-8">
            <form method="get" class="grid gap-4 md:grid-cols-3 items-end">
                <div>
                    <label for="q" class="block text-sm font-semibold text-slate-700 mb-2">Buscar</label>
                    <input type="search" id="q" name="q" value="<?php echo esc_attr($search_query); ?>" placeholder="Ordenanza, descripción, nombre" class="w-full border border-slate-200 rounded-sm px-4 py-3 focus:border-[#75232c] focus:ring-[#75232c]/20 focus:outline-none" />
                </div>
                <div>
                    <label for="year" class="block text-sm font-semibold text-slate-700 mb-2">Año</label>
                    <select id="year" name="year" class="w-full border border-slate-200 rounded-sm px-4 py-3 focus:border-[#75232c] focus:ring-[#75232c]/20 focus:outline-none">
                        <option value="">Todos los años</option>
                        <?php foreach ($years as $year): ?>
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
                    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                        $ordenanza_url = get_field('ordenanza_url');
                        $fecha = get_field('fecha_normativa');
                        $description = get_the_excerpt() ?: wp_trim_words(get_the_content(), 25);
                        $date_object = $fecha ? (DateTime::createFromFormat('Y-m-d', $fecha) ?: DateTime::createFromFormat('d/m/Y', $fecha)) : null;
                        $fecha_formateada = $date_object ? $date_object->format('d/m/Y') : 'Sin fecha';
                    ?>
                        <tr>
                            <td class="px-6 py-5 align-top">
                                <?php if ($ordenanza_url): ?>
                                    <a href="<?php echo esc_url($ordenanza_url); ?>" target="_blank" rel="noopener noreferrer" class="font-semibold text-[#75232c] hover:text-[#9c323f] transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                <?php else: ?>
                                    <span class="font-semibold text-slate-800"><?php the_title(); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-5 align-top text-slate-600"><?php echo esc_html($fecha_formateada); ?></td>
                            <td class="px-6 py-5 align-top text-slate-600"><?php echo esc_html($description); ?></td>
                        </tr>
                    <?php endwhile; else: ?>
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-slate-500">No se encontraron normativas para estos filtros.</td>
                        </tr>
                    <?php endif; wp_reset_postdata(); ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php get_footer(); ?>
