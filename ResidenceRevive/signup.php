<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up to Residence Revive</title>
    <link rel="stylesheet" href="css/signup_styles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Sign Up to Residence Revive</h2>
                <form action="signup.php" method="POST">
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
</body>
</html>
