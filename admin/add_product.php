<?php include '../includes/admin_header.php'; ?>

<?php
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category_id = intval($_POST['category_id']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    $imageName = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = '../images/' . $imageName;
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
        } else {
            $error = "Invalid image type. Use JPG, PNG, WEBP, or GIF.";
        }
    }

    if (!$error && $name && $category_id && $price >= 0) {
        $stmt = $conn->prepare("INSERT INTO products (category_id, name, description, price, stock, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdis", $category_id, $name, $description, $price, $stock, $imageName);
        $stmt->execute();
        header("Location: products.php");
        exit;
    } elseif (!$error) {
        $error = "Please fill in all required fields.";
    }
}

$categories = $conn->query("SELECT * FROM categories ORDER BY name");
?>

<h1>Add New Product</h1>

<?php if ($error): ?>
    <p class="form-error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST" action="add_product.php" enctype="multipart/form-data" class="admin-form">
    <label>Product Name</label>
    <input type="text" name="name" required>

    <label>Category</label>
    <select name="category_id" required>
        <option value="">-- Select Category --</option>
        <?php while ($cat = $categories->fetch_assoc()): ?>
            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
        <?php endwhile; ?>
    </select>

    <label>Description</label>
    <textarea name="description" rows="4"></textarea>

    <label>Price (Rs.)</label>
    <input type="number" name="price" step="0.01" min="0" required>

    <label>Stock</label>
    <input type="number" name="stock" min="0" required>

    <label>Product Image</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" class="btn-primary">Add Product</button>
</form>

<?php include '../includes/admin_footer.php'; ?>