<?php
get_header();
get_template_part('template-parts/navbar');
?>

<main class="bg-[#fdfbfb] pb-24">

    <section class="relative bg-[#75232c] pt-20 pb-40 overflow-hidden fondo-svg">
       

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10">
            <nav class="flex text-base font-bold  uppercase text-white/50 mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2 text-base">
                    <li><a href="<?php echo home_url(); ?>" class="hover:text-white transition-colors">Inicio</a></li>
                    <li><span class="text-white/30">/</span></li>
                    <li class="text-[#dd7859]">Formularios y Solicitudes</li>
                </ol>
            </nav>

            <div class="max-w-3xl">
                <span class="inline-block border border-[#dd7859] text-[#dd7859] text-xs font-bold tracking-widest uppercase px-4 py-1.5 mb-5 rounded-sm bg-[#75232c]/50">
                    Trámites
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight">
                    Formularios y Solicitudes
                </h1>
                <p class="text-xl text-white/80 mt-4 leading-relaxed">
                    Acceso rápido a todos los formularios que necesitás para gestionar tus trámites académicos
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 lg:px-10 -mt-16 relative z-20 mb-12">
        
        <?php
            $tipos = get_terms(array(
                'taxonomy' => 'tipo_formulario',
                'hide_empty' => true,
            ));
            
            if (!empty($tipos) && !is_wp_error($tipos)):
        ?>
            <div class="bg-white border border-slate-200 rounded-sm shadow-xl p-6 mb-8">
                <h3 class="font-bold text-[#75232c] mb-4">Filtrar por tipo:</h3>
                <div class="flex flex-wrap gap-2">
                    <a href="<?php echo get_post_type_archive_link('formulario_solicitud'); ?>" class="px-4 py-2 rounded-full bg-[#75232c] text-white text-sm font-semibold hover:bg-[#9c323f] transition-colors">
                        Ver todos
                    </a>
                    <?php foreach ($tipos as $tipo): ?>
                        <a href="<?php echo get_term_link($tipo); ?>" class="px-4 py-2 rounded-full border-2 border-[#75232c] text-[#75232c] text-sm font-semibold hover:bg-[#75232c] hover:text-white transition-colors">
                            <?php echo esc_html($tipo->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </section>

    <section class="max-w-7xl mx-auto px-6 lg:px-10 pb-24">
        <?php if (have_posts()): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php while (have_posts()): the_post();
                    $tipos = get_the_terms(get_the_ID(), 'tipo_formulario');
                    $thumbnail = get_the_post_thumbnail_url() ?: 'https://images.unsplash.com/photo-1554224311-beee415c201f?auto=format&fit=crop&q=80&w=500';
                ?>
                    <article class="bg-white border border-slate-200 rounded-sm shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group flex flex-col">
                        
                        <div class="h-48 overflow-hidden bg-slate-100 relative">
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover  transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#75232c]/60 to-transparent"></div>
                        </div>

                        
                        <div class="flex-1 flex flex-col p-6">
                            
                            <?php if (!empty($tipos)): ?>
                                <div class="mb-3 flex flex-wrap gap-2">
                                    <?php foreach ($tipos as $tipo): ?>
                                        <span class="text-xs font-bold text-white bg-[#dd7859] px-2.5 py-1 rounded uppercase tracking-wider">
                                            <?php echo esc_html($tipo->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            
                            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-[#75232c] transition-colors">
                                <?php the_title(); ?>
                            </h3>

                        
                            <?php if (has_excerpt()): ?>
                                <p class="text-slate-600 text-sm mb-4 flex-1">
                                    <?php the_excerpt(); ?>
                                </p>
                            <?php else: ?>
                                <p class="text-slate-600 text-sm mb-4 flex-1">
                                    <?php echo wp_trim_words(get_the_content(), 20); ?>
                                </p>
                            <?php endif; ?>

                            
                            <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 bg-[#75232c] text-white font-bold px-6 py-3 rounded-sm hover:bg-[#9c323f] transition-colors text-sm uppercase tracking-wide">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                                Ver más
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            
            <div class="flex justify-center gap-2 mt-12">
                <?php
                    echo paginate_links(array(
                        'type' => 'list',
                        'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>',
                        'next_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>',
                    ));
                ?>
            </div>

        <?php else: ?>
            <div class="bg-white border-2 border-dashed border-slate-300 rounded-sm p-12 text-center">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No hay formularios disponibles</h3>
                <p class="text-slate-600">Los formularios estarán disponibles pronto. Por favor, intentá más tarde.</p>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
