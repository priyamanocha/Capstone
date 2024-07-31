<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Residence Revive offers hassle-free and reliable home services, including housekeeping, pest control, appliance repair, and more. Our team of professionals ensures your home is in perfect condition using advanced techniques and eco-friendly products.">
    <title>About Residence Revive</title>
    <link rel="stylesheet" href="css/about-us.css">
</head>

<body>
    <?php
    session_start();
    include 'config/db.php';
    include 'includes/functions.php';

    $categories = getAllCategories($conn); // Fetch category names
    ?>

    <?php include 'includes/header.php'; ?>

    <!-- New Image Section Below Nav Bar -->
    <div class="background-image-container">
            <a href="#contact-page-container">
                <h1 class="mb-2">About Us</h1>
            </a>
        </div>
    <!-- <section class="hero-image">
        <img src="images/background.jpg" alt="Carpet Cleaning">
    </section> -->

    <section class="about-section">
        <div class="about-content">
            <div class="intro">
                <h2>Welcome to Residence Revive</h2>
                <p>Our journey began with a simple mission: to make home services hassle-free, reliable, and accessible for everyone. We understand the profound impact that a clean, safe, and well-maintained home has on your overall well-being and quality of life. From regular housekeeping and comprehensive disinfection to pest control, furniture assembly, plumbing, electrician services, and appliance repair, our professional team ensures every aspect of your living space is in perfect condition. We use advanced techniques and eco-friendly products to provide top-notch services, building trust and creating lasting relationships with our clients. Thank you for choosing Residence Revive!</p>
            </div>

            <div class="services">
                <h2>Residence Revive Services</h2>
                <div class="service-cards">
                    <div class="service-card">
                        <img src="images/appliance_repair.jpg" alt="Appliance Repair">
                        <div class="card-text">Appliance Repair</div>
                        <div class="card-description">Our experienced technicians can repair a wide range of home appliances, ensuring they function efficiently and extend their lifespan.</div>
                    </div>
                    <div class="service-card">
                        <img src="images/cleaning.jpg" alt="Cleaning/Disinfection">
                        <div class="card-text">Cleaning/Disinfection</div>
                        <div class="card-description">From regular housekeeping to deep cleaning, our professional team ensures your home is spotless and inviting.</div>
                    </div>
                    <div class="service-card">
                        <img src="images/electrician.jpg" alt="Electrician">
                        <div class="card-text">Electrician</div>
                        <div class="card-description">From fixing faulty wiring to installing new electrical systems, our certified electricians ensure your home is safe and functional.</div>
                    </div>
                    <div class="service-card">
                        <img src="images/furniture_assembly.jpg" alt="Furniture Assembly">
                        <div class="card-text">Furniture Assembly</div>
                        <div class="card-description">We take the hassle out of furniture assembly, providing quick and efficient services to set up your new furniture.</div>
                    </div>
                    <div class="service-card">
                        <img src="images/pest_control.jpg" alt="Pest Control">
                        <div class="card-text">Pest Control</div>
                        <div class="card-description">Our experts provide effective pest control solutions to keep your home free from unwanted guests.</div>
                    </div>
                    <div class="service-card">
                        <img src="images/plumbing.jpg" alt="Plumbing">
                        <div class="card-text">Plumbing</div>
                        <div class="card-description">Our skilled plumbers are ready to tackle any plumbing issue, from minor repairs to major installations.</div>
                    </div>
                </div>
            </div>

            <div class="about-info">
                <div class="info-card">
                    <img src="images/user.png" alt="About Our Team">
                    <h3>About Our Team</h3>
                    <p>Our staff is full of experts, and have on-job experience of years</p>
                </div>
                <div class="info-card">
                    <img src="images/question.png" alt="Why Trust Us?">
                    <h3>Why Trust Us?</h3>
                    <p>Because we have a good track record</p>
                </div>
                <div class="info-card">
                    <img src="images/map.png" alt="Where We Are Located">
                    <h3>Where We Are Located</h3>
                    <p>You can find our office in Kitchener, Ontario.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
