<?php

/**
 * Template Name: Plantilla de Secretaría
 */
get_header();
get_template_part('template-parts/navbar');

// Extraemos los campos de ACF (con valores por defecto por si aún no los llenas)
$auth_nombre = get_field('autoridad_nombre') ?: 'Nombre de la Autoridad';
$auth_cargo = get_field('autoridad_cargo') ?: 'Secretario/a';
$auth_foto = get_field('autoridad_foto') ?: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=400';
$email = get_field('contacto_email');
$telefono = get_field('contacto_telefono');
$ubicacion = get_field('ubicacion_oficina') ?: 'Bloque II, Planta Baja';
$horarios = get_field('horario_atencion') ?: 'Lunes a Viernes de 08:00 a 13:00 hs';
?>

<main class="bg-[#fdfbfb] pb-24">

    <section class="relative bg-[#75232c] pt-20 pb-40 overflow-hidden ">
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
                    <li><span class="hover:text-white transition-colors cursor-default">Secretarías</span></li>
                    <li><span class="text-white/30">/</span></li>
                    <li class="text-[#dd7859]"><?php the_title(); ?></li>
                </ol>
            </nav>

            <div class="max-w-3xl">
                <span class="inline-block border border-[#dd7859] text-[#dd7859] text-xs font-bold tracking-widest uppercase px-4 py-1.5 mb-5 rounded-sm bg-[#75232c]/50">
                    Gestión Institucional
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 lg:px-10 -mt-24 relative z-20">
        <div class="flex flex-col lg:flex-row gap-10 items-start">

            <div class="w-full lg:w-2/3 bg-white border border-slate-200 rounded-sm shadow-xl p-8 md:p-12 order-2 lg:order-1">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="wp-content-secretaria">
                            <?php
                            // Si el contenido está vacío, mostramos un texto de relleno elegante
                            $content = get_the_content();
                            if (empty($content)):
                            ?>
                                <h2 class="text-2xl font-bold text-[#75232c] mb-4">Misión de la Secretaría</h2>
                                <p class="text-slate-600 leading-relaxed mb-6">La misión principal de esta secretaría es coordinar, planificar y ejecutar las políticas institucionales en su área de competencia, asegurando el cumplimiento de los objetivos estratégicos de la Facultad de Ciencias Físico-Matemáticas y Naturales.</p>

                                <h3 class="text-xl font-bold text-slate-800 mb-4 mt-8">Funciones Principales</h3>
                                <ul class="list-disc pl-5 text-slate-600 space-y-2 mb-6">
                                    <li>Asesorar al Decanato en las temáticas específicas de su área.</li>
                                    <li>Elaborar proyectos de reglamentaciones y normativas.</li>
                                    <li>Coordinar las actividades de los departamentos y comisiones dependientes.</li>
                                    <li>Atender las necesidades y consultas de docentes, nodocentes y estudiantes.</li>
                                </ul>
                            <?php else: ?>
                                <?php the_content(); ?>
                            <?php endif; ?>
                        </div>
                <?php endwhile;
                endif; ?>
            </div>

            <aside class="w-full lg:w-1/3 flex flex-col gap-6 order-1 lg:order-2">

                <div class="bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden relative">
                    <div class="h-24 bg-gradient-to-r from-[#75232c] to-[#9c323f] w-full"></div>

                    <div class="px-8 pb-8 flex flex-col items-center text-center -mt-12 relative z-10">
                        <div class="w-28 h-28 rounded-full border-4 border-white shadow-lg overflow-hidden bg-slate-100 mb-4">
                            <img src="<?php echo esc_url($auth_foto); ?>" alt="<?php echo esc_attr($auth_nombre); ?>" class="w-full h-full object-cover">
                        </div>

                        <span class="text-[#dd7859] text-[10px] font-bold uppercase tracking-widest mb-1">
                            <?php echo esc_html($auth_cargo); ?>
                        </span>
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-1">
                            <?php echo esc_html($auth_nombre); ?>
                        </h3>
                        <p class="text-slate-500 text-xs mb-6">Facultad de Cs. Físico Matemáticas y Naturales</p>

                        <div class="w-full h-px bg-slate-100 mb-6"></div>

                        <ul class="w-full text-left space-y-4">
                            <?php if ($email): ?>
                                <li class="flex items-start gap-3">
                                    <div class="mt-0.5 w-6 h-6 rounded bg-[#dd7859]/10 text-[#dd7859] flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Email</span>
                                        <a href="mailto:<?php echo esc_attr($email); ?>" class="text-sm font-semibold text-slate-800 hover:text-[#75232c] transition-colors break-all"><?php echo esc_html($email); ?></a>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if ($telefono): ?>
                                <li class="flex items-start gap-3">
                                    <div class="mt-0.5 w-6 h-6 rounded bg-[#dd7859]/10 text-[#dd7859] flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 6z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Teléfono / Interno</span>
                                        <span class="text-sm font-semibold text-slate-800"><?php echo esc_html($telefono); ?></span>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <li class="flex items-start gap-3">
                                <div class="mt-0.5 w-6 h-6 rounded bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Ubicación</span>
                                    <span class="text-sm font-medium text-slate-600"><?php echo esc_html($ubicacion); ?></span>
                                </div>
                            </li>

                            <li class="flex items-start gap-3">
                                <div class="mt-0.5 w-6 h-6 rounded bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Horario de Atención</span>
                                    <span class="text-sm font-medium text-slate-600"><?php echo esc_html($horarios); ?></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-[#75232c] rounded-sm p-6 text-white shadow-xl relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full pointer-events-none"></div>

                    <h4 class="font-bold text-lg mb-4 relative z-10">Accesos Rápidos</h4>
                    <ul class="space-y-3 relative z-10">
                        <li>
                            <a href="#" class="flex items-center gap-2 text-sm text-white/80 hover:text-white transition-colors group">
                                <svg class="w-4 h-4 text-[#dd7859] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                                Calendario Académico
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-sm text-white/80 hover:text-white transition-colors group">
                                <svg class="w-4 h-4 text-[#dd7859] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                                Trámites Estudiantiles
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-sm text-white/80 hover:text-white transition-colors group">
                                <svg class="w-4 h-4 text-[#dd7859] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                                Reglamentaciones
                            </a>
                        </li>
                    </ul>
                </div>

            </aside>
        </div>
    </section>
</main>

<style>
    .wp-content-secretaria h2 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #75232c;
        margin-top: 2rem;
        margin-bottom: 1rem;
        letter-spacing: -0.025em;
    }

    .wp-content-secretaria h2:first-child {
        margin-top: 0;
    }

    .wp-content-secretaria h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .wp-content-secretaria p {
        color: #475569;
        line-height: 1.8;
        margin-bottom: 1.25rem;
    }

    .wp-content-secretaria ul {
        list-style-type: disc;
        padding-left: 1.25rem;
        color: #475569;
        margin-bottom: 1.25rem;
        line-height: 1.8;
    }

    .wp-content-secretaria li {
        margin-bottom: 0.5rem;
    }

    .wp-content-secretaria a {
        color: #dd7859;
        font-weight: 600;
        text-decoration: underline;
        text-decoration-color: rgba(221, 120, 89, 0.3);
        text-underline-offset: 4px;
        transition: all 0.2s;
    }

    .wp-content-secretaria a:hover {
        color: #75232c;
        text-decoration-color: #75232c;
    }
</style>

<?php get_footer(); ?>