(function () {
  const toggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-primary-nav]');
  const header = document.querySelector('[data-site-header]');
  const promo = document.querySelector('[data-promo-banner]');
  const promoClose = document.querySelector('[data-promo-close]');

  const closeNav = () => {
    if (!toggle || !nav) {
      return;
    }

    toggle.setAttribute('aria-expanded', 'false');
    nav.classList.remove('is-open');
    document.body.classList.remove('nav-open');
  };

  if (toggle && nav) {
    toggle.addEventListener('click', (event) => {
      event.stopPropagation();
      const isOpen = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!isOpen));
      nav.classList.toggle('is-open', !isOpen);
      document.body.classList.toggle('nav-open', !isOpen);
    });

    nav.addEventListener('click', (event) => {
      if (event.target.closest('a')) {
        closeNav();
      }
    });

    document.addEventListener('click', (event) => {
      if (!nav.classList.contains('is-open')) {
        return;
      }

      if (!nav.contains(event.target) && !toggle.contains(event.target)) {
        closeNav();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        closeNav();
      }
    });

    window.addEventListener('resize', () => {
      if (window.matchMedia('(min-width: 761px)').matches) {
        closeNav();
      }
    });
  }

  if (promo && promoClose) {
    const promoStorageKey = 'growmodoPromoDismissed';

    if (window.sessionStorage && sessionStorage.getItem(promoStorageKey) === '1') {
      promo.hidden = true;
      promo.classList.add('is-hidden');
    }

    promoClose.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();
      promo.hidden = true;
      promo.classList.add('is-hidden');

      if (window.sessionStorage) {
        sessionStorage.setItem(promoStorageKey, '1');
      }
    });
  }

  if (header) {
    const setHeaderState = () => {
      header.classList.toggle('is-scrolled', window.scrollY > 8);
    };
    setHeaderState();
    window.addEventListener('scroll', setHeaderState, { passive: true });
  }

  const form = document.querySelector('[data-contact-form]');
  const note = document.querySelector('[data-form-note]');
  if (form && note && new URLSearchParams(window.location.search).get('contact') === 'sent') {
    note.hidden = false;
  }
})();
