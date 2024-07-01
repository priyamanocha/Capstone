<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Billing Page </title>
    <link rel="stylesheet" href="../css/contact_styles.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/billing.css">
</head>
<body>
    <?php include '../includes/header.php' ?>
    <main>
        
        <div class="billing-form-container">
            <form action="billing_action.php" method="POST">
                <div>
                    <h1> Personal Information </h1>
                </div>
                <hr> </hr>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="you@yoursite.com" required>
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
                            <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                            <label for="creditcard">Credit Card</label>
                            <input type="number" id="ccard" name="ccard" placeholder="Credit Card Number" required>
                        </div>
                        <div class="form-group">
                            <label for="securitycode">Security Code</label>
                            <input type="number" id="scode" name="scode" placeholder="Enter Security Code" required>
                        </div>
                        <div class="form-group">
                            <label for="expirationmonth">Expiration Month</label>
                            <input type="number" id="emonth" name="emonth" placeholder="Enter Expiration Month" required>
                        </div>
                        <div class="form-group">
                            <label for="expirationyear">Expiration Year</label>
                            <input type="number" id="emonth" name="emonth" placeholder="Enter Expiration Month" required>
                        </div>
                </div>
                <div>
                    <div>
                        <h1> Billing Address </h1>
                    </div>
                    <hr> </hr>
                        <div class="form-group">
                            <label for="unitnumber">Unit/Apartment Number</label>
                            <input type="number" id="unumber" name="unumber" placeholder="Enter Unit/Apartment Number" required>
                        </div>
                        <div class="form-group">
                            <label for="Street Address"> Street Address </label>
                            <input type="text" id="saddress" name="saddress" placeholder="Enter Street Address" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Enter City" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State/Province</label>
                            <input type="text" id="state" name="state" placeholder="Enter State/Province" required>
                        </div>
                        <div class="form-group">
                            <label for="zipcode">Zip Code</label>
                            <input type="text" id="zcode" name="zcode" placeholder="Enter Zip Code" required>
                        </div>
                </div>
                <div>
                    <button type="submit" name="submit"> Submit </button>
                </div>
            </form>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
