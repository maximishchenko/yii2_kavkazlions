(function () {
  var root = document.documentElement;
  // Экран загрузки включается только на главной и только когда работает JS.
  var homeLoader = document.querySelector('.home-loading');
  if (homeLoader && document.body.classList.contains('home')) {
    homeLoader.hidden = false;
    var loaderShownAt = Date.now();
    var minDisplayTime = 3000;
    var loadingTimeout, minimumDisplayTimeout, loaderHidden = false;
    function hideHomeLoader() {
      if (loaderHidden) return;
      loaderHidden = true;
      clearTimeout(loadingTimeout);
      clearTimeout(minimumDisplayTimeout);
      homeLoader.hidden = true;
    }
    function hideAfterMinimumDisplay() {
      var remaining = minDisplayTime - (Date.now() - loaderShownAt);
      if (remaining <= 0) hideHomeLoader();
      else minimumDisplayTimeout = setTimeout(hideHomeLoader, remaining);
    }
    loadingTimeout = setTimeout(hideHomeLoader, 8000);
    if (document.readyState === 'complete') hideAfterMinimumDisplay();
    else window.addEventListener('load', hideAfterMinimumDisplay, {once: true});
  }

  // Мобильное меню
  var burger = document.querySelector('.burger');
  var nav = document.getElementById('nav');
  var menuHeader = document.querySelector('.header');
  if (burger && nav) {
    var updateNavTop = function () {
      if (!menuHeader) return;
      menuHeader.style.setProperty('--nav-top', Math.ceil(menuHeader.getBoundingClientRect().height) + 'px');
    };
    burger.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      burger.setAttribute('aria-expanded', open);
      if (open) updateNavTop();
    });
    window.addEventListener('resize', function () {
      if (nav.classList.contains('is-open')) updateNavTop();
    });
  }

  // Закреплённая шапка: тёмный фон, когда страница прокручена
  var header = document.querySelector('.header');
  if (header) {
    var ticking = false;
    var update = function () {
      ticking = false;
      header.classList.toggle('is-scrolled', window.scrollY > 8);
    };
    window.addEventListener('scroll', function () {
      if (!ticking) {
        ticking = true;
        window.requestAnimationFrame(update);
      }
    }, { passive: true });
    window.addEventListener('pageshow', update);
    update();
  }

  // Слайдер
  var slider = document.querySelector('.slider');
  if (slider) {
    var track = slider.querySelector('.slider-track');
    var slides = slider.querySelectorAll('.slide');
    var dotsBox = slider.querySelector('.slider-dots');
    var i = 0, timer = null, timerDeadline = 0, pausedRemaining = null, drag = null;
    var activation = 0, suppressClick = false, suppressClickTimer = null;
    var cleanup = function () {};
    function trackPosition(index) {
      return 'translateX(-' + (index * 100) + '%)';
    }
    function scheduleNext(delay, fn) {
      timerDeadline = Date.now() + delay;
      timer = setTimeout(function () {
        timer = null;
        fn();
      }, delay);
    }
    function pauseAutoplay() {
      if (!timer) return;
      clearTimeout(timer);
      timer = null;
      pausedRemaining = Math.max(0, timerDeadline - Date.now());
    }
    function resumeAutoplay() {
      if (pausedRemaining == null) return;
      var remaining = pausedRemaining;
      pausedRemaining = null;
      scheduleNext(remaining, function () { go(i + 1); });
    }
    function suppressNextClick() {
      suppressClick = true;
      clearTimeout(suppressClickTimer);
      suppressClickTimer = setTimeout(function () { suppressClick = false; }, 350);
    }

    function startDrag(event, slide) {
      if (drag || !slide.classList.contains('is-active')) return;
      if (event.isPrimary === false) return;
      if (event.button != null && event.button !== 0) return;
      drag = {
        id: event.pointerId,
        slide: slide,
        startX: event.clientX,
        startY: event.clientY,
        dx: 0,
        dy: 0,
        offset: 0,
        axis: null,
        width: slider.getBoundingClientRect().width || 0
      };
      slider.classList.add('is-dragging');
      pauseAutoplay();
    }
    function moveDrag(event) {
      if (!drag || event.pointerId !== drag.id) return;
      drag.dx = event.clientX - drag.startX;
      drag.dy = event.clientY - drag.startY;
      if (!drag.axis) {
        if (Math.abs(drag.dx) < 8 && Math.abs(drag.dy) < 8) return;
        drag.axis = Math.abs(drag.dx) > Math.abs(drag.dy) ? 'x' : 'y';
        if (drag.axis === 'x') track.style.transition = 'none';
      }
      if (drag.axis !== 'x') return;
      var limit = drag.width * 0.4;
      drag.offset = Math.max(-limit, Math.min(limit, drag.dx * 0.35));
      track.style.transform = 'translateX(' + (-i * drag.width + drag.offset) + 'px)';
    }
    function finishDrag(event, cancelled) {
      if (!drag || event.pointerId !== drag.id) return;
      var gesture = drag;
      var threshold = Math.max(40, gesture.width * 0.15);
      var switched = !cancelled && gesture.axis === 'x' && Math.abs(gesture.dx) >= threshold;
      var dragged = gesture.axis === 'x' && Math.abs(gesture.dx) >= 8;
      drag = null;
      slider.classList.remove('is-dragging');
      track.style.transition = '';
      if (switched) {
        suppressNextClick();
        go(i + (gesture.dx < 0 ? 1 : -1));
        return;
      }
      track.style.transform = trackPosition(i);
      if (dragged) suppressNextClick();
      resumeAutoplay();
    }
    slides.forEach(function (_, n) {
      var d = document.createElement('button');
      d.type = 'button';
      d.setAttribute('aria-label', 'Слайд ' + (n + 1));
      d.addEventListener('click', function () { go(n); });
      dotsBox.appendChild(d);
    });
    function go(n) {
      activation += 1;
      cleanup();
      cleanup = function () {};
      clearTimeout(timer);
      timer = null;
      pausedRemaining = null;
      drag = null;
      slider.classList.remove('is-dragging');
      track.style.transition = '';
      i = (n + slides.length) % slides.length;
      slides.forEach(function (s, k) {
        s.classList.toggle('is-active', k === i);
        s.setAttribute('aria-hidden', k === i ? 'false' : 'true');
      });
      dotsBox.querySelectorAll('button').forEach(function (d, k) {
        d.classList.toggle('is-active', k === i);
        d.setAttribute('aria-current', k === i ? 'true' : 'false');
      });
      track.style.transform = trackPosition(i);
      var slide = slides[i];
      var video = slide.querySelector('video');
      var run = activation;
      function current() { return run === activation; }
      function next() { if (current()) go(i + 1); }
      if (!video) {
        scheduleNext(6000, next);
        return;
      }

      var watchdog, fallback = false, lastPosition = 0, lastProgress = Date.now();
      slide.classList.remove('is-video-fallback');
      function showPoster() {
        if (!current() || fallback) return;
        fallback = true;
        clearTimeout(watchdog);
        slide.classList.remove('is-playing');
        slide.classList.add('is-video-fallback');
        video.pause();
        scheduleNext(6000, next);
      }
      function playing() {
        if (current() && !fallback && !video.paused) slide.classList.add('is-playing');
      }
      function ended() {
        // A queued event from a previous activation must not skip a slide.
        if (current() && !fallback && video.ended) next();
      }
      function checkProgress() {
        if (!current() || fallback) return;
        if (video.currentTime !== lastPosition) {
          lastPosition = video.currentTime;
          lastProgress = Date.now();
        }
        if (Date.now() - lastProgress >= 10000) {
          showPoster();
        } else {
          watchdog = setTimeout(checkProgress, 1000);
        }
      }
      video.addEventListener('playing', playing);
      video.addEventListener('ended', ended);
      // Capture also catches errors emitted by the child <source>.
      video.addEventListener('error', showPoster, true);
      cleanup = function () {
        clearTimeout(watchdog);
        video.removeEventListener('playing', playing);
        video.removeEventListener('ended', ended);
        video.removeEventListener('error', showPoster, true);
        slide.classList.remove('is-playing');
        video.pause();
        try { video.currentTime = 0; } catch (_) { /* Metadata may not be available yet. */ }
      };
      video.muted = true;
      watchdog = setTimeout(checkProgress, 1000);
      try {
        video.currentTime = 0;
        if (video.error) {
          showPoster();
          return;
        }
        var play = video.play();
        if (play && typeof play.then === 'function') {
          play.then(function () {
            // Do not pause a newer activation of this same video.
            if (!current()) {
              if (!slide.classList.contains('is-active') || slide.classList.contains('is-video-fallback')) video.pause();
              return;
            }
            if (fallback) video.pause();
            else playing();
          }, showPoster);
        }
      } catch (_) {
        showPoster();
      }
    }
    slider.querySelector('.prev').addEventListener('click', function () { go(i - 1); });
    slider.querySelector('.next').addEventListener('click', function () { go(i + 1); });
    slides.forEach(function (slide) {
      slide.addEventListener('pointerdown', function (event) { startDrag(event, slide); });
      slide.addEventListener('dragstart', function (event) {
        if (event.preventDefault) event.preventDefault();
      });
      slide.addEventListener('click', function (event) {
        if (!suppressClick) return;
        suppressClick = false;
        clearTimeout(suppressClickTimer);
        if (event.preventDefault) event.preventDefault();
        if (event.stopPropagation) event.stopPropagation();
      });
    });
    window.addEventListener('pointermove', moveDrag);
    window.addEventListener('pointerup', function (event) { finishDrag(event, false); });
    window.addEventListener('pointercancel', function (event) { finishDrag(event, true); });
    go(0);
  }

  // Преимущества на главной
  document.querySelectorAll('[data-benefits-slider]').forEach(function (benefits) {
    var track = benefits.querySelector('.benefits-track');
    var viewport = benefits.querySelector('.benefits-viewport');
    var slides = Array.prototype.slice.call(track.querySelectorAll('.benefits-slide'));
    var prev = benefits.querySelector('.benefits-prev');
    var next = benefits.querySelector('.benefits-next');
    var index = 0, timer = null, hoverPaused = false, focusPaused = false;
    var drag = null, suppressClick = false, suppressClickTimer = null;
    var motionQuery = window.matchMedia ? window.matchMedia('(prefers-reduced-motion: reduce)') : {matches: false};

    function visibleCount() {
      return parseInt(window.getComputedStyle(track).getPropertyValue('--benefits-visible'), 10) || 1;
    }
    function clearAutoplay() {
      clearTimeout(timer);
      timer = null;
    }
    function scheduleAutoplay() {
      clearAutoplay();
      if (hoverPaused || focusPaused || motionQuery.matches || slides.length <= visibleCount()) return;
      timer = setTimeout(function () {
        var maxIndex = Math.max(0, slides.length - visibleCount());
        index = index >= maxIndex ? 0 : index + 1;
        render();
      }, 5000);
    }
    function stepSize() {
      var gap = parseFloat(window.getComputedStyle(track).columnGap) || 0;
      return slides.length ? slides[0].getBoundingClientRect().width + gap : 0;
    }
    function render() {
      var visible = visibleCount();
      var maxIndex = Math.max(0, slides.length - visible);
      index = Math.min(index, maxIndex);
      var step = stepSize();
      track.style.transform = 'translateX(' + (-index * step) + 'px)';
      prev.disabled = index === 0;
      next.disabled = index >= maxIndex;
      scheduleAutoplay();
    }
    function suppressNextClick() {
      suppressClick = true;
      clearTimeout(suppressClickTimer);
      suppressClickTimer = setTimeout(function () { suppressClick = false; }, 350);
    }
    function startDrag(event) {
      if (drag) return;
      if (event.isPrimary === false) return;
      if (event.button != null && event.button !== 0) return;
      var step = stepSize();
      if (!step) return;
      drag = {
        id: event.pointerId,
        startX: event.clientX,
        startY: event.clientY,
        dx: 0,
        dy: 0,
        axis: null,
        step: step,
        offset: -index * step,
        current: null
      };
      benefits.classList.add('is-dragging');
      clearAutoplay();
    }
    function moveDrag(event) {
      if (!drag || event.pointerId !== drag.id) return;
      drag.dx = event.clientX - drag.startX;
      drag.dy = event.clientY - drag.startY;
      if (!drag.axis) {
        if (Math.abs(drag.dx) < 8 && Math.abs(drag.dy) < 8) return;
        drag.axis = Math.abs(drag.dx) > Math.abs(drag.dy) ? 'x' : 'y';
        if (drag.axis === 'x') track.style.transition = 'none';
      }
      if (drag.axis !== 'x') return;
      var maxIndex = Math.max(0, slides.length - visibleCount());
      var min = -maxIndex * drag.step;
      var raw = drag.offset + drag.dx;
      var offset = raw;
      if (raw > 0) offset = raw * 0.3;
      else if (raw < min) offset = min + (raw - min) * 0.3;
      drag.current = offset;
      track.style.transform = 'translateX(' + offset + 'px)';
    }
    function finishDrag(event, cancelled) {
      if (!drag || event.pointerId !== drag.id) return;
      var gesture = drag;
      drag = null;
      benefits.classList.remove('is-dragging');
      track.style.transition = '';
      if (gesture.axis !== 'x') {
        scheduleAutoplay();
        return;
      }
      if (cancelled) {
        render();
        return;
      }
      suppressNextClick();
      var offset = gesture.current == null ? gesture.offset : gesture.current;
      var maxIndex = Math.max(0, slides.length - visibleCount());
      index = Math.max(0, Math.min(maxIndex, Math.round(-offset / gesture.step)));
      render();
    }

    benefits.addEventListener('mouseenter', function () {
      hoverPaused = true;
      clearAutoplay();
    });
    benefits.addEventListener('mouseleave', function () {
      hoverPaused = false;
      scheduleAutoplay();
    });
    benefits.addEventListener('focusin', function () {
      focusPaused = true;
      clearAutoplay();
    });
    benefits.addEventListener('focusout', function (event) {
      if (!benefits.contains(event.relatedTarget)) {
        focusPaused = false;
        scheduleAutoplay();
      }
    });
    function onMotionPreferenceChange(event) {
      motionQuery = event;
      if (motionQuery.matches) clearAutoplay();
      else scheduleAutoplay();
    }
    if (motionQuery.addEventListener) motionQuery.addEventListener('change', onMotionPreferenceChange);
    else if (motionQuery.addListener) motionQuery.addListener(onMotionPreferenceChange);
    prev.addEventListener('click', function () {
      index = Math.max(0, index - 1);
      render();
    });
    next.addEventListener('click', function () {
      index = Math.min(slides.length - visibleCount(), index + 1);
      render();
    });
    if (viewport) {
      viewport.addEventListener('pointerdown', startDrag);
      viewport.addEventListener('dragstart', function (event) {
        if (event.preventDefault) event.preventDefault();
      });
      viewport.addEventListener('click', function (event) {
        if (!suppressClick) return;
        suppressClick = false;
        clearTimeout(suppressClickTimer);
        if (event.preventDefault) event.preventDefault();
        if (event.stopPropagation) event.stopPropagation();
      });
    }
    window.addEventListener('pointermove', moveDrag);
    window.addEventListener('pointerup', function (event) { finishDrag(event, false); });
    window.addEventListener('pointercancel', function (event) { finishDrag(event, true); });
    window.addEventListener('resize', render);
    render();
  });
})();
