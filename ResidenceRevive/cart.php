<?php
session_start();

// empty services in cart
if (isset($_GET['action']) && $_GET['action'] == 'empty') {
    unset($_SESSION['cart']);
    header('Location: cart.php');
    exit;
}

// add service to cart
if (isset($_POST['service_id']) && isset($_POST['action']) && $_POST['action'] == 'add') {
    $_SESSION['cart'][] = $_POST['service_id'];
    $_SESSION['cart'] = array_unique($_SESSION['cart']);
    echo json_encode(['status' => 'success', 'message' => 'Service added to cart']);
    exit;
}

// remove item from cart
if (isset($_GET['service_id']) && isset($_GET['action']) && $_GET['action'] == 'remove') {
    $valueToDelete = $_GET['service_id'];
    $cart_items = $_SESSION['cart'];

    if (($key = array_search($valueToDelete, $cart_items)) !== false) {
        unset($cart_items[$key]);
    }

    $_SESSION['cart'] = array_values($cart_items);
    header('Location: cart.php?message=removed');
    exit;
}

include 'config/db.php';

$cart_items = $_SESSION['cart'] ?? [];

if ($cart_items) {
    $ids = implode(", ", $cart_items);
    $sql = "SELECT * FROM services WHERE service_id IN ($ids)";
    $cart_services = $conn->query($sql);
    $conn->close();
}

$cart_total = 0;
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

        .table tbody + tbody {
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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Service</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th style="min-width: 140px;">
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=empty" class="btn btn-danger">Empty Cart</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($cart_service = $cart_services->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <div class="border d-flex p-3 rounded-5 w-75">
                                    <img src="<?php echo $cart_service['service_img']; ?>" class="img-fluid object-fit-contain" alt="Image">
                                    <div class="p-3 ms-2">
                                        <h6><?php echo $cart_service['service_name']; ?></h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <input type="number" class="form-control form-control-lg rounded-3 w-50" name="quantity1" id="quantity1" value="1">
                            </td>
                            <td>
                                <span class="fw-bold"><?php echo $cart_service['price']; ?></span>
                                <?php $cart_total += $cart_service['price']; ?>
                            </td>
                            <td>
                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=remove&service_id=<?php echo $cart_service['service_id']; ?>" class="btn text-danger fw-bold fs-3">&times;</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="cart-total">Cart Total: $<?php echo $cart_total; ?></td>
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
