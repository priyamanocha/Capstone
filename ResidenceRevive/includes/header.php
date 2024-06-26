<!DOCTYPE html>
<html lang="en">

<head>
    <!-- The Meta tags for char set and viewport settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link to the external CSS stylesheet for styling the page -->
    <link rel="stylesheet" href="css/styles.css">
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