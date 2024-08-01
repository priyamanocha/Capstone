<?php
// Checking for the session, if is not already started, then start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <!-- The Meta tags for char set and viewport settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Residence Revive offers hassle-free and reliable home services, including housekeeping, pest control, appliance repair, and more. Our team of professionals ensures your home is in perfect condition using advanced techniques and eco-friendly products.">
    <title>Careers Page</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/careers-styles.css">
</head>

<body>
<?php

include 'config/db.php';
include 'includes/functions.php';

$categories = getAllCategories($conn); // Fetch category names
?>
    <?php include 'includes/header.php'; ?>
   

    <div class="hero">
        <h1>Welcome to Residence Revive Careers</h1>
        <a href="#job-postings" class="btn">Job Postings</a>
        <div class="circle" onclick="scrollToJobPostings()">
            <div class="arrow-down">&#8595;</div>
        </div>
    </div>

    <div class="container">
        <section class="section" id="job-postings">
            <h2>Current Job Openings</h2>
            <div class="job-listings-container">
                <div class="job-listing">
                    <h3>General Manager</h3>
                    <h4>Residence Revive - Kitchener</h4>
                    <h3>General Manager</h3>
                    <h4>Residence Revive - Kitchener</h4>
                </div>
                <div class="job-listing">
                    <h3>Supervisor</h3>
                    <h4>Residence Revive - Toronto</h4>
                    <h3>Supervisor</h3>
                    <h4>Residence Revive - Toronto</h4>
                </div>
                <div class="job-listing">
                    <h3>Operations Manager</h3>
                    <h4>Residence Revive - Toronto</h4>
                    <h3>Operations Manager</h3>
                    <h4>Residence Revive - Toronto</h4>
                </div>
                <div class="job-listing">
                    <h3>Marketing Director</h3>
                    <h4>Residence Revive - Remote</h4>
                    <h3>Marketing Director</h3>
                    <h4>Residence Revive - Remote</h4>
                </div>
            </div>
            <h5>Please apply by sending us cover letter and resume to support@residencerevive.com</h5>
            <h5>Please apply by sending us cover letter and resume to support@residencerevive.com</h5>
        </section>

        <div class="map">
            <iframe title="Google Map showing the location of Residence Revive" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2900.020333996691!2d-80.42182492376466!3d43.376598870276716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882c7571ae5d7969%3A0x34136ccf2e63d14c!2s21%20Sportsman%20Hill%20St%2C%20Kitchener%2C%20ON%20N2P%202N7!5e0!3m2!1sen!2sca!4v1721873628207!5m2!1sen!2sca" 
            width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
    <h3>Our Location</h3>
    

    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
        function scrollToJobPostings() {
            document.getElementById('job-postings').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>
