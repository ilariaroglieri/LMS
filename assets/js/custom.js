document.fonts.ready.then(() => {
	document.querySelectorAll('.project-title-track').forEach(track => {
		const span = track.querySelector('.project-title');
		const titleW = span.getBoundingClientRect().width;
		const wrapW = track.parentElement.getBoundingClientRect().width;
		span.style.setProperty('--title-w', titleW + 'px');

		const totalDist = wrapW + titleW;
		const duration = 15;
		const delay = -((wrapW / totalDist) * duration);

		if (titleW >= wrapW) {
			track.classList.add('is-long');
      track.appendChild(span.cloneNode(true));
		} else {
      track.classList.add('is-short');
      track.style.height = span.getBoundingClientRect().height + 'px';

      const clone = span.cloneNode(true);
      clone.style.setProperty('--title-w', titleW + 'px');
      clone.classList.add('clone');
      clone.style.animationDelay = delay + 's';
      track.appendChild(clone);
    }
	})
})
