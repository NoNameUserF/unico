<?php 
  include('app/database/db.php');

  $users = selectAll('users');
  $errorMsg = '';
  $errorTel = '';
  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) { 

    $firstName = trim($_POST['firstname']);
    $secondsName = trim($_POST['secondname']);
    
    $email = trim($_POST['email']);
    $tel = trim($_POST['tel']);
    $passwordF =  $_POST["password"] ;
    $passwordS =  $_POST["passwordconfirm"];
    
    $admin = 0 ;
  
    if($firstName ==='' || $secondsName === '' || $tel === '' ||  $passwordF === '' || $passwordS === '' || $email === '') { 
      $errorMsg = 'You have not filled in all the fields';
    
    
    }elseif (mb_strlen($firstName , 'UTF8') <=2 ) { 
      $errorMsg = 'Login length must be more than 2 symblos';
    }elseif ($passwordF !== $passwordS) { 
      $errorMsg = 'Passwords are not equal';
    }       
    else {  

      $existence = selectOne('users' , ['email' => $email]); 
      
      
      if($existence['email'] === $email  )  {
        
         $errorMsg = 'This email is already used';
         
      }
      if($existence['tel'] === $tel  )  {
        
        $errorMsg = 'This phone number is already used';
        
     }
      else { 
        $passwordS = password_hash($passwordS , PASSWORD_DEFAULT);
        $post = [ 
          'admin' => $admin , 
          'first_name' => $firstName , 
          'second_name' => $secondsName , 
          'email' => $email , 
          'password' => $passwordS , 
          'phone' =>$tel,
          'conf' => 0,
          'confirm_tel' => '-',
          'admin_tel' => 0,
          'changing_data' => 0	
          
        ];
      
        $id = insert('users',$post);
        
      
        $user = selectOne('users', ['id' => $id]);


        $_SESSION['id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['second_name'] = $user['second_name'];
        $_SESSION['admin'] = $user['admin'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['balance'] = $user['balance'];
        $_SESSION['conf'] = $existence['conf'];
        $_SESSION['wallet'] = $user['wallet'];
        $_SESSION['amount'] = $user['amount'];
        $_SESSION['corp_wallet'] = $user['corp_wallet'];
        $_SESSION['verification'] = 0;
        $_SESSION['confirm_tel'] = $existence['confirm_tel'];
        $_SESSION['changing_data'] = $existence['changing_data'];
        header('location: ' . 'confirm.php' );
        
      }
     
    
    }
  


  }else{ 
    $firstName = ''; 
    $secondsName = ''; 
    
    
  }

  
  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {

    $email = trim($_POST['email']);
    $pass = trim($_POST["pass"]);      
    
    
    
    if($_SESSION['confirm_tel'] =='-') {
      
      header('location:' . 'confirm.php');
      $existence = selectOne('users' , ['email' => $email]);  
      $_SESSION['id'] = $existence['id'];
      $_SESSION['first_name'] = $existence['first_name'];
      $_SESSION['second_name'] = $existence['second_name'];
      $_SESSION['email'] = $existence['email'];
      $_SESSION['admin'] = $existence['admin'];
      $_SESSION['balance'] = $existence['balance'];
      $_SESSION['conf'] = $existence['conf'];
      $_SESSION['wallet'] = $existence['wallet'];
      $_SESSION['amount'] = $existence['amount'];
      $_SESSION['corp_wallet'] = $existence['corp_wallet'];
      $_SESSION['confirm_tel'] = '-';
      $_SESSION['changing_data'] = $existence['changing_data'];
      header('location:' . 'confirm.php');
      
    }else {
      if($email == '' || $pass == '') { 

        $errorMsg = 'Not filled all fields';
      }else { 
        
        $existence = selectOne('users' , ['email' => $email]);  
          
          if($existence && password_verify($pass , $existence['password']) ) { 
                
            $_SESSION['id'] = $existence['id'];
            $_SESSION['first_name'] = $existence['first_name'];
            $_SESSION['second_name'] = $existence['second_name'];
            $_SESSION['email'] = $existence['email'];
            $_SESSION['admin'] = $existence['admin'];
            $_SESSION['balance'] = $existence['balance'];
            $_SESSION['conf'] = $existence['conf'];
            $_SESSION['wallet'] = $existence['wallet'];
            $_SESSION['amount'] = $existence['amount'];
            $_SESSION['corp_wallet'] = $existence['corp_wallet'];
            $_SESSION['confirm_tel'] = $existence['confirm_tel'];
            $_SESSION['changing_data'] = $existence['changing_data'];
            header('location: ' . 'lk-user.php');
          
          }elseif (!password_verify($pass , $existence['password'])) { 
            $errorMsg = 'Wrong password';
          }
          
          else {
            'Wwwwwwroooooong';
          }
      }
  
    }
   }
  
  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-set-tel'])) {

    $tel = trim($_POST['confirmTel']);
    $id = $_POST['id'];
    $post = [ 
      'confirm_tel' => $tel,
    ];
  
    update('users', $id, $post);
    
    $user = selectOne('users', ['id' => $id]);
    if(strlen($tel) < 2) { 
      $errorTel = "Incorrect password ";
    }
    if($user['admin_tel'] == $user['confirm_tel']) {
      header('location: lk-user.php');
      $errorTel = '';
    }else {
      $errorTel = "Incorrect password ";
    }

   }

?>