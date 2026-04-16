<?php get_header(); ?>
<?php get_template_part('template-parts/navbar'); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <main class="w-full pb-20">

            <header class="max-w-7xl mx-auto px-6 pt-16 pb-10">

                <?php
                $categories = get_the_category();
                $cat_name = !empty($categories) ? esc_html($categories[0]->name) : 'Noticias';
                ?>
                <nav class="flex text-[10px] font-bold tracking-[0.2em] uppercase text-slate-400 mb-8" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2">
                        <li><a href="<?php echo home_url(); ?>" class="hover:text-[#75232c] transition-colors">Inicio</a></li>
                        <li><span class="text-slate-300">/</span></li>
                        <li><a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="hover:text-[#75232c] transition-colors">Noticias</a></li>
                        <li><span class="text-slate-300">/</span></li>
                        <li class="text-[#dd7859]"><?php echo $cat_name; ?></li>
                    </ol>
                </nav>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-[1.1] tracking-tight mb-8">
                    <?php the_title(); ?>
                </h1>

                <div class="flex flex-wrap items-center gap-6 text-sm font-medium text-slate-500 border-b border-slate-200 pb-8">


                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <?php echo get_the_date(); ?>
                    </div>
                    <div class="hidden sm:block w-1 h-1 rounded-full bg-slate-300"></div>
                    <div class="flex items-center gap-2 text-[#dd7859]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <?php echo function_exists('fcfmyn_reading_time') ? fcfmyn_reading_time() : '4 min de lectura'; ?>
                    </div>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="max-w-7xl mx-auto px-6 mb-16">
                    <figure class="relative aspect-video lg:aspect-[21/9] overflow-hidden rounded-sm bg-slate-100 shadow-lg">
                        <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
                    </figure>
                    <?php if (get_the_post_thumbnail_caption()) : ?>
                        <figcaption class="text-center text-slate-400 text-xs mt-4 font-medium"><?php the_post_thumbnail_caption(); ?></figcaption>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-8">

                <div class="hidden md:block md:col-span-1 relative">
                    <div class="sticky top-28 flex flex-col gap-4 items-center">
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest writing-vertical-rl  mb-2">Compartir</span>
                        <div class="w-px h-8 bg-slate-200 mb-2"></div>

                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition-all">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-800 hover:border-slate-800 transition-all">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.005 4.223H5.078z" />
                            </svg>
                        </a>

                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-white hover:bg-green-500 hover:border-green-500 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.397-.272.322-1.04 1.016-1.04 2.479 0 1.463 1.065 2.876 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-11 wp-content">
                    <?php the_content(); ?>
                </div>
            </div>

            <?php $tags = get_the_tags();
            if ($tags) : ?>
                <div class="max-w-3xl mx-auto px-6 mt-12 border-t border-slate-200 pt-8">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-bold text-slate-800 uppercase tracking-widest mr-2">Etiquetas:</span>
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-medium px-3 py-1 rounded transition-colors">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </main>

<?php endwhile;
endif; ?>

<section class="bg-slate-50 py-20 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        <div class="flex items-center justify-between mb-12">
            <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight">También te puede interesar</h3>
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="hidden sm:flex items-center gap-2 text-[#75232c] text-xs font-bold uppercase tracking-widest hover:text-[#dd7859] transition-colors">
                Ver más noticias
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php

            $related_args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
            );
            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()) :
                while ($related_query->have_posts()) : $related_query->the_post();


                    $rel_categories = get_the_category();
                    $rel_cat_name = !empty($rel_categories) ? esc_html($rel_categories[0]->name) : 'Noticias';
            ?>
                    <article class="group bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 cursor-pointer" onclick="window.location.href='<?php the_permalink(); ?>';">
                        <div class="aspect-video overflow-hidden bg-slate-200">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            <?php else : ?>
                                <div class="w-full h-full flex items-center justify-center bg-[#75232c]/10 text-[#75232c]">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <span class="text-[#dd7859] text-[10px] font-bold tracking-widest uppercase mb-2 block"><?php echo $rel_cat_name; ?></span>
                            <h4 class="text-lg font-bold text-slate-800 leading-snug group-hover:text-[#75232c] transition-colors mb-3">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <p class="text-slate-400 text-xs font-medium"><?php echo get_the_date(); ?></p>
                        </div>
                    </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<style>
    body {
        font-family: 'Inter', sans-serif;
    }


    .wp-content p {
        margin-bottom: 1.5rem;
        color: #334155;
        line-height: 1.8;
        font-size: 1.125rem;
        font-weight: 300;
    }

    .wp-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 3rem;
        margin-bottom: 1rem;
        line-height: 1.2;
        letter-spacing: -0.025em;
    }

    .wp-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1e293b;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }

    .wp-content ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
        color: #334155;
        font-weight: 300;
        line-height: 1.8;
    }

    .wp-content li {
        margin-bottom: 0.5rem;
    }

    .wp-content a {
        color: #dd7859;
        font-weight: 500;
        text-decoration: underline;
        text-decoration-color: rgba(221, 120, 89, 0.3);
        text-underline-offset: 4px;
        transition: all 0.2s;
    }

    .wp-content a:hover {
        text-decoration-color: #dd7859;
        color: #75232c;
    }

    .wp-content blockquote {
        border-left: 4px solid #75232c;
        background: #f8fafc;
        padding: 2rem;
        margin: 2.5rem 0;
        border-radius: 0 0.5rem 0.5rem 0;
    }

    .wp-content blockquote p {
        margin-bottom: 0;
        font-size: 1.5rem;
        font-style: italic;
        color: #1e293b;
        font-weight: 500;
        line-height: 1.5;
    }


    .wp-content>p:first-of-type::first-letter {
        color: #75232c;
        float: left;
        font-size: 4.5rem;
        line-height: 1;
        font-weight: 800;
        margin-right: 0.75rem;
        margin-top: -0.25rem;
    }
</style>

<?php get_footer(); ?>