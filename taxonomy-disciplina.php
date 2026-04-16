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

<section class="relative bg-[#75232c] pt-24 pb-28 overflow-hidden">
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

    <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&q=80&w=2000" alt="Disciplina" class="absolute top-0 left-0 w-full h-full object-cover opacity-10 mix-blend-multiply">

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
            <span class="inline-block border border-[#dd7859] text-[#dd7859] text-xs font-bold tracking-widest uppercase px-4 py-1.5 mb-6 rounded-sm bg-[#75232c]/50 backdrop-blur-sm">
                Disciplina
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight tracking-tight mb-6">
                <?php echo esc_html($term->name); ?>
            </h1>
            <?php if (!empty($term->description)) : ?>
                <p class="text-white/80 text-lg leading-relaxed font-light">
                    <?php echo esc_html($term->description); ?>
                </p>
            <?php else: ?>
                <p class="text-white/80 text-lg leading-relaxed font-light">Explora todas las carreras de pregrado, grado y posgrado de la Facultad asociadas a esta área fundamental del conocimiento.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-20 bg-[#fdfbfb] min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        <div class="flex items-center justify-between mb-12">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Oferta Académica</h2>
            <span class="text-[#dd7859] text-sm font-bold uppercase tracking-widest bg-[#dd7859]/10 px-4 py-1 rounded-sm">
                <?php echo count($carreras_disciplina); ?> Carreras
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            if (!empty($carreras_disciplina)) :
                foreach ($carreras_disciplina as $c) :


                    $mod = in_array('modalidad-virtual', $c->class_list) ? 'Virtual' : 'Presencial';
                    $dur = isset($c->acf->duracion_carrera) ? $c->acf->duracion_carrera : '';

                    $es_pregrado = in_array('nivel-pregrado', $c->class_list);
                    $es_posgrado = in_array('nivel-posgrado', $c->class_list);
                    $nivel_nombre = $es_pregrado ? 'Pregrado' : ($es_posgrado ? 'Posgrado' : 'Grado');


                    $badge_bg = $es_pregrado ? 'bg-[#dd7859]/10' : ($es_posgrado ? 'bg-[#dc5d34]/10' : 'bg-[#75232c]/10');
                    $badge_text = $es_pregrado ? 'text-[#dd7859]' : ($es_posgrado ? 'text-[#dc5d34]' : 'text-[#75232c]');
                    $badge_dot = $es_pregrado ? 'bg-[#dd7859]' : ($es_posgrado ? 'bg-[#dc5d34]' : 'bg-[#75232c]');


                    $link_local = home_url('/carrera/' . $c->slug . '/');
            ?>
                    <article class="group bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-[#75232c]/30 transition-all duration-300 cursor-pointer flex flex-col h-full" onclick="window.location.href='<?php echo esc_url($link_local); ?>';">



                        <div class="p-6 flex flex-col h-full">
                            <div class="flex items-start justify-between gap-2 mb-4">
                                <span class="<?php echo $badge_bg . ' ' . $badge_text; ?> text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-sm flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo $badge_dot; ?>"></span><?php echo esc_html($nivel_nombre); ?>
                                </span>
                            </div>

                            <h4 class="text-lg font-bold text-slate-900 leading-snug group-hover:text-[#75232c] transition-colors mb-6">
                                <a href="<?php echo esc_url($link_local); ?>"><?php echo esc_html($c->title->rendered); ?></a>
                            </h4>

                            <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between text-slate-500 text-xs font-medium uppercase tracking-wider">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <?php echo esc_html($mod); ?>
                                </span>
                                <?php if ($dur): ?>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <?php echo esc_html($dur); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php
                endforeach;
            else :
                ?>
                <div class="col-span-1 md:col-span-3 flex flex-col items-center justify-center py-20 text-center border-2 border-dashed border-slate-200 rounded-sm bg-white">
                    <svg class="w-12 h-12 text-slate-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Verificando oferta académica...</h3>
                    <p class="text-slate-500 text-sm">Asegúrate de que los enlaces de las carreras coincidan con la base de datos central.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>