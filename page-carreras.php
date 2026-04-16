<?php

/**
 * Template Name: Buscador de Carreras (API)
 */
get_header();
get_template_part('template-parts/navbar');

$api_url = "http://192.168.103.3/wp-json/wp/v2/carrera?facultad=14&per_page=100";
$response = wp_remote_get($api_url);

$carreras_limpias = array();

if (! is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
    $body = wp_remote_retrieve_body($response);
    $carreras_api = json_decode($body);

    if (! empty($carreras_api) && is_array($carreras_api)) {
        foreach ($carreras_api as $c) {

            $nivel = 'grado';
            $nivel_label = 'Grado';
            if (in_array('nivel-pregrado', $c->class_list)) {
                $nivel = 'pregrado';
                $nivel_label = 'Pregrado';
            }
            if (in_array('nivel-posgrado', $c->class_list)) {
                $nivel = 'posgrado';
                $nivel_label = 'Posgrado';
            }

            $modalidad = in_array('modalidad-virtual', $c->class_list) ? 'Virtual' : 'Presencial';


            $carreras_limpias[] = array(
                'nombre'    => html_entity_decode($c->title->rendered),
                'link'      => home_url('/carrera/' . $c->slug . '/'),
                'nivel'     => $nivel,
                'nivel_label' => $nivel_label,
                'modalidad' => $modalidad,
                'duracion'  => isset($c->acf->duracion) ? $c->acf->duracion : 'No especificada'
            );
        }
    }
}
?>

<section class="relative bg-slate-900 pt-24 pb-32  overflow-hidden">



    <img src="<?php echo get_template_directory_uri() . '/assets/archivos/554883248_24956201910670993_8698305140664215116_n.j   pg' ?>" alt="Carreras FCFMyN" class="absolute inset-0 w-full h-full object-cover opacity-20 pointer-events-none">

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 text-start">
        <h1 class="text-xl md:text-2xl lg:text-4xl font-extrabold text-white tracking-tight mb-6">Buscá tu carrera</h1>
        <div class="max-w-7xl mx-auto relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-6 w-6 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <input type="text" id="searchInput" placeholder="Busca por nombre de carrera, ej: Computación..." class="w-full bg-white text-slate-900 rounded-sm py-4 pl-12 pr-4 text-lg focus:outline-none focus:ring-4 focus:ring-[#dd7859]/50 transition-all shadow-xl">
        </div>
    </div>


</section>

<section class="py-16 bg-[#fdfbfb] min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 flex flex-col lg:flex-row gap-10">

        <aside class="w-full lg:w-1/4 flex-shrink-0">
            <div class="sticky top-28 bg-white p-6 border border-slate-200 shadow-sm rounded-sm">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                        </svg>
                        Filtros
                    </h3>
                    <button id="clearFilters" class="text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-[#75232c] transition-colors">Limpiar</button>
                </div>

                <div class="mb-8">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Nivel Académico</span>
                    <div class="flex flex-col gap-2">
                        <button data-filter="nivel" data-value="" class="filter-btn active text-left px-4 py-2 rounded-sm text-sm font-semibold transition-all bg-[#75232c] text-white shadow-md">Todos los niveles</button>
                        <button data-filter="nivel" data-value="pregrado" class="filter-btn text-left px-4 py-2 rounded-sm text-sm font-semibold transition-all bg-slate-50 text-slate-600 hover:bg-slate-100">Pregrado</button>
                        <button data-filter="nivel" data-value="grado" class="filter-btn text-left px-4 py-2 rounded-sm text-sm font-semibold transition-all bg-slate-50 text-slate-600 hover:bg-slate-100">Grado</button>
                        <button data-filter="nivel" data-value="posgrado" class="filter-btn text-left px-4 py-2 rounded-sm text-sm font-semibold transition-all bg-slate-50 text-slate-600 hover:bg-slate-100">Posgrado</button>
                    </div>
                </div>

                <div>
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Modalidad</span>
                    <select id="filterModalidad" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-sm focus:ring-[#dd7859] focus:border-[#dd7859] block p-2.5 outline-none">
                        <option value="">Todas las modalidades</option>
                        <option value="Presencial">Presencial</option>
                        <option value="Virtual">Virtual</option>
                    </select>
                </div>
            </div>
        </aside>

        <main class="w-full lg:w-3/4">
            <div class="mb-6 flex items-center justify-between text-sm font-medium text-slate-500">
                <span>Mostrando <strong id="resultCount" class="text-slate-900">0</strong> carreras</span>
            </div>

            <div id="carrerasGrid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            </div>

            <div id="emptyState" class="hidden flex flex-col items-center justify-center py-20 text-center border-2 border-dashed border-slate-200 rounded-sm bg-white">
                <svg class="w-12 h-12 text-slate-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="text-lg font-bold text-slate-800 mb-2">No se encontraron resultados</h3>
                <p class="text-slate-500 text-sm">Prueba ajustando los filtros o utilizando otros términos de búsqueda.</p>
            </div>
        </main>
    </div>
</section>

<script>
    const CARRERAS = <?php echo json_encode($carreras_limpias, JSON_UNESCAPED_UNICODE); ?>;


    const TIPO_CONFIG = {
        pregrado: {
            bg: "bg-[#dd7859]/10",
            text: "text-[#dd7859]",
            dot: "bg-[#dd7859]"
        },
        grado: {
            bg: "bg-[#75232c]/10",
            text: "text-[#75232c]",
            dot: "bg-[#75232c]"
        },
        posgrado: {
            bg: "bg-[#dc5d34]/10",
            text: "text-[#dc5d34]",
            dot: "bg-[#dc5d34]"
        }
    };

    let state = {
        search: "",
        nivel: "",
        modalidad: ""
    };


    function buildCard(c) {
        const conf = TIPO_CONFIG[c.nivel] || TIPO_CONFIG['grado'];

        return `
            <a href="${c.link}" class="group bg-white border border-slate-200 rounded-sm hover:shadow-xl hover:-translate-y-1 hover:border-[#75232c]/30 transition-all duration-300 flex flex-col cursor-pointer overflow-hidden">
                <div class="h-2 w-full ${conf.dot}"></div>
                <div class="p-6 flex flex-col h-full">
                    
                    <div class="flex items-start justify-between gap-2 mb-4">
                        <span class="${conf.bg} ${conf.text} text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-sm flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full ${conf.dot}"></span>${c.nivel_label}
                        </span>
                    </div>
                    
                    <h3 class="text-slate-900 text-lg font-bold leading-snug group-hover:text-[#75232c] transition-colors mb-6">
                        ${c.nombre}
                    </h3>
                    
                    <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-medium text-slate-500">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            ${c.modalidad}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            ${c.duracion}
                        </span>
                    </div>
                </div>
            </a>
        `;
    }


    function render() {

        const q = state.search.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");

        const filtered = CARRERAS.filter(c => {
            const name = c.nombre.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");

            if (state.nivel && c.nivel !== state.nivel) return false;
            if (state.modalidad && c.modalidad !== state.modalidad) return false;
            if (q && !name.includes(q)) return false;

            return true;
        }).sort((a, b) => a.nombre.localeCompare(b.nombre, 'es', {
            sensitivity: 'base'
        }));


        const grid = document.getElementById("carrerasGrid");
        const empty = document.getElementById("emptyState");
        const resultCount = document.getElementById("resultCount");

        if (resultCount) resultCount.textContent = filtered.length;

        if (filtered.length === 0) {
            grid.innerHTML = "";
            empty.classList.remove("hidden");
            empty.classList.add("flex");
        } else {
            empty.classList.add("hidden");
            empty.classList.remove("flex");
            grid.innerHTML = filtered.map(buildCard).join("");
        }
    }


    document.addEventListener("DOMContentLoaded", () => {


        const searchInput = document.getElementById("searchInput");
        if (searchInput) {
            searchInput.addEventListener("input", e => {
                state.search = e.target.value;
                render();
            });
        }


        document.querySelectorAll(".filter-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                state.nivel = btn.dataset.value;


                document.querySelectorAll(".filter-btn").forEach(b => {
                    b.classList.remove("bg-[#75232c]", "text-white", "shadow-md", "active");
                    b.classList.add("bg-slate-50", "text-slate-600");
                });
                btn.classList.add("bg-[#75232c]", "text-white", "shadow-md", "active");
                btn.classList.remove("bg-slate-50", "text-slate-600");

                render();
            });
        });


        const filterModalidad = document.getElementById("filterModalidad");
        if (filterModalidad) {
            filterModalidad.addEventListener("change", e => {
                state.modalidad = e.target.value;
                render();
            });
        }


        const clearBtn = document.getElementById("clearFilters");
        if (clearBtn) {
            clearBtn.addEventListener("click", () => {
                state = {
                    search: "",
                    nivel: "",
                    modalidad: ""
                };

                if (searchInput) searchInput.value = "";
                if (filterModalidad) filterModalidad.value = "";


                document.querySelectorAll(".filter-btn").forEach((b, i) => {
                    if (i === 0) {
                        b.classList.add("bg-[#75232c]", "text-white", "shadow-md", "active");
                        b.classList.remove("bg-slate-50", "text-slate-600");
                    } else {
                        b.classList.remove("bg-[#75232c]", "text-white", "shadow-md", "active");
                        b.classList.add("bg-slate-50", "text-slate-600");
                    }
                });
                render();
            });
        }


        render();
    });
</script>

<?php get_footer(); ?>