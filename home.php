<?php
get_header();
get_template_part('template-parts/navbar');


$titulo_pagina = 'Noticias FCFMyN';
$descripcion_pagina = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
$badge_texto = 'Actualidad';

if (is_category()) {
    $titulo_pagina = single_cat_title('', false);
    $desc = category_description();
    $descripcion_pagina = $desc ? wp_strip_all_tags($desc) : 'Explorá todas las noticias relacionadas con esta categoría institucional.';
    $badge_texto = 'Categoría';
} elseif (is_tag()) {
    $titulo_pagina = single_tag_title('#', false);
    $descripcion_pagina = 'Noticias, comunicados...';
    $badge_texto = 'Etiqueta';
} elseif (is_search()) {
    $titulo_pagina = 'Resultados de búsqueda';
    $descripcion_pagina = 'Has buscado: "' . get_search_query() . '"';
    $badge_texto = 'Búsqueda';
}
?>

<main class="bg-[#fdfbfb] min-h-screen flex flex-col">

    <header class="relative bg-[#75232c] pt-20 pb-28  overflow-hidden flex-shrink-0">


        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10">
            <nav class="flex text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="<?php echo home_url(); ?>" class="hover:text-white transition-colors">Inicio</a></li>
                    <li><span class="text-white/30">/</span></li>
                    <?php if (!is_home()): ?>
                        <li><a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="hover:text-white transition-colors">Noticias</a></li>
                        <li><span class="text-white/30">/</span></li>
                    <?php endif; ?>
                    <li class="text-[#dd7859] truncate max-w-[200px]"><?php echo esc_html($titulo_pagina); ?></li>
                </ol>
            </nav>

            <div class="max-w-3xl">
                <span class="inline-block border border-[#dd7859] text-[#dd7859] text-xs font-bold tracking-widest uppercase px-4 py-1.5 mb-5 rounded-sm bg-[#75232c]/50">
                    <?php echo esc_html($badge_texto); ?>
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight mb-6">
                    <?php echo esc_html($titulo_pagina); ?>
                </h1>
                <p class="text-white/80 text-lg leading-relaxed font-light">
                    <?php echo esc_html($descripcion_pagina); ?>
                </p>
            </div>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-6 lg:px-10 py-16 flex-grow w-full">

        <div class="flex items-center justify-between mb-10 border-b border-slate-200 pb-4">
            <h2 class="text-2xl font-bold text-slate-800">Últimas noticias</h2>
            <span class="text-slate-500 text-sm font-medium"><?php echo $wp_query->found_posts; ?> noticias</span>
        </div>

        <?php if (have_posts()) : ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <?php while (have_posts()) : the_post();


                    $categorias = get_the_category();
                    $cat_nombre = !empty($categorias) ? $categorias[0]->name : 'Institucional';
                    $cat_link = !empty($categorias) ? get_category_link($categorias[0]->term_id) : '#';
                ?>

                    <article class="group bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-[1px] transition-all duration-300 flex flex-col h-full">

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
                                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                <span class="flex items-center gap-1 text-[#dd7859]">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <?php echo function_exists('fcfmyn_reading_time') ? fcfmyn_reading_time() : 'Lectura rápida'; ?>
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-slate-900 leading-snug group-hover:text-[#75232c] transition-colors mb-3">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-6">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </p>


                        </div>
                    </article>

                <?php endwhile; ?>
            </div>

            <div class="fcfmyn-pagination flex justify-center w-full">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('&larr; Anterior', 'textdomain'),
                    'next_text' => __('Siguiente &rarr;', 'textdomain'),
                ));
                ?>
            </div>

        <?php else : ?>

            <div class="flex flex-col items-center justify-center py-24 text-center border-2 border-dashed border-slate-200 rounded-sm bg-white">
                <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="text-2xl font-bold text-slate-800 mb-2">No hay publicaciones aún</h3>
                <p class="text-slate-500 text-base">Pronto publicaremos novedades en esta sección.</p>
                <a href="<?php echo home_url(); ?>" class="mt-6 bg-[#75232c] text-white text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-sm hover:bg-[#dd7859] transition-colors">Volver al inicio</a>
            </div>

        <?php endif; ?>

    </section>
</main>

<style>
    .fcfmyn-pagination .nav-links {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .fcfmyn-pagination .page-numbers {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 0.75rem;
        background-color: white;
        border: 1px solid #e2e8f0;
        /* slate-200 */
        color: #475569;
        /* slate-600 */
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 0.375rem;
        /* rounded-md */
        transition: all 0.2s;
    }

    .fcfmyn-pagination .page-numbers:hover {
        background-color: #f8fafc;
        /* slate-50 */
        border-color: #cbd5e1;
        /* slate-300 */
        color: #75232c;
    }

    .fcfmyn-pagination .page-numbers.current {
        background-color: #75232c;
        border-color: #75232c;
        color: white;
    }

    .fcfmyn-pagination .dots {
        border: none;
        background: transparent;
        color: #94a3b8;
    }
</style>

<?php get_footer(); ?>