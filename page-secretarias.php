<?php


get_header();
get_template_part('template-parts/navbar');
?>

<section id="secretarias" class="pt-28 bg-[#FFF7F5] min-h-screen">
    <div class="max-w-7xl mx-auto px-3">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-16">
            <div>
                <h2 class="text-[clamp(2.5rem,5vw,4rem)] font-semibold text-[#75232c] leading-none">
                    <?php single_post_title(); ?>
                </h2>
            </div>

            <?php if (has_excerpt()) : ?>
                <p class="text-slate-500 text-sm leading-relaxed max-w-xs font-semibold">
                    <?php echo get_the_excerpt(); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>

    <div class="tarjetas py-4">
        <div class="max-w-7xl mx-auto px-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <?php

                $args = array(
                    'post_type'      => 'page',
                    'post_parent'    => get_the_ID(),
                    'order'          => 'ASC',
                    'orderby'        => 'menu_order',
                    'posts_per_page' => -1,
                );

                $secretarias_query = new WP_Query($args);


                $colores = ['#dc5d34', '#cf2e2e', '#75232c', '#dd7859'];
                $i = 0;

                if ($secretarias_query->have_posts()) :
                    while ($secretarias_query->have_posts()) : $secretarias_query->the_post();

                        $color_actual = $colores[$i % count($colores)];
                        $i++;
                ?>

                        <div class="bg-white p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group rounded-sm flex flex-col justify-between">
                            <div>
                                <h3 class="text-[1.2rem] font-semibold text-[#75232c] mb-2">
                                    <?php the_title(); ?>
                                </h3>

                                <div class="text-slate-500 text-[13px] leading-relaxed font-semibold">
                                    <?php
                                    if (has_excerpt()) {
                                        the_excerpt();
                                    } else {
                                        echo wp_trim_words(get_the_content(), 15, '...');
                                    }
                                    ?>
                                </div>
                            </div>

                            <a href="<?php the_permalink(); ?>"
                                style="color: <?php echo $color_actual; ?>"
                                class="inline-flex items-center gap-1.5 text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200">
                                Ver secretaría
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();  
                else :
                    ?>
                    <p class="text-slate-500">Aún no se han cargado las secretarías.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>