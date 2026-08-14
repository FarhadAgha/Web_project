<?php include '../includes/admin_header.php'; ?>

<h1>Contact Messages</h1>

<table class="admin-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Received</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
        if ($messages && $messages->num_rows > 0):
            while ($msg = $messages->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo htmlspecialchars($msg['name']); ?></td>
            <td><?php echo htmlspecialchars($msg['email']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($msg['message'])); ?></td>
            <td><?php echo date("M j, Y g:i A", strtotime($msg['created_at'])); ?></td>
            <td>
                <a href="delete_message.php?id=<?php echo $msg['id']; ?>" class="btn-small btn-delete" onclick="return confirm('Delete this message?');">Delete</a>
            </td>
        </tr>
        <?php
            endwhile;
        else:
            echo '<tr><td colspan="5">No messages yet.</td></tr>';
        endif;
        ?>
    </tbody>
</table>

<?php include '../includes/admin_footer.php'; ?>