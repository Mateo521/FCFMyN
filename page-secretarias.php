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

            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>