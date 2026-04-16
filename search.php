<?php
get_header();
get_template_part('template-parts/navbar');


$search_query = get_search_query();


$api_url = "http://192.168.103.3/wp-json/wp/v2/carrera?facultad=14&search=" . urlencode($search_query);
$response = wp_remote_get($api_url);

$carreras_encontradas = array();
if (! is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);
    if (! empty($data) && is_array($data)) {
        $carreras_encontradas = $data;
    }
}
?>

<main class="bg-[#fdfbfb] min-h-screen flex flex-col">

    <header class="relative bg-slate-900 pt-20 pb-24 border-b-[6px] border-[#dd7859] overflow-hidden flex-shrink-0">
        <div class="absolute inset-0 opacity-[0.04] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 text-center">
            <span class="inline-block border border-[#dd7859] text-[#dd7859] text-xs font-bold tracking-widest uppercase px-4 py-1.5 mb-5 rounded-sm bg-slate-900/50">
                Resultados de búsqueda
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight tracking-tight mb-4">
                : <span class="text-[#dd7859]">"<?php echo esc_html($search_query); ?>"</span>
            </h1>
            <p class="text-white/70 text-lg font-light">
                <?php echo count($carreras_encontradas); ?> carreras y <?php echo $wp_query->found_posts; ?> noticias relacionadas.
            </p>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-6 lg:px-10 py-16 w-full">
        <div class="flex items-center gap-3 mb-8 border-b border-slate-200 pb-4">
            <span class="w-3 h-1 bg-[#75232c]"></span>
            <h2 class="text-2xl font-extrabold text-slate-900">Oferta Académica</h2>
            <span class="w-24 h-1 bg-[#75232c]"></span>
        </div>

        <?php if (! empty($carreras_encontradas)) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($carreras_encontradas as $c) :
                    $mod = in_array('modalidad-virtual', $c->class_list) ? 'Virtual' : 'Presencial';
                    $es_pregrado = in_array('nivel-pregrado', $c->class_list);
                    $es_posgrado = in_array('nivel-posgrado', $c->class_list);
                    $nivel_nombre = $es_pregrado ? 'Pregrado' : ($es_posgrado ? 'Posgrado' : 'Grado');

                    // Colores del badge según el nivel
                    $badge_bg = $es_pregrado ? 'bg-[#dd7859]/10' : ($es_posgrado ? 'bg-[#dc5d34]/10' : 'bg-[#75232c]/10');
                    $badge_text = $es_pregrado ? 'text-[#dd7859]' : ($es_posgrado ? 'text-[#dc5d34]' : 'text-[#75232c]');
                    $badge_dot = $es_pregrado ? 'bg-[#dd7859]' : ($es_posgrado ? 'bg-[#dc5d34]' : 'bg-[#75232c]');

                    $link_local = home_url('/carrera/' . $c->slug . '/');
                ?>
                    <article class="group bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-[#75232c]/30 transition-all duration-300 cursor-pointer flex flex-col" onclick="window.location.href='<?php echo esc_url($link_local); ?>';">
                        <div class="h-2 w-full <?php echo $badge_dot; ?>"></div>
                        <div class="p-6 flex flex-col h-full">
                            <div class="flex items-start justify-between gap-2 mb-4">
                                <span class="<?php echo $badge_bg . ' ' . $badge_text; ?> text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-sm flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo $badge_dot; ?>"></span><?php echo esc_html($nivel_nombre); ?>
                                </span>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900 leading-snug group-hover:text-[#75232c] transition-colors mb-6">
                                <a href="<?php echo esc_url($link_local); ?>"><?php echo esc_html($c->title->rendered); ?></a>
                            </h4>
                            <div class="mt-auto pt-4 border-t border-slate-100 text-slate-500 text-xs font-medium uppercase tracking-wider">
                                <?php echo esc_html($mod); ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="bg-white p-8 border border-slate-200 rounded-sm text-center">
                <p class="text-slate-500">No encontramos carreras que coincidan con tu búsqueda.</p>
            </div>
        <?php endif; ?>
    </section>

    <section class="max-w-7xl mx-auto px-6 lg:px-10 pb-20 w-full">
        <div class="flex items-center gap-3 mb-8 border-b border-slate-200 pb-4">

            <span class="w-24 h-1 bg-[#75232c]"></span>
            <h2 class="text-2xl font-extrabold text-slate-900">Noticias relacionadas</h2>
            <span class="w-3 h-1 bg-[#75232c]"></span>

        </div>

        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <?php while (have_posts()) : the_post();
                    $categorias = get_the_category();
                    $cat_nombre = !empty($categorias) ? $categorias[0]->name : 'Institucional';
                    $cat_link = !empty($categorias) ? get_category_link($categorias[0]->term_id) : '#';
                ?>
                    <article class="group bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transform  transition-transform duration-700">
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" class="w-full h-full flex items-center justify-center text-[#75232c]/20 bg-[#75232c]/5 group-hover:bg-[#75232c]/10 transition-colors">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($cat_link); ?>" class="absolute top-4 left-4 bg-white/95 backdrop-blur text-[#75232c] text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-sm shadow-sm hover:bg-[#75232c] hover:text-white transition-colors">
                                <?php echo esc_html($cat_nombre); ?>
                            </a>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-3 text-slate-400 text-xs font-medium mb-3">
                                <time class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    <?php echo get_the_date(); ?>
                                </time>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 leading-snug group-hover:text-[#75232c] transition-colors mb-3">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-3">
                                <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                            </p>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="flex justify-center">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('&larr; Anterior', 'textdomain'),
                    'next_text' => __('Siguiente &rarr;', 'textdomain'),
                ));
                ?>
            </div>

        <?php else : ?>
            <div class="bg-white p-8 border border-slate-200 rounded-sm text-center">
                <p class="text-slate-500">No encontramos noticias que coincidan con tu búsqueda.</p>
            </div>
        <?php endif; ?>
    </section>

</main>

<style>
    .nav-links {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .page-numbers {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 0.75rem;
        background-color: white;
        border: 1px solid #e2e8f0;
        color: #475569;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 0.25rem;
        transition: all 0.2s;
    }

    .page-numbers:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: #75232c;
    }

    .page-numbers.current {
        background-color: #75232c;
        border-color: #75232c;
        color: white;
    }

    .dots {
        border: none;
        background: transparent;
        color: #94a3b8;
    }
</style>

<?php get_footer(); ?>