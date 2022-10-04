<?php
session_start();
require_once '../connect.php'; 



if(isset($_POST["prihlasit"])){ 
    $email = $_POST['id'];
    $heslo = $_POST['psswd'];

      //antispam (2)
      if(isset($_POST["password"])){
        sleep(20);
        header("../location:index.php?err=405");
        exit;
      }

      //anti-spam
      $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
      $recaptcha_secret = '';

      try{
      if (isset($_POST['recaptcha_response'])) {
        $recaptcha_response = $_POST['recaptcha_response'];
        } else {
          
          header("../location:index.php?err=405");
          exit;
        }
        
      // Make and decode POST request:
      $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
      $recaptcha = json_decode($recaptcha);

      if(!isset($recaptcha->score)){
        header("location:../index.php?err=405");
        exit;
      }
      
      if ($recaptcha->score >= 0.5) {
        // Verified 
    } else {
        header("location:../login_formular.php?err=405");
        exit;
    }
  }catch(Exception $e){
    header("location:../index.php?err=405");
        exit;
  }

    if($email == 'admin@admin.com'){

      $sh1Heslo = sha1($heslo);

      $kontrola = $conn->query("SELECT email FROM zakaznik where email = '$email' and heslo = '$sh1Heslo' and aktivni = '9'");

      if ($kontrola->num_rows > 0) {
        while($row = $kontrola->fetch_assoc()) {
        }
        $_SESSION["sesID1"] = ".@!%admin%!@.";
        $_SESSION["sesA"] = "superuser44";
        header("location:../index.php");
        exit;
      }else{
        header("location:../login_formular.php?err=1");
        exit;
      }

    }else{

      $hesloSh1 = sha1($heslo);

    $kontrola = $conn->query("SELECT email,id,pohlave,jmeno FROM zakaznik where email = '$email' and heslo = '$hesloSh1' and aktivni = '0'"); 

    if ($kontrola->num_rows > 0) {
        while($row = $kontrola->fetch_assoc()) {
          $idZ = $row['id'];
          $jmeno = $row['jmeno'];
          $pohlave = $row['pohlave'];
        }
        $_SESSION["sesJ"] = $jmeno;
        $_SESSION["sesIDP"] = $pohlave;
        $_SESSION["sesIDZ"] = $idZ;
        $_SESSION["sesID1"] = $email;
        header("location:../index.php");
        exit;
      } else {
        header("location:../login_formular.php?err=1");
        exit;
      }
    }
}

if(isset($_POST["odlasit"])){ 
    session_unset();
    header("location:../index.php?mssg=1"); 
    exit;
}

header("location:../index.php"); 
    exit;

?>
