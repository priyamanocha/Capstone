<!-- We are starting the session in order to track user login and other session-related information -->

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Residence Revive</title>
    <!-- The link to external CSS stylesheets -->
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <!-- Including the header from a separate PHP file -->
    <?php include 'includes/header.php'; ?>

    <div class="container my-4">

        <h2 class="mb-3 text-start p-0">Cart Summary</h2>

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Service</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>

                        <div class="border d-flex p-3 rounded-5 w-75">
                            <img src="images/electrician.png" class="img-fluid object-fit-contain" alt="Image"
                                style="max-width: 60px;">
                            <div class="p-3 ms-2">
                                <h5>Electrician Service</h5>
                            </div>
                        </div>

                    </td>
                    <td>
                        <input type="number" class="form-control form-control-lg rounded-3 w-50" name="quantity1" id="quantity1" value="1">
                    </td>
                    <td>
                        <span class="fw-bold">$10.00</span>
                    </td>
                </tr>


                <tr>
                    <td>

                        <div class="border d-flex p-3 rounded-5 w-75">
                            <img src="images/cleaning.png" class="img-fluid object-fit-contain" alt="Image"
                                style="max-width: 60px;">
                            <div class="p-3 ms-2">
                                <h5>Carpet Cleaning</h5>
                            </div>
                        </div>

                    </td>
                    <td>
                        <input type="number" class="form-control form-control-lg rounded-3 w-50" name="quantity1" id="quantity1" value="1">
                    </td>
                    <td>
                        <span class="fw-bold">$20.00</span>
                    </td>
                </tr>


                <tr>
                    <td>

                        <div class="border d-flex p-3 rounded-5 w-75">
                            <img src="images/plumbing.png" class="img-fluid object-fit-contain" alt="Image"
                                style="max-width: 60px;">
                            <div class="p-3 ms-2">
                                <h5>Plumbing Service</h5>
                            </div>
                        </div>

                    </td>
                    <td>
                        <input type="number" class="form-control form-control-lg rounded-3 w-50" name="quantity1" id="quantity1" value="1">
                    </td>
                    <td>
                        <span class="fw-bold">$20.00</span>
                    </td>
                </tr>

            </tbody>
            <tfoot>
                <tr>
                    <td>

                       <div class="d-flex border rounded-4 p-3 align-items-center justify-content-between mt-4">
                           <h3>Cart Total</h3>
                           <p class="lead fw-normal">$60.00</p>
                       </div>

                    </td>
                    <td></td>
                    <td>

                        <form action="" class="mt-4">

                            <button type="submit" class="btn btn-primary p-3"
                                style="background-color: #FF6F61; border-color: #FF6F61;">Proceed to Payment</button>

                        </form>

                    </td>
                </tr>
            </tfoot>
        </table>
    </div>



    <!-- Including the footer from a separate PHP file -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>