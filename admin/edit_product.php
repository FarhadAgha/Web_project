<?php include '../includes/admin_header.php'; ?>

<?php
$id = intval($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    echo '<p>Product not found.</p>';
    include '../includes/admin_footer.php';
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category_id = intval($_POST['category_id']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $imageName = $product['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = '../images/' . $imageName;
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
        }
    }

    $stmt2 = $conn->prepare("UPDATE products SET category_id=?, name=?, description=?, price=?, stock=?, image=? WHERE id=?");
    $stmt2->bind_param("issdisi", $category_id, $name, $description, $price, $stock, $imageName, $id);
    $stmt2->execute();
    header("Location: products.php");
    exit;
}

$categories = $conn->query("SELECT * FROM categories ORDER BY name");
?>

<h1>Edit Product</h1>

<?php if ($error): ?>
    <p class="form-error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST" action="edit_product.php?id=<?php echo $product['id']; ?>" enctype="multipart/form-data" class="admin-form">
    <label>Product Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

    <label>Category</label>
    <select name="category_id" required>
        <?php while ($cat = $categories->fetch_assoc()): ?>
            <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($cat['name']); ?>
            </option>
        <?php endwhile; ?>
        </select>

    <label>Description</label>
    <textarea name="description" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>

    <label>Price (Rs.)</label>
    <input type="number" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($product['price']); ?>" required>

    <label>Stock</label>
    <input type="number" name="stock" min="0" value="<?php echo htmlspecialchars($product['stock']); ?>" required>

    <?php if ($product['image']): ?>
        <img src="/gull_boutique/images/<?php echo htmlspecialchars($product['image']); ?>" class="table-thumb" style="margin-bottom:10px;">
    <?php endif; ?>

    <label>Replace Image (optional)</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" class="btn-primary">Update Product</button>
</form>

<?php include '../includes/admin_footer.php'; ?>