<?php
// Checking for the session, if is not already started, then start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "Home";
include 'config/db.php';
include 'includes/functions.php';
include 'includes/header.php';


$sql = "SELECT * FROM services";
$services = $conn->query($sql);
$conn->close();

?>

<h3>Our Services</h3>
<div class="services-grid">
    <?php  while($service = $services->fetch_assoc()): ?>
        <div class="service-card">
                    <img src="<?php echo $service['service_img']; ?>"
                        alt="<?php echo $service['service_name']; ?> icon" class="service-icon">
                <h2><?php echo $service['service_name']; ?></h2>
                <p>$<?php echo $service['price']; ?></p>
                <!-- details and add to cart button -->
                <a class="btn btn-dark mb-2 w-100" href="subcategory.php?service_id=<?php echo $service['service_id']; ?>">Details</a>
                <a class="btn btn-primary w-100"  href="cart.php?action=add&service_id=<?php echo $service['service_id']; ?>">Add to Cart</a>
        </div>
    <?php endwhile; ?>
</div>

<h3>Why Choose Us?</h3>
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
                <h2>Transparent Pricing</h2>
                <p>See prices before you book, No hidden fees</p>
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

<!-- Carousel -->
<div class="carousel">
    <div class="carousel-images">
        <img src="./images/slider_1.png" alt="Carousel Image 1" class="carousel-image">
        <img src="./images/slider_2.png" alt="Carousel Image 2" class="carousel-image">
        <img src="./images/slider_3.png" alt="Carousel Image 3" class="carousel-image">
    </div>
    <button class="carousel-prev" onclick="prevSlide()">&#10094;</button>
    <button class="carousel-next" onclick="nextSlide()">&#10095;</button>
</div>

<!-- Including the footer from a separate PHP file -->
<?php
include 'includes/footer.php';
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
