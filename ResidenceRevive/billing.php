<?php
// Include database connection
include 'config/db.php';
$email = "";
$fname_err = $lname_err = $cfname_err = $clname_err = $email_err = $unit_err = $address_err = $city_err = $state_err = $zip_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cash_on_completion'])) {
    
    if (empty($_POST["fname"])) {
        $fname_err = "Please enter first name";
    }

    if (empty($_POST["lname"])) {
        $lname_err = "Please enter last name";
    }

    if (empty($_POST["email"])) {
        $email_err = "Please enter email";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (empty($_POST["unumber"])) {
        $unit_err = "Please enter unit number!";
    } elseif (!empty($_POST["unumber"] && !preg_match("/^[0-9]{5} $/", $_POST["unumber"]))) {
        $unit_err = "Please enter valid unit number";
    }

    if (empty($_POST["saddress"])) {
        $address_err = "Please enter street address";
    }
    if (empty($_POST["city"])) {
        $city_err = "Please enter city";
    }
    if (empty($_POST["state"])) {
        $state_err = "Please enter province";
    }
    if (empty($_POST["zcode"])) {
        $zip_err = "Please enter zip code";
    }

    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($phone_err) && empty($message_err)) {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $unit_number = $_POST['unumber'];
        $street_address = $_POST['saddress'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip_code = $_POST['zcode'];

        $sql = "INSERT INTO billing_info (first_name, last_name, email, unit_number, street_address, city, state, zip_code)
            VALUES ('$first_name', '$last_name', '$email', '$unit_number', '$street_address', '$city', '$state', '$zip_code')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Your service is booked successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $sql . "<br>" . $conn->error]);
        }

        $conn->close();
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script
        src="https://www.paypal.com/sdk/js?client-id=AU-BCliRR1GrxubqPo3StNDXE15Fc0lw4AsW_9KTwhTBPxmAwXTiG9QzHR4N0pZ6d1eaE60UBad5cPm5"></script>
    <script src="https://pay.google.com/gp/p/js/pay.js" async></script>
    <style>
        .payment-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .payment-buttons div {
            flex: 1 1 200px;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <div class="container mt-5">
            <div class="billing-form-container">
                <form id="billing-form" class="fo" method="POST" action="billing.php">
                    <div class="mb-4">
                        <h1 class="h3">Personal Information</h1>
                        <hr>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                placeholder="First Name" pattern="[A-Za-z]+" >
                                <span class="error"><?php echo $fname_err; ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                placeholder="Last Name" pattern="[A-Za-z]+" >
                            <span class="error"><?php echo $lname_err; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="xxx@xxxx.com">
                        <span class="error"><?php echo $email_err; ?></span>
                    </div>
                    <div class="mb-4">
                        <h1 class="h3">Billing Address</h1>
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="unumber">Unit/Apartment Number</label>
                        <input type="number" class="form-control" id="unumber" name="unumber"
                            placeholder="Unit/Apartment Number" >
                        <span class="error"><?php echo $unit_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="saddress">Street Address</label>
                        <input type="text" class="form-control" id="saddress" name="saddress"
                            placeholder="Street Address" >
                        <span class="error"><?php echo $address_err; ?></span>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City" >
                            <span class="error"><?php echo $city_err; ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="state">Province</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Province">
                            <span class="error"><?php echo $state_err; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zcode">Zip Code</label>
                        <input type="text" class="form-control" id="zcode" name="zcode" placeholder="Zip Code" >
                        <span class="error"><?php echo $zip_err; ?></span>
                    </div>
                    <div class="text-center">
                        <!-- <button type="button" class="btn btn-success mb-3" onclick="handleCashOnCompletion()">Cash On
                            Completion</button> -->
                            <button type="submit" class="btn btn-success mb-3">Cash On
                            Completion</button>
                    </div>
                    <!-- <div class="payment-buttons">
                        <div id="paypal-button-container"></div>
                        <div id="google-pay-button-container"></div>
                    </div> -->
                </form>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>

    <script>
        function handleCashOnCompletion() {
            const form = document.getElementById('billing-form');
            const formData = new FormData(form);
            formData.append('cash_on_completion', '1');

            fetch('', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                        window.location.href = '/';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '0.01'
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    alert('Your service is booked successfully!');
                    window.location.href = '../index.php';
                });
            }
        }).render('#paypal-button-container');
    </script>

    <script>
        const baseRequest = {
            apiVersion: 2,
            apiVersionMinor: 0
        };

        const allowedCardNetworks = ["AMEX", "DISCOVER", "JCB", "MASTERCARD", "VISA"];
        const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

        const tokenizationSpecification = {
            type: 'PAYMENT_GATEWAY',
            parameters: {
                'gateway': 'example',
                'gatewayMerchantId': 'exampleMerchantId'
            }
        };

        const baseCardPaymentMethod = {
            type: 'CARD',
            parameters: {
                allowedAuthMethods: allowedCardAuthMethods,
                allowedCardNetworks: allowedCardNetworks
            }
        };

        const cardPaymentMethod = Object.assign(
            {},
            baseCardPaymentMethod,
            {
                tokenizationSpecification: tokenizationSpecification
            }
        );

        const paymentsClient = new google.payments.api.PaymentsClient({ environment: 'TEST' });

        const isReadyToPayRequest = Object.assign(
            {},
            baseRequest,
            {
                allowedPaymentMethods: [baseCardPaymentMethod]
            }
        );

        paymentsClient.isReadyToPay(isReadyToPayRequest)
            .then(function (response) {
                if (response.result) {
                    const button = paymentsClient.createButton({ onClick: onGooglePaymentButtonClicked });
                    document.getElementById('google-pay-button-container').appendChild(button);
                }
            })
            .catch(function (err) {
                console.error(err);
            });

        function onGooglePaymentButtonClicked() {
            const paymentDataRequest = Object.assign({}, baseRequest);
            paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
            paymentDataRequest.transactionInfo = {
                totalPriceStatus: 'FINAL',
                totalPrice: '0.01',
                currencyCode: 'USD'
            };
            paymentDataRequest.merchantInfo = {
                merchantName: 'Residence Revive'
            };

            paymentsClient.loadPaymentData(paymentDataRequest)
                .then(function (paymentData) {
                    processPayment(paymentData);
                })
                .catch(function (err) {
                    console.error(err);
                });
        }

        function processPayment(paymentData) {
            console.log(paymentData);
            alert('Your service is booked successfully!');
            window.location.href = '/';
        }
    </script>
</body>

</html>