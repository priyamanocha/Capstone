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
            <form action="billing_action.php" method="POST" class="fo">
                <div>
                    <h1> Personal Information </h1>
                </div>
                <hr> </hr>
                <div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="First Name" pattern="[A-Za-z]" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" pattern="[A-Za-z]" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="you@yoursite.com" pattern="[A-Za-z]" required>
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
                            <input type="text" id="first_name" name="first_name" placeholder="First Name" pattern="[A-Za-z]" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" placeholder="Last Name" pattern="[A-Za-z]" required>
                        </div>
                        <div class="form-group">
                            <label for="creditcard">Credit Card</label>
                            <input type="number" id="ccard" name="ccard" placeholder="Credit Card Number" pattern="[1-9]{12}" required>
                        </div>
                        <div class="form-group">
                            <label for="securitycode">Security Code</label>
                            <input type="number" id="scode" name="scode" placeholder="Enter Security Code" pattern="[1-9]{3}" required>
                        </div>
                        <div class="form-group">
                            <label for="expirationmonth">Expiration Month</label>
                            <input type="number" id="emonth" name="emonth" placeholder="Enter Expiration Month" pattern="[1-9]{2}" required>
                        </div>
                        <div class="form-group">
                            <label for="expirationyear">Expiration Year</label>
                            <input type="number" id="eyear" name="eyear" placeholder="Enter Expiration Year" pattern="[1-9]{2}" required>
                        </div>
                </div>
                <div>
                    <div>
                        <h1> Billing Address </h1>
                    </div>
                    <hr> </hr>
                        <div class="form-group">
                            <label for="unitnumber">Unit/Apartment Number</label>
                            <input type="number" id="unumber" name="unumber" placeholder="Enter Unit/Apartment Number" pattern="[1-9]{2}" required>
                        </div>
                        <div class="form-group">
                            <label for="Street Address"> Street Address </label>
                            <input type="text" id="saddress" name="saddress" placeholder="Enter Street Address" pattern="[A-Za-z]" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Enter City" pattern="[A-Za-z]" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State/Province</label>
                            <input type="text" id="state" name="state" placeholder="Enter State/Province" pattern="[A-Za-z]" required>
                        </div>
                        <div class="form-group">
                            <label for="zipcode">Zip Code</label>
                            <input type="text" id="zcode" name="zcode" placeholder="Enter Zip Code" pattern="[A-Za-z1-9]" required>
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
