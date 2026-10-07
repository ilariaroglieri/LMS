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
	// const marquee = document.querySelector('#journal-banner');

	const setMainOffset = () => {
	  document.documentElement.style.setProperty('--header-height', header.offsetHeight + 'px');
	  // document.documentElement.style.setProperty('--marquee-height', marquee.offsetHeight + 'px');
	};

	setMainOffset();
	window.addEventListener('resize', setMainOffset);
}

// dynamic loading
function dynamicLoad() {
  const panel = document.getElementById('project-panel');
  if (!panel) return;
  const body = panel.querySelector('.project-panel-body');
  const close = panel.querySelector('.project-panel-close');
	const endpoint = panel.dataset.endpoint;
  let slider = null;

	async function loadProject(id) {
	  if (slider) {
	    slider.destroy(true, true);
	    slider = null;
	  }

	  body.classList.remove('loaded');
	  body.innerHTML = '';

	  const response = await fetch(endpoint + id);
	  const data = await response.json();

	  body.innerHTML = data.html;
	  slider = initSlider(body);
	  body.classList.add('loaded');
	}

  document.addEventListener('click', (e) => {
    const link = e.target.closest('.project .overall');
    if (!link) return;

    e.preventDefault();
    panel.dataset.state = 'open';
    loadProject(link.dataset.id);
  });

  close.addEventListener('click', () => {
    panel.dataset.state = 'closed';
    body.innerHTML = '';
  });
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

marquees();
randomImg();
journalAccordion();
initSlider(document);

heightVariables();
dynamicLoad();