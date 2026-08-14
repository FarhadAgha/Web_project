<?php
include 'includes/db.php';

$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if ($name && $email && $message) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        if ($stmt->execute()) {
            $successMsg = "Thank you! Your message has been sent.";
        } else {
            $errorMsg = "Something went wrong. Please try again.";
        }
    } else {
        $errorMsg = "Please fill in all fields.";
    }
}

include 'includes/header.php';
?>

<section class="page-header">
    <h1>Contact Us</h1>
</section>

<section class="contact-section">
    <?php if ($successMsg): ?>
        <p class="form-success"><?php echo htmlspecialchars($successMsg); ?></p>
    <?php endif; ?>
    <?php if ($errorMsg): ?>
        <p class="form-error"><?php echo htmlspecialchars($errorMsg); ?></p>
    <?php endif; ?>

    <form method="POST" action="contact.php" class="contact-form">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="message">Message</label>
        <textarea name="message" id="message" rows="6" required></textarea>

        <button type="submit" class="btn-primary">Send Message</button>
    </form>
</section>

<?php include 'includes/footer.php'; ?>