<?php
    include "app/controllers/users.php";
    include 'app/include/header.php'; 
?>

<section class="sign-in">
  <div class="container">
    <h1>Welcome back</h1>
    <h2>Sign in</h2>
    <span>to access your account</span>
    <form action="sign-in.php" method="post" class="sign-in-form">
      <label for="email">email*<input id="email" name="email" placeholder="mail@example.com" type="email"
          required></label>
      <label for="password">Password*<input id="password" name="pass" placeholder="********" type="password"></label>
      <input value="Continue" type="submit" name="button-log">
    </form>
    <p style='margin-top:20px; color:red; font-size:24px'><?=$errorMsg?></p>
    <a href="sign-up.php">Sign up</a>

  </div>
</section>

<?php require_once 'app/include/footer.php'; ?>