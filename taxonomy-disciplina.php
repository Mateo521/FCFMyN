<?php 
get_header(); 
get_template_part('template-parts/navbar'); 


$term = get_queried_object();
?>

<section class="relative bg-[#75232c] pt-24 pb-28 overflow-hidden border-b-[6px] border-[#dd7859]">
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10">
        <nav class="flex text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li><a href="<?php echo home_url(); ?>" class="hover:text-white transition-colors">Inicio</a></li>
                <li><span class="text-white/30">/</span></li>
                <li><a href="<?php echo home_url('/disciplinas'); ?>" class="hover:text-white transition-colors">Disciplinas</a></li>
                <li><span class="text-white/30">/</span></li>
                <li class="text-[#dd7859]"><?php echo esc_html($term->name); ?></li>
            </ol>
        </nav>

        <div class="max-w-3xl">
            <span class="inline-block border border-[#dd7859] text-[#dd7859] text-xs font-bold tracking-widest uppercase px-4 py-1.5 mb-6 rounded-sm bg-[#75232c]/50">
                Área Disciplinar
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight tracking-tight mb-6">
                <?php echo esc_html($term->name); ?>
            </h1>
            <?php if (!empty($term->description)) : ?>
                <p class="text-white/80 text-lg leading-relaxed font-light">
                    <?php echo esc_html($term->description); ?>
                </p>
            <?php else: ?>
                <p class="text-white/80 text-lg leading-relaxed font-light">Explora todas las carreras de pregrado, grado y posgrado asociadas a esta área del conocimiento.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-20 bg-[#fdfbfb]">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Oferta Académica</h2>
            <span class="text-[#dd7859] text-sm font-bold uppercase tracking-widest bg-[#dd7859]/10 px-4 py-1 rounded-full">
                <?php echo $wp_query->found_posts; ?> Carreras
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            // El loop nativo de WP ya sabe que solo debe traer las carreras de esta disciplina
            if (have_posts()) :
                while (have_posts()) : the_post(); 
                
                $mod = get_field('modalidad');
                $dur = get_field('duracion');
                $niveles = get_the_terms(get_the_ID(), 'nivel_academico');
                $nivel_nombre = $niveles && !is_wp_error($niveles) ? $niveles[0]->name : 'Carrera';
            ?>
            <article class="group bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer flex flex-col h-full" onclick="window.location.href='<?php the_permalink(); ?>';">
                <div class="aspect-video overflow-hidden bg-slate-100 relative">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    <?php else : ?>
                        <div class="w-full h-full flex items-center justify-center text-slate-300 group-hover:text-[#dd7859] transition-colors duration-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 00-.491 6.347A48.62 48.62 0 0112 20.904a48.62 48.62 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.636 50.636 0 00-2.658-.813A59.906 59.906 0 0112 3.493a59.903 59.903 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0112 13.489a50.702 50.702 0 013.741-1.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg>
                        </div>
                    <?php endif; ?>
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-slate-800 text-[10px] font-bold uppercase tracking-widest px-3 py-1 shadow-sm">
                        <?php echo esc_html($nivel_nombre); ?>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h4 class="text-xl font-bold text-slate-800 leading-snug group-hover:text-[#75232c] transition-colors mb-4">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between text-slate-500 text-xs font-medium uppercase tracking-wider">
                        <span><?php echo $mod ? esc_html($mod) : 'Presencial'; ?></span>
                        <span><?php echo $dur ? esc_html($dur) : ''; ?></span>
                    </div>
                </div>
            </article>
            <?php 
                endwhile; 
            else : 
                echo '<p class="col-span-3 text-slate-500 text-lg">Próximamente se publicará la oferta académica para esta disciplina.</p>';
            endif; 
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>