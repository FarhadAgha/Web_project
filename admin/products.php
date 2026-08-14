<?php include '../includes/admin_header.php'; ?>

<h1>Manage Products</h1>
<a href="add_product.php" class="btn-primary">+ Add New Product</a>

<table class="admin-table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT products.*, categories.name AS category_name 
                FROM products 
                LEFT JOIN categories ON products.category_id = categories.id 
                ORDER BY products.created_at DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><img src="/gull_boutique/images/<?php echo htmlspecialchars($row['image']); ?>" alt="" class="table-thumb"></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['category_name']); ?></td>
            <td>$<?php echo htmlspecialchars($row['price']); ?></td>
            <td><?php echo htmlspecialchars($row['stock']); ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn-small btn-edit">Edit</a>
                <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn-small btn-delete" onclick="return confirm('Delete this product?');">Delete</a>
            </td>
        </tr>
        <?php
            endwhile;
        else:
            echo '<tr><td colspan="6">No products yet.</td></tr>';
        endif;
        ?>
    </tbody>
</table>

<?php include '../includes/admin_footer.php'; ?>