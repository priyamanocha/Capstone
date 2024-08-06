<?php
$first_name = "";
// setting firstname and lastname from session
if (isset($_SESSION['email']) && isset($_SESSION['first_name'])) {
    $first_name = $_SESSION['first_name'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- The Meta tags for char set and viewport settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Professional home improvement, maintenance, and repair services. Sign up to book expert services for your residence today!">
    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Link to the external CSS stylesheet for styling the page -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand logo" href="index.php">
                    <img src="images/ResidenceRevive_logo.png" alt="Residence Revive Logo">
                    Residence Revive Services
                </a>
                <form class="d-inline-block">
                    <div class="search mx-5">
                        <input type="text" id="searchInput" placeholder="Search for Service"
                            class="form-control form-control-lg">
                        <div id="searchResults" class="mt-2"></div>
                    </div>
                </form>
                <div>
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo "<span class=\"welcome\">Welcome $first_name!</span>";
                    } ?>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Services
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <?php if (isset($categories) && is_array($categories)): ?>
                                    <?php foreach ($categories as $category): ?>
                                        <li><a class="dropdown-item"
                                                href="subcategory.php?category_id=<?php echo $category['category_id']; ?>">
                                                <?php echo $category['category_name']; ?>
                                            </a></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="#">No categories available</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about_us.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact_us.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>

                        <?php if (!isset($_SESSION['email'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="signup.php">Register</a>
                            </li>

                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout
                                </a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function() {
        const query = searchInput.value.trim();

        if (query.length > 0) {
            fetch(`search.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';

                    if (Array.isArray(data) && data.length > 0) {
                        const list = document.createElement('ul');
                        list.classList.add('list-group');

                        data.forEach(item => {
                            const listItem = document.createElement('li');
                            listItem.classList.add('list-group-item');
                            listItem.innerHTML = `<a href="subcategory.php?category_id=${item.category_id}">${item.service_name}</a>`;
                            list.appendChild(listItem);
                        });

                        searchResults.appendChild(list);
                    } else {
                        searchResults.innerHTML = '<p>No results found.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                });
        } else {
            searchResults.innerHTML = '';
        }
    });
});
</script>

    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>