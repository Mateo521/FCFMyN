<?php

/**
 * Template Name: Índice de Disciplinas
 */
get_header();
get_template_part('template-parts/navbar');
?>


<section id="secretarias" class="pt-28 bg-[#FFF7F5]">
    <div class="max-w-7xl mx-auto  px-3">


        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-16">
            <div>

                <h2 class="s text-[clamp(2.5rem,5vw,4rem)] font-semibold text-[#75232c] leading-none">Secretarías</h2>
                <!--div class="w-12 h-px bg-[#dd7859] mt-5"></div-->
            </div>
            <p class="text-slate-500 text-sm leading-relaxed max-w-xs font-semibold">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, inventore corrupti!
            </p>
        </div>


    </div>






    <div class="tarjetas py-4">
        <div class="max-w-7xl mx-auto  px-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">


                <div
                    class="bg-white  p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group rounded-sm">
                    <!--div
            class="w-11 h-11 bg-[#faf8f6] flex items-center justify-center mb-6 group-hover:bg-[#dd7859]/10 transition-colors duration-300">
            <svg class="w-5 h-5 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-1.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
          </div-->
                    <h3 class="s text-[1.2rem] font-semibold text-[#75232c] mb-2">Secretaría Académica</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed font-semibold">Gestión de planes de estudio, seguimiento
                        estudiantil y articulación con departamentos docentes.</p>
                    <a href="#"
                        class="inline-flex items-center gap-1.5 text-[#dc5d34] text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200 group/link">
                        Ver secretaría
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>


                <div
                    class="bg-white  p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group rounded-sm">
                    <!--div
            class="w-11 h-11 bg-[#faf8f6] flex items-center justify-center mb-6 group-hover:bg-[#cf2e2e]/10 transition-colors duration-300">
            <svg class="w-5 h-5 text-[#cf2e2e]" fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
            </svg>
          </div-->
                    <h3 class="s text-[1.2rem] font-semibold text-[#75232c] mb-2">Secretaría Administrativa</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed font-semibold">Recursos humanos, presupuesto,
                        infraestructura y servicios generales de la unidad académica.</p>
                    <a href="#"
                        class="inline-flex items-center gap-1.5 text-[#cf2e2e] text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200">
                        Ver secretaría
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>


                <div
                    class="bg-white  p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group rounded-sm">
                    <!--div
            class="w-11 h-11 bg-[#faf8f6] flex items-center justify-center mb-6 group-hover:bg-[#dc5d34]/10 transition-colors duration-300">
            <svg class="w-5 h-5 text-[#dc5d34]" fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 1-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
            </svg>
          </div-->
                    <h3 class="s text-[1.2rem] font-semibold text-[#75232c] mb-2">Investigación y Posgrado</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed font-semibold">Articulación de proyectos de
                        investigación,
                        grupos de investigación y programas de posgrado.</p>
                    <a href="#"
                        class="inline-flex items-center gap-1.5 text-[#dc5d34] text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200">
                        Ver secretaría
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>


                <div
                    class="bg-white  p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group rounded-sm">
                    <!--div
            class="w-11 h-11 bg-[#faf8f6] flex items-center justify-center mb-6 group-hover:bg-[#75232c]/10 transition-colors duration-300">
            <svg class="w-5 h-5 text-[#75232c]" fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
            </svg>
          </div-->

                    <h3 class="s text-[1.2rem] font-semibold text-[#75232c] mb-2">Secretaría General</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed font-semibold">Actas de Consejo Directivo, resoluciones
                        decanales y coordinación institucional general.</p>
                    <a href="#"
                        class="inline-flex items-center gap-1.5 text-[#75232c] text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200">
                        Ver secretaría
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>


                <div
                    class="bg-white  p-7 shadow-sm hover:shadow-md transition-shadow duration-300 group rounded-sm">
                    <!--div
            class="w-11 h-11 bg-[#faf8f6] flex items-center justify-center mb-6 group-hover:bg-[#dd7859]/10 transition-colors duration-300">
            <svg class="w-5 h-5 text-[#dd7859]" fill="none" stroke="currentColor" stroke-width="1.5"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
            </svg>
          </div-->
                    <h3 class="s text-[1.2rem] font-semibold text-[#75232c] mb-2">Vinculación y Extensión</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed font-semibold">Proyectos de extensión universitaria,
                        transferencia tecnológica y vínculos con el medio productivo y social.</p>
                    <a href="#"
                        class="inline-flex items-center gap-1.5 text-[#dd7859] text-base font-medium mt-5 hover:gap-2.5 transition-all duration-200">
                        Ver secretaría
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

            </div><!-- /grid -->
        </div>
    </div>
</section>


<?php get_footer(); ?>