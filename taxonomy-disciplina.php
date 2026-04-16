<?php
get_header();
get_template_part('template-parts/navbar');

$term = get_queried_object();
$disciplina_slug = strtolower($term->slug);

 
$mapa_disciplinas = array(
    'electronica' => array(
        'maestria-en-sistemas-embebidos',
        'maestria-en-diseno-de-sistemas-electronicos-aplicados-a-la-agronomia',
        'especializacion-en-sistemas-embebidos',
        'ingenieria-electronica-con-orientacion-en-sistemas-digitales',
        'profesorado-en-tecnologia-electronica',
        'tecnicatura-universitaria-en-electronica',
        'tecnicatura-universitaria-en-telecomunicaciones'
    ),
    'fisica' => array(
        'doctorado-en-fisica',
        'maestria-en-ciencias-de-superficies-y-medios-porosos',
        'especializacion-en-ensenanza-de-la-fisica',
        'licenciatura-en-fisica',
        'profesorado-en-fisica',
        'tecnicatura-universitaria-en-energias-renovables',
        'tecnicatura-universitaria-en-fotografia'
    ),
    'geologia' => array(
        'doctorado-en-ciencias-geologicas',
        'licenciatura-en-ciencias-geologicas',
        'tecnicatura-universitaria-en-teledeteccion-y-sistemas-de-informacion-geografica-t-sig'
    ),
    'informatica' => array(
        'doctorado-en-ciencias-de-la-computacion',
        'doctorado-en-ingenieria-en-informatica',
        'maestria-en-calidad-del-software',
        'maestria-en-ciencias-de-la-computacion',
        'maestria-en-ensenanza-en-escenarios-digitales',
        'maestria-en-ingenieria-de-software',
        'especializacion-en-ingenieria-de-software',
        'ingenieria-en-computacion',
        'ingenieria-en-informatica',
        'licenciatura-en-ciencias-de-la-computacion',
        'profesorado-en-ciencias-de-la-computacion',
        'tecnicatura-universitaria-en-redes-de-computadoras',
        'tecnicatura-universitaria-en-web'
    ),
    'matematica' => array(
        'doctorado-en-ciencias-matematicas',
        'maestria-en-matematica',
        'especializacion-en-didactica-matematica',
        'licenciatura-en-ciencias-matematicas',
        'licenciatura-en-matematica-aplicada',
        'profesorado-en-matematica'
    ),
    'mineria' => array(
        'especializacion-en-simulacion-discreta-aplicada-a-la-planificacion-minera',
        'ingenieria-en-minas',
        'tecnicatura-universitaria-en-mineria',
        'tecnicatura-universitaria-en-obras-viales'
    )
);

$carreras_disciplina = array();

if (array_key_exists($disciplina_slug, $mapa_disciplinas)) {
    $slugs_buscar = $mapa_disciplinas[$disciplina_slug];
    $api_url = "http://192.168.103.3/wp-json/wp/v2/carrera?facultad=14&per_page=100";
    $response = wp_remote_get($api_url);

    if (! is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        $body = wp_remote_retrieve_body($response);
        $carreras_api = json_decode($body);

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
}
?>
<section class="py-24 bg-[#fdfbfb] min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        <div class="flex items-end justify-between mb-20 border-b border-slate-200 pb-6">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Oferta Académica</h2>
                <p class="text-slate-500 mt-2 font-medium">Programas de estudio estructurados para el futuro.</p>
            </div>
            <span class="hidden sm:inline-block text-[#dd7859] text-xs font-bold uppercase tracking-widest bg-[#dd7859]/10 px-4 py-2 rounded-sm border border-[#dd7859]/20">
                <?php echo count($carreras_disciplina); ?> Carreras
            </span>
        </div>

        <div class="flex flex-col gap-24">
            <?php
            if (!empty($carreras_disciplina)) :
                
                foreach ($carreras_disciplina as $index => $c) :

                    $mod = in_array('modalidad-virtual', $c->class_list) ? 'Virtual' : 'Presencial';
                    $dur = isset($c->acf->duracion_carrera) ? $c->acf->duracion_carrera : '';

                    $es_pregrado = in_array('nivel-pregrado', $c->class_list);
                    $es_posgrado = in_array('nivel-posgrado', $c->class_list);
                    $nivel_nombre = $es_pregrado ? 'Pregrado' : ($es_posgrado ? 'Posgrado' : 'Grado');

                    $badge_bg = $es_pregrado ? 'bg-[#dd7859]/10' : ($es_posgrado ? 'bg-[#dc5d34]/10' : 'bg-[#75232c]/10');
                    $badge_text = $es_pregrado ? 'text-[#dd7859]' : ($es_posgrado ? 'text-[#dc5d34]' : 'text-[#75232c]');
                    $badge_dot = $es_pregrado ? 'bg-[#dd7859]' : ($es_posgrado ? 'bg-[#dc5d34]' : 'bg-[#75232c]');

                    $extracto = !empty($c->excerpt->rendered) ? wp_strip_all_tags($c->excerpt->rendered) : 'Formamos profesionales con sólidos conocimientos teóricos y prácticos, capacitados para analizar, diseñar e implementar soluciones tecnológicas innovadoras. Desarrolla habilidades de investigación y liderazgo esenciales para los desafíos del siglo XXI en entornos socio-productivos de alta exigencia.';

                    $link_local = home_url('/carrera/' . $c->slug . '/');

       
                    $es_invertido = ($index % 2 !== 0);
                    $orden_imagen = $es_invertido ? 'lg:order-2' : 'lg:order-1';
                    $orden_texto = $es_invertido ? 'lg:order-1' : 'lg:order-2';

                
                    $img_placeholder = 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=800';
            ?>
                    <article class="group flex flex-col lg:flex-row items-center gap-10 lg:gap-16 cursor-pointer" onclick="window.location.href='<?php echo esc_url($link_local); ?>';">

                        <div class="w-full lg:w-1/2 aspect-[4/3] relative rounded-sm overflow-hidden shadow-lg <?php echo $orden_imagen; ?>">
                            <img src="<?php echo $img_placeholder; ?>" alt="<?php echo esc_attr($c->title->rendered); ?>" class="w-full h-full object-cover transform  transition-transform duration-1000 ease-out">

                            <div class="absolute inset-0 bg-[#75232c]/10 mix-blend-multiply group-hover:bg-transparent transition-colors duration-500"></div>

                            <div class="absolute inset-0 border-4 border-transparent group-hover:border-white/30 transition-colors duration-500 z-10 m-4 rounded-sm pointer-events-none"></div>
                        </div>

                        <div class="w-full lg:w-1/2 flex flex-col <?php echo $orden_texto; ?>">

                            <div class="flex items-center gap-4 mb-6">
                                <span class="<?php echo $badge_bg . ' ' . $badge_text; ?> text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-sm inline-flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo $badge_dot; ?>"></span><?php echo esc_html($nivel_nombre); ?>
                                </span>
                            </div>

                            <h3 class="text-3xl lg:text-4xl font-bold text-slate-900 leading-tight group-hover:text-[#75232c] transition-colors mb-6">
                                <a href="<?php echo esc_url($link_local); ?>"><?php echo esc_html($c->title->rendered); ?></a>
                            </h3>

                            <p class="text-slate-500 text-base leading-relaxed mb-10">
                                <?php echo $extracto; ?>
                            </p>

                            <div class="flex items-center justify-between border-t border-slate-200 pt-6">
                                <div class="flex items-center gap-6 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <?php echo esc_html($mod); ?>
                                    </span>
                                    <?php if ($dur): ?>
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <?php echo esc_html($dur); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="flex items-center gap-3 text-[#75232c] font-bold text-xs uppercase tracking-widest group-hover:text-[#dd7859] transition-colors">
                                    Ver carrera
                                    <span class="w-8 h-8 rounded-full bg-[#75232c]/10 flex items-center justify-center group-hover:translate-x-2 transition-transform duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php
                endforeach;
            else :
                ?>
                <div class="flex flex-col items-center justify-center py-24 text-center border-2 border-dashed border-slate-200 rounded-sm bg-white">
                    <svg class="w-16 h-16 text-slate-300 mb-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Verificando oferta académica...</h3>
                    <p class="text-slate-500 text-base">Asegúrate de que los enlaces de las carreras coincidan con la base de datos central.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>