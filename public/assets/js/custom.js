(function () {
    const $themeConfig = {
        locale: 'en', // en, da, de, el, es, fr, hu, it, ja, pl, pt, ru, sv, tr, zh
        theme: 'light', // light, dark, system
        menu: 'vertical', // vertical, collapsible-vertical, horizontal
        layout: 'full', // full, boxed-layout
        rtlClass: 'ltr', // rtl, ltr
        animation: '', // animate__fadeIn, animate__fadeInDown, animate__fadeInUp, animate__fadeInLeft, animate__fadeInRight, animate__slideInDown, animate__slideInLeft, animate__slideInRight, animate__zoomIn
        navbar: 'navbar-sticky', // navbar-sticky, navbar-floating, navbar-static
        semidark: false,
    };
    window.addEventListener('load', function () {
        // screen loader
        const screen_loader = document.getElementsByClassName('screen_loader');
        if (screen_loader?.length) {
            screen_loader[0].classList.add('animate__fadeOut');
            setTimeout(() => {
                document.body.removeChild(screen_loader[0]);
            }, 200);
        }

        // set rtl layout
        Alpine.store('app').setRTLLayout();
    });


    document.addEventListener('alpine:init', () => {

        Alpine.data('dropdown', (initialOpenState = false) => ({
            open: initialOpenState,

            toggle() {
                this.open = !this.open;
            },
        }));
        Alpine.data('modal', (initialOpenState = false) => ({
            open: initialOpenState,

            toggle() {
                this.open = !this.open;
            },
        }));

        // main - custom functions
        Alpine.data('main', (value) => ({}));

        Alpine.store('app', {
            // theme
            theme: Alpine.$persist($themeConfig.theme),
            isDarkMode: Alpine.$persist(false),
            toggleTheme(val) {
                if (!val) {
                    val = this.theme || $themeConfig.theme; // light|dark|system
                }

                this.theme = val;

                if (this.theme == 'light') {
                    this.isDarkMode = false;
                } else if (this.theme == 'dark') {
                    this.isDarkMode = true;
                } else if (this.theme == 'system') {
                    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        this.isDarkMode = true;
                    } else {
                        this.isDarkMode = false;
                    }
                }
            },

            // navigation menu
            menu: Alpine.$persist($themeConfig.menu),
            toggleMenu(val) {
                if (!val) {
                    val = this.menu || $themeConfig.menu; // vertical, collapsible-vertical, horizontal
                }
                this.sidebar = false; // reset sidebar state
                this.menu = val;
            },

            // layout
            layout: Alpine.$persist($themeConfig.layout),
            toggleLayout(val) {
                if (!val) {
                    val = this.layout || $themeConfig.layout; // full, boxed-layout
                }

                this.layout = val;
            },




            // animation
            animation: Alpine.$persist($themeConfig.animation),
            toggleAnimation(val) {
                if (!val) {
                    val = this.animation || $themeConfig.animation; // animate__fadeIn, animate__fadeInDown, animate__fadeInLeft, animate__fadeInRight
                }

                val = val?.trim();

                this.animation = val;
            },

            // navbar type
            navbar: Alpine.$persist($themeConfig.navbar),
            toggleNavbar(val) {
                if (!val) {
                    val = this.navbar || $themeConfig.navbar; // navbar-sticky, navbar-floating, navbar-static
                }

                this.navbar = val;
            },

            // semidark
            semidark: Alpine.$persist($themeConfig.semidark),
            toggleSemidark(val) {
                if (!val) {
                    val = this.semidark || $themeConfig.semidark;
                }

                this.semidark = val;
            },

            // multi language
            locale: Alpine.$persist($themeConfig.locale),
            toggleLocale(val) {
                if (!val) {
                    val = this.locale || $themeConfig.locale;
                }

                this.locale = val;
                if (this.locale?.toLowerCase() === 'ae') {
                    this.toggleRTL('rtl');
                } else {
                    this.toggleRTL('ltr');
                }
            },

            // sidebar
            sidebar: false,
            toggleSidebar() {
                this.sidebar = !this.sidebar;
            },
        });
    });
})();
