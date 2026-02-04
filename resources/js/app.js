import './bootstrap';
import "../css/app.css";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('localeSwitcher', () => ({
    open: false,
    locales: [
        { code: 'en', label: 'English' },
        { code: 'el', label: 'Ελληνικά' }
    ],
    toggle() {
        this.open = !this.open
    },
    setLocale(code) {
        window.location.href = `${window.location.pathname}?lang=${code}`
    }
}));

Alpine.data('inputLocaleSwitcher', (Locales) => {
    const localesData = Locales.map(locale => ({
        id: locale.id,
        name: locale.name,
        image: locale.image.startsWith('http') ? locale.image : `/${locale.image}`
    }));

    return {
        open: false,
        localesData,
        selectedLocale: localesData[0],
        titles: {},
        touched: {},

        selectLocale(locale) {
            this.selectedLocale = locale;
            this.open = false;
        }
    }
});



Alpine.start();