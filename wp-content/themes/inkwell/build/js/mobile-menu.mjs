export const mobileMenu = () => {
    const elements = {
        trigger: document.querySelector('.mobile-tav-trigger'),
        menu: document.querySelector('.theme-main-menu'),
        body: document.querySelector('body')
    };

    const toggleMenu = () => {
        elements.menu.classList.toggle('open');
        elements.body.style.position = elements.body.style.position === 'fixed' ? '' : 'fixed';
    };

    elements.trigger.addEventListener('click', toggleMenu);
};