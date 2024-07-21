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
    <title>Careers Page</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/careers-styles.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="hero">
        <h1>Welcome to Residence Revive</h1>
        <a href="#connect" class="btn" onclick="scrollToContact()">Connect</a>
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
                    <h4>General Manager</h4>
                    <h5>Residence Revive - Kitchener</h5>
                </div>
                <div class="job-listing">
                    <h4>Supervisor</h4>
                    <h5>Residence Revive - Toronto</h5>
                </div>
                <div class="job-listing">
                    <h4>Operations Manager</h4>
                    <h5>Residence Revive - Toronto</h5>
                </div>
                <div class="job-listing">
                    <h4>Marketing Director</h4>
                    <h5>Residence Revive - Remote</h5>
                </div>
            </div>
            <h6>People can reach out to us via email: support@residencerevive.com and upload their cover letter and resume.</h6>
        </section>

        <div class="container-split">
            <div class="contact-form" id="contact">
                <h3>Contact Us</h3>
                <form action="contact_form_submission.php" method="post">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>

            <div class="map">
                <h3>Our Location</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509068!2d144.95592631550484!3d-37.81720974201551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf5774c9bdb3b4a02!2sResidence+Revive!5e0!3m2!1sen!2sau!4v1592244257777!5m2!1sen!2sau" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
        function scrollToJobPostings() {
            document.getElementById('job-postings').scrollIntoView({ behavior: 'smooth' });
        }
        function scrollToContact() {
            document.getElementById('contact').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>
