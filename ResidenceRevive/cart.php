<?php 

session_start();

// empty services to cart
if(isset($_GET['action']) && $_GET['action'] == 'empty'){


    unset($_SESSION['cart']);
    header('Location: cart.php');
    exit;


}



// add service to cart
if(isset($_GET['service_id']) && isset($_GET['action']) && $_GET['action'] == 'add'){

    $_SESSION['cart'][] = $_GET['service_id'];
    
    $_SESSION['cart'] = array_unique($_SESSION['cart']);

    header('Location: index.php?message=added');
    exit;


}


// remove item from cart
if(isset($_GET['service_id']) && isset($_GET['action']) && $_GET['action'] == 'remove'){

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



if($cart_items){

        
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
    <!-- The link to external CSS stylesheets -->
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <!-- Including the header from a separate PHP file -->
    <?php include 'includes/header.php'; ?>

    <div class="container my-4 col-lg-10 mx-auto">


    <?php if(isset($_GET['message']) && $_GET['message'] == 'removed'): ?>
    
<div class="alert alert-success">Service removed from Cart.  
</div>
<?php endif; ?>


        <h2 class="mb-3 text-start p-0">Cart Summary</h2>

        <?php if($cart_items): ?>

        <table class="table table-borderless align-middle">
            <thead>
                <tr>
                    <th scope="col">Service</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th style="min-width: 140px;">
                    <a href="<?php $_SERVER['PHP_SELF']; ?>?action=empty" class="btn btn-danger">Empty Cart</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                

                <?php while($cart_service = $cart_services->fetch_assoc()): ?>

                    <tr>
                        <td>

                            <div class="border d-flex p-3 rounded-5 w-75">
                                <img src="<?php echo $cart_service['service_img']; ?>" class="img-fluid object-fit-contain" alt="Image"
                                    style="max-width: 60px;">
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
                        <a href="<?php $_SERVER['PHP_SELF']; ?>?action=remove&service_id=<?php echo $cart_service['service_id']; ?>" class="btn text-danger fw-bold fs-3">&times;</a>
                    </td>
                </tr>

                <?php endwhile; ?>

               
            </tbody>
            <tfoot>
                <tr>
                    <td>

                       <div class="d-flex border rounded-4 p-3 align-items-center justify-content-between mt-4">
                           <h3>Cart Total</h3>
                           <p class="lead fw-normal">$<?php echo $cart_total; ?></p>
                       </div>

                    </td>
                    <td colspan="3" class="text-end">

                        <form action="" class="mt-4">

                            <button type="submit" class="btn w-50 btn-primary btn-lg h-auto"
                                style="background-color: #FF6F61; border-color: #FF6F61;">Proceed to Payment</button>

                        </form>

                    </td>
                </tr>
            </tfoot>
        </table>

        <?php else: ?>

            <div class="alert alert-success">No Services in Cart</div>

            <?php endif; ?>
        


    </div>



    <!-- Including the footer from a separate PHP file -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>