<?php

session_start();

//  only logged in user can vist cart
if(!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}


require 'config/db.php';

// Assume user email is stored in session
$email = $_SESSION['email'];

// empty cart
if (isset($_GET['action']) && $_GET['action'] == 'empty') {

    $sql = "DELETE FROM cart WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// remove item from cart
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];

    $sql = "DELETE FROM cart WHERE email = ? AND service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $service_id);

    $stmt->execute();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}




$sql = "
SELECT 
    cart.quantity, 
    services.service_name, 
    cart.service_id, 
    services.service_img, 
    services.price AS service_price, 
    services.description AS service_description, 
    categories.category_name, 
    sub_categories.sub_category_name
FROM 
    cart
JOIN 
    services ON cart.service_id = services.service_id
JOIN 
    categories ON cart.category_id = categories.category_id
JOIN 
    sub_categories ON cart.subcategory_id = sub_categories.sub_category_id
WHERE 
    cart.email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$cart_total = 0;
$cart_items = $result->num_rows > 0;


$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Residence Revive</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            padding: 20px;
            background-color: #4caf50;
            color: white;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .alert.alert-danger {
            background-color: #f44336;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 1rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: #f2f2f2;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .img-fluid {
            max-width: 60px;
            height: auto;
            border-radius: 5px;
        }

        .table .btn-danger {
            background-color: #ff6f61;
            border-color: #ff6f61;
        }

        .table .btn-danger:hover {
            background-color: #e65c54;
            border-color: #e65c54;
        }

        .table .btn-primary {
            background-color: #ff6f61;
            border-color: #ff6f61;
        }

        .table .btn-primary:hover {
            background-color: #e65c54;
            border-color: #e65c54;
        }

        .cart-total {
            text-align: right;
            margin-top: 20px;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .cart-buttons {
            text-align: right;
            margin-top: 20px;
        }

        .cart-buttons button {
            background-color: #ff6f61;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .cart-buttons button:hover {
            background-color: #e65c54;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container my-4">
        <?php if (isset($_GET['message']) && $_GET['message'] == 'removed'): ?>
        <div class="alert">Service removed from Cart.</div>
        <?php endif; ?>

        <h2>Cart Summary</h2>

        <?php if ($cart_items): ?>
        <table class="table" style="vertical-align: middle;">
            <thead>
                <tr>
                    <th scope="col">Service</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th style="min-width: 140px;">
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=empty"
                            class="btn btn-danger">Empty Cart</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php while ($cart_service = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <div class="border d-flex p-3 rounded w-75">
                            <img src="<?php echo $cart_service['service_img']; ?>"
                                class="img-fluid object-fit-contain" alt="Image">
                            <div class="p-2 ms-2">
                                <h6><?php echo $cart_service['service_name']; ?>
                                </h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="number" class="mt-3 form-control form-control-lg rounded-3 w-50" name="quantity1"
                            id="quantity1"
                            value="<?php echo $cart_service['quantity']; ?>">
                    </td>
                    <td>
                        <p class="fw-bold mt-3">
                            <?php echo $cart_service['service_price']; ?>
                        </p>
                        <?php $cart_total += $cart_service['service_price'] * $cart_service['quantity']; ?>
                    </td>
                    <td>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=remove&service_id=<?php echo $cart_service['service_id']; ?>"
                            class="btn text-danger fw-bold fs-3">&times;</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="cart-total" style="font-size: 1.2rem;">



                        <?php

                    $tax_rate = 0.13;

            $tax_amount = $cart_total * $tax_rate;
            $total_with_tax = $cart_total + $tax_amount;


            ?>

                        <table class="table table-bordered">
                            <tr>
                                <td>Cart Total:</td>
                                <td>$<?php echo number_format($cart_total, 2); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tax Amount (13% of Cart Total):</td>
                                <td>$<?php echo number_format($tax_amount, 2); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total with Tax:</td>
                                <td>$<?php echo number_format($total_with_tax, 2); ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="text-end">
                        <form action="billing.php" method="POST" class="cart-buttons">
                            <button type="submit">Proceed to Payment</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>
        <?php else: ?>
        <div class="alert alert-danger">No Services in Cart</div>
        <?php endif; ?>

    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>