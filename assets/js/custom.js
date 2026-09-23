function marquees() {	
	document.fonts.ready.then(() => {
		//journal banner
		const jt = document.querySelector('.journal-track');
		const span = jt.querySelector('.journal-title');
		jt.appendChild(span.cloneNode(true));

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


function randomImg() {
	document.querySelectorAll('.project-thumb').forEach(img => {
		const vW  = window.innerWidth;
		const imgW = img.getBoundingClientRect().width;

		const randomPos = Math.floor(Math.random() * ((vW - imgW - 60) / 30)) * 30;

		img.style.left = randomPos + 'px';
		img.classList.add('loaded');
	})
}

marquees();
randomImg();