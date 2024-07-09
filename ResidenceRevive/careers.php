<?php
// Checking for the session, if is not already started, then start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Careers Page </title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

    <div class="form-row">
        <div class="form- group col-md-6">
            <div class="imgg">
                
            </div>
        </div>

        <div class="form-group col-md-6">
            <div class="pa">

            </div>
        </div>

    </div>


</body>
<br>
<?php
include 'includes/footer.php';
?>

</html>