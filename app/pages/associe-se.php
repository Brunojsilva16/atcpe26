<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associe-se</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="./src/styles/carousel.css">
    <!-- <link rel="stylesheet" href="../src/styles/navbar.css"> -->
    <link rel="stylesheet" href="./src/styles/navbar.css">
    <link rel="stylesheet" href="./src/styles/associe-se.css">
    <link rel="stylesheet" href="./src/styles/footer.css">
    <link rel="icon" href="./assets/favicon.png" sizes="32x32">
</head>


<body class="font-sans">

    <!-- Main Navbar -->
    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm rounded-lg">
        <div class="container-fluid">
            <!-- Navbar Brand/Logo -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <!-- <img src="./assets/img/logo.png" alt="Your Logo" width="10%" height="5%" class="d-inline-block align-text-top rounded-md me-2"> -->
                <!-- <span class="fw-bold text-primary">YourBrand</span> -->
            </a>
            <!-- Navbar Toggler for mobile -->
            <button id="navbarToggler" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Collapse Content -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul id="navbarNav" class="navbar-nav ms-auto"> <!-- ms-auto pushes items to the right -->
                    <li class="nav-item">
                        <a class="nav-link active rounded-md hover:bg-gray-200 px-3 py-2" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-md hover:bg-gray-200 px-3 py-2" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-md hover:bg-gray-200 px-3 py-2" href="#">Pricing</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle rounded-md hover:bg-gray-200 px-3 py-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu rounded-md shadow-lg">
                            <li><a class="dropdown-item rounded-md hover:bg-blue-100" href="#">Action</a></li>
                            <li><a class="dropdown-item rounded-md hover:bg-blue-100" href="#">Another action</a></li>
                            <li><a class="dropdown-item rounded-md hover:bg-blue-100" href="#">Something else here</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="card-container">

        <div class="card card-light-green">
            <div class="card-content">
                <h2 class="title">Estudante<br>de graduação</h2>
                <div class="price">70,00</div>
            </div>
        </div>

        <div class="card card-light-green">
            <div class="card-content">
                <h2 class="title">Profissional<br>de Psicologia</h2>
                <div class="price">110,00</div>
            </div>
        </div>

        <div class="card card-light-green highlighted">
            <div class="card-content">
                <h2 class="title">Profissional<br>de Psiquiatria</h2>
                <div class="price">110,00</div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Jquery needed -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="./srcjs/scripts.js"></script>

    <script src="./src/js/carousel.js"></script>
    <script>
        $(document).ready(function() {
            // Function to handle the navbar affix effect
            function checkScroll() {
                // Check if the scroll position is greater than 50 pixels
                if ($(document).scrollTop() > 50) {
                    // Add the 'affix' class to the mainNavbar
                    $('#mainNavbar').addClass('affix');
                } else {
                    // Remove the 'affix' class from the mainNavbar
                    $('#mainNavbar').removeClass('affix');
                }
            }

            // Call the function once on page load to set the initial state
            checkScroll();

            // Attach the function to the window's scroll event
            $(window).scroll(function() {
                checkScroll();
            });
        });
    </script>

    <?php
    include './includes/footer.php'
    ?>
</body>

</html>