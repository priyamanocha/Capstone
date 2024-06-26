<?php
// Checking for the session, if is not already started, then start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "Home";
include 'config/db.php';
include 'includes/functions.php';
include 'includes/header.php';


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
<h2>Our Services</h2>
<div class="services-grid">
    <?php foreach ($categories as $category): ?>
        <div class="service-card">
            <?php if (isset($icons[$category['category_name']])): ?>
                <img src="<?php echo $icons[$category['category_name']]; ?>"
                    alt="<?php echo $category['category_name']; ?> icon" class="service-icon">
            <?php else: ?>
                <img src="images/default.png" alt="Default icon" class="service-icon"> <!-- Fallback icon -->
            <?php endif; ?>
            <h2><?php echo $category['category_name']; ?></h2>
        </div>
    <?php endforeach; ?>
</div>

<h2>Why Choose Us?</h2>
<div class="why-us">

    <!-- Left Container -->
    <div class="left-container">
        <div class="icon-line">
            <img src="./images/safe.png" alt="Icon 1">
            <div>
                <h2>100% Safe</h2>
                <p>Totally safe and secure</p>
            </div>
        </div>
        <div class="icon-line">
            <img src="./images/search.png" alt="Icon 2">
            <div>
                <h2>Tranparent Pricing</h2>
                <p>See prices before you book,No hidden fees</p>
            </div>
        </div>
        <div class="icon-line">
            <img src="./images/leader.png" alt="Icon 3">
            <div>
                <h2>Experts Only</h2>
                <p>Our Staff is full of experts, and have on-job experience of years</p>
            </div>
        </div>
    </div>

    <!-- Right Container -->
    <div class="right-container">
        <div class="whyus_card">
            <img src="./images/100.png" alt="Card Icon">
            <h2>100% Quality Assured</h2>
            <p>Our promise to make it right</p>
        </div>
    </div>
</div>

<!-- Including the footer from a separate PHP file -->
<?php
include 'includes/footer.php';
$conn->close();
?>