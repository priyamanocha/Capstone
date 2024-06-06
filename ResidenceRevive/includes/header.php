<!DOCTYPE html>
<html lang="en">

<head>
    <!-- The Meta tags for char set and viewport settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Link to the external CSS stylesheet for styling the page -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <a href="#"><img src="../images/ResidenceRevive_logo.png" alt="Residence Revive Logo"></a>
                <a href="#">Residence Revive</a>
            </div>
            <div class="search">
                <input type="text" placeholder="Search for Service" class="search-service">
            </div>
            <div class="links">
                <a href="../index.php">Home</a>
                <a href="#">About us</a>
                <a href="#">Contact us</a>
                <a href="../Pages/login.php">Login</a>
                <a href="../Pages/signup.php">SignUp</a>
            </div>
             <!-- The menu toggle button, just for the responsive design -->
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </nav>

    </header>
   
</body>

</html>