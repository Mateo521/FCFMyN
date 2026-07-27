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

<section id="autoridades" class="pt-28 bg-[#FFF7F5] min-h-screen">
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

        <?php if (! empty($secretarias)) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                <?php foreach ($secretarias as $secretaria) : ?>
                    <article class="group bg-white border border-slate-200 rounded-sm shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative overflow-hidden h-64 bg-slate-100">
                            <img src="<?php echo esc_url($secretaria->auth_foto); ?>" alt="<?php echo esc_attr($secretaria->auth_nombre); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] uppercase tracking-[0.3em] font-bold text-[#dd7859] bg-[#dd7859]/10 mb-4"><?php echo esc_html($secretaria->auth_cargo); ?></span>
                            <h3 class="text-xl font-bold text-slate-900 mb-2"><?php echo esc_html($secretaria->auth_nombre); ?></h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-5"><?php echo esc_html($secretaria->title); ?></p>
                            <p class="text-slate-500 text-sm leading-relaxed mb-6"><?php echo esc_html($secretaria->excerpt); ?></p>
                            <a href="<?php echo esc_url($secretaria->link); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-[#75232c] hover:text-[#dd7859] transition-colors">
                                Ver secretaría
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-slate-500">Aún no se han cargado las autoridades.</p>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>