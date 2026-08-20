const searchToggle = document.getElementById('searchToggle');
const searchBar = document.getElementById('searchBar');
if (searchToggle) {
    searchToggle.addEventListener('click', () => {
        searchBar.classList.toggle('hidden');
    });
}
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('wishlist-heart')) {
        e.preventDefault();
        const btn = e.target;
        const productId = btn.getAttribute('data-id');

        fetch('/gull_boutique/wishlist_toggle.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'product_id=' + productId
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'added') {
                btn.textContent = '♥';
                btn.classList.add('active');
            } else {
                btn.textContent = '♡';
                btn.classList.remove('active');
            }
        });
    }
});

const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');
if (hamburger) {
    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
}
const slides = document.querySelectorAll('.carousel-slide');
const dots = document.querySelectorAll('.dot');
let currentSlide = 0;

if (slides.length > 0) {
    function showSlide(index) {
        slides.forEach(s => s.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        currentSlide = index;
    }

    setInterval(() => {
        let next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }, 3000);

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            showSlide(parseInt(dot.getAttribute('data-index')));
        });
    });
}