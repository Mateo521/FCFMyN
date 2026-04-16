<?php

/**
 * Template Name: Índice de Disciplinas
 */
get_header();
get_template_part('template-parts/navbar');
?>

<section class="relative bg-slate-900 pt-24 pb-28 border-b-[6px] border-[#dd7859]">
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-4">Áreas Disciplinares</h1>
        <p class="text-slate-300 text-lg max-w-2xl mx-auto font-light">Explora nuestra facultad a través de sus grandes ramas del conocimiento. Seis disciplinas fundamentales que impulsan la ciencia y la tecnología.</p>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php

            $disciplinas = get_terms(array(
                'taxonomy' => 'disciplina',
                'hide_empty' => false,
            ));

            if (!empty($disciplinas) && !is_wp_error($disciplinas)) :
                foreach ($disciplinas as $disciplina) :
            ?>
                    <a href="<?php echo get_term_link($disciplina); ?>" class="group bg-white border-t-4 border-transparent hover:border-[#75232c] p-8 shadow-sm hover:shadow-xl transition-all duration-300 rounded-sm">
                        <h3 class="text-2xl font-bold text-slate-800 mb-3 group-hover:text-[#75232c] transition-colors"><?php echo esc_html($disciplina->name); ?></h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">
                            <?php echo !empty($disciplina->description) ? esc_html($disciplina->description) : 'Explora las carreras disponibles en esta área.'; ?>
                        </p>
                        <span class="inline-flex items-center gap-2 text-[#dd7859] text-xs font-bold uppercase tracking-widest group-hover:gap-3 transition-all">
                            Ver <?php echo $disciplina->count; ?> Carreras &rarr;
                        </span>
                    </a>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>