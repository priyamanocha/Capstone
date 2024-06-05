<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "Sign Up";
include 'config/db.php';
include 'includes/functions.php';
include 'includes/header.php';

if (isset($_SESSION['db_message'])) {
    echo "<div class='alert alert-info'>" . $_SESSION['db_message'] . "</div>";
    unset($_SESSION['db_message']); 
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Sign Up to Residence Revive</h2>
            <form action="signup_action.php" method="POST">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="password-strength">
                        <div class="weak"></div>
                        <div class="medium"></div>
                        <div class="strong"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>
        </div>
    </div>
</div>

<script>
    const password = document.getElementById('password');
    const weak = document.querySelector('.weak');
    const medium = document.querySelector('.medium');
    const strong = document.querySelector('.strong');

    password.addEventListener('input', () => {
        const val = password.value;
        let strength = 0;

        if (val.length > 7) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[0-9]/.test(val)) strength++;
        if (/[@$!%*?&#]/.test(val)) strength++;

        weak.style.backgroundColor = strength > 0 ? 'red' : 'gray';
        medium.style.backgroundColor = strength > 2 ? 'orange' : 'gray';
        strong.style.backgroundColor = strength > 3 ? 'green' : 'gray';
    });
</script>

<?php
include 'includes/footer.php';
?>
