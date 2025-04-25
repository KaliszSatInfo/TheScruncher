document.addEventListener('DOMContentLoaded', function () {
    const gallery = document.querySelector('.gallery');
  
    gallery.addEventListener('click', function (e) {
        const img = e.target.closest('img');
        if (!img) return;
  
        if (img.classList.contains('zoomed-img')) {
            img.classList.remove('zoomed-img');
            document.querySelector('.zoom-overlay')?.remove();
            return;
        }
  
        document.querySelectorAll('.zoomed-img').forEach(el => el.classList.remove('zoomed-img'));
        document.querySelectorAll('.zoom-overlay').forEach(el => el.remove());
  
        const overlay = document.createElement('div');
        overlay.className = 'zoom-overlay';
        document.body.appendChild(overlay);
  
        const zoomed = img.cloneNode();
        zoomed.className = 'zoomed-img';
        document.body.appendChild(zoomed);
  
        zoomed.addEventListener('click', (e) => {
            e.stopPropagation();
        });
  
        overlay.addEventListener('click', () => {
            zoomed.remove();
            overlay.remove();
        });
    });
  });
  