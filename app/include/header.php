

<!DOCTYPE html>
<header class="header">

  <?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); // Start session only if not started
    }
  ?>


  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unico</title>

    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
    <link type="Image/x-icon" href="/favicon.ico" rel="icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">

    <link rel="stylesheet" href="assets/js/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/js/owl.theme.default.min.css">

    <link rel="stylesheet" href="assets/js/animate.min.css">

    <link rel="stylesheet" href="assets/nouislider.min.css">

    <link rel="stylesheet" href="assets/main.css">
  </head>

  <body>


    <div class="container">
      <a href="lk-user.php" class="logo">
        <img src="assets/img/logo.svg" alt="Unico" class="logo-img">
      </a>
      <nav class="menu">
        <ul class="menu-list">
          <li class="menu-item">
            <a href="index.php" class="menu-link">Home</a>
          </li>
          <li class="menu-item">
            <a href="trust-management.php" class="menu-link">Trust managment</a>
          </li>
          <li class="menu-item">
            <a href="about.php#content-1 " class="menu-link">About company</a>
          </li>
          <li class="menu-item">
            <a href="strategys-f-main.php" class="menu-link">Strategies</a>
          </li>
          <li class="menu-item">
            <a href="Insurance.php" class="menu-link">Insurance</a>
          </li>
          <?php if ($_SESSION['admin']):?>
          <li class="menu-item">
            <a href="ak.php" class="menu-link">Admin panel</a>
          </li>
          <?php endif ?>
        </ul>
      </nav>
      <?php if (isset($_SESSION['id'])):?>
      <a id="logOut" href="logout.php" class="logout-btn btn-41">Log out</a>
      <?php else: ?>
      <a id="privateLogin" href="sign-in.php" class="login-btn purple-btn">Private login</a>
      <?php endif ?>
    </div>
</header>
