<?php
include 'includes/db.php';

$newsletterMsg = '';
$newsletterError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe'])) {
    $email = trim($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("INSERT IGNORE INTO newsletter_subscribers (email) VALUES (?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $newsletterMsg = "Thanks for subscribing!";
    } else {
        $newsletterError = "Please enter a valid email address.";
    }
}

include 'includes/header.php';
?>
<section class="hero-carousel">
    <div class="carousel-track" id="carouselTrack">
        <img src="/gull_boutique/images/hero-1.webp" class="carousel-slide active" alt="Azadi Sale">
        <img src="/gull_boutique/images/hero-2.webp" class="carousel-slide" alt="Unstitched Collection">
        <img src="/gull_boutique/images/hero-3.webp" class="carousel-slide" alt="Signature Collection">
    </div>
    <div class="carousel-dots">
        <span class="dot active" data-index="0"></span>
        <span class="dot" data-index="1"></span>
        <span class="dot" data-index="2"></span>
    </div>
</section>

<section class="hero">
    <h1>Elegance for Every Woman</h1>
    <p>Discover Gull Boutique's curated collection of dresses, bags, and accessories.</p>
    <a href="/gull_boutique/products.php" class="btn-primary">Shop Now</a>
</section>

<section class="category-scroll-section">
    <div class="category-scroll-header">
        <h2>Shop By Category</h2>
        <img src="/gull_boutique/images/logo.png" alt="Gull Boutique" class="category-scroll-logo">
    </div>
    <div class="category-scroll-track">
        <?php
        $catImgQuery = $conn->query("SELECT * FROM categories WHERE image IS NOT NULL ORDER BY name");
        $catList = [];
        while ($c = $catImgQuery->fetch_assoc()) {
            $catList[] = $c;
        }
        $loopList = array_merge($catList, $catList);
        foreach ($loopList as $cat) {
            echo '<a href="/gull_boutique/products.php?category=' . $cat['id'] . '" class="category-scroll-card">';
            echo '<img src="/gull_boutique/images/' . htmlspecialchars($cat['image']) . '" alt="' . htmlspecialchars($cat['name']) . '">';
            echo '<span>' . htmlspecialchars($cat['name']) . '</span>';
            echo '</a>';
        }
        ?>
    </div>
</section>

<section class="featured">
    <h2>Featured Products</h2>
    <div class="product-grid">
        <?php
        $result = $conn->query("SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id ORDER BY products.created_at DESC LIMIT 8");
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<a href="/gull_boutique/product_detail.php?id=' . $row['id'] . '" class="product-img-wrap">';
                echo '<span class="card-badge">' . htmlspecialchars($row['category_name'] ?? 'New') . '</span>';
                echo '<button class="wishlist-heart" data-id="' . $row['id'] . '">♡</button>';
                echo '<img src="/gull_boutique/images/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                echo '</a>';
                echo '<div class="product-info">';
                echo '<h3><a href="/gull_boutique/product_detail.php?id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a></h3>';
                echo '<p class="price">Rs. ' . number_format($row['price']) . '</p>';
                echo '<a href="/gull_boutique/product_detail.php?id=' . $row['id'] . '" class="btn-view">View Details</a>';
                echo '</div></div>';
            }
        } else {
            echo '<p>No products yet — add some from the admin panel!</p>';
        }
        ?>
    </div>
</section>

<section class="testimonials-section">
    <h2>What Our Customers Say</h2>
    <div class="testimonials-grid">
        <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p>"The quality is amazing and the fabric feels so premium. My Eid outfit from Gull Boutique got so many compliments!"</p>
            <strong>— Ayesha K.</strong>
        </div>
        <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p>"Fast delivery and exactly as pictured. I've ordered three times now and never been disappointed."</p>
            <strong>— Mehwish R.</strong>
        </div>
        <div class="testimonial-card">
            <div class="stars">★★★★☆</div>
            <p>"Beautiful wedding guest collection — found the perfect outfit within my budget. Highly recommend!"</p>
            <strong>— Sana T.</strong>
        </div>
    </div>
</section>

<section class="newsletter-section">
    <h2>Join Our Newsletter</h2>
    <p>Be the first to know about new arrivals and special offers.</p>

    <?php if ($newsletterMsg): ?>
        <p class="form-success"><?php echo htmlspecialchars($newsletterMsg); ?></p>
    <?php endif; ?>
    <?php if ($newsletterError): ?>
        <p class="form-error"><?php echo htmlspecialchars($newsletterError); ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php" class="newsletter-form">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit" name="subscribe">Subscribe</button>
    </form>
</section>

<section class="about-teaser">
    <h2>About Gull Boutique</h2>
    <p>We bring timeless style and modern elegance together, curated for women who know what they want.</p>
    <a href="/gull_boutique/about.php" class="btn-primary">Learn More</a>
</section>

<?php include 'includes/footer.php'; ?>