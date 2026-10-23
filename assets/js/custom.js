function marquees() {	
	document.fonts.ready.then(() => {
		//journal banner
		const jt = document.querySelector('.journal-track');
		if (jt) {
			const span = jt.querySelector('.journal-titles');
			jt.appendChild(span.cloneNode(true));
		}

		// projects list
		document.querySelectorAll('.project-title-track').forEach(track => {
			const span = track.querySelector('.project-title');
			const titleW = span.getBoundingClientRect().width;
			const vW  = window.innerWidth;

			if (titleW >= vW) {
				track.classList.add('is-long');
	      track.appendChild(span.cloneNode(true));
			} else {
	      track.classList.add('is-short');

	      const clone = span.cloneNode(true);
	      clone.classList.add('clone');
	      track.appendChild(clone);
	    }
		})
	})
}

// homepage thumbnails
function randomImg() {
	document.querySelectorAll('.project-thumb').forEach(img => {
		const vW  = window.innerWidth;
		const imgW = img.getBoundingClientRect().width;

		const randomPos = Math.floor(Math.random() * ((vW - imgW - 60) / 30)) * 30;

		img.style.left = randomPos + 'px';
		img.classList.add('loaded');
	})
}

// home page intro panel
function hideIntroOnScroll() {
  const panel = document.querySelector('#intro-panel');

  if (!sessionStorage.getItem('introHidden')) {
    panel.classList.add('visible');

    document.addEventListener('scroll', () => {
      panel.classList.remove('visible');
      sessionStorage.setItem('introHidden', true);
    }, { once: true });
  }
}

// journal accordion
function journalAccordion() {
	const jItem = document.querySelectorAll('.journal-item');

	if (jItem) {
		jItem.forEach(item => {
			const btn = item.querySelector('.journal-header');

			btn.addEventListener('click', function() {
				console.log('click');
        const content = btn.nextElementSibling;
        content.classList.toggle('visible');
      });
		})
	}
}

// dynamic height calculations
function heightVariables() {
  const header = document.querySelector('header');

  const setMainOffset = () => {
    document.documentElement.style.setProperty('--header-height', header.offsetHeight + 'px');
    
    const marquee = document.querySelector('#journal-banner');
    if (marquee) {
      document.documentElement.style.setProperty('--marquee-height', marquee.offsetHeight + 'px');
    }
  };

  setMainOffset();
  window.addEventListener('resize', setMainOffset);
}

// dynamic loading
function dynamicLoad({ panelId, trigger, onLoad, onOpen, bodyLocked }) {
  const panel = document.getElementById(panelId);
  if (!panel) return null;

  const panelBody = panel.querySelector('[data-panel-body]');
  const closeBtn = panel.querySelector('[data-panel-close]');
  const endpoint = panel.dataset.endpoint;
  let cleanup = null;
  let currentId = null;

  async function load(id) {
    if (cleanup) {
      cleanup();
      cleanup = null;
    }

    panelBody.classList.remove('loaded');
    panelBody.innerHTML = '';

    const response = await fetch(endpoint + id);
    const data = await response.json();

    panelBody.innerHTML = data.html;
    if (onLoad) cleanup = onLoad(panelBody, { panel, closePanel}) || null; // init + salva la pulizia per il prossimo load
    
    panelBody.classList.add('loaded');
  }

  function openPanel(id) {
    if (onOpen) onOpen();
    currentId = id;
    panel.dataset.state = 'open';
    if (bodyLocked) document.body.classList.add('locked');
    load(id);
  }

  async function closePanel() {
    if (panel.dataset.state !== 'open') return;

    panel.dataset.state = 'closed';
    if (bodyLocked) document.body.classList.remove('locked');

    // aspetta la fine delle transizioni del pannello
    await Promise.all(panel.getAnimations().map((a) => a.finished.catch(() => {})));
    panel.scrollTop = 0;
  }

  document.addEventListener('click', async (e) => {
    const link = e.target.closest(trigger);
    if (!link) return;

    e.preventDefault();
    const id = link.dataset.id;

    if (panel.dataset.state === 'open') {
      const sameId = id === currentId;
      await closePanel();
      if (sameId) return;
    }

    openPanel(id);
  });

  closeBtn.addEventListener('click', closePanel);

  return { closePanel };
}

// single page slider
function initSlider(root) {
  const el = root.querySelector('.swiper-slider');
  if (!el) return null;

  return new Swiper(el, {
    autoplay: false,
    slidesPerView: 1,
    centeredSlides: true,
    loop: true,
    effect: 'fade',
    navigation: {
      nextEl: el.querySelector('.swiper-button-next'),
      prevEl: el.querySelector('.swiper-button-prev'),
    },
  });
}

// archive filters
function archiveFilters() {
  const buttons  = document.querySelectorAll('#cats-container button[data-cat]');
  const projects = document.querySelectorAll('#projects-container .single-project');
  if (!buttons.length || !projects.length) return;

  const FADE = 400; // uguale alla durata nel CSS
  let timer;

  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      const cat = btn.dataset.cat;

      buttons.forEach(b => {
        const isActive = b === btn;
        b.classList.toggle('active', isActive);
        b.setAttribute('aria-pressed', isActive);
      });

      const match = p => cat === 'all' || (p.dataset.projectCat || '').split(' ').includes(cat);

      clearTimeout(timer);

      // 1. fade out di quelli visibili che non corrispondono
      projects.forEach(p => {
        if (!p.classList.contains('hidden')) {
          p.classList.toggle('is-fading', !match(p));
        }
      });

      // 2. a fade finito: tolgo dal layout gli uni, rimetto gli altri a opacity 0
      timer = setTimeout(() => {
        const entering = [];

        projects.forEach(p => {
          const show = match(p);
          if (!show) {
            p.classList.add('hidden');
          } else if (p.classList.contains('hidden')) {
            p.classList.remove('hidden');
            p.classList.add('is-fading');
            entering.push(p);
          }
        });

        // 3. al frame successivo tolgo is-fading, così parte il fade in
        requestAnimationFrame(() => requestAnimationFrame(() => {
          entering.forEach(p => p.classList.remove('is-fading'));
        }));
      }, FADE);
    });
  });
}


document.addEventListener('DOMContentLoaded', () => {
	marquees();
	randomImg();
	journalAccordion();
	initSlider(document);

	heightVariables();

  if (document.body.classList.contains('home')) {
    hideIntroOnScroll();
  } else if (document.body.classList.contains('page-id-3837') || document.body.classList.contains('page-id-3862')) {
    archiveFilters();
  }

	const journalPanel = dynamicLoad({
	  panelId: 'journal-panel',
	  trigger: '.journal-titles a',
	  bodyLocked: false,
	});

	dynamicLoad({
	  panelId: 'project-panel',
	  trigger: '.project .overall',
	  onLoad: (root, { panel, closePanel }) => {
	    const slider = initSlider(root); // init slider

      function onScroll() {
        const end = panel.scrollTop + panel.clientHeight >= panel.scrollHeight - 1;

        if (end) closePanel();
      }

      panel.addEventListener('scroll', onScroll, {passive: true});

	    return () => {
        slider?.destroy(true, true);
        panel.removeEventListener('scroll', onScroll);
      };
	  },
	  onOpen: () => journalPanel?.closePanel(),
	  bodyLocked: true,
	});

  document.querySelector('body').classList.add('loaded');

  // mobile-menu {
  const toggle = document.querySelector('.menu-toggle');
  const menu = document.querySelector('div[class*="menu-1"]');

  toggle.addEventListener('click', () => {
    toggle.classList.toggle('open');
    menu.classList.toggle('open');
  });
});