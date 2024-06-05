<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "Home";
include 'config/db.php';
include 'includes/functions.php';
include 'includes/header.php';

if (isset($_SESSION['db_message'])) {
    echo "<p>" . $_SESSION['db_message'] . "</p>";
    unset($_SESSION['db_message']); // Clear the message after displaying it
}

$services = getAllServices($conn);
?>

<div class="services-grid">
    <?php foreach ($services as $service): ?>
        <div class="service-card">
            <h2><?php echo $service['service_name']; ?></h2>
        </div>
    <?php endforeach; ?>
</div>

<?php
include 'includes/footer.php';
$conn->close();
?>
