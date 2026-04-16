<?php
// 1. OBTENER EL SLUG Y HACER LA PETICIÓN
$slug = get_query_var('carrera_api_slug');
$api_url = "http://192.168.103.3/wp-json/wp/v2/carrera?slug=" . urlencode($slug);
$response = wp_remote_get($api_url);

$carrera = null;
if (! is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);
    if (! empty($data) && is_array($data)) {
        $carrera = $data[0];
    }
}

if (! $carrera) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part(404);
    exit();
}


$titulo = $carrera->title->rendered;
$acf = isset($carrera->acf) ? $carrera->acf : null;


$titulo_otorgado = !empty($acf->titulo_otorgado) ? $acf->titulo_otorgado : $titulo;
$duracion = !empty($acf->duracion_carrera) ? $acf->duracion_carrera : 'No especificada';
$titulo_intermedio = !empty($acf->titulo_intermedio) ? $acf->titulo_intermedio : false;


$acreditada = !empty($acf->acreditada_coneau) && $acf->acreditada_coneau === true;
$sin_inscripciones = !empty($acf->sin_inscripciones) && $acf->sin_inscripciones === true;
$url_plan = !empty($acf->enlace_plan_estudios) ? $acf->enlace_plan_estudios : false;
$imagen_fondo = !empty($acf->imagen_fondo_hero) ? $acf->imagen_fondo_hero : 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&q=80&w=2000';


$objetivos = !empty($acf->objetivos_carrera) ? $acf->objetivos_carrera : '';
$alcances = !empty($acf->alcances_titulo) ? $acf->alcances_titulo : '';


$materias = array();
for ($i = 1; $i <= 5; $i++) {
    $campo = 'materias_anio_' . $i;
    if (!empty($acf->$campo)) {
        $materias[$i] = $acf->$campo;
    }
}

$telefono = isset($acf->telefono) ? $acf->telefono : '';
$sitio_web = isset($acf->sitio_web) ? $acf->sitio_web : '';



$email = !empty($acf->correo_contacto) ? $acf->correo_contacto : '';
$instagram = !empty($acf->instagram_contacto) ? $acf->instagram_contacto : '';
$facebook = !empty($acf->facebook_contacto) ? $acf->facebook_contacto : '';


$res_ministerial = !empty($acf->resolucion_ministerial) ? $acf->resolucion_ministerial : '';
$res_coneau = !empty($acf->resolucion_coneau) ? $acf->resolucion_coneau : '';
$ordenanzas = !empty($acf->ordenanzas_unsl) ? $acf->ordenanzas_unsl : '';
$obs_academicas = !empty($acf->observaciones_academicas) ? $acf->observaciones_academicas : '';


$es_pregrado = in_array('nivel-pregrado', $carrera->class_list);
$es_posgrado = in_array('nivel-posgrado', $carrera->class_list);
$nivel_txt = $es_pregrado ? 'Pregrado' : ($es_posgrado ? 'Posgrado' : 'Grado');
$modalidad_txt = in_array('modalidad-virtual', $carrera->class_list) ? 'Virtual' : 'Presencial';
$sede_txt = in_array('sede-villa-mercedes', $carrera->class_list) ? 'Villa Mercedes' : 'San Luis';

add_filter('document_title_parts', function ($title_parts) use ($titulo) {
    $title_parts['title'] = $titulo;
    return $title_parts;
});

get_header();
get_template_part('template-parts/navbar');
?>

<main class="bg-[#fdfbfb]">

    <header class="relative pt-24 pb-32 overflow-hidden bg-[#75232c] "> <!-- border-b-8 border-[#dd7859] -->
        <div class="absolute inset-0 z-0">
            <img src="<?php echo esc_url($imagen_fondo); ?>" class="w-full h-full object-cover opacity-20 mix-blend-multiply">
            <div class="absolute inset-0 bg-gradient-to-t from-[#75232c] via-[#75232c]/90 to-[#1a080a]/50"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10">
            <nav class="flex text-[10px] font-bold tracking-[0.2em] uppercase text-white/50 mb-10">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="<?php echo home_url(); ?>" class="hover:text-white transition-colors">Inicio</a></li>
                    <li><span class="text-[#dd7859]">/</span></li>
                    <li><a href="<?php echo home_url('/carreras/'); ?>" class="hover:text-white transition-colors">Carreras</a></li>
                    <li><span class="text-[#dd7859]">/</span></li>
                    <li class="text-white truncate max-w-[200px]"><?php echo esc_html($titulo); ?></li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end">
                <div class="lg:col-span-8">
                    <span class="inline-flex items-center gap-2 bg-[#dd7859]/20 border border-[#dd7859]/30 text-[#dd7859] px-3 py-1 text-[10px] font-bold uppercase tracking-widest rounded-sm mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#dd7859]"></span>
                        <?php echo $nivel_txt; ?>
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-white leading-[1.05] tracking-tight mb-6">
                        <?php echo esc_html($titulo); ?>
                    </h1>
                    <p class="text-xl text-white/80 font-light mb-2">Te vas a graduar como: <strong class="text-white font-semibold"><?php echo esc_html($titulo_otorgado); ?></strong></p>

                    <?php if ($titulo_intermedio): ?>
                        <p class="text-sm text-[#dd7859] font-medium flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                            Título Intermedio: <?php echo esc_html($titulo_intermedio); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="lg:col-span-4 flex flex-col items-start lg:items-end gap-4">
                    <div class="flex flex-wrap lg:justify-end gap-3">
                        <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-sm px-4 py-3 flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            <div class="flex flex-col">
                                <span class="text-[9px] text-white/50 uppercase font-bold tracking-widest leading-none">Duración</span>
                                <span class="text-white font-medium text-sm"><?php echo esc_html($duracion); ?></span>
                            </div>
                        </div>
                        <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-sm px-4 py-3 flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <div class="flex flex-col">
                                <span class="text-[9px] text-white/50 uppercase font-bold tracking-widest leading-none">Modalidad</span>
                                <span class="text-white font-medium text-sm"><?php echo esc_html($modalidad_txt); ?></span>
                            </div>
                        </div>
                    </div>

                    <?php if (!$sin_inscripciones): ?>
                        <a href="https://sgu.unsl.edu.ar/preinscripcion/" target="_blank" class="w-full lg:w-auto text-center bg-[#dd7859] hover:bg-white text-white hover:text-[#75232c] text-xs font-bold uppercase tracking-widest px-8 py-4 transition-all duration-300 rounded-sm shadow-xl mt-2">
                            Preinscribirme 2025
                        </a>
                    <?php else: ?>
                        <span class="w-full lg:w-auto text-center bg-white/10 text-white/50 border border-white/20 text-xs font-bold uppercase tracking-widest px-8 py-4 rounded-sm mt-2 cursor-not-allowed">
                            Inscripciones Cerradas
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 lg:px-10 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <div class="lg:col-span-8 flex flex-col gap-12">

                <?php if ($objetivos): ?>
                    <section>
                        <h2 class="text-3xl font-extrabold text-slate-900 mb-6 flex items-center gap-3">
                            <span class="w-4 h-1 bg-[#dd7859]"></span> Objetivos de la carrera
                            <span class="w-8 h-1 bg-[#dd7859]"></span>
                        </h2>
                        <div class="prose prose-slate prose-lg max-w-none text-slate-600 font-light leading-relaxed wp-format">
                            <?php echo $objetivos; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if ($alcances): ?>
                    <section class="bg-white p-8 sm:p-10 border border-slate-200 rounded-sm shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-full pointer-events-none"></div>
                        <h2 class="text-2xl font-bold text-[#75232c] mb-6 relative z-10">Alcances e incumbencias</h2>
                        <div class="prose prose-slate max-w-none text-slate-600 text-sm sm:text-base leading-relaxed wp-format relative z-10">
                            <?php echo $alcances; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if (!empty($materias)): ?>
                    <section>
                        <div class="flex items-end justify-between mb-8 border-b border-slate-200 pb-4">
                            <h2 class="text-3xl font-extrabold text-slate-900 flex items-center gap-3">
                                <span class="w-3 h-1 bg-[#dd7859]"></span> Organización curricular
                                <span class="w-6 h-1 bg-[#dd7859]"></span>
                            </h2>
                            <?php if ($url_plan): ?>
                                <a href="<?php echo esc_url($url_plan); ?>" target="_blank" class="hidden sm:flex items-center gap-2 text-[#dd7859] text-xs font-bold uppercase tracking-widest hover:text-[#75232c] transition-colors">
                                    Ver plan de estudios
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach ($materias as $anio => $texto_materias): ?>
                                <div class="bg-white border-t-4 border-[#75232c] shadow-sm rounded-b-sm overflow-hidden">
                                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                                        <span class="w-8 h-8 rounded-full bg-[#75232c] text-white flex items-center justify-center font-bold text-sm shrink-0"><?php echo $anio; ?></span>
                                        <h3 class="text-lg font-bold text-slate-800">Año <?php echo $anio; ?></h3>
                                    </div>
                                    <div class="p-6 text-sm text-slate-600 whitespace-pre-line leading-loose">
                                        <?php echo nl2br(esc_html(trim($texto_materias))); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>

            <aside class="lg:col-span-4 flex flex-col gap-8">

                <div class="bg-slate-900 text-white p-8 rounded-sm relative overflow-hidden">
                    <!--div class="absolute -right-10 -bottom-10 opacity-10">
                        <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0L1.91 4.56L2.3 11c.28 4.71 4.45 8.9 9.7 13 5.25-4.1 9.42-8.29 9.7-13l.39-6.44L12 0zm0 11.5l-4-4 1.41-1.41L12 8.67l6.59-6.58L20 3.5l-8 8z" />
                        </svg>
                    </div-->

                    <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Respaldo académico
                    </h3>

                    <div class="space-y-4 relative z-10">
                        <?php if ($acreditada || $res_coneau): ?>
                            <div class="flex flex-col border-b border-white/10 pb-4">
                                <span class="text-[#dd7859] text-[10px] uppercase font-bold tracking-widest mb-1">CONEAU</span>
                                <span class="text-sm font-medium"><?php echo $res_coneau ? esc_html($res_coneau) : 'Carrera Acreditada'; ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($res_ministerial): ?>
                            <div class="flex flex-col border-b border-white/10 pb-4">
                                <span class="text-[#dd7859] text-[10px] uppercase font-bold tracking-widest mb-1">Ministerio de Educación</span>
                                <span class="text-sm font-medium"><?php echo esc_html($res_ministerial); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($ordenanzas): ?>
                            <div class="flex flex-col pb-2">
                                <span class="text-[#dd7859] text-[10px] uppercase font-bold tracking-widest mb-1">Ordenanzas UNSL</span>
                                <span class="text-sm font-medium"><?php echo esc_html($ordenanzas); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($obs_academicas): ?>
                            <div class="mt-4 bg-[#dd7859]/20 border border-[#dd7859]/40 p-3 rounded-sm">
                                <p class="text-xs text-[#ffecd4] italic leading-relaxed"><?php echo esc_html($obs_academicas); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($email || $telefono || $facebook || $instagram): ?>
                    <div class="bg-white border border-slate-200 p-8 rounded-sm shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#75232c]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 6z" />
                            </svg>
                            Contacto coordinación
                        </h3>

                        <ul class="space-y-4">
                            <?php if ($email): ?>
                                <li class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                        </svg>
                                    </span>
                                    <a href="mailto:<?php echo esc_attr($email); ?>" class="text-sm font-medium text-[#75232c] hover:underline break-all"><?php echo esc_html($email); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if ($facebook || $instagram): ?>
                                <li class="pt-4 mt-2 border-t border-slate-100 flex items-center gap-2">
                                    <?php if ($instagram): ?>
                                        <a href="<?php echo esc_url($instagram); ?>" target="_blank" class="w-10 h-10 bg-slate-50 hover:bg-[#E1306C] hover:text-white text-slate-400 rounded-sm flex items-center justify-center transition-colors">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($facebook): ?>
                                        <a href="<?php echo esc_url($facebook); ?>" target="_blank" class="w-10 h-10 bg-slate-50 hover:bg-[#1877f2] hover:text-white text-slate-400 rounded-sm flex items-center justify-center transition-colors">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</main>

<style>
    .wp-format p {
        margin-bottom: 1.25rem;
    }

    .wp-format ul {
        list-style-type: disc;
        margin-left: 1.5rem;
        margin-bottom: 1.25rem;
    }

    .wp-format li {
        margin-bottom: 0.5rem;
    }

    .wp-format strong {
        color: #0f172a;
        font-weight: 700;
    }

    .wp-format a {
        color: #dd7859;
        font-weight: 500;
        text-decoration: underline;
        text-decoration-color: rgba(221, 120, 89, 0.3);
        text-underline-offset: 4px;
        transition: all 0.2s;
    }

    .wp-format a:hover {
        text-decoration-color: #dd7859;
        color: #75232c;
    }
</style>

<?php get_footer(); ?>