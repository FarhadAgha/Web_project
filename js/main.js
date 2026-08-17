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