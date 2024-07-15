<!-- We are starting the session in order to track user login and other session-related information -->

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Residence Revive</title>
    <!-- The link to external CSS stylesheets -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <!-- Including the header from a separate PHP file -->
    <?php include 'includes/header.php'; ?>
    <div class="background-image-container">
        <h1 class="mb-2">Residence Revive Story</h1>
    </div>
    <div class="about-us-container">
        <div class="container text-start">
            <div class="card col">
                <div class="d-flex p-3 rounded-5">
                    <div class="flex-grow-1 px-2 mt-5">
                        <p class="card-text ms-2">
                            Welcome to Residence Revive! Our journey began with a simple mission: to make home services
                            hassle-free, reliable, and accessible for everyone. We understand the profound impact that a
                            clean, safe, and well-maintained home has on your overall well-being and quality of life.
                            From regular housekeeping and comprehensive disinfection to pest control, furniture
                            assembly, plumbing, electrician services, and appliance repair, our professional team
                            ensures every aspect of your living space is in perfect condition. We use advanced
                            techniques and eco-friendly products to provide top-notch services, building trust and
                            creating lasting relationships with our clients. Thank you for choosing Residence Revive!
                        </p>
                    </div>
                </div>
            </div>
            <div class="card col">
                <div class="d-flex p-3 rounded-5">
                    <div class="flex-grow-1 px-2">
                        <p class="card-text me-2">
                        <h4 style="padding: 1% 1% 1% 0%;"><b>What We Do</b></h4>
                        <p>At Residence Revive, we offer a comprehensive range of home services to meet all your needs:
                        </p>

                        <p><b>Cleaning Services:</b> From regular housekeeping to deep cleaning, our professional team
                            ensures your
                            home is spotless and inviting.</p>
                        <p><b>Appliance Repair:</b> Our experienced technicians can repair a wide range of home
                            appliances, ensuring they function efficiently and extend their lifespan.</p>
                        <p><b>Pest Control:</b> Our experts provide effective pest control solutions to keep your home
                            free from
                            unwanted guests.</p>
                        <p><b>Furniture Assembly:</b> We take the hassle out of furniture assembly, providing quick and
                            efficient
                            services to set up your new furniture.</p>
                        <p><b>Plumbing Services:</b> Our skilled plumbers are ready to tackle any plumbing issue, from
                            minor repairs
                            to major installations.</p>
                        <p><b>Electrician Services:</b> From fixing faulty wiring to installing new electrical systems,
                            our certified
                            electricians ensure your home is safe and functional.</p>
                        </p>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center choose-us">
                <div class="col-md-6">
                    <div class="mb-4">
                        <div class="d-flex p-3 rounded-5">
                            <img src="images/user.png" class="img-fluid object-fit-contain" alt="Image"
                                style="max-width: 80px;">
                            <div class="flex-grow-1 p-3 ms-2">
                                <h4 class="card-title mb-2">About Our Team</h4>
                                <p class="card-text">
                                    Our Staff is full of experts, and have on-job experience of years</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <div class="d-flex p-3 rounded-5">
                            <img src="images/question.png" class="img-fluid object-fit-contain" alt="Image"
                                style="max-width: 80px;">
                            <div class="flex-grow-1 p-3 ms-2">
                                <h4 class="card-title mb-2">Why to trust Us?</h4>
                                <p class="card-text">
                                    Because We have a Good Track Record</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <div class="d-flex p-3 rounded-5">
                            <img src="images/map.png" class="img-fluid object-fit-contain" alt="Image"
                                style="max-width: 80px;">
                            <div class="flex-grow-1 p-3 ms-2">
                                <h4 class="card-title mb-2">Where are we located.</h4>
                                <p class="card-text">
                                    You can find our Office in Kitchener, Ontario.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Including the footer from a separate PHP file -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>