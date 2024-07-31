<?php
// Include database connection
include 'config/db.php';
$email = "";
// setting email from session
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
// header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cash_on_completion'])) {

    // Retrieve POST data
    $unit_number = $_POST['unumber'];
    $street_address = $_POST['saddress'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zcode'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $serviceDate = $_POST['service_date'];
    $serviceTime = $_POST['service_time'];
    $phone_number = $_POST['phone_number'];

    // Retrieve services from cart
    $sql = "
    SELECT 
        c.category_id, 
        c.subcategory_id, 
        c.service_id, 
        c.quantity, 
        s.price 
    FROM cart AS c
    JOIN services AS s ON c.service_id = s.service_id
    JOIN categories AS cat ON c.category_id = cat.category_id
    JOIN sub_categories AS subcat ON c.subcategory_id = subcat.sub_category_id
    WHERE c.email = ?
";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $amount = 0;
    $tax = 0;

    // Calculate total amount based on cart
    while ($row = $result->fetch_assoc()) {
        $price = $row['price'];
        $quantity = $row['quantity'];
        $amount += $price * $quantity;
    }

    $taxRate = 0.13;
    $tax = $amount * $taxRate;

    $totalAmount = $amount + $tax;

    $amount = round($amount, 2);
    $tax = round($tax, 2);
    $totalAmount = round($totalAmount, 2);

    // Insert booking information into booking table
    $sql = "INSERT INTO booking (email, booking_date, booking_time, service_date, service_time, booking_first_name, booking_last_name, booking_contact_number, address, city, state, postal_code, amount, tax, total_amount) 
            VALUES (?, NOW(), NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssssddd', $email, $serviceDate, $serviceTime, $first_name, $last_name, $phone_number, $street_address, $city, $state, $zip_code, $amount, $tax, $totalAmount);

    if ($stmt->execute()) {
        // Get the last inserted ID
        $booking_id = $conn->insert_id;

        // Insert services into booking_services
        $sql = "INSERT INTO booking_services (booking_id, category_id, subcategory_id, service_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $insertStmt = $conn->prepare("INSERT INTO booking_services (booking_id, category_id, subcategory_id, service_id) VALUES (?, ?, ?, ?)");

        $result->data_seek(0);

        while ($row = $result->fetch_assoc()) {
            $stmt->bind_param('iiii', $booking_id, $row['category_id'], $row['subcategory_id'], $row['service_id']);
            $stmt->execute();
        }

        // Clear the cart
        $sql = "DELETE FROM cart WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        echo json_encode(['status' => 'success', 'message' => 'Your service is booked successfully!', 'booking_id' => $booking_id]);
       
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
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
                <form id="billing-form" class="fo" method="POST" action="">
                    <div class="mb-4">
                        <h1 class="h3">Service Data and Time</h1>
                        <hr>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="service_date">Service Date</label>
                            <input type="date" class="form-control" id="service_date" name="service_date">
                            <span class="error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="service_time">Service Time</label>
                            <select class="form-control" id="service_time" name="service_time">
                                <option value="10:00">10:00 AM</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="12:00">12:00 PM</option>
                                <option value="13:00">01:00 PM</option>
                                <option value="14:00">02:00 PM</option>
                                <option value="15:00">03:00 PM</option>
                                <option value="16:00">04:00 PM</option>
                                <option value="17:00">05:00 PM</option>
                                <option value="18:00">06:00 PM</option>
                            </select>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h1 class="h3">Personal Information</h1>
                        <hr>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="First Name" pattern="[A-Za-z]+">
                            <span class="error"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Last Name" pattern="[A-Za-z]+">
                            <span class="error"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone_number"> Phone Number</label>
                            <input type="number" class="form-control" id="phone_number" name="phone_number"
                                placeholder="Phone Number" pattern="[0-9]{10}">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h1 class="h3">Billing Address</h1>
                        <hr>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="unumber">Unit/Apartment Number</label>
                            <input type="number" class="form-control" id="unumber" name="unumber"
                                placeholder="Unit/Apartment Number">
                            <span class="error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="saddress">Street Address</label>
                            <input type="text" class="form-control" id="saddress" name="saddress"
                                placeholder="Street Address">
                            <span class="error"></span>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City">
                            <span class="error"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State/Province</label>
                            <input type="text" class="form-control" id="state" name="state"
                                placeholder="State/Province">
                            <span class="error"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="zcode">Zip Code</label>
                            <input type="text" class="form-control" id="zcode" name="zcode" placeholder="Zip Code">
                            <span class="error"></span>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-success mb-3" onclick="handleCashOnCompletion()">Cash On
                            Completion</button>
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
        const serviceDateInput = document.getElementById('service_date');
        const serviceTimeInput = document.getElementById('service_time');

        // Get today's date and the date seven days from now
        const today = new Date();
        const minDate = new Date(today);
        minDate.setDate(today.getDate() + 1);
        const maxDate = new Date(today);
        maxDate.setDate(today.getDate() + 7);

        // Format the dates to YYYY-MM-DD
        const formattedMinDate = minDate.toISOString().split('T')[0];
        const formattedMaxDate = maxDate.toISOString().split('T')[0];

        // Set the min and max attributes of the service_date input
        serviceDateInput.setAttribute('min', formattedMinDate);
        serviceDateInput.setAttribute('max', formattedMaxDate);
        function validateForm() {
            const serviceDate = document.getElementById('service_date').value;
            const serviceTime = document.getElementById('service_time').value;
            const firstName = document.getElementById('first_name').value;
            const lastName = document.getElementById('last_name').value;
            const unitNumber = document.getElementById('unumber').value;
            const streetAddress = document.getElementById('saddress').value;
            const city = document.getElementById('city').value;
            const state = document.getElementById('state').value;
            const zipCode = document.getElementById('zcode').value;
            const phoneNumber = document.getElementById('phone_number').value;

            let valid = true;

            // Validate service date
            if (!serviceDate) {
                valid = false;
                document.getElementById('service_date').nextElementSibling.textContent = 'Service Date is required.';
            } else {
                document.getElementById('service_date').nextElementSibling.textContent = '';
            }

            // Validate service time
            if (!serviceTime) {
                valid = false;
                document.getElementById('service_time').nextElementSibling.textContent = 'Service Time is required.';
            } else {
                document.getElementById('service_time').nextElementSibling.textContent = '';
            }

            // Validate first name
            if (!firstName) {
                valid = false;
                document.getElementById('first_name').nextElementSibling.textContent = 'First Name is required.';
            } else if (!/^[a-zA-Z]+$/.test(firstName)) {
                valid = false;
                document.getElementById('first_name').nextElementSibling.textContent = 'Only letters are allowed.';
            } else {
                document.getElementById('first_name').nextElementSibling.textContent = '';
            }

            // Validate last name
            if (!lastName) {
                valid = false;
                document.getElementById('last_name').nextElementSibling.textContent = 'Last Name is required.';
            } else if (!/^[a-zA-Z]+$/.test(lastName)) {
                valid = false;
                document.getElementById('last_name').nextElementSibling.textContent = 'Only letters are allowed.';
            } else {
                document.getElementById('last_name').nextElementSibling.textContent = '';
            }

            // Validate unit number (optional)
            if (unitNumber && isNaN(unitNumber)) {
                valid = false;
                document.getElementById('unumber').nextElementSibling.textContent = 'Unit Number must be a number.';
            } else {
                document.getElementById('unumber').nextElementSibling.textContent = '';
            }

            // Validate street address
            if (!streetAddress) {
                valid = false;
                document.getElementById('saddress').nextElementSibling.textContent = 'Street Address is required.';
            } else {
                document.getElementById('saddress').nextElementSibling.textContent = '';
            }

            // Validate city
            if (!city) {
                valid = false;
                document.getElementById('city').nextElementSibling.textContent = 'City is required.';
            } else {
                document.getElementById('city').nextElementSibling.textContent = '';
            }

            // Validate state
            if (!state) {
                valid = false;
                document.getElementById('state').nextElementSibling.textContent = 'State is required.';
            } else {
                document.getElementById('state').nextElementSibling.textContent = '';
            }

            // Validate zip code
            if (!zipCode) {
                valid = false;
                document.getElementById('zcode').nextElementSibling.textContent = 'Postal Code is required.';
            } else if (!/^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/.test(zipCode)) {
                valid = false;
                document.getElementById('zcode').nextElementSibling.textContent = 'Invalid Postal Code format. Use format A1A 1A1.';
            } else {
                document.getElementById('zcode').nextElementSibling.textContent = '';
            }

            // Validate phone number
            if (!phoneNumber) {
                valid = false;
                document.getElementById('phone_number').nextElementSibling.textContent = 'Phone Number is required.';
            } else if (!/^\d{10}$/.test(phoneNumber)) {
                valid = false;
                document.getElementById('phone_number').nextElementSibling.textContent = 'Phone Number must be 10 digits.';
            } else {
                document.getElementById('phone_number').nextElementSibling.textContent = '';
            }

            return valid;
        }


        function handleCashOnCompletion() {
            if (validateForm()) {
                const form = document.getElementById('billing-form');
                const formData = new FormData(form);
                for (let [key, value] of formData.entries()) {
                    console.log(key, value);
                }
                console.log(form);
                console.log(formData);
                formData.append('cash_on_completion', '1');

                fetch('billing.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        // Log the response to inspect it
                        console.log('Response status:', response.status);
                        return response.text(); // Use text() to capture the raw response
                    })
                    .then(text => {
                        try {
                            console.log(text);
                            const data = JSON.parse(text); // Attempt to parse JSON
                            console.log('Response data:', data);
                            if (data.status === 'success') {
                                alert(`Your service has been successfully booked! Your booking ID is ${data.booking_id}. Thank you for choosing our service.`);
                                window.location.href = '/'; // Redirect to the index page
                            } else {
                                alert(data.message);
                            }
                        } catch (error) {
                            console.error('Failed to parse JSON:', error);
                            alert('Failed to process the response.');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }
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