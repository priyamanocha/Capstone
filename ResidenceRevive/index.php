<?php
// Checking for the session, if it is not already started, then start the session
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="./css/styles.css">
    <!-- Your other meta tags, stylesheets, and scripts -->
</head>
<body>

<h3>Our Services</h3>
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
                <h3 class="bold">100% Safe</h3>
                <p>Totally safe and secure</p>
            </div>
        </div>
        <div class="icon-line">
            <img src="./images/search.png" alt="Icon 2">
            <div>
                <h3 class="bold">Transparent Pricing</h3>
                <h3 class="bold">Transparent Pricing</h3>
                <p>See prices before you book, No hidden fees</p>
            </div>
        </div>
        <div class="icon-line">
            <img src="./images/leader.png" alt="Icon 3">
            <div>
                <h3 class="bold">Experts Only</h3>
                <h3 class="bold">Experts Only</h3>
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

<!-- Reviews -->
<!-- Reviews -->
<section>
  <div class="row d-flex justify-content-center">
    <div class="col-md-10 col-xl-8 text-center">
      <h3 class="mb-4">Reviews</h3>
      <p class="mb-4 pb-2 mb-md-5 pb-md-0">
        Here are some of our customer reviews:
      </p>
    </div>
  </div>

  <div class="row text-center">
    <div class="col-md-4 mb-5 mb-md-0">
      <div class="d-flex justify-content-center mb-4">
        <img src="./images/profile3.jpg"
          class="rounded-circle shadow-1-strong" width="150" height="150" />
      </div>
      <h5 class="mb-3">Maria Smantha</h5>
      <!-- <h6 class="text-primary mb-3">Web Developer</h6> -->
      <p class="px-xl-3">
        Efficient service! The electrician fixed my wiring issue in less than an hour.
      </p>
      <ul class="list-unstyled d-flex justify-content-center mb-0">
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star-half-alt fa-sm text-warning"></i>
        </li>
      </ul>
    </div>
    <div class="col-md-4 mb-5 mb-md-0">
      <div class="d-flex justify-content-center mb-4">
        <img src="./images/profile2.jpg"
          class="rounded-circle shadow-1-strong" width="150" height="150" />
      </div>
      <h5 class="mb-3">Lisa Cudrow</h5>
      <!-- <h6 class="text-primary mb-3">Graphic Designer</h6> -->
      <p class="px-xl-3">
        Professional service. The plumber arrived on time and fixed the leak quickly.
      </p>
      <ul class="list-unstyled d-flex justify-content-center mb-0">
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
      </ul>
    </div>
    <div class="col-md-4 mb-0">
      <div class="d-flex justify-content-center mb-4">
        <img src="./images/profile1.jpg"
          class="rounded-circle shadow-1-strong" width="150" height="150" />
      </div>
      <h5 class="mb-3">John Smith</h5>
      <!-- <h6 class="text-primary mb-3">Marketing Specialist</h6> -->
      <p class="px-xl-3">
        Great experience overall. The appliance repair service was thorough and professional.
      </p>
      <ul class="list-unstyled d-flex justify-content-center mb-0">
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="fas fa-star fa-sm text-warning"></i>
        </li>
        <li>
          <i class="far fa-star fa-sm text-warning"></i>
        </li>
      </ul>
    </div>
  </div>
</section>


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
$conn->close();
?>

<!-- Bootstrap JS Bundle and Custom Scripts -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-image');
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-image');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.opacity = i === index ? '1' : '0';
            slide.style.display = i === index ? 'block' : 'none';
        });
    }
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
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }
    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    // Auto change slides every 5 seconds
    setInterval(nextSlide, 5000);
    // Auto change slides every 5 seconds
    setInterval(nextSlide, 5000);

    // Initialize carousel
    showSlide(currentSlide);
    // Initialize carousel
    showSlide(currentSlide);
</script>
</body>
</html>
