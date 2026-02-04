import './bootstrap';
import '../css/app.css';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

const mapLocales = (locales) => {
    return locales.map(locale => ({
        id: locale.id,
        code: locale.code,
        name: locale.name,
        image: locale.image?.startsWith('http') ? locale.image : `/${locale.image}`,
    }));
}

Alpine.data('localeSwitcher', (locales) => ({
    open: false,
    locales: mapLocales(locales),

    toggle() {
        this.open = !this.open;
    },

    setLocale(locale) {
        const path = window.location.pathname === '/'
            ? ''
            : window.location.pathname;
        window.location.href = `${path}?lang=${locale.code}`;
    }
}));

Alpine.data('localeForm', () => {
    //
});

Alpine.start();