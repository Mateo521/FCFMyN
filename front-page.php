<?php

/**
 * Template Name: Front Page
 */
get_header();
?>

<section class="relative w-full h-screen flex items-center overflow-hidden bg-slate-900">
    <div class="swiper heroSwiper absolute inset-0 w-full h-full z-0">
        <div class="swiper-wrapper">

            <?php
            $args_slider = array(
                'post_type'      => 'slider_home',
                'posts_per_page' => -1,
                'order'          => 'ASC'
            );
            $slider_query = new WP_Query($args_slider);

            if ($slider_query->have_posts()) :
                while ($slider_query->have_posts()) : $slider_query->the_post();


                    $es_video = get_field('es_video');
                    $url_video = get_field('url_video');
                    $bajada = get_field('bajada');
                    $imagen_fondo = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>

                    <div class="swiper-slide relative flex items-center">
                        <?php if ($es_video && $url_video) : ?>
                            <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
                                <source src="<?php echo esc_url($url_video); ?>" type="video/mp4">
                            </video>
                        <?php elseif ($imagen_fondo) : ?>
                            <img src="<?php echo esc_url($imagen_fondo); ?>" alt="<?php the_title_attribute(); ?>" class="absolute inset-0 w-full h-full object-cover z-0">
                        <?php endif; ?>

                        <div class="absolute inset-0 bg-slate-900/60 bg-gradient-to-r from-[#75232c]/90 via-[#75232c]/60 to-transparent z-10"></div>

                        <div class="relative z-20 max-w-7xl mx-auto flex flex-col justify-center h-full px-6 lg:px-10 w-full pt-16">
                            <div class="flex flex-col items-start lg:w-2/3">
                                <img class="h-16 lg:h-20 mb-8 invert brightness-0 opacity-90" src="https://fmnvz.unsl.edu.ar/wp-content/uploads/2019/11/Logo-Horizontal.svg" alt="Logo FCFMyN">
                                <h2 class="text-5xl lg:text-7xl font-bold text-white tracking-tight mb-6 leading-tight">
                                    <?php the_title(); ?>
                                </h2>
                                <?php if ($bajada) : ?>
                                    <p class="text-white/80 text-lg leading-relaxed max-w-xl font-light mb-10">
                                        <?php echo esc_html($bajada); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>

        </div>

        <div class="absolute bottom-10 right-6 lg:right-10 z-50 flex gap-4">
            <button class="swiper-btn-prev w-12 h-12 rounded-full border border-white/30 flex items-center justify-center text-white hover:bg-white hover:text-[#75232c] transition-all duration-300 backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <button class="swiper-btn-next w-12 h-12 rounded-full border border-white/30 flex items-center justify-center text-white hover:bg-white hover:text-[#75232c] transition-all duration-300 backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
        <div class="swiper-pagination !bottom-10 !w-auto !left-6 lg:!left-10"></div>
    </div>
</section>


<?php get_template_part('template-parts/navbar'); ?>

<section id="carreras" class="py-28 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-16">
            <div>
                <h2 class="s text-[clamp(2.5rem,5vw,4rem)] font-semibold text-[#75232c] leading-none">
                    Carreras por duración
                </h2>
            </div>
            <p class="text-slate-500 text-sm leading-relaxed max-w-xs font-semibold">
                Explorá nuestra oferta académica.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-100">

            <div class="bg-white p-9 flex flex-col h-[550px]">
                <div class="flex items-start justify-between mb-8 flex-shrink-0">
                    <div>
                        <span class="text-[#dd7859] text-sm font-semibold uppercase">Pregrado</span>
                        <h3 class="s text-2xl font-semibold text-[#75232c] mt-1.5">Carreras Cortas</h3>
                        <p class="text-slate-400 text-base mt-0.5 tracking-wide"> 2-3 años</p>
                    </div>
                </div>
                <div class="h-px bg-[#dd7859]/20 mb-7 flex-shrink-0"></div>
                <div class="flex-grow overflow-hidden relative">
                    <ul class="space-y-4 h-full overflow-y-auto pr-4 custom-scroll scroll-fade">
                        <?php
                        $pregrado = new WP_Query(array(
                            'post_type' => 'carrera',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array('taxonomy' => 'nivel_academico', 'field' => 'slug', 'terms' => 'pregrado')
                            )
                        ));
                        if ($pregrado->have_posts()): while ($pregrado->have_posts()): $pregrado->the_post(); ?>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#dd7859] mt-2 flex-shrink-0"></span>
                                    <div>
                                        <a href="<?php the_permalink(); ?>" class="text-[13px] font-medium text-slate-700 leading-snug hover:text-[#dd7859] transition-colors"><?php the_title(); ?></a>
                                        <p class="text-slate-400 text-sm mt-0.5"><?php echo esc_html(get_field('modalidad')); ?> · <?php echo esc_html(get_field('duracion')); ?></p>
                                    </div>
                                </li>
                        <?php endwhile;
                            wp_reset_postdata();
                        endif; ?>
                    </ul>
                </div>
            </div>

            <div class="grado p-9 rounded flex flex-col h-[550px] transform md:-translate-y-4 shadow-xl relative z-10">
                <div class="flex items-start justify-between mb-8 flex-shrink-0">
                    <div>
                        <span class="text-[#dd7859]/70 text-sm font-semibold uppercase">Grado</span>
                        <h3 class="s text-2xl font-semibold text-white mt-1.5">Licenciatura / Ingeniería</h3>
                        <p class="text-base text-white mt-0.5 tracking-wide"> 4-5 años</p>
                    </div>
                </div>
                <div class="h-px bg-white/15 mb-7 flex-shrink-0"></div>
                <div class="flex-grow overflow-hidden relative">
                    <ul class="space-y-4 h-full overflow-y-auto pr-4 custom-scroll-dark scroll-fade">
                        <?php
                        $grado = new WP_Query(array(
                            'post_type' => 'carrera',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array('taxonomy' => 'nivel_academico', 'field' => 'slug', 'terms' => 'grado')
                            )
                        ));
                        if ($grado->have_posts()): while ($grado->have_posts()): $grado->the_post(); ?>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#dd7859] mt-2 flex-shrink-0"></span>
                                    <div>
                                        <a href="<?php the_permalink(); ?>" class="text-[13px] font-medium text-white/90 leading-snug hover:text-[#dd7859] transition-colors"><?php the_title(); ?></a>
                                        <p class="text-white/40 text-sm mt-0.5"><?php echo esc_html(get_field('modalidad')); ?> · <?php echo esc_html(get_field('duracion')); ?></p>
                                    </div>
                                </li>
                        <?php endwhile;
                            wp_reset_postdata();
                        endif; ?>
                    </ul>
                </div>
            </div>

            <div class="bg-white p-9 flex flex-col h-[550px]">
                <div class="flex items-start justify-between mb-8 flex-shrink-0">
                    <div>
                        <span class="text-[#dc5d34] text-sm font-semibold uppercase">Posgrado</span>
                        <h3 class="s text-2xl font-semibold text-[#75232c] mt-1.5">Maestría / Doctorado</h3>
                        <p class="text-slate-400 text-base mt-0.5 tracking-wide">Especialización</p>
                    </div>
                </div>
                <div class="h-px bg-[#dc5d34]/20 mb-7 flex-shrink-0"></div>
                <div class="flex-grow overflow-hidden relative">
                    <ul class="space-y-4 h-full overflow-y-auto pr-4 custom-scroll scroll-fade">
                        <?php
                        $posgrado = new WP_Query(array(
                            'post_type' => 'carrera',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array('taxonomy' => 'nivel_academico', 'field' => 'slug', 'terms' => 'posgrado')
                            )
                        ));
                        if ($posgrado->have_posts()): while ($posgrado->have_posts()): $posgrado->the_post(); ?>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#dc5d34] mt-2 flex-shrink-0"></span>
                                    <div>
                                        <a href="<?php the_permalink(); ?>" class="text-[13px] font-medium text-slate-700 leading-snug hover:text-[#dc5d34] transition-colors"><?php the_title(); ?></a>
                                        <p class="text-slate-400 text-sm mt-0.5"><?php echo esc_html(get_field('modalidad')); ?></p>
                                    </div>
                                </li>
                        <?php endwhile;
                            wp_reset_postdata();
                        endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="disciplinas" class="py-28 bg-[#faf8f6]">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">






            <a href="<?php echo home_url('/disciplina/electronica'); ?>"
                class="group bg-white p-8 hover:bg-[#75232c] transition-colors duration-300 relative rounded-sm overflow-hidden">
                <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                <div class="relative flex flex-col items-end">
                    <div class="w-12 h-12 mb-6 flex items-center justify-center">
                        <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="14" y="14" width="20" height="20" rx="2" stroke="#dd7859" stroke-width="1.5" />
                            <line x1="8" y1="20" x2="14" y2="20" stroke="#dd7859" stroke-width="1.5" />
                            <line x1="8" y1="28" x2="14" y2="28" stroke="#dd7859" stroke-width="1.5" />
                            <line x1="34" y1="20" x2="40" y2="20" stroke="#dd7859" stroke-width="1.5" />
                            <line x1="34" y1="28" x2="40" y2="28" stroke="#dd7859" stroke-width="1.5" />
                            <line x1="20" y1="8" x2="20" y2="14" stroke="#dd7859" stroke-width="1.5" />
                            <line x1="28" y1="8" x2="28" y2="14" stroke="#dd7859" stroke-width="1.5" />
                            <line x1="20" y1="34" x2="20" y2="40" stroke="#dd7859" stroke-width="1.5" />
                            <line x1="28" y1="34" x2="28" y2="40" stroke="#dd7859" stroke-width="1.5" />
                            <circle cx="24" cy="24" r="3" fill="#dd7859" opacity="0.7" />
                        </svg>
                    </div>
                    <h3
                        class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                        Electrónica</h3>
                    <p
                        class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                        Diseño de sistemas electrónicos, telecomunicaciones y procesamiento de señales.
                    </p>
                    <div
                        class="flex items-center gap-2 text-[#dd7859] group-hover:text-[#dd7859] text-sm font-semibold  uppercase">
                        <span>1 carrera</span>
                        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </a>


            <a href="<?php echo home_url('/disciplina/fisica'); ?>"
                class="group bg-white p-8 hover:bg-[#75232c] transition-colors duration-300 relative rounded-sm overflow-hidden">
                <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                <div class="relative flex flex-col items-end">
                    <div class="w-12 h-12 mb-6 flex items-center justify-center">
                        <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <ellipse cx="24" cy="24" rx="18" ry="7" stroke="#cf2e2e" stroke-width="1.5" opacity="0.8" />
                            <ellipse cx="24" cy="24" rx="18" ry="7" stroke="#cf2e2e" stroke-width="1.5" opacity="0.5"
                                transform="rotate(60 24 24)" />
                            <ellipse cx="24" cy="24" rx="18" ry="7" stroke="#cf2e2e" stroke-width="1.5" opacity="0.5"
                                transform="rotate(120 24 24)" />
                            <circle cx="24" cy="24" r="3.5" fill="#cf2e2e" opacity="0.85" />
                        </svg>
                    </div>
                    <h3
                        class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                        Física</h3>
                    <p
                        class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                        Física teórica, experimental y aplicada. Formación en investigación científica de frontera.
                    </p>
                    <div
                        class="flex items-center gap-2 text-[#cf2e2e] group-hover:text-[#dd7859] text-sm font-semibold  uppercase transition-colors duration-300">
                        <span>3 carreras</span>
                        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </a>


            <a href="<?php echo home_url('/disciplina/geologia'); ?>"
                class="group bg-white p-8 hover:bg-[#75232c] transition-colors duration-300 relative rounded-sm overflow-hidden">
                <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                <div class="relative flex flex-col items-end">
                    <div class="w-12 h-12 mb-6 flex items-center justify-center">
                        <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Mountain layers -->
                            <path d="M6 38 L18 16 L24 26 L30 18 L42 38 Z" stroke="#dc5d34" stroke-width="1.5"
                                stroke-linejoin="round" fill="none" opacity="0.85" />
                            <line x1="6" y1="32" x2="42" y2="32" stroke="#dc5d34" stroke-width="0.8" opacity="0.35"
                                stroke-dasharray="3,2" />
                            <line x1="6" y1="26" x2="42" y2="26" stroke="#dc5d34" stroke-width="0.8" opacity="0.25"
                                stroke-dasharray="3,2" />
                        </svg>
                    </div>
                    <h3
                        class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                        Geología</h3>
                    <p
                        class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                        Estudio de la tierra, sus recursos, estructura y dinámica. Geología ambiental y aplicada.
                    </p>
                    <div
                        class="flex items-center gap-2 text-[#dc5d34] group-hover:text-[#dd7859] text-sm font-semibold  uppercase transition-colors duration-300">
                        <span>3 carreras</span>
                        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </a>


            <a href="<?php echo home_url('/disciplina/informatica'); ?>"
                class="group bg-white p-8 hover:bg-[#75232c] transition-colors duration-300 relative rounded-sm overflow-hidden">
                <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                <div class="relative flex flex-col items-end">
                    <div class="w-12 h-12 mb-6 flex items-center justify-center">
                        <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="10" width="36" height="24" rx="2" stroke="#dd7859" stroke-width="1.5" />
                            <line x1="17" y1="38" x2="31" y2="38" stroke="#dd7859" stroke-width="1.5" stroke-linecap="round" />
                            <line x1="24" y1="34" x2="24" y2="38" stroke="#dd7859" stroke-width="1.5" />
                            <text x="11" y="27" font-family="monospace" font-size="10" fill="#dd7859" opacity="0.6">&lt;/&gt;</text>
                        </svg>
                    </div>
                    <h3
                        class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                        Informática</h3>
                    <p
                        class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                        Ciencias de la computación, inteligencia artificial, software y redes de datos.
                    </p>
                    <div
                        class="flex items-center gap-2 text-[#75232c] group-hover:text-[#dd7859] text-sm font-semibold  uppercase transition-colors duration-300">
                        <span>4 carreras</span>
                        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </a>


            <a href="<?php echo home_url('/disciplina/matematica'); ?>"
                class="group bg-white p-8 hover:bg-[#75232c]  transition-colors duration-300 relative rounded-sm overflow-hidden">
                <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                <div class="relative flex flex-col items-end">
                    <div class="w-12 h-12 mb-6 flex items-center justify-center">
                        <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Integral symbol -->
                            <text x="8" y="36" font-family="Georgia,serif" font-size="32" fill="#dd7859" opacity="0.85"
                                font-weight="300">∫</text>
                            <text x="26" y="22" font-family="Georgia,serif" font-size="14" fill="#dd7859" opacity="0.5"
                                font-weight="300">π</text>
                            <text x="28" y="36" font-family="Georgia,serif" font-size="12" fill="#dd7859" opacity="0.45">dx</text>
                        </svg>
                    </div>
                    <h3
                        class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                        Matemática</h3>
                    <p
                        class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                        Álgebra, análisis, estadística y matemática aplicada. Formación pura y docente.
                    </p>
                    <div
                        class="flex items-center gap-2 text-[#dd7859] group-hover:text-[#dd7859] text-sm font-semibold  uppercase transition-colors duration-300">
                        <span>3 carreras</span>
                        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </a>


            <a href="<?php echo home_url('/disciplina/mineria'); ?>"
                class="group bg-white p-8 hover:bg-[#75232c] transition-colors duration-300 relative rounded-sm overflow-hidden">
                <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                <div class="relative flex flex-col items-end">
                    <div class="w-12 h-12 mb-6 flex items-center justify-center">
                        <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Crystal / hexagon -->
                            <polygon points="24,6 38,15 38,33 24,42 10,33 10,15" stroke="#cf2e2e" stroke-width="1.5" fill="none"
                                opacity="0.85" />
                            <line x1="24" y1="6" x2="24" y2="42" stroke="#cf2e2e" stroke-width="0.7" opacity="0.3" />
                            <line x1="10" y1="15" x2="38" y2="33" stroke="#cf2e2e" stroke-width="0.7" opacity="0.3" />
                            <line x1="10" y1="33" x2="38" y2="15" stroke="#cf2e2e" stroke-width="0.7" opacity="0.3" />
                            <circle cx="24" cy="24" r="2.5" fill="#cf2e2e" opacity="0.6" />
                        </svg>
                    </div>
                    <h3
                        class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                        Minería</h3>
                    <p
                        class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                        Ingeniería de minas, procesamiento de minerales y desarrollo de industrias extractivas.
                    </p>
                    <div
                        class="flex items-center gap-2 text-[#cf2e2e] group-hover:text-[#dd7859] text-sm font-semibold  uppercase transition-colors duration-300">
                        <span>2 carreras</span>
                        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </a>


        </div>
    </div>
</section>

<section class="ingreso relative py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-8">
        <div>

            <div class="flex flex-col">
                <h3
                    class="s text-2xl lg:text-5xl font-semibold bg-gradient-to-r from-[#FFDEDE] via-[#FFC4C4] to-[#FFEDED] inline-block text-transparent bg-clip-text leading-snug">
                    Ingreso 2025<br class="hidden sm:block">
                </h3>
                <p class="text-[#FFDEDE] text-2xl leading-relaxed max-w-xs font-semibold">
                    Inscripciones abiertas
                </p>
            </div>
        </div>
        <div class="flex flex-wrap gap-3 flex-shrink-0">
            <a href="#"
                class="bg-white hover:bg-[#faf8f6] text-[#75232c] text-sm font-semibold  uppercase px-8 py-3.5 transition-colors duration-200">
                Inscribirme
            </a>
            <a href="#"
                class="border border-white/40 hover:border-white text-white text-sm font-semibold  uppercase px-8 py-3.5 transition-colors duration-200">
                Más información
            </a>
        </div>
    </div>


</section>

<section class="py-28 bg-white border-t border-slate-100 relative overflow-hidden">

    <div class="absolute -top-10 -right-16 text-[#75232c] opacity-[0.05] pointer-events-none z-0">
        <svg class="w-[300px] h-[300px]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10">

        <!--div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-16 border-b border-slate-100 pb-10">
            <div>
                <p class="text-[#dc5d34] text-xs font-bold uppercase tracking-widest mb-3">Comunidad FCFMyN</p>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-[1.1] tracking-tight">Voces que Inspiran</h2>
            </div>
            <p class="text-slate-500 text-sm leading-relaxed max-w-sm font-medium">Nuestros egresados y las mentes más brillantes te motivan a seguir tu camino con pasión y determinación.</p>
        </div-->

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <article class="group bg-slate-50 p-8 shadow-sm flex flex-col hover:shadow-2xl transition-all duration-500 rounded-sm border-t-4 border-transparent hover:border-[#75232c] relative">

                <div class="absolute top-6 left-8 text-[#75232c] opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>
                </div>

                <p class="text-slate-700 text-lg leading-relaxed italic mb-10 relative z-10 pt-16">
                    "La vida no es fácil para ninguno de nosotros. ¿Pero qué importa? Hay que tener perseverancia y, sobre todo, confianza en uno mismo."
                </p>

                <div class="flex items-center gap-4 mt-auto">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Marie_Curie_c._1920s.jpg/960px-Marie_Curie_c._1920s.jpg" alt="Dra. Marie Curie" class="w-14 h-14 rounded-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 border-2 border-slate-100">
                    <div>
                        <h4 class="text-slate-900 font-bold text-sm">Dra. Marie Curie</h4>
                        <p class="text-[#dc5d34] text-[10px] font-bold uppercase tracking-widest mt-0.5">Física y Química, Premio Nobel</p>
                        <p class="text-slate-400 text-xs mt-0.5">Una mente inquebrantable</p>
                    </div>
                </div>
            </article>

            <article class="group bg-slate-50 p-8 shadow-sm hover:shadow-2xl flex flex-col transition-all duration-500 rounded-sm border-t-4 border-transparent hover:border-[#75232c] relative">

                <div class="absolute top-6 left-8 text-[#75232c] opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>
                </div>

                <p class="text-slate-700 text-lg leading-relaxed italic mb-10 relative z-10 pt-16">
                    "Tu tiempo es limitado, así que no lo desperdicies viviendo la vida de otra persona... Ten el coraje de seguir tu corazón e intuición."
                </p>

                <div class="flex items-center gap-4 mt-auto">
                    <img src="https://i.blogs.es/c3747a/steve-jobs-presentacion/375_375.webp" alt="Steve Jobs" class="w-14 h-14 rounded-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 border-2 border-slate-100">
                    <div>
                        <h4 class="text-slate-900 font-bold text-sm">Steve Jobs</h4>
                        <p class="text-[#dc5d34] text-[10px] font-bold uppercase tracking-widest mt-0.5">Cofundador de Apple, Visionario</p>
                        <p class="text-slate-400 text-xs mt-0.5">Pionero tecnológico</p>
                    </div>
                </div>
            </article>

            <article class="group bg-slate-50 p-8 shadow-sm hover:shadow-2xl flex flex-col transition-all duration-500 rounded-sm border-t-4 border-transparent hover:border-[#75232c] relative">

                <div class="absolute top-6 left-8 text-[#75232c] opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>
                </div>

                <p class="text-slate-700 text-lg leading-relaxed italic mb-10 relative z-10 pt-16">
                    "Lo importante es no dejar de hacerse preguntas. La curiosidad tiene su propia razón de existir."
                </p>

                <div class="flex items-center gap-4 mt-auto">
                    <img src="https://tn.com.ar/resizer/v2/albert-einstein-dijo-hace-76-anos-una-persona-que-nunca-cometio-un-error-nunca-intenta-nada-nuevo-foto-imagen-ilustrativa-generada-con-ia-gemini-U63XFC2FWBADTCWSKIZBXFXZAI.png?auth=93308080279845d8096032072bb13b33c3ab085afdd411c04e8430a9b8180bcf&width=767" alt="Prof. Albert Einstein" class="w-14 h-14 rounded-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 border-2 border-slate-100">
                    <div>
                        <h4 class="text-slate-900 font-bold text-sm">Prof. Albert Einstein</h4>
                        <p class="text-[#dc5d34] text-[10px] font-bold uppercase tracking-widest mt-0.5">Físico Teórico, Premio Nobel</p>
                        <p class="text-slate-400 text-xs mt-0.5">La curiosidad eterna</p>
                    </div>
                </div>
            </article>

        </div>
    </div>
</section>

<style>
    .custom-scroll-horizontal::-webkit-scrollbar {
        height: 6px;
    }

    .custom-scroll-horizontal::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scroll-horizontal::-webkit-scrollbar-thumb {
        background: rgba(117, 35, 44, 0.2);
        /* Rojo institucional con baja opacidad */
        border-radius: 10px;
    }

    .custom-scroll-horizontal:hover::-webkit-scrollbar-thumb {
        background: rgba(117, 35, 44, 0.5);
    }
</style>


<section id="secretarias" class="pt-28 bg-[#FFF7F5]">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">


        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-16">
            <div>

                <h2 class="s text-[clamp(2.5rem,5vw,4rem)] font-semibold text-[#75232c] leading-none">Secretarías</h2>
                <!--div class="w-12 h-px bg-[#dd7859] mt-5"></div-->
            </div>
            <p class="text-slate-500 text-sm leading-relaxed max-w-xs font-semibold">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, inventore corrupti!
            </p>
        </div>


    </div>






    <div class="tarjetas py-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">


                <div
                    class="bg-white  p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group">
                    <!--div
            class="w-11 h-11 bg-[#faf8f6] flex items-center justify-center mb-6 group-hover:bg-[#dd7859]/10 transition-colors duration-300">
            <svg class="w-5 h-5 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-1.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
          </div-->
                    <h3 class="s text-[1.2rem] font-semibold text-[#75232c] mb-2">Secretaría Académica</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed font-semibold">Gestión de planes de estudio, seguimiento
                        estudiantil y articulación con departamentos docentes.</p>
                    <a href="#"
                        class="inline-flex items-center gap-1.5 text-[#dc5d34] text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200 group/link">
                        Ver secretaría
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>


                <div
                    class="bg-white  p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group">
                    <!--div
            class="w-11 h-11 bg-[#faf8f6] flex items-center justify-center mb-6 group-hover:bg-[#cf2e2e]/10 transition-colors duration-300">
            <svg class="w-5 h-5 text-[#cf2e2e]" fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
            </svg>
          </div-->
                    <h3 class="s text-[1.2rem] font-semibold text-[#75232c] mb-2">Secretaría Administrativa</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed font-semibold">Recursos humanos, presupuesto,
                        infraestructura y servicios generales de la unidad académica.</p>
                    <a href="#"
                        class="inline-flex items-center gap-1.5 text-[#cf2e2e] text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200">
                        Ver secretaría
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>


                <div
                    class="bg-white  p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group">
                    <!--div
            class="w-11 h-11 bg-[#faf8f6] flex items-center justify-center mb-6 group-hover:bg-[#dc5d34]/10 transition-colors duration-300">
            <svg class="w-5 h-5 text-[#dc5d34]" fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 1-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
            </svg>
          </div-->
                    <h3 class="s text-[1.2rem] font-semibold text-[#75232c] mb-2">Investigación y Posgrado</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed font-semibold">Articulación de proyectos de
                        investigación,
                        grupos de investigación y programas de posgrado.</p>
                    <a href="#"
                        class="inline-flex items-center gap-1.5 text-[#dc5d34] text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200">
                        Ver secretaría
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>


                <div
                    class="bg-white  p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group">
                    <!--div
            class="w-11 h-11 bg-[#faf8f6] flex items-center justify-center mb-6 group-hover:bg-[#75232c]/10 transition-colors duration-300">
            <svg class="w-5 h-5 text-[#75232c]" fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
            </svg>
          </div-->

                    <h3 class="s text-[1.2rem] font-semibold text-[#75232c] mb-2">Secretaría General</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed font-semibold">Actas de Consejo Directivo, resoluciones
                        decanales y coordinación institucional general.</p>
                    <a href="#"
                        class="inline-flex items-center gap-1.5 text-[#75232c] text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200">
                        Ver secretaría
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>


                <div
                    class="bg-white  p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group">
                    <!--div
            class="w-11 h-11 bg-[#faf8f6] flex items-center justify-center mb-6 group-hover:bg-[#dd7859]/10 transition-colors duration-300">
            <svg class="w-5 h-5 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
            </svg>
          </div-->
                    <h3 class="s text-[1.2rem] font-semibold text-[#75232c] mb-2">Vinculación y Extensión</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed font-semibold">Proyectos de extensión universitaria,
                        transferencia tecnológica y vínculos con el medio productivo y social.</p>
                    <a href="#"
                        class="inline-flex items-center gap-1.5 text-[#dd7859] text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200">
                        Ver secretaría
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

            </div><!-- /grid -->
        </div>
    </div>
</section>



<section id="noticias" class="py-28 bg-[#fdfbfb] border-t relative overflow-hidden z-0 border-slate-100">

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-16">
            <div>
                <p class="text-[#dc5d34] text-sm font-semibold uppercase mb-3">Actualidad FCFMyN</p>
                <h2 class="s text-[clamp(2.5rem,5vw,4rem)] font-semibold text-[#75232c] leading-none">Noticias</h2>
            </div>
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="group flex items-center gap-2 text-[#75232c] text-sm font-semibold uppercase transition-colors hover:text-[#dd7859]">
                Ver todas las noticias
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

            <?php
            $noticia_principal = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 1));
            if ($noticia_principal->have_posts()): $noticia_principal->the_post();
                $categoria = get_the_category();
                $nombre_cat = !empty($categoria) ? esc_html($categoria[0]->name) : 'Noticias';
            ?>
                <article class="lg:col-span-7 group cursor-pointer" onclick="window.location.href='<?php the_permalink(); ?>';">
                    <div class="relative overflow-hidden rounded-sm mb-6 aspect-video bg-slate-200">
                        <img src="<?php echo get_the_post_thumbnail_url() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&q=80&w=1200'; ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transform transition-transform duration-700 ease-out ">
                        <div class="absolute top-4 left-4 bg-[#75232c] text-white text-sm font-semibold tracking-widest uppercase px-3 py-1.5 shadow-md">
                            <?php echo $nombre_cat; ?>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 text-slate-400 text-xs font-medium mb-3">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            <?php echo get_the_date(); ?>
                        </span>


                    </div>

                    <h3 class="text-2xl lg:text-3xl font-bold text-slate-800 group-hover:text-[#75232c] leading-tight mb-4 transition-colors duration-300">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="text-slate-600 leading-relaxed text-sm">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php wp_reset_postdata();
            endif; ?>


            <div class="lg:col-span-5 flex flex-col justify-between">
                <h4 class="text-slate-800 font-bold text-lg mb-6 flex items-center gap-3">
                    <span class="w-6 h-[2px] bg-[#dd7859]"></span> Últimas noticias
                </h4>

                <div class="space-y-6">
                    <?php
                    $noticias_secundarias = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'offset' => 1
                    ));

                    if ($noticias_secundarias->have_posts()):
                        while ($noticias_secundarias->have_posts()): $noticias_secundarias->the_post();
                            $categoria_sec = get_the_category();
                            $nombre_cat_sec = !empty($categoria_sec) ? esc_html($categoria_sec[0]->name) : 'Noticias';
                    ?>
                            <article class="group cursor-pointer grid grid-cols-4 gap-4 items-center" onclick="window.location.href='<?php the_permalink(); ?>';">
                                <div class="col-span-1 overflow-hidden rounded-sm aspect-square bg-slate-200">
                                    <?php if (has_post_thumbnail()): ?>
                                        <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transform transition-transform duration-500 ">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-[#75232c] flex items-center justify-center group-hover:bg-[#dd7859] transition-colors duration-300">
                                            <svg class="w-6 h-6 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-span-3">
                                    <span class="text-[#dd7859] text-[10px] font-bold tracking-widest uppercase mb-1 block"><?php echo $nombre_cat_sec; ?></span>
                                    <h5 class="text-slate-800 font-semibold leading-snug group-hover:text-[#75232c] transition-colors duration-200 text-sm mb-1.5">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>
                                    <p class="text-slate-400 text-xs"><?php echo get_the_date(); ?></p>
                                </div>
                            </article>

                            <?php if ($noticias_secundarias->current_post + 1 < $noticias_secundarias->post_count): ?>
                                <hr class="border-slate-200">
                            <?php endif; ?>

                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <div class="mt-8 sm:hidden">
                    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="block text-center border border-[#75232c] text-[#75232c] text-xs font-bold tracking-widest uppercase py-3 hover:bg-[#75232c] hover:text-white transition-colors duration-300">
                        Ver todas
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>




<?php get_footer(); ?>