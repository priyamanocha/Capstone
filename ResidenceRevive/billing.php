<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cash_on_completion'])) {
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://www.paypal.com/sdk/js?client-id=AU-BCliRR1GrxubqPo3StNDXE15Fc0lw4AsW_9KTwhTBPxmAwXTiG9QzHR4N0pZ6d1eaE60UBad5cPm5"></script> 
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
                <form id="billing-form" class="fo">
                    <div class="mb-4">
                        <h1 class="h3">Personal Information</h1>
                        <hr>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" pattern="[A-Za-z]+" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" pattern="[A-Za-z]+" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@yoursite.com" required>
                    </div>
                  
                    <div class="mb-4">
                        <h1 class="h3">Billing Address</h1>
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="unumber">Unit/Apartment Number</label>
                        <input type="number" class="form-control" id="unumber" name="unumber" placeholder="Unit/Apartment Number" required>
                    </div>
                    <div class="form-group">
                        <label for="saddress">Street Address</label>
                        <input type="text" class="form-control" id="saddress" name="saddress" placeholder="Street Address" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="state">State/Province</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="State/Province" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zcode">Zip Code</label>
                        <input type="text" class="form-control" id="zcode" name="zcode" placeholder="Zip Code" required>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-success mb-3" onclick="handleCashOnCompletion()">Cash On Completion</button>
                    </div>
                    <div class="payment-buttons">
                        <div id="paypal-button-container"></div>
                        <div id="google-pay-button-container"></div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>

    <script>
        function handleCashOnCompletion() {
            const form = document.getElementById('billing-form');
            const formData = new FormData(form);

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
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '0.01' 
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Your service is booked successfully!');
                    window.location.href = '/'; 
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
                'gateway': 'Jai Maurya', 
                'gatewayMerchantId': 'JaiMauryaGatewayMerchantId' 
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
            .then(function(response) {
                if (response.result) {
                    const button = paymentsClient.createButton({ onClick: onGooglePaymentButtonClicked });
                    document.getElementById('google-pay-button-container').appendChild(button);
                }
            })
            .catch(function(err) {
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
                merchantName: 'Jai Maurya' 
            };

            paymentsClient.loadPaymentData(paymentDataRequest)
                .then(function(paymentData) {
                    processPayment(paymentData);
                })
                .catch(function(err) {
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
