<?php
/**
 * Template Name: Detalle de Secretaría
 * Description: Plantilla compartida para mostrar el interior de cualquier secretaría.
 */
get_header();
get_template_part('template-parts/navbar');
?>

<main class="pt-28 bg-[#FFF7F5] min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-12">
        
        <div class="mb-8">
            <?php 
            $id_padre = wp_get_post_parent_id( get_the_ID() );
            if ( $id_padre ) : 
            ?>
                <a href="<?php echo get_permalink( $id_padre ); ?>" class="inline-flex items-center gap-2 text-[#dc5d34] font-semibold hover:underline text-sm group">
                    <svg class="w-4 h-4 transform rotate-180 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                    Volver a Secretarías
                </a>
            <?php endif; ?>
        </div>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <article class="bg-white p-8 sm:p-12 shadow-sm rounded-sm">
                <h1 class="text-3xl sm:text-4xl font-bold text-[#75232c] mb-6 leading-tight">
                    <?php the_title(); ?>
                </h1>

                <div class="text-slate-600 font-medium leading-relaxed space-y-4 entry-content">
                    <?php the_content(); ?>
                </div>
            </article>

        <?php endwhile; endif; ?>

    </div>
</main>

<?php get_footer(); ?>