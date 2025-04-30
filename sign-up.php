<?php

    include "app/controllers/users.php";
    include 'app/include/header.php'; 
    // if (isset($_SESSION['id'])) {
    //     header('Location: index.php');
    //     exit();
    // }
    
?>

<section class="sign-up">
  <div class="container">
    <h1>Welcome into Unico</h1>
    <h2>Sign up</h2>
    <span>to create your account</span>
    <form action="sign-up.php" method="post" class="sign-up-form">
      <label for="firstname">First name<input id="firstname" name="firstname" placeholder="Your name"
          type="text"></label>
      <label for="secondname">Second name<input id="secondname" name="secondname" placeholder="Your last name"
          type="text"></label>
      <label for="email">Email<input id="email" name="email" placeholder="Email" type="text"></label>
      <label for="tel">Phone number<input id='tel' class='phone' name="tel" class="num-only" type="tel"></label>
      <label for="password">Password*<input name="password" placeholder="********" id='password'
          type='password'></label>
      <label for="passwordc">Passsword confirmation<input name="passwordconfirm" id='passwordc' placeholder="********"
          type='password'></label>
      <input value="Sign up" type="submit" name="button-reg" class='modal'>
    </form>
    <a href="sign-in.php">Sign in</a>
    <p><?=$errorMsg?></p>
  </div>
</section>

<?php require_once 'app/include/footer.php'; ?>