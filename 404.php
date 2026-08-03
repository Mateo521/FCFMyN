<?php

get_header();
get_template_part('template-parts/navbar');
?>

<section class="relative min-h-[calc(100vh-70px)] bg-[#69151E] text-white overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(221,120,89,0.35),transparent_35%),radial-gradient(circle_at_bottom_right,rgba(119,30,30,0.35),transparent_25%)]"></div>
    <div class="relative max-w-6xl mx-auto px-6 lg:px-10 py-24 flex flex-col justify-center h-full">
        <div class="max-w-3xl">
            <span class="inline-flex items-center px-3 py-1 rounded bg-[#dd7859]/15 text-[#dd7859] text-xs font-semibold uppercase  mb-6">
                Error 404
            </span>
            <h1 class="font-black text-white text-[clamp(3rem,7vw,5.75rem)] leading-[0.95] mb-6">
                Página no encontrada
            </h1>
            <p class="text-white/80 text-lg leading-relaxed max-w-2xl mb-10">
                Lo sentimos, la ruta que intentaste visitar no existe o fue movida. Podés volver al inicio, buscar en el sitio o explorar algunas secciones destacadas.
            </p>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center justify-center rounded bg-[#dd7859] px-8 py-4 text-sm font-semibold uppercase tracking-[0.12em] text-white shadow-lg shadow-[#dd7859]/20 hover:bg-[#c45a54] transition-all duration-300">
                    Volver al inicio
                </a>
                <!--a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="inline-flex items-center justify-center rounded border border-white/20 bg-white/5 px-8 py-4 text-sm font-semibold uppercase tracking-[0.12em] text-white hover:border-[#dd7859] hover:bg-white/10 transition-all duration-300">
                    Contacto
                </a-->
            </div>
        </div>
    </div>
</section>

<section class="bg-[#fff7f5] py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="grid gap-8 lg:grid-cols-[1.4fr_1fr] items-center">
            <div class="rounded bg-white p-10 shadow-[0_30px_60px_rgba(0,0,0,0.08)] border border-[#dd7859]/10">
                <h2 class="text-3xl font-semibold text-[#75232c] mb-4">¿Querés encontrar algo específico?</h2>
                <p class="text-slate-600 mb-8">Usá el buscador para buscar carreras, noticias...</p>

                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex flex-col sm:flex-row gap-3">
                    <label for="search-404" class="sr-only">Buscar</label>
                    <input id="search-404" type="search" name="s" placeholder="Buscar carreras, noticias..." class="min-w-0 flex-1 rounded border border-[#d9d4d2] bg-white px-5 py-4 text-sm text-slate-900 outline-none focus:border-[#dd7859] focus:ring-4 focus:ring-[#dd7859]/10 transition-all duration-300" />
                    <button type="submit" class="rounded bg-[#75232c] px-8 py-4 text-sm font-semibold uppercase tracking-[0.12em] text-white hover:bg-[#5d1515] transition-all duration-300">Buscar</button>
                </form>
            </div>

            <div class="rounded bg-[#75232c] bg-opacity-5 p-10 border border-[#75232c]/10">
                <h3 class="text-2xl font-semibold text-[#75232c] mb-6">Secciones recomendadas</h3>
                <ul class="space-y-4 text-[#2c1a18]">
                    <li>
                        <a href="<?php echo esc_url(home_url('/carreras/')); ?>" class="block rounded bg-white/90 px-6 py-5 hover:bg-[#fff1ee] transition-colors duration-300">
                            <span class="text-base font-semibold">Carreras</span>
                            <p class="text-sm text-[#6b4d49] mt-1">Descubrí nuestra oferta académica y modalidades.</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/disciplinas/')); ?>" class="block rounded bg-white/90 px-6 py-5 hover:bg-[#fff1ee] transition-colors duration-300">
                            <span class="text-base font-semibold">Disciplinas</span>
                            <p class="text-sm text-[#6b4d49] mt-1">Explorá los campos de estudio y sus carreras relacionadas.</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/secretarias/')); ?>" class="block rounded bg-white/90 px-6 py-5 hover:bg-[#fff1ee] transition-colors duration-300">
                            <span class="text-base font-semibold">Secretarías</span>
                            <p class="text-sm text-[#6b4d49] mt-1">Conocé las áreas de gestión y responsabilidad dentro de la facultad.</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
