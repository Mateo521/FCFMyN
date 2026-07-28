<?php

/**
 * Template Name: Autoridades
 */
get_header();
get_template_part('template-parts/navbar');

$secretarias_parent = get_page_by_path('secretarias');
$secretarias = array();
if ($secretarias_parent) {
    $secretarias = fcfmyn_get_secretarias_pages_with_autoridades($secretarias_parent->ID);
}
?>

<section id="autoridades" class="pt-20 pb-28 bg-[#FFF7F5] min-h-screen">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">


        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-20">
            <div class="max-w-2xl text-center md:text-left">

                <h2 class="text-[clamp(2.5rem,5vw,4rem)] font-bold text-[#75232c] leading-tight">
                    <?php single_post_title(); ?>
                </h2>
            </div>

            <?php if (has_excerpt()) : ?>
                <p class="text-slate-600 text-base leading-relaxed max-w-md text-center md:text-right font-medium mx-auto md:mx-0">
                    <?php echo get_the_excerpt(); ?>
                </p>
            <?php endif; ?>
        </div>


        <div class="mb-24">
            <div class="flex items-center gap-6 mb-12">
                <div class="h-px bg-[#75232c]/20 flex-1 hidden sm:block"></div>
                <h3 class="text-2xl font-bold text-[#75232c] uppercase tracking-wider text-center w-full sm:w-auto">Decanato</h3>
                <div class="h-px bg-[#75232c]/20 flex-1"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-8 max-w-4xl mx-auto">

                <article class="group flex flex-col items-center text-center">
                    <div class="relative w-56 h-56 sm:w-64 sm:h-64 mb-6 overflow-hidden rounded-full border-4 border-white shadow-lg bg-slate-200">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/imagenes/decano.jpg" alt="Decano" class="w-full h-full object-cover  transition-transform duration-500">
                    </div>
                    <span class="text-xs uppercase tracking-[0.2em] font-bold text-[#75232c] mb-2">Decano</span>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Dr. Rodolfo Porasso</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 max-w-sm">Máxima autoridad de la Facultad de Ciencias Físico Matemáticas y Naturales.</p>

                    <a href="mailto:decano@email.com" class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-[#dd7859] hover:text-[#75232c] transition-colors">
                        Contactar
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </a>
                </article>


                <article class="group flex flex-col items-center text-center">
                    <div class="relative w-56 h-56 sm:w-64 sm:h-64 mb-6 overflow-hidden rounded-full border-4 border-white shadow-lg bg-slate-200">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/imagenes/vicedecano.jpg" alt="Vicedecana" class="w-full h-full object-cover  transition-transform duration-500">
                    </div>
                    <span class="text-xs uppercase tracking-[0.2em] font-bold text-[#dd7859] mb-2">Vicedecano</span>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Dr. Daniel Sales</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 max-w-sm">Acompaña al decanato en la gestión académica e institucional de la facultad.</p>

                    <a href="mailto:vicedecano@email.com" class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-[#dd7859] hover:text-[#75232c] transition-colors">
                        Contactar
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </a>
                </article>
            </div>
        </div>



        <div>
            <div class="flex items-center gap-6 mb-16">
                <div class="h-px bg-[#75232c]/20 flex-1 hidden sm:block"></div>
                <h3 class="text-2xl font-bold text-[#75232c] uppercase tracking-wider text-center w-full sm:w-auto">Secretarías</h3>
                <div class="h-px bg-[#75232c]/20 flex-1"></div>
            </div>




            <?php if (! empty($secretarias)) : ?>
                <?php
                $total_secretarias = count($secretarias);
                $i = 0;
                ?>
                <!-- 1. Cambiamos lg:grid-cols-3 por lg:grid-cols-6 -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-y-16 gap-x-8">
                    <?php foreach ($secretarias as $secretaria) : ?>
                        <?php
                        // Base: En tablet ocupa 1 (de 2), en escritorio ocupa 2 (de 6, igual a 1/3)
                        $grid_classes = 'sm:col-span-1 lg:col-span-2';

                        // 2. Si son exactamente 5, empujamos el cuarto elemento (índice 3) para centrar la última fila en pantallas grandes (lg)
                        if ($total_secretarias === 5 && $i === 3) {
                            $grid_classes .= ' lg:col-start-2';
                        }

                        // BONUS: En pantallas medianas/tablets (sm) son 2 por fila. El impar (último) quedará a la izquierda. 
                        // Con esto hacemos que ocupe el 100% de la fila y se centre automáticamente.
                        if ($total_secretarias % 2 !== 0 && $i === $total_secretarias - 1) {
                            // Reemplaza sm:col-span-1 por sm:col-span-2
                            $grid_classes = str_replace('sm:col-span-1', 'sm:col-span-2', $grid_classes);
                        }
                        ?>

                        <!-- 3. Imprimimos las clases dinámicas -->
                        <article class="group flex flex-col items-center text-center h-full <?php echo $grid_classes; ?>">

                            <!-- Foto Circular -->
                            <div class="relative w-48 h-48 mb-6 overflow-hidden rounded-full border-4 border-white shadow-md bg-slate-100">
                                <img src="<?php echo esc_url($secretaria->auth_foto); ?>" alt="<?php echo esc_attr($secretaria->auth_nombre); ?>" class="w-full h-full object-cover  transition-transform duration-500">
                            </div>

                            <!-- Contenido Centrado -->
                            <span class="text-[10px] uppercase tracking-[0.2em] font-bold text-[#dd7859] mb-2">
                                <?php echo esc_html($secretaria->auth_cargo); ?>
                            </span>

                            <h3 class="text-xl font-bold text-slate-900 mb-1 group-hover:text-[#75232c] transition-colors">
                                <?php echo esc_html($secretaria->auth_nombre); ?>
                            </h3>

                            <p class="text-[#dd7859] font-medium text-sm mb-3">
                                <?php echo esc_html($secretaria->title); ?>
                            </p>

                            <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3 max-w-sm">
                                <?php echo esc_html($secretaria->excerpt); ?>
                            </p>

                            <!-- Botón centrado en la base -->
                            <a href="<?php echo esc_url($secretaria->link); ?>" class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-[#75232c] hover:text-[#dd7859] transition-colors">
                                Ver secretaría
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </article>

                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="text-center py-10">
                    <p class="text-slate-500 font-medium">Aún no se han cargado las autoridades.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>