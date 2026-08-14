<?php include '../includes/admin_header.php'; ?>

<?php
$error = '';
$success = '';

// Handle Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $name = trim($_POST['name']);
    if ($name) {
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $success = "Category added.";
    } else {
        $error = "Category name cannot be empty.";
    }
}

// Handle Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_category'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    if ($name && $id) {
        $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        $stmt->execute();
        $success = "Category updated.";
    }
}
?>

<h1>Manage Categories</h1>

<?php if ($success): ?><p class="form-success"><?php echo htmlspecialchars($success); ?></p><?php endif; ?>
<?php if ($error): ?><p class="form-error"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>

<form method="POST" action="categories.php" class="admin-form">
    <label>New Category Name</label>
    <input type="text" name="name" required>
    <button type="submit" name="add_category" class="btn-primary">Add Category</button>
</form>

<table class="admin-table">
    <thead>
        <tr>
            <th>Name</th>
            <th># of Products</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cats = $conn->query("SELECT categories.*, 
                               (SELECT COUNT(*) FROM products WHERE products.category_id = categories.id) AS product_count 
                               FROM categories ORDER BY name");
        while ($cat = $cats->fetch_assoc()):
        ?>
        <tr>
            <form method="POST" action="categories.php">
                <td>
                    <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
                    <input type="text" name="name" value="<?php echo htmlspecialchars($cat['name']); ?>" style="padding:6px; border:1px solid #ddd; border-radius:6px;">
                </td>
                <td><?php echo $cat['product_count']; ?></td>
                <td>
                    <button type="submit" name="edit_category" class="btn-small btn-edit">Save</button>
            </form>
                    <a href="delete_category.php?id=<?php echo $cat['id']; ?>" class="btn-small btn-delete" onclick="return confirm('Delete this category? Products using it will need reassigning.');">Delete</a>
                </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/admin_footer.php'; ?>