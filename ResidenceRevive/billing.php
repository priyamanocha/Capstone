<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$email = "";
$fname_err = $lname_err = $cfname_err = $clname_err = $email_err = $card_err = $security_err = $month_err = $year_err = $unit_err = $address_err = $city_err = $state_err = $zip_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    // Personal Information Input Validation.

    if(empty($_POST["fname"]))
    {
        $fname_err = "Please Enter First Name!";
    }

    if(empty($_POST["lname"]))
    {
        $lname_err = "Please Enter Last Name!";
    }
    
    if(empty($_POST["email"]))
    {
        $email_err = "Please Enter Email Id!";
    }
    elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format!";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    // Credit Card Input Validation.

    if(empty($_POST["cfname"]))
    {
        $cfname_err = "Please Enter First Name!";
    }
    if(empty($_POST["clname"]))
    {
        $clname_err = "Please Enter Last Name!";
    }
    
    if(empty($_POST["ccard"]))
    {
        $card_err = "Please Enter Card Number!";
    }
    elseif(!empty($_POST["ccard"]) && !preg_match("/^[0-9]{12}$/", $_POST["ccard"]))
    {
        $card_err = "Please Enter Valid Card Number!";
    }

    if(empty($_POST["scode"]))
    {
        $security_err = "Please Enter Security Code!";
    }
    elseif(!empty($_POST["scode"] && !preg_match("/^[0-9]{3} $/", $_POST["scode"])))
    {
        $security_err = "Please Enter Valid Security Code!";

    }

    if(empty($_POST["emonth"]))
    {
        $month_err = "Please Enter Expiration Month!";
    }
    elseif(!empty($_POST["emonth"] && !preg_match("/^[0-9]{2} $/", $_POST["emonth"])))
    {
        $month_err = "Please Enter Valid Expiration Month!";

    }

    if(empty($_POST["eyear"]))
    {
        $year_err = "Please Enter Expiration Year!";
    }
    elseif(!empty($_POST["eyear"] && !preg_match("/^[0-9]{4} $/", $_POST["eyear"])))
    {
        $year_err = "Please Enter Valid Expiration Year!";
    }

    // Unit Information Input Validation.

    if(empty($_POST["unumber"]))
    {
        $unit_err = "Please Enter Unit Number!";
    }
    elseif(!empty($_POST["unumber"] && !preg_match("/^[0-9]{5} $/", $_POST["unumber"])))
    {
        $unit_err = "Please Enter Valid Unit Number!";
    }

    if(empty($_POST["saddress"]))
    {
        $address_err = "Please Enter Street Address!";
    }
    if(empty($_POST["city"]))
    {
        $city_err = "Please Enter City Name!";
    }
    if(empty($_POST["state"]))
    {
        $state_err = "Please Enter State/Province Name!";
    }
    if(empty($_POST["zcode"]))
    {
        $zip_err = "Please Enter Zip Code!";
    }

}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Billing Page </title>
    <link rel="stylesheet" href="../css/contact_styles.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
</head>
<body>
    <?php include 'includes/header.php' ?>
    <main>
        <div class="billing-form-container">
            <form action="billing.php" method="POST" class="fo">
                <div>
                    <h1> Personal Information </h1>
                </div>
                <hr> </hr>
                <div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="fname" name="first_name" placeholder="First Name" >
                        <span class="error"><?php echo $fname_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="lname" name="last_name" placeholder="Last Name"  >
                        <span class="error"><?php echo $lname_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="you@yoursite.com" >
                        <span class="error"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="invoicenumber">Invoice Number</label>
                        <input type="text" id="inumber" name="invoivenumber" // value="<?php $inumber; ?>">
                    </div>
                    <div class="form-group">
                        <label for="Payment Amount">Payment Amount</label>
                        <input type="text" id="pamount" name="paymentamout" // value="<?php  $pamount;?>">
                    </div>
                </div>
                <div>
                    <div>
                        <h1> Credit Card </h1>
                    </div>
                    <hr> </hr>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="fname" name="cfname" placeholder="First Name" >
                            <span class="error"><?php echo $cfname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="lname" name="clname" placeholder="Last Name" >
                            <span class="error"><?php echo $clname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="creditcard">Credit Card</label>
                            <input type="number" id="ccard" name="ccard" placeholder="Credit Card Number" >
                            <span class="error"><?php echo $card_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="securitycode">Security Code</label>
                            <input type="number" id="scode" name="scode" placeholder="Enter Security Code" >
                            <span class="error"><?php echo $security_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="expirationmonth">Expiration Month</label>
                            <input type="number" id="emonth" name="emonth" placeholder="Enter Expiration Month" >
                            <span class="error"><?php echo $month_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="expirationyear">Expiration Year</label>
                            <input type="number" id="eyear" name="eyear" placeholder="Enter Expiration Year" pattern="[1-9]{2}" >
                            <span class="error"><?php echo $year_err; ?></span>
                        </div>
                </div>
                <div>
                    <div>
                        <h1> Billing Address </h1>
                    </div>
                    <hr> </hr>
                        <div class="form-group">
                            <label for="unitnumber">Unit/Apartment Number</label>
                            <input type="number" id="unumber" name="unumber" placeholder="Enter Unit/Apartment Number" pattern="[1-9]{2}" >
                            <span class="error"><?php echo $unit_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="Street Address"> Street Address </label>
                            <input type="text" id="saddress" name="saddress" placeholder="Enter Street Address" pattern="[A-Za-z]" >
                            <span class="error"><?php echo $address_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Enter City" pattern="[A-Za-z]" >
                            <span class="error"><?php echo $city_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="state">State/Province</label>
                            <input type="text" id="state" name="state" placeholder="Enter State/Province" pattern="[A-Za-z]" >
                            <span class="error"><?php echo $state_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="zipcode">Zip Code</label>
                            <input type="text" id="zcode" name="zcode" placeholder="Enter Zip Code" pattern="[A-Za-z1-9]" >
                            <span class="error"><?php echo $zip_err; ?></span>
                        </div>
                </div>
                <div>
                    <center>
                        <button type="submit" class="btn btn-success"> Processed </button>
                    </center>
                </div>
            </form>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
