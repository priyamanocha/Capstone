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
$icons = [
    'Cleaning/Disinfection' => './images/cleaning.jpg',
    'Appliance Repair' => './images/repair.jpg',
    'Electrician' => './images/electrician.jpg',
    'Furniture Assembly' => './images/furniture_assembly.jpg',
    'Pest-Control' => './images/pest_control.jpg',
    'Plumbing' => './images/plumbing.jpg',
    // Add more categories with their respective icon paths
];
?>
<div class="background-image-container"></div>
<h1 class="heading">Residence Revive Services</h1>
<div class="services-grid">
    <?php foreach ($categories as $category): ?>
        <div class="service-card">
            <a href="subcategory.php?category_id=<?php echo $category['category_id']; ?>">
                <div class="service-image-container">
                    <?php if (isset($icons[$category['category_name']])): ?>
                        <img src="<?php echo $icons[$category['category_name']]; ?>"
                            alt="<?php echo $category['category_name']; ?> icon" class="service-icon">
                    <?php else: ?>
                        <img src="images/default.png" alt="Default icon" class="service-icon">
                    <?php endif; ?>
                    <h2 class="service-name"><?php echo $category['category_name']; ?></h2>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<h3 class="heading">Why Choose Us?</h3>
<div class="why-us">
    <!-- Left Container -->
    <div class="left-container">
        <div class="icon-line">
            <img src="./images/safe.png" alt="Icon 1">
            <div>
                <h3 class="bold">100% Safe</h3>
                <p>Totally safe and secure</p>
            </div>
        </div>
        <div class="icon-line">
            <img src="./images/search.png" alt="Icon 2">
            <div>
                <h3 class="bold">Transparent Pricing</h3>
                <p>See prices before you book, No hidden fees</p>
            </div>
        </div>
        <div class="icon-line">
            <img src="./images/leader.png" alt="Icon 3">
            <div>
                <h3 class="bold">Experts Only</h3>
                <p>Our Staff is full of experts, and have on-job experience of years</p>
            </div>
        </div>
    </div>

    <!-- Right Container -->
    <div class="right-container">
        <div class="whyus_card">
            <img src="./images/slider_1.png" alt="Card Icon">
            <h3 class="bold">100% Quality Assured</h3>
            <p>Our promise to make it right</p>
        </div>
    </div>
</div>

<!-- Carousel -->
<div class="carousel">
    <div class="carousel-images">
        <img src="./images/slider_1.png" alt="Carousel Image 1" class="carousel-image">
        <img src="./images/slider_2.jpg" alt="Carousel Image 4" class="carousel-image">
        <img src="./images/slider_3.jpg" alt="Carousel Image 4" class="carousel-image">
    </div>
    <button class="carousel-prev" onclick="prevSlide()">&#10094;</button>
    <button class="carousel-next" onclick="nextSlide()">&#10095;</button>
</div>

<!-- Including the footer from a separate PHP file -->
<?php
include 'includes/footer.php';
$conn->close();
?>

<!-- JavaScript for Carousel -->
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-image');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.opacity = i === index ? '1' : '0';
            slide.style.display = i === index ? 'block' : 'none';
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    // Auto change slides every 5 seconds
    setInterval(nextSlide, 5000);

    // Initialize carousel
    showSlide(currentSlide);
</script>