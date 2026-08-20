<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gull Boutique</title>
<link rel="stylesheet" href="/gull_boutique/css/style.css">
</head>
<body>

<header class="site-header">
    <a href="/gull_boutique/index.php" class="logo">
        <img src="/gull_boutique/images/logo.png" alt="Gull Boutique" class="logo-img">
    </a>

    <nav>
        <ul class="nav-links" id="navLinks">
            <li><a href="/gull_boutique/index.php">Home</a></li>
            <li><a href="/gull_boutique/about.php">About</a></li>
            <li><a href="/gull_boutique/products.php">Products</a></li>
            <li><a href="/gull_boutique/contact.php">Contact</a></li>
        </ul>

        <div class="nav-icons">
            <button id="searchToggle" class="icon-btn" aria-label="Search">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </button>
            <a href="/gull_boutique/wishlist.php" class="icon-btn" aria-label="Wishlist">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </a>
            <div class="hamburger" id="hamburger">&#9776;</div>
        </div>
    </nav>
</header>

<div id="searchBar" class="search-bar hidden">
    <form action="/gull_boutique/products.php" method="GET">
        <input type="text" name="search" placeholder="Search products..." autocomplete="off">
        <button type="submit">Search</button>
    </form>
</div>