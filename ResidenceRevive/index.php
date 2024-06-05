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

$categories = getAllCategories($conn); // Fetch category names

// Manually add icon paths
$icons = [
    'Cleaning/Disinfection' => './images/cleaning.png',
    'Appliance Repair' => './images/gas-stove.png',
    'Electrician' => './images/electrician.png',
    'Furniture Assembly' => './images/sofa.png',
    'Pest-Control' => './images/bug-spray.png',
    'Plumbing' => './images/plumbing.png',
    // Add more categories with their respective icon paths
];
?>

<div class="services-grid">
    <?php foreach ($categories as $category): ?>
        <div class="service-card">
            <?php if (isset($icons[$category['category_name']])): ?>
                <img src="<?php echo $icons[$category['category_name']]; ?>" alt="<?php echo $category['category_name']; ?> icon" class="service-icon">
            <?php else: ?>
                <img src="images/default.png" alt="Default icon" class="service-icon"> <!-- Fallback icon -->
            <?php endif; ?>
            <h2><?php echo $category['category_name']; ?></h2>
        </div>
    <?php endforeach; ?>
</div>

<?php
include 'includes/footer.php';
$conn->close();
?>
