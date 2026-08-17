<?php
session_start();
include 'includes/db.php';

$productId = intval($_POST['product_id'] ?? 0);

if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

if ($productId > 0) {
    if (in_array($productId, $_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$productId]);
        $status = 'removed';
    } else {
        $_SESSION['wishlist'][] = $productId;
        $status = 'added';
    }
}

header('Content-Type: application/json');
echo json_encode(['status' => $status, 'count' => count($_SESSION['wishlist'])]);
?>