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

  const body = panel.querySelector('[data-panel-body]');
  const close = panel.querySelector('[data-panel-close]');
  const endpoint = panel.dataset.endpoint;
  let cleanup = null;
  let currentId = null;

  async function load(id) {
    if (cleanup) {
      cleanup();
      cleanup = null;
    }

    body.classList.remove('loaded');
    body.innerHTML = '';

    const response = await fetch(endpoint + id);
    const data = await response.json();

    body.innerHTML = data.html;
    if (onLoad) cleanup = onLoad(body) || null; // init + salva la pulizia per il prossimo load
    body.classList.add('loaded');
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

  close.addEventListener('click', closePanel);

  return { close: closePanel };
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

  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      const cat = btn.dataset.cat;

      buttons.forEach(b => {
        const isActive = b === btn;
        b.classList.toggle('active', isActive);
        b.setAttribute('aria-pressed', isActive);
      });

      projects.forEach(p => {
        const cats = (p.dataset.projectCat || '').split(' ');
        const show = cat === 'all' || cats.includes(cat);
        p.classList.toggle('hidden', !show);
      });
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
  } else if (document.body.classList.contains('page-id-3837')) {
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
	  onLoad: (root) => {
	    const slider = initSlider(root);
	    return () => slider?.destroy(true, true);
	  },
	  onOpen: () => journalPanel?.close(),
	  bodyLocked: true,
	});

  document.querySelector('body').classList.add('loaded');
});