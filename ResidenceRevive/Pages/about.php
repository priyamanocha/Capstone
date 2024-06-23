<!-- We are starting the session in order to track user login and other session-related information -->

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Residence Revive</title>
    <!-- The link to external CSS stylesheets -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
     <!-- Including the header from a separate PHP file -->
    <?php include '../includes/header.php'; ?>

    <!-- The container for the login form -->
    <div class="container mt-4 text-start">
    
    <h1 class="mb-4">Our Story</h1>

    <!-- Section 1-->

    <div class="card col-lg-10 mb-4">
            <div class="d-flex p-3 rounded-5">
                <img src="../images/parchment.png" class="img-fluid object-fit-contain" alt="Image" style="max-width: 80px;">
                <div class="flex-grow-1 p-3">
                    <p class="card-text ms-2">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt distinctio neque ut atque inventore sunt eius, velit sapiente! Incidunt, neque? Explicabo sed aperiam distinctio deserunt earum beatae iusto incidunt culpa!
                    </p>
                </div>
            </div>    
        </div>


        <div class="card col-lg-10 ms-lg-auto mb-4">
            <div class="d-flex p-3 rounded-5">
                <img src="../images/parchment.png" class="img-fluid object-fit-contain order-last" alt="Image" style="max-width: 80px;">
                <div class="flex-grow-1 p-3">
                    <p class="card-text me-2">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt distinctio neque ut atque inventore sunt eius, velit sapiente! Incidunt, neque? Explicabo sed aperiam distinctio deserunt earum beatae iusto incidunt culpa!
                    </p>
                </div>
            </div>    
        </div>


        <div class="card col-lg-10 mb-4">
            <div class="d-flex p-3 rounded-5">
                <img src="../images/parchment.png" class="img-fluid object-fit-contain" alt="Image" style="max-width: 80px;">
                <div class="flex-grow-1 p-3">
                    <p class="card-text ms-2">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt distinctio neque ut atque inventore sunt eius, velit sapiente! Incidunt, neque? Explicabo sed aperiam distinctio deserunt earum beatae iusto incidunt culpa!
                    </p>
                </div>
            </div>    
        </div>
       

     <!-- Section 2 -->

     <div class="row justify-content-center">
        <div class="col-md-6">
        <div class="mb-4">
            <div class="d-flex p-3 rounded-5">
                <img src="../images/user.png" class="img-fluid object-fit-contain" alt="Image" style="max-width: 80px;">
                <div class="flex-grow-1 p-3 ms-2">
                    <h4 class="card-title mb-2" style="color: #3F44E5;">About Our Team</h4>
                    <p class="card-text">
                    Our Staff is full of experts, and have on-job experience of years</p>
                </div>
            </div>    
        </div>
        </div>

        <div class="col-md-6">
        <div class="mb-4">
            <div class="d-flex p-3 rounded-5">
                <img src="../images/question.png" class="img-fluid object-fit-contain" alt="Image" style="max-width: 80px;">
                <div class="flex-grow-1 p-3 ms-2">
                    <h4 class="card-title mb-2" style="color: #3F44E5;">Why to trust Us?</h4>
                    <p class="card-text">
                    Because We have a Good Track Record</p>
                </div>
            </div>    
        </div>
        </div>


        <div class="col-md-6">
        <div class="mb-4">
            <div class="d-flex p-3 rounded-5">
                <img src="../images/map.png" class="img-fluid object-fit-contain" alt="Image" style="max-width: 80px;">
                <div class="flex-grow-1 p-3 ms-2">
                    <h4 class="card-title mb-2" style="color: #3F44E5;">Where are we located.</h4>
                    <p class="card-text">
                    You can find our Office in Kitchener, Ontario.</p>
                </div>
            </div>    
        </div>
        </div>
     </div>


        
    </div>
    <!-- Including the footer from a separate PHP file -->
    <?php include '../includes/footer.php'; ?>
</body>
</html>
