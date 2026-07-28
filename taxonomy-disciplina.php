<?php
get_header();
get_template_part('template-parts/navbar');

$term = get_queried_object();
$disciplina_slug = strtolower($term->slug);

$mapa_disciplinas = fcfmyn_get_disciplinas_carreras();

$carreras_disciplina = array();

if (array_key_exists($disciplina_slug, $mapa_disciplinas)) {
    $slugs_buscar = array_keys($mapa_disciplinas[$disciplina_slug]['carreras']);
    
    $carreras_api = fcfmyn_get_api_carreras(array(
        'per_page' => 100
    ));
    if (! empty($carreras_api) && is_array($carreras_api)) {
        foreach ($carreras_api as $c) {
            if (in_array($c->slug, $slugs_buscar)) {
                $carreras_disciplina[] = $c;
            }
        }
        usort($carreras_disciplina, function ($a, $b) {
            return strcmp($a->title->rendered, $b->title->rendered);
        });
    }
}
?>
<section class="py-24 bg-[#fdfbfb] min-h-[50vh]">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
        
         
        <div class="mb-16 flex items-end justify-between border-b border-slate-200 pb-6">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">Oferta Académica</h2>
                <p class="mt-2 font-medium text-slate-500">Programas de estudio estructurados para el futuro.</p>
            </div>
            <span class="hidden rounded-sm border border-[#dd7859]/20 bg-[#dd7859]/10 px-4 py-2 text-xs font-bold uppercase tracking-widest text-[#dd7859] sm:inline-block">
                <?php echo count($carreras_disciplina); ?> Carreras
            </span>
        </div>

        
        <div class="flex flex-col gap-8">
            <?php
            if (!empty($carreras_disciplina)) :
                
                foreach ($carreras_disciplina as $index => $c) :
                    $mod = in_array('modalidad-virtual', $c->class_list) ? 'Virtual' : 'Presencial';
                    $dur = isset($c->acf->duracion_carrera) ? $c->acf->duracion_carrera : '';
                    $nivel_nombre = fcfmyn_get_nivel_carrera($c->class_list);
                    $badge_classes = fcfmyn_get_nivel_carrera_badge_classes($nivel_nombre);
                    $badge_bg = $badge_classes['bg'];
                    $badge_text = $badge_classes['text'];
                    $badge_dot = $nivel_nombre === 'Pregrado' ? 'bg-[#dd7859]' : ($nivel_nombre === 'Posgrado' ? 'bg-[#dc5d34]' : 'bg-[#75232c]');
                    $objetivos_carrera = isset($c->acf->objetivos_carrera) ? $c->acf->objetivos_carrera : '';
                    $extracto = $objetivos_carrera ? $objetivos_carrera : (!empty($c->excerpt->rendered) ? $c->excerpt->rendered : 'Formamos profesionales con sólidos conocimientos teóricos y prácticos, capacitados para analizar, diseñar e implementar soluciones tecnológicas innovadoras. Desarrolla habilidades de investigación y liderazgo esenciales para los desafíos del siglo XXI en entornos socio-productivos de alta exigencia.');
                    $link_local = home_url('/carrera/' . $c->slug . '/');
            ?>
                    <article class="group relative flex flex-col gap-8 rounded border border-slate-200 bg-white p-8 transition-all duration-300 hover:border-[#dd7859]/30 hover:shadow-[0_15px_40px_-10px_rgba(0,0,0,0.08)] sm:flex-row sm:items-center sm:justify-between lg:p-10">
                        
                        
                        <div class="flex-1">
                            
                            
                            <div class="mb-4">
                                <span class="<?php echo $badge_bg . ' ' . $badge_text; ?> inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest">
                                    <span class="h-1.5 w-1.5 rounded-full <?php echo $badge_dot; ?>"></span><?php echo esc_html($nivel_nombre); ?>
                                </span>
                            </div>
                            
                            
                            <h3 class="mb-4 text-2xl font-bold leading-tight text-slate-900 transition-colors group-hover:text-[#75232c] lg:text-3xl">
                                
                                <a href="<?php echo esc_url($link_local); ?>" class="before:absolute before:inset-0">
                                    <?php echo esc_html($c->title->rendered); ?>
                                </a>
                            </h3>
                            
                            
                            <div class="mb-8 max-w-4xl">
                                <?php echo wpautop( wp_kses_post( $extracto ) ); ?>
                            </div>
                            
                        
                            <div class="flex flex-wrap items-center gap-4 text-xs font-semibold uppercase tracking-wider text-slate-600">
                                <span class="flex items-center gap-2 rounded-md border border-slate-100 bg-slate-50 px-3 py-2">
                                    <svg class="h-4 w-4 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <?php echo esc_html($mod); ?>
                                </span>
                                
                                <?php if ($dur): ?>
                                    <span class="flex items-center gap-2 rounded-md border border-slate-100 bg-slate-50 px-3 py-2">
                                        <svg class="h-4 w-4 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <?php echo esc_html($dur); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="mt-2 shrink-0 sm:mt-0 sm:self-end">
                            <div class="flex items-center gap-3 text-sm font-bold uppercase tracking-widest text-[#75232c] transition-colors group-hover:text-[#dd7859]">
                                Ver detalles
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#75232c]/10 transition-all duration-300 group-hover:translate-x-2 group-hover:bg-[#dd7859]/10">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                    </article>
            <?php
                endforeach;
            else :
            ?>
                
                <div class="flex flex-col items-center justify-center rounded border-2 border-dashed border-slate-200 bg-white py-24 text-center">
                    <svg class="mb-6 h-16 w-16 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h3 class="mb-2 text-xl font-bold text-slate-800">Verificando oferta académica...</h3>
                    <p class="text-base text-slate-500">Asegúrate de que los enlaces de las carreras coincidan con la base de datos central.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>