document.fonts.ready.then(() => {
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
