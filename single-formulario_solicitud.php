<?php
get_header();
get_template_part('template-parts/navbar');

$formulario_url = get_field('url_formulario_google');
$instrucciones = get_field('instrucciones_formulario');
$secretaria_relacionada = get_field('secretaria_relacionada');
$tipo = get_the_terms(get_the_ID(), 'tipo_formulario');
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
                    <li><span class="text-white/30">/</span></li>
                    <li><a href="<?php echo get_post_type_archive_link('formulario_solicitud'); ?>" class="hover:text-white transition-colors">Formularios</a></li>
                    <li><span class="text-white/30">/</span></li>
                    <li class="text-[#dd7859]"><?php the_title(); ?></li>
                </ol>
            </nav>

            <div class="max-w-3xl">
                <span class="inline-block border border-[#dd7859] text-[#dd7859] text-xs font-bold tracking-widest uppercase px-4 py-1.5 mb-5 rounded-sm bg-[#75232c]/50">
                    Formularios y Solicitudes
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 lg:px-10 -mt-24 relative z-20">
        <div class="flex flex-col lg:flex-row gap-10 items-start">

            
            <div class="w-full lg:w-2/3">
                
                <?php if ($instrucciones): ?>
                    <div class="bg-white border border-slate-200 rounded-sm shadow-xl p-8 md:p-12 mb-8">
                        <div class="bg-blue-50 border-t-4 border-blue-500 p-4 mb-6">
                            <h3 class="font-bold text-blue-900 mb-2">Instrucciones</h3>
                            <div class="text-blue-800 text-sm">
                                <?php echo wp_kses_post($instrucciones); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                
                <?php if ($formulario_url): ?>
                    <div class="bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden">
                        <div class="bg-gradient-to-r from-[#75232c] to-[#9c323f] px-8 py-6">
                            <h2 class="text-xl font-bold text-white">Completar formulario</h2>
                        </div>
                        
                        <div class="p-8">
                            <iframe 
                                src="<?php echo esc_url($formulario_url); ?>" 
                                width="100%" 
                                height="700" 
                                frameborder="0" 
                                marginheight="0" 
                                marginwidth="0"
                                class="rounded-sm border border-slate-100">
                                Cargando formulario...
                            </iframe>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-sm p-8 text-center">
                        <p class="text-yellow-800 font-semibold">El formulario aún no está configurado. Por favor, intentá más tarde.</p>
                    </div>
                <?php endif; ?>

                
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php $content = get_the_content(); ?>
                    <?php if (!empty($content)): ?>
                        <div class="bg-white border border-slate-200 rounded-sm shadow-xl p-8 md:p-12 mt-8">
                            <div class="wp-content-formulario">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; endif; ?>
            </div>

            
            <aside class="w-full lg:w-1/3 flex flex-col gap-6">
                
                
                <?php if ($secretaria_relacionada): 
                    $secretaria = $secretaria_relacionada;
                    $auth_email = get_field('contacto_email', $secretaria->ID);
                    $auth_telefono = get_field('contacto_telefono', $secretaria->ID);
                    $auth_nombre = get_field('autoridad_nombre', $secretaria->ID);
                ?>
                    <div class="bg-white border border-slate-200 rounded-sm shadow-xl p-6">
                        <h3 class="font-bold text-[#75232c] mb-4 text-lg"> ¿Necesitás ayuda?</h3>
                        <p class="text-slate-600 text-sm mb-4">Para consultas sobre este trámite, contacta con:</p>
                        
                        <?php if ($auth_nombre): ?>
                            <p class="font-semibold text-slate-800 mb-3"><?php echo esc_html($auth_nombre); ?></p>
                        <?php endif; ?>

                        <?php if ($auth_email): ?>
                            <div class="mb-3">
                                <a href="mailto:<?php echo esc_attr($auth_email); ?>" class="flex items-center gap-2 text-[#dd7859] hover:text-[#75232c] transition-colors text-sm font-semibold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                    <?php echo esc_html($auth_email); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($auth_telefono): ?>
                            <p class="flex items-center gap-2 text-slate-600 text-sm">
                                <svg class="w-4 h-4 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 6z" />
                                </svg>
                                <?php echo esc_html($auth_telefono); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($tipo)): ?>
                    <div class="bg-[#75232c] rounded-sm p-6 text-white shadow-xl">
                        <h4 class="font-bold mb-3 text-sm uppercase tracking-wide">Tipo de Solicitud</h4>
                        <div class="space-y-2">
                            <?php foreach ($tipo as $t): ?>
                                <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1.5 rounded">
                                    <?php echo esc_html($t->name); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php
                    $args = array(
                        'post_type' => 'formulario_solicitud',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    $otros = new WP_Query($args);
                    if ($otros->have_posts()):
                ?>
                    <div class="bg-white border border-slate-200 rounded-sm shadow-xl p-6">
                        <h4 class="font-bold text-[#75232c] mb-4">Otros Formularios</h4>
                        <ul class="space-y-3">
                            <?php while ($otros->have_posts()): $otros->the_post(); ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>" class="flex items-start gap-2 text-sm text-[#dd7859] hover:text-[#75232c] transition-colors font-semibold group">
                                        <svg class="w-4 h-4 text-[#dd7859] group-hover:translate-x-1 transition-transform mt-0.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                        <span><?php the_title(); ?></span>
                                    </a>
                                </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                        <a href="<?php echo get_post_type_archive_link('formulario_solicitud'); ?>" class="inline-block mt-4 text-[#dd7859] hover:text-[#75232c] font-semibold text-sm transition-colors">
                            Ver todos los formularios →
                        </a>
                    </div>
                <?php endif; ?>
            </aside>
        </div>
    </section>
</main>
<style>
    .wp-content-formulario h2 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #75232c;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    .wp-content-formulario h2:first-child {
        margin-top: 0;
    }
    .wp-content-formulario h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-top: 1.25rem;
        margin-bottom: 0.75rem;
    }
    .wp-content-formulario p {
        color: #475569;
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    .wp-content-formulario ul,
    .wp-content-formulario ol {
        list-style-type: disc;
        padding-left: 1.25rem;
        color: #475569;
        margin-bottom: 1rem;
        line-height: 1.8;
    }
    .wp-content-formulario li {
        margin-bottom: 0.5rem;
    }
    .wp-content-formulario a {
        color: #dd7859;
        font-weight: 600;
        text-decoration: underline;
        text-decoration-color: rgba(221, 120, 89, 0.3);
        text-underline-offset: 4px;
        transition: all 0.2s;
    }
    .wp-content-formulario a:hover {
        color: #75232c;
        text-decoration-color: #75232c;
    }
</style>



<?php get_footer(); ?>
