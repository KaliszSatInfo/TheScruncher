document.addEventListener('DOMContentLoaded', function () {
    const card = document.querySelector('.tinder-card');
    const form = document.querySelector('.tinder-form');
    let startX = 0;
    let currentX = 0;
    let isDragging = false;

    if (!card || !form) return;

    const image = card.querySelector('img');
    if (image) {
        image.addEventListener('dragstart', (e) => e.preventDefault());
    }

    const flashOverlay = document.createElement('div');
    flashOverlay.style.position = 'fixed';
    flashOverlay.style.top = '0';
    flashOverlay.style.left = '0';
    flashOverlay.style.width = '100%';
    flashOverlay.style.height = '100%';
    flashOverlay.style.pointerEvents = 'none';
    flashOverlay.style.opacity = '0';
    flashOverlay.style.transition = 'opacity 0.3s ease';
    flashOverlay.style.zIndex = '999';
    document.body.appendChild(flashOverlay);

    function flash(color) {
        flashOverlay.style.background = color;
        flashOverlay.style.opacity = '0.4';
        setTimeout(() => {
            flashOverlay.style.opacity = '0';
        }, 200);
    }

    function startDrag(x) {
        startX = x;
        isDragging = true;
        card.style.transition = 'none';
    }

    function duringDrag(x) {
        if (!isDragging) return;
        currentX = x - startX;
        card.style.transform = `translateX(${currentX}px) rotate(${currentX / 10}deg)`;
    }

    function endDrag() {
        if (!isDragging) return;
        isDragging = false;
        card.style.transition = 'transform 0.5s ease, opacity 0.5s ease';

        if (currentX > 100) {
            card.style.transform = 'translateX(100vw) rotate(20deg)';
            card.style.opacity = '0';
            flash('rgba(0, 255, 0, 0.5)');
            setTimeout(() => {
                form.querySelector('button[name="liked_image"]').click();
            }, 300);
        } else if (currentX < -100) {
            card.style.transform = 'translateX(-100vw) rotate(-20deg)';
            card.style.opacity = '0';
            flash('rgba(255, 0, 0, 0.5)');
            setTimeout(() => {
                form.querySelector('button[name="disliked_image"]').click();
            }, 300);
        } else {
            card.style.transform = 'translateX(0) rotate(0)';
        }
    }

    card.addEventListener('touchstart', (e) => startDrag(e.touches[0].clientX));
    card.addEventListener('touchmove', (e) => duringDrag(e.touches[0].clientX));
    card.addEventListener('touchend', () => endDrag());

    card.addEventListener('mousedown', (e) => startDrag(e.clientX));
    window.addEventListener('mousemove', (e) => duringDrag(e.clientX));
    window.addEventListener('mouseup', () => endDrag());
});
