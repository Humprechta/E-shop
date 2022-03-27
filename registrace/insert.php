<?php

require_once '../connect.php'; 

if (isset($_POST['posli']) == true){ 

  try{

  //anti-spam
  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6Ldek70eAAAAAMV82dYqzIW56rkLBmTeOvud9p_o';
    $recaptcha_response = $_POST['recaptcha_response'];

    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    // Take action based on the score returned:
    
  $psswd1 = $_POST['psswd'];
  $psswd2 =  $_POST['psswd1'];
  $prijmeni =  $_POST['lastname'];
  $jmeno =  $_POST['firstname'];
  $pohlave =  $_POST['radio'];
  $adress =  $_POST['adress'];
  $tel =  $_POST['tel'];
  $e =  $_POST['email'];
  $z =  $_POST['radio1'];

  if(!isset($recaptcha->score)){
    header("location:../index.php?err=405");
    exit;
  }

  if ($recaptcha->score >= 0.5) {
    // Verified 
} else {
    // Not verified 
    header("location:registrace.php?err=666&jmeno=$jmeno&prijmeni=$prijmeni&pohlave=$pohlave&adress=$adress&tel=$tel&e=$e&z=$z");
    exit;
}
}catch(Exception $e){
  header("location:../index.php?err=405");
      exit;
}

  if($psswd1 == $psswd2){

    $kontrolaEmail = $conn->query("SELECT email FROM zakaznik where email = '$e'"); 

    if ($kontrolaEmail->num_rows > 0) {
      // output data of each row
      while($row = $kontrolaEmail->fetch_assoc()) {
        //email jiz existuje
        header("location:registrace.php?err=err2&jmeno=$jmeno&prijmeni=$prijmeni&pohlave=$pohlave&adress=$adress&tel=$tel&e=$e&z=$z");
        exit;
      }
    } else {
    }
    $sh1 = sha1($psswd1);
    $sql = "insert into zakaznik (jmeno,prijmeni,email,heslo,adresa,tel,zem,pohlave,aktivni) 
    values('$jmeno','$prijmeni','$e','$sh1','$adress','$tel','$z','$pohlave','0')";

            if ($conn->query($sql) === TRUE) {
              //vse ok.
              header("location:../index.php?uspesne=6&e=$e&jmeno=$jmeno"); 
            }else{ header("location:registrace.php?Fatall=err2&jmeno=$jmeno&prijmeni=$prijmeni&pohlave=$pohlave&adress=$adress&tel=$tel&e=$e&z=$z");}
            exit;
  }else{
    header("location:registrace.php?err=err1&jmeno=$jmeno&prijmeni=$prijmeni&pohlave=$pohlave&adress=$adress&tel=$tel&e=$e&z=$z");
    exit;
  }
} 