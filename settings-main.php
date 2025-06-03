<?php
include "app/controllers/passport.php";
require_once 'app/include/header.php'; 

require_once "app/database/db.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$user = selectOne('users', ['id' => $_SESSION['id']]);
?>
<section class="lk-user-main">
  <div class="container">

    <div class="left-col">
      <?php require_once 'inc/lk/left-menu.php'; ?>
      <div class="calendar-wrapper">
        <button id="btnPrev" type="button"><img src="assets/img/calendar-left.svg" alt="prev"></button>
        <button id="btnNext" type="button"><img src="assets/img/calendar-right.svg" alt="next"></button>
        <div id="divCal"></div>
      </div>
    </div>

    <div class="right-col">
      <div class="widgets">
        <span>место для виджетов</span>
      </div>
      <h1 class="settings-title">Settings</h1>
      <div class="settings-container">
        <div class="personal-info-wrapper">
          <h2>Personal info</h2>
          <form action="settings-main.php" method="post" class="personal-info">
            <input name='id' type="hidden" value=<?=$user['id']?>>
            <label>First name
              <input name="newName" placeholder="Jon" type="text">
            </label>
            <label>Second name
              <input name="newFam" placeholder="Michael" type="text">
            </label>
            <label>Email
              <input name="newEmail" placeholder="JonMichael@gmail.com" type="email">
            </label>
            <label>Phone
              <input name="newPhone" class="num-only" placeholder="010-534-757-87" type="tel"></label>
            <button class="btn-41" name="editBtn" type="submit">Edit</button>
          </form>
        </div>
        <div class="password">
          <h2>Password</h2>
          <form action="#" class="password-change">
            <label>Password<input placeholder="********" type="password"></label>
            <input class="btn-41" value="Change" type="submit">
          </form>
        </div>
        <?php 
                        if (count($passports) == 0){
                            ?>
        <div class="passport-verification not-verified">
          <span class="passport-status">Document for review</span>
          <h2>Passport</h2>
          <form enctype='multipart/form-data' action="settings-main.php" method="post"
            class="passport-verification-form">
            <label>First name<input name="first_name" placeholder="Jon" type="text"></label>
            <label>Second name<input name="second_name" placeholder="Michael" type="text"></label>
            <label>Passport Book Number<input name="number" placeholder="********" type="text"></label>
            <div class="input__wrapper">
              <input name="file" type="file" id="input__file" class="input input__file" multiple>
              <label for="input__file" class="input__file-button">
                <span class="input__file-icon-wrapper"><img class="input__file-icon" src="assets/img/paper-clip.svg"
                    alt=""></span>
                <span class="input__file-button-text">Verification</span>
              </label>
            </div>
            <button class="input__file-button" name="button-download" value="Submit" type="submit">SUBMIT</button>
          </form>
        </div>
        <?php
                        } else {
                            for($i = 0; $i < count($passports); $i++){
                                
                                if(($passports[$i]['id_user'] == $_SESSION['id'])){
                                    $loading = 0;
                                    break; 
                                } else {
                                    $loading = 1;

                                }
                            
                            }
                            }
                            
                            if($loading){
                                ?>
        <div class="passport-verification not-verified">
          <span class="passport-status">Document for review</span>
          <h2>Passport</h2>
          <form enctype='multipart/form-data' action="settings-main.php" method="post"
            class="passport-verification-form">
            <label>First name<input name="first_name" placeholder="Jon" type="text"></label>
            <label>Second name<input name="second_name" placeholder="Michael" type="text"></label>
            <label>Passport Book Number<input name="number" placeholder="********" type="text"></label>
            <div class="input__wrapper">
              <input name="file" accept='.pdf' type="file" id="input__file" class="input input__file" multiple>
              <label for="input__file" class="input__file-button">
                <span class="input__file-icon-wrapper"><img class="input__file-icon" src="assets/img/paper-clip.svg"
                    alt=""></span>
                <span class="input__file-button-text">Verification</span>
              </label>
            </div>
            <button class="input__file-button" name="button-download" value="Submit" type="submit">SUBMIT</button>
          </form>
        </div>
        <?php
                            }

                        ?>
        <?php
                        for($i = 0; $i < count($passports); $i++){
                            if(!$passports[$i]['verification'] && $passports[$i]['id_user'] == $_SESSION['id']){
                                ?>
        <div class="passport-verification for-view">
          <span class="passport-status">Document for review</span>
          <h2>Passport</h2>
          <form action="#" class="passport-verification-form">
            <label>First name<input readonly placeholder="<?=$passports[$i]['first_name']?>" type="text"></label>
            <label>Second name<input readonly placeholder="<?=$passports[$i]['second_name']?>" type="text"></label>
            <label>Passport Book Number<input readonly placeholder="********" type="text"></label>
          </form>
        </div>
        <?php
                                break;
                            } elseif(($passports[$i]['verification'] && $passports[$i]['id_user'] == $_SESSION['id'])) {
                                ?>
        <div class="passport-verification verified">
          <span class="passport-status">Document for review</span>
          <h2>Passport</h2>
          <form action="#" class="passport-verification-form">
            <label>First name<input readonly placeholder="<?=$passports[$i]['first_name']?>" type="text"></label>
            <label>Second name<input readonly placeholder="<?=$passports[$i]['second_name']?>" type="text"></label>
            <label>Passport Book Number<input readonly placeholder="********" type="text"></label>
          </form>
        </div>

        <?php
                                break;
                            }
                        }
                        ?>
      </div>
    </div>
  </div>
</section>
<?php require_once 'app/include/footer.php'; ?>