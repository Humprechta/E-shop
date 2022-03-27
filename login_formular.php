<?php

session_start();
require_once 'connect.php'; 

if(isset($_SESSION["sesIDZ"])){
    //prihlasen
    header("location:index.php");
    exit;
}else{
        ?>  <head>
            <!-- neni prihlasen -->
            <!-- css vyuziva z profilu!! -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://kit.fontawesome.com/31a5950820.js" crossorigin="anonymous"></script>
            <script src="https://www.google.com/recaptcha/api.js?render=6Ldek70eAAAAAPvPhzMQKcOopMo3ae-6TWb6KP0p"></script>
            <script>
                grecaptcha.ready(() => {
                    grecaptcha.execute('6Ldek70eAAAAAPvPhzMQKcOopMo3ae-6TWb6KP0p', { action: 'validate_captcha' }).then(token => {
                    document.querySelector('#recaptchaResponse').value = token;
                    document.getElementById("cas").disabled = false;
                    });
                });
            </script>
            <style>
            <?php include 'profil/css.css'; ?>
            body{
                /*background-color: #DCDCDC;*/
            }
            .marginTop{
                margin: 20px !important;
                }
                @media only screen and (max-width: 600px) {
                .marginTop{
                    margin: 40px !important;
                }
                }
            </style>
            </head>
            <div class ="marginTop"></div>
            <?php
            if(isset($_GET['err'])){
            if($_GET['err'] == '1'){
            ?>
              <div class="alertErr">
                <!-- err spatnej login, msg from scripts/login.php -->
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong>Špatné přihlašovací údaje,</strong> zkus to znovu.
              </div>
            <?php
                }
            }
            //err=405 "neco se nepovedlo, zkus to znovu"
          if(isset($_GET['err'])){
            if($_GET['err'] == '405'){
            ?>
              <div class="alertErr">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong>Něco se nepovedlo</strong>, zkus to znovu.
              </div>
            <?php
        }
      }
            ?>
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                <li style="color:red;"><i class="fa fa-sign-in" aria-hidden="true"></i>Přihlášení</li>
                    <li><a href="registrace/registrace.php"><i class="fa fa-registered" aria-hidden="true"></i>Registrovat se</a></li>
            </ul>
            <div class="log-form">
            <h2>Přihlášení</h2>
            <form  action="scripts/login.php" method="post">
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                <input type="email" title="username" placeholder="email" name="id">
                <input style="display:none;" type="checkbox" id="password" name="password" value="password">
                <input type="password" title="username" placeholder="heslo" name="psswd">
                <input type="hidden" name="action" value="validate_captcha">
                <input type="submit" name="prihlasit" value="Prihlasit se" id ="cas" disabled>
            </form>
            </div>
            
        <?php
    }
?>