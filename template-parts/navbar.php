<header class="sticky top-0 z-50 bg-[#751B1B] border-b border-white/10 shadow-md">
    <nav class="max-w-7xl mx-auto px-6 lg:px-10 h-[70px] flex items-center justify-between">

        <a href="<?php echo home_url(); ?>" class="flex items-center gap-4 group z-50">
            <img src="https://fmnvz.unsl.edu.ar/wp-content/uploads/2019/11/Logo-Horizontal.svg" alt="Logo FCFMyN" class="h-12 lg:h-14 w-auto opacity-90 group-hover:opacity-100 transition-opacity duration-300 invert brightness-0">
        </a>

        <div class="hidden lg:flex items-center gap-8">
            <a href="<?php echo home_url('/secretarias/'); ?>" class="relative text-white/80 hover:text-white text-sm font-semibold uppercase transition-colors duration-300 group/link">
                Secretarías
                <span class="absolute -bottom-2 left-0 w-0 h-px bg-[#dd7859] transition-all duration-300 group-hover/link:w-full"></span>
            </a>

            <a href="<?php echo home_url('/carreras/'); ?>" class="relative text-white/80 hover:text-white text-sm font-semibold uppercase transition-colors duration-300 group/link">
                Carreras
                <span class="absolute -bottom-2 left-0 w-0 h-px bg-[#dd7859] transition-all duration-300 group-hover/link:w-full"></span>
            </a>

            <a href="<?php echo home_url('/disciplinas/'); ?>" class="relative text-white/80 hover:text-white text-sm font-semibold uppercase transition-colors duration-300 group/link">
                Disciplinas
                <span class="absolute -bottom-2 left-0 w-0 h-px bg-[#dd7859] transition-all duration-300 group-hover/link:w-full"></span>
            </a>

            <a href="<?php echo home_url('/noticias/'); ?>" class="relative text-white/80 hover:text-white text-sm font-semibold uppercase transition-colors duration-300 group/link">
                Noticias
                <span class="absolute -bottom-2 left-0 w-0 h-px bg-[#dd7859] transition-all duration-300 group-hover/link:w-full"></span>
            </a>

            <a href="<?php echo home_url('/contacto/'); ?>" class="relative text-white/80 hover:text-white text-sm font-semibold uppercase transition-colors duration-300 group/link">
                Contacto
                <span class="absolute -bottom-2 left-0 w-0 h-px bg-[#dd7859] transition-all duration-300 group-hover/link:w-full"></span>
            </a>

            <a href="https://sgu.unsl.edu.ar/preinscripcion/" target="_blank" class="ml-4 bg-[#dd7859] hover:bg-white text-white hover:text-[#75232c] text-sm font-bold uppercase px-7 py-3 rounded-sm transition-all duration-300 shadow-sm hover:shadow-lg">
                Ingreso 2025
            </a>
        </div>

        <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-sm text-white/90 hover:text-white hover:bg-white/10 transition-colors duration-200 z-50">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
        </button>
    </nav>

    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-[60] hidden opacity-0 transition-opacity duration-300 backdrop-blur-sm"></div>

    <div id="mobile-menu" class="fixed top-0 right-0 w-4/5 max-w-sm h-screen bg-[#751B1B] z-[70] transform translate-x-full transition-transform duration-300 ease-in-out shadow-2xl flex flex-col">

        <div class="h-[70px] px-6 flex items-center justify-end border-b border-white/10">
            <button id="close-menu-btn" class="p-2 rounded-sm text-white/70 hover:text-white hover:bg-white/10 transition-colors duration-200">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto py-8 px-6 flex flex-col gap-6">
            <a href="<?php echo home_url('/secretarias/'); ?>" class="text-white text-lg font-bold uppercase tracking-wider hover:text-[#dd7859] transition-colors">Secretarías</a>
            <a href="<?php echo home_url('/carreras/'); ?>" class="text-white text-lg font-bold uppercase tracking-wider hover:text-[#dd7859] transition-colors">Carreras</a>
            <a href="<?php echo home_url('/disciplinas/'); ?>" class="text-white text-lg font-bold uppercase tracking-wider hover:text-[#dd7859] transition-colors">Disciplinas</a>
            <a href="<?php echo home_url('/noticias/'); ?>" class="text-white text-lg font-bold uppercase tracking-wider hover:text-[#dd7859] transition-colors">Noticias</a>
            <a href="<?php echo home_url('/contacto/'); ?>" class="text-white text-lg font-bold uppercase tracking-wider hover:text-[#dd7859] transition-colors">Contacto</a>

            <div class="mt-8 pt-8 border-t border-white/10">
                <a href="https://sgu.unsl.edu.ar/preinscripcion/" target="_blank" class="block text-center bg-[#dd7859] text-white text-sm font-bold uppercase tracking-widest py-4 rounded-sm hover:bg-white hover:text-[#751B1B] transition-colors">
                    Ingreso 2025
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnOpen = document.getElementById('mobile-menu-btn');
        const btnClose = document.getElementById('close-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-menu-overlay');
        const openMenu = () => {
            overlay.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                menu.classList.remove('translate-x-full');
            }, 10);
            document.body.style.overflow = 'hidden';
        };
        const closeMenu = () => {
            menu.classList.add('translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 300);
            document.body.style.overflow = '';
        };
        btnOpen.addEventListener('click', openMenu);
        btnClose.addEventListener('click', closeMenu);
        overlay.addEventListener('click', closeMenu);
    });
</script>