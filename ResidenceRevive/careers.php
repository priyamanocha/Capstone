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
    <title> Careers Page </title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <a href="index.php"><img src="images/ResidenceRevive_logo.png" alt="Residence Revive Logo"></a>
                <a href="index.php">Residence Revive</a>
            </div>
            <div class="search">
                <input type="text" placeholder="Search for Service"
                    class="form-control form-control-lg d-inline-block search-service">
            </div>
            <div class="links">
                <a href="index.php">Home</a>
                <a href="about_us.php">About us</a>
                <a href="cart.php">Cart</a>
                <a href="contact_us.php">Contact us</a>
                <a href="login.php">Login</a>
                <a href="signup.php">Register</a>
            </div>
            <!-- The menu toggle button, just for the responsive design -->
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </header>
</body>

</html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Careers Page </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/careers-styles.css">
   
</head>
<body>
    <div class="con">
        <div class="form-row">
            <div class="form- group col-md-6">
                <div class="imgg">

                </div>
            </div>

            <div class="form-group col-md-6">
                <br>
                <div class="pa">
                    <center>
                        <h2> Creating the sorcery in the movement </h2>
                    </center>
                    <p> 
                        <center> Residence Revive is reshaping the way real estate works by making it more efficient. Inactive agents and dysfunctional processes have been having a detrimental impact on the vendors for far too long. Using cutting-edge technology and specialists in individual neighborhoods, Residence Revive is resolving each problem associated with relocation – come and be part of it! <br> <br> <h5> Learn More... </h5> </center>
                    </p>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="fi">
        <center>
            <h2> Current Job Openings </h2>
            <br>
            <h4> Residential Cleaner </h4>
            <h5> Residence Revive - North Side </h5> <hr> <br>

            <h4> Office Cleaner </h4>
            <h5> Residence Revive - West Side </h5> <hr> <br>

            <h4> Industrial Cleaner </h4>
            <h5> Residence Revive - East Side </h5> <hr> <br>

            <h4> Commercial cleaner </h4>
            <h5> Residence Revive - South Side </h5> 
            <h6> People can reach to us Email: support@residencerevive.com and upload the cover letter and resume on it. </h6>
            <br>
        </center>
    </div>

    <div>
        <center> <b> <h1> Our hiring process </h1> </b> </center>
        <div class="form-row"> 
            <div class="form-group col-md-4">
                <div class="hi"> </div>
                <h3><b> 1. Phone call. </b></h3>
                <p class="pp"> Onces you apply, first of all we talk to you over the phone. It happens so that we can understand you more and you could get to know more about us. </p>
            </div>
            <div class="form-group col-md-4">
                <h3><b> 2. Interview. </b></h3>
                <p class="pp"> You must have an interview that is deeper by the hiring manager or perform a practical test. Note: Preliminary telephone interviews may be after this test in some engineering jobs. </p>     
            </div>
            <div class="form-group col-md-4">
                <h3><b> 3. Trial Day. </b> </h3>
                <p class="pp"> The third and final stage is a working interview. It allows you to see what a day at Residence Revive looks like. Moreover, we can understand your work style. It’s a win-win situation. </p>
            </div>
        </div>
    </div>

</body>
</html>
<?php
    include 'includes/footer.php';
?>