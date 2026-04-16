<?php

/**
 * Template Name: Índice de Disciplinas
 */
get_header();
get_template_part('template-parts/navbar');
?>

<div class="pt-28 bg-[#FFF7F5]">
    <div class="max-w-7xl mx-auto px-3"> <!--   lg:px-10 -->


        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-16">
            <div>

                <h2 class="s text-[clamp(2.5rem,5vw,4rem)] font-semibold text-[#75232c] leading-none">Disciplinas</h2>
                <!--div class="w-12 h-px bg-[#dd7859] mt-5"></div-->
            </div>
            <p class="text-slate-500 text-sm leading-relaxed max-w-xs font-semibold">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, inventore corrupti!
            </p>
        </div>


    </div>

    <section id="disciplinas" class="py-4">
        <div class="max-w-7xl mx-auto  px-3"> <!-- lg:px-10  px-6 -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">






                <a href="<?php echo home_url('/disciplina/electronica'); ?>"
                    class="group bg-white p-8 hover:bg-[#75232c] transition-colors duration-300 relative rounded-sm overflow-hidden">
                    <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
        </div-->
                    <div class="relative flex flex-col items-end">
                        <div class="w-12 h-12 mb-6 flex items-center justify-center">
                            <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="14" y="14" width="20" height="20" rx="2" stroke="#dd7859" stroke-width="1.5" />
                                <line x1="8" y1="20" x2="14" y2="20" stroke="#dd7859" stroke-width="1.5" />
                                <line x1="8" y1="28" x2="14" y2="28" stroke="#dd7859" stroke-width="1.5" />
                                <line x1="34" y1="20" x2="40" y2="20" stroke="#dd7859" stroke-width="1.5" />
                                <line x1="34" y1="28" x2="40" y2="28" stroke="#dd7859" stroke-width="1.5" />
                                <line x1="20" y1="8" x2="20" y2="14" stroke="#dd7859" stroke-width="1.5" />
                                <line x1="28" y1="8" x2="28" y2="14" stroke="#dd7859" stroke-width="1.5" />
                                <line x1="20" y1="34" x2="20" y2="40" stroke="#dd7859" stroke-width="1.5" />
                                <line x1="28" y1="34" x2="28" y2="40" stroke="#dd7859" stroke-width="1.5" />
                                <circle cx="24" cy="24" r="3" fill="#dd7859" opacity="0.7" />
                            </svg>
                        </div>
                        <h3
                            class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                            Electrónica</h3>
                        <p
                            class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                            Diseño de sistemas electrónicos, telecomunicaciones y procesamiento de señales.
                        </p>
                        <div
                            class="flex items-center gap-2 text-[#dd7859] group-hover:text-[#dd7859] text-sm font-semibold  uppercase">
                            <span>1 carrera</span>
                            <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </a>


                <a href="<?php echo home_url('/disciplina/fisica'); ?>"
                    class="group bg-white p-8 hover:bg-[#75232c] transition-colors duration-300 relative rounded-sm overflow-hidden">
                    <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                    <div class="relative flex flex-col items-end">
                        <div class="w-12 h-12 mb-6 flex items-center justify-center">
                            <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <ellipse cx="24" cy="24" rx="18" ry="7" stroke="#cf2e2e" stroke-width="1.5" opacity="0.8" />
                                <ellipse cx="24" cy="24" rx="18" ry="7" stroke="#cf2e2e" stroke-width="1.5" opacity="0.5"
                                    transform="rotate(60 24 24)" />
                                <ellipse cx="24" cy="24" rx="18" ry="7" stroke="#cf2e2e" stroke-width="1.5" opacity="0.5"
                                    transform="rotate(120 24 24)" />
                                <circle cx="24" cy="24" r="3.5" fill="#cf2e2e" opacity="0.85" />
                            </svg>
                        </div>
                        <h3
                            class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                            Física</h3>
                        <p
                            class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                            Física teórica, experimental y aplicada. Formación en investigación científica de frontera.
                        </p>
                        <div
                            class="flex items-center gap-2 text-[#cf2e2e] group-hover:text-[#dd7859] text-sm font-semibold  uppercase transition-colors duration-300">
                            <span>3 carreras</span>
                            <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </a>


                <a href="<?php echo home_url('/disciplina/geologia'); ?>"
                    class="group bg-white p-8 hover:bg-[#75232c] transition-colors duration-300 relative rounded-sm overflow-hidden">
                    <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                    <div class="relative flex flex-col items-end">
                        <div class="w-12 h-12 mb-6 flex items-center justify-center">
                            <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Mountain layers -->
                                <path d="M6 38 L18 16 L24 26 L30 18 L42 38 Z" stroke="#dc5d34" stroke-width="1.5"
                                    stroke-linejoin="round" fill="none" opacity="0.85" />
                                <line x1="6" y1="32" x2="42" y2="32" stroke="#dc5d34" stroke-width="0.8" opacity="0.35"
                                    stroke-dasharray="3,2" />
                                <line x1="6" y1="26" x2="42" y2="26" stroke="#dc5d34" stroke-width="0.8" opacity="0.25"
                                    stroke-dasharray="3,2" />
                            </svg>
                        </div>
                        <h3
                            class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                            Geología</h3>
                        <p
                            class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                            Estudio de la tierra, sus recursos, estructura y dinámica. Geología ambiental y aplicada.
                        </p>
                        <div
                            class="flex items-center gap-2 text-[#dc5d34] group-hover:text-[#dd7859] text-sm font-semibold  uppercase transition-colors duration-300">
                            <span>3 carreras</span>
                            <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </a>


                <a href="<?php echo home_url('/disciplina/informatica'); ?>"
                    class="group bg-white p-8 hover:bg-[#75232c] transition-colors duration-300 relative rounded-sm overflow-hidden">
                    <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                    <div class="relative flex flex-col items-end">
                        <div class="w-12 h-12 mb-6 flex items-center justify-center">
                            <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="6" y="10" width="36" height="24" rx="2" stroke="#dd7859" stroke-width="1.5" />
                                <line x1="17" y1="38" x2="31" y2="38" stroke="#dd7859" stroke-width="1.5" stroke-linecap="round" />
                                <line x1="24" y1="34" x2="24" y2="38" stroke="#dd7859" stroke-width="1.5" />
                                <text x="11" y="27" font-family="monospace" font-size="10" fill="#dd7859" opacity="0.6">&lt;/&gt;</text>
                            </svg>
                        </div>
                        <h3
                            class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                            Informática</h3>
                        <p
                            class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                            Ciencias de la computación, inteligencia artificial, software y redes de datos.
                        </p>
                        <div
                            class="flex items-center gap-2 text-[#75232c] group-hover:text-[#dd7859] text-sm font-semibold  uppercase transition-colors duration-300">
                            <span>4 carreras</span>
                            <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </a>


                <a href="<?php echo home_url('/disciplina/matematica'); ?>"
                    class="group bg-white p-8 hover:bg-[#75232c]  transition-colors duration-300 relative rounded-sm overflow-hidden">
                    <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                    <div class="relative flex flex-col items-end">
                        <div class="w-12 h-12 mb-6 flex items-center justify-center">
                            <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Integral symbol -->
                                <text x="8" y="36" font-family="Georgia,serif" font-size="32" fill="#dd7859" opacity="0.85"
                                    font-weight="300">∫</text>
                                <text x="26" y="22" font-family="Georgia,serif" font-size="14" fill="#dd7859" opacity="0.5"
                                    font-weight="300">π</text>
                                <text x="28" y="36" font-family="Georgia,serif" font-size="12" fill="#dd7859" opacity="0.45">dx</text>
                            </svg>
                        </div>
                        <h3
                            class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                            Matemática</h3>
                        <p
                            class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                            Álgebra, análisis, estadística y matemática aplicada. Formación pura y docente.
                        </p>
                        <div
                            class="flex items-center gap-2 text-[#dd7859] group-hover:text-[#dd7859] text-sm font-semibold  uppercase transition-colors duration-300">
                            <span>3 carreras</span>
                            <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </a>


                <a href="<?php echo home_url('/disciplina/mineria'); ?>"
                    class="group bg-white p-8 hover:bg-[#75232c] transition-colors duration-300 relative rounded-sm overflow-hidden">
                    <!--div
            class="absolute top-0 right-0 w-24 h-24 translate-x-8 -translate-y-8 rounded-full bg-[#dd7859]/5 group-hover:bg-white/5 transition-colors duration-300">
          </div-->
                    <div class="relative flex flex-col items-end">
                        <div class="w-12 h-12 mb-6 flex items-center justify-center">
                            <svg viewBox="0 0 48 48" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Crystal / hexagon -->
                                <polygon points="24,6 38,15 38,33 24,42 10,33 10,15" stroke="#cf2e2e" stroke-width="1.5" fill="none"
                                    opacity="0.85" />
                                <line x1="24" y1="6" x2="24" y2="42" stroke="#cf2e2e" stroke-width="0.7" opacity="0.3" />
                                <line x1="10" y1="15" x2="38" y2="33" stroke="#cf2e2e" stroke-width="0.7" opacity="0.3" />
                                <line x1="10" y1="33" x2="38" y2="15" stroke="#cf2e2e" stroke-width="0.7" opacity="0.3" />
                                <circle cx="24" cy="24" r="2.5" fill="#cf2e2e" opacity="0.6" />
                            </svg>
                        </div>
                        <h3
                            class="s text-xl font-semibold text-[#75232c] group-hover:text-white mb-2 transition-colors duration-300">
                            Minería</h3>
                        <p
                            class="text-slate-500 group-hover:text-white/55 text-[13px] leading-relaxed font-semibold transition-colors duration-300 mb-5">
                            Ingeniería de minas, procesamiento de minerales y desarrollo de industrias extractivas.
                        </p>
                        <div
                            class="flex items-center gap-2 text-[#cf2e2e] group-hover:text-[#dd7859] text-sm font-semibold  uppercase transition-colors duration-300">
                            <span>2 carreras</span>
                            <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform duration-200" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </a>


            </div>
        </div>
    </section>

    <style>
        #disciplinas {
            background-color: #410902;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120' viewBox='0 0 120 120'%3E%3Cpolygon fill='%23520B02' points='120 120 60 120 90 90 120 60 120 0 120 0 60 60 0 0 0 60 30 90 60 120 120 120 '/%3E%3C/svg%3E");
        }
    </style>

    <?php get_footer(); ?>