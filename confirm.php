<?php
include 'app/include/header.php'; 
include "app/controllers/users.php";

session_start();
?>
<div class='confirm-tel-active'>
  <div class='confirm-tel-info'>
    <h2 class='confirm-tel-text'>An SMS has been sent to your phone, please confirm it</h2>
    <form action="confirm.php" method='post'>
      <label class='confirm-tel-label' for="confirmTels">Confirm telephone number<input id="confirmTel"
          name="confirmTel" placeholder="Please confirm your telephone" type="text"></label>
      <input name='id' type="hidden" value=<?=$_SESSION['id']?>>
      <button class="ak-wallet-number-save-btn btn-41" type="submit" name="button-set-tel">Confirm Telephone</button>
    </form>

    <?=$errorTel?>
  </div>
</div>