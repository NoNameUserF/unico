<?php
include 'app/include/header.php'; 
include "app/controllers/users.php";

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}	?>
<div class='confirm-tel-active'>
  <div class='confirm-tel-info'>
    <h2 class='confirm-tel-text'>An SMS has been sent to your email, please confirm it</h2>
    <form action="confirm.php" method='post'>
      <label class='confirm-tel-label' for="confirmTels">Confirm email code<input id="confirmTel" name="confirmTel"
          placeholder="Please confirm your mail code" type="text"></label>
      <input name='id' type="hidden" value=<?=$_SESSION['id']?>>
      <button class="ak-wallet-number-save-btn btn-41" type="submit" name="button-set-tel">Confirm Email</button>
    </form>

    <?=$errorTel?>
  </div>
</div>