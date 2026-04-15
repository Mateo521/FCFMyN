<?php 
get_header(); 
get_template_part('template-parts/navbar'); 


// 1. Cargar los campos de ACF
$modalidad = get_field('modalidad');
$duracion = get_field('duracion');

// 2. Obtener la taxonomía (Pregrado, Grado, Posgrado)
// Nota: Verifica que 'niveles_academicos' sea el slug correcto de tu taxonomía en ACF
$niveles = get_the_terms(get_the_ID(), 'niveles_academicos'); 
$nivel_nombre = $niveles && !is_wp_error($niveles) ? $niveles[0]->name : 'Carrera';
?>

<style>
    /* Estilos para que el the_content() se vea perfecto */
    .wp-content p { margin-bottom: 1.5rem; color: #334155; line-height: 1.8; font-size: 1.125rem; font-weight: 300; }
    .wp-content h2 { font-size: 2rem; font-weight: 700; color: #0f172a; margin-top: 3rem; margin-bottom: 1rem; line-height: 1.2; letter-spacing: -0.025em; }
    .wp-content h3 { font-size: 1.5rem; font-weight: 600; color: #1e293b; margin-top: 2.5rem; margin-bottom: 1rem; }
    .wp-content ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.5rem; color: #334155; font-weight: 300; line-height: 1.8; }
    .wp-content li { margin-bottom: 0.5rem; }
    .wp-content a { color: #dd7859; font-weight: 500; text-decoration: underline; text-decoration-color: rgba(221, 120, 89, 0.3); text-underline-offset: 4px; transition: all 0.2s; }
    .wp-content a:hover { text-decoration-color: #dd7859; color: #75232c; }
</style>

<main class="w-full pb-20">

    <header class="max-w-4xl mx-auto px-6 pt-16 pb-10">

        <nav class="flex text-[10px] font-bold tracking-[0.2em] uppercase text-slate-400 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li><a href="<?php echo home_url(); ?>" class="hover:text-[#75232c] transition-colors">Inicio</a></li>
                <li><span class="text-slate-300">/</span></li>
                <li><a href="<?php echo home_url('/#carreras'); ?>" class="hover:text-[#75232c] transition-colors">Carreras</a></li>
                <li><span class="text-slate-300">/</span></li>
                <li class="text-[#dd7859]"><?php echo esc_html($nivel_nombre); ?></li>
            </ol>
        </nav>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-[1.1] tracking-tight mb-8">
            <?php the_title(); ?>
        </h1>

        <div class="flex flex-wrap items-center gap-6 text-sm font-medium text-slate-500 border-b border-slate-200 pb-8">
            
            <div class="flex items-center gap-2">
                <span class="bg-[#75232c] text-white text-[10px] uppercase tracking-widest px-3 py-1 rounded-sm">
                    <?php echo esc_html($nivel_nombre); ?>
                </span>
            </div>
            
            <div class="hidden sm:block w-1 h-1 rounded-full bg-slate-300"></div>
            
            <div class="flex items-center gap-2 text-slate-800">
                <svg class="w-4 h-4 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <?php echo $modalidad ? esc_html($modalidad) : 'Presencial'; ?>
            </div>
            
            <div class="hidden sm:block w-1 h-1 rounded-full bg-slate-300"></div>
            
            <div class="flex items-center gap-2 text-slate-800">
                <svg class="w-4 h-4 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <?php echo $duracion ? esc_html($duracion) : 'No especificada'; ?>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 mb-16">
        <figure class="relative aspect-video lg:aspect-[21/9] overflow-hidden rounded-sm bg-slate-100 shadow-lg">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
            <?php else : ?>
                <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&q=80&w=2000" alt="Facultad" class="w-full h-full object-cover">
            <?php endif; ?>
        </figure>
    </div>

    <div class="max-w-3xl mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-8">

        <div class="hidden md:block md:col-span-1 relative">
            <div class="sticky top-28 flex flex-col gap-4 items-center">
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest writing-vertical-rl  mb-2">Compartir</span>
                <div class="w-px h-8 bg-slate-200 mb-2"></div>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition-all"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" /></svg></a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-800 hover:border-slate-800 transition-all"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.005 4.223H5.078z" /></svg></a>
            </div>
        </div>

        <div class="col-span-1 md:col-span-11 wp-content">
            <?php 
            if (have_posts()) : while (have_posts()) : the_post();
                the_content();
            endwhile; endif; 
            ?>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-6 mt-12 border-t border-slate-200 pt-8">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-slate-800 uppercase tracking-widest">Inscripciones:</span>
                <a href="https://sgu.unsl.edu.ar/preinscripcion/" target="_blank" class="bg-[#dd7859] hover:bg-[#75232c] text-white text-xs font-bold px-4 py-2 rounded-sm transition-colors uppercase tracking-widest">Comenzar Preinscripción</a>
            </div>
        </div>
    </div>

</main>

<section class="bg-slate-50 py-20 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        <div class="flex items-center justify-between mb-12">
            <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight">Otras carreras relacionadas</h3>
            <a href="<?php echo home_url('/#carreras'); ?>" class="hidden sm:flex items-center gap-2 text-[#75232c] text-xs font-bold uppercase tracking-widest hover:text-[#dd7859] transition-colors">
                Ver toda la oferta
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            // Buscar 3 carreras distintas a la actual
            $args_relacionadas = array(
                'post_type'      => 'carrera', // slug de tu CPT
                'posts_per_page' => 3,
                'post__not_in'   => array(get_the_ID()), // Excluir la actual
                'orderby'        => 'rand' // Aleatorio
            );
            $query_relacionadas = new WP_Query($args_relacionadas);

            if ($query_relacionadas->have_posts()) :
                while ($query_relacionadas->have_posts()) : $query_relacionadas->the_post(); 
                
                $mod_rel = get_field('modalidad');
                $dur_rel = get_field('duracion');
                $niv_rel = get_the_terms(get_the_ID(), 'niveles_academicos');
                $nombre_niv_rel = $niv_rel && !is_wp_error($niv_rel) ? $niv_rel[0]->name : 'Carrera';
            ?>
            <article class="group bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 cursor-pointer" onclick="window.location.href='<?php the_permalink(); ?>';">
                <div class="aspect-video overflow-hidden bg-[#75232c]/5">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    <?php else : ?>
                        <div class="w-full h-full flex items-center justify-center text-[#75232c]/20">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 00-.491 6.347A48.62 48.62 0 0112 20.904a48.62 48.62 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.636 50.636 0 00-2.658-.813A59.906 59.906 0 0112 3.493a59.903 59.903 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0112 13.489a50.702 50.702 0 013.741-1.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-6">
                    <span class="text-[#dd7859] text-[10px] font-bold tracking-widest uppercase mb-2 block"><?php echo esc_html($nombre_niv_rel); ?></span>
                    <h4 class="text-lg font-bold text-slate-800 leading-snug group-hover:text-[#75232c] transition-colors mb-3">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <p class="text-slate-500 text-xs font-medium"><?php echo $mod_rel ? esc_html($mod_rel) : ''; ?> <?php echo $dur_rel ? '· ' . esc_html($dur_rel) : ''; ?></p>
                </div>
            </article>
            <?php 
                endwhile; wp_reset_postdata(); 
            endif; 
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>