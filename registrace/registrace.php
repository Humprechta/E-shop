<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/31a5950820.js" crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js?render=6Ldek70eAAAAAPvPhzMQKcOopMo3ae-6TWb6KP0p"></script>
    <script>
        grecaptcha.ready(() => {
            grecaptcha.execute('6Ldek70eAAAAAPvPhzMQKcOopMo3ae-6TWb6KP0p', { action: 'submit' }).then(token => {
              document.querySelector('#recaptchaResponse').value = token;
            });
        });
    </script>

<style>
* {
  padding: 3px;
  box-sizing: border-box;
}
/* topnav */
ul.breadcrumb {
  left:0;
  z-index: 10;
  margin: auto;
  padding: 13px 30px;
  width: 100%;
  list-style: none;
  background-color: #eee;
  position: fixed;
  top: 0;
}
ul.breadcrumb li {
  display: inline;
  font-size: 18px;
}
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: "/\00a0";
}
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}
.marginTop{
  margin: 25px;
}
@media only screen and (max-width: 600px) {
  .marginTop{
    margin: 35px;
  }
  }
#loading{
 display: none;
}

input[type=text], input[type=password], input[type=email] {
  width: 100%;
  padding: 12px;
  border:none;
  border-bottom: 3px solid DodgerBlue;
  resize: vertical;
}
input[type=text]:hover, input[type=password]:hover, input[type=email]:hover {
  border-bottom: 3px solid DeepSkyBlue;
}
input[type=text]:focus, input[type=password]:focus, input[type=email]:focus {
  border: none;
border-style: none;
  border-bottom: 3px solid DeepSkyBlue;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: DeepSkyBlue;
}

.container {
    margin: auto;
  border-radius: 7px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
  .container {
    padding: 5px;
    margin: 0px;
}
}

/* css RADIO */
.containerR {
  margin: 10px;
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.containerR input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: rgba(128, 128, 128, 0.4);
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.containerR:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.containerR input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.containerR input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.containerR .checkmark:after {
 	top: 7px;
	left: 7px;
	width: 6px;
	height: 6px;
	border-radius: 50%;
	background: white;
}
@media screen and (max-width: 600px) {
  .containerR {
  margin: 5px;
  padding: 5px;
  padding-left: 23px;
}
}
input:invalid:focus {
  background-image: linear-gradient(to right, rgba(255,0,0,0.1), rgba(255,0,0,0.1));
}
</style>
</head>
<body>
<div class ="marginTop"></div>
<ul class="breadcrumb">
  <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
  <?php
  if(isset($_SESSION["sesIDZ"]) or isset($_SESSION["sesA"])){
    echo "<li onclick='odhlas()'><a href='#'><i class='fa fa-sign-out' aria-hidden='true'></i>Odhlásit se</a></li>";
  }else{
    ?>
    <li><a href="../login_formular.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Přihlášení</a></li>
    <li style="color:red;"><i class="fa fa-registered" aria-hidden="true"></i>Registrovat se</li>
    <?php
  }
  ?>
</ul>
<?php
if(isset($_GET['err'])){
  if($_GET['err'] == 'err1' ){
  ?>
  <div class="alert alert-warning">
    <strong>Upozornění!</strong> Hesla se neshodují...
  </div>
  <?php
  }
}
if(isset($_GET['err'])){
  if($_GET['err'] == '666' ){
  ?>
  <div class="alert alert-danger">
    <strong>Auva,</strong> Něco se nepovedlo :(
  </div>
  <?php
  }
}
if(isset($_GET['Fatall'])){
  if($_GET['Fatall'] == 'err' ){
  ?>
  <div class="alert alert-danger">
    <strong>Upozornění!</strong> Něco se nepovedlo, usilovně pracujeme na opravení problému...
  </div>
  <?php
  }
}
if(isset($_GET['err'])){
  if($_GET['err'] == 'err2' ){
  ?>
  <div class="alert alert-warning">
    <strong>Upozornění!</strong> Email se již používá, prosím přihlaste se...
  </div>
  <?php
  }
}
?>
<div class="container">
  <form action="insert.php" method="post">
  <div class="row">
    <div class="col-25">
      <label for="fname">Jméno</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="firstname" placeholder="Vaše jméno..." required minlength="2" maxlength="20" value="<?php if(isset($_GET['jmeno'])){echo $_GET['jmeno'];}?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname">Přijmení</label>
    </div>
    <div class="col-75">
      <input type="text" id="lname" name="lastname" placeholder="Vaše Přijmení..." required minlength="2" maxlength="20" value="<?php if(isset($_GET['prijmeni'])){echo $_GET['prijmeni'];}?>">
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="lname">Pohlaví: </label>
    </div>
    <div class="col-75">
        <div style="display:flex">
        <label class="containerR">Nechci uvádět
            <input type="radio" <?php if(isset($_GET['pohlave'])){
              if($_GET['pohlave'] == 'on'){
                echo "checked";
              }
            }else{
              echo "checked";
            }?> name="radio" vaue="00">
            <span class="checkmark"></span>
          </label>
          <label class="containerR">Muž
            <input type="radio" name="radio" <?php if(isset($_GET['pohlave'])){
              if($_GET['pohlave'] == 'Muž'){
                echo "checked";
              }
            }?> value="Muž">
            <span class="checkmark"></span>
          </label>
          <label class="containerR">Žena
            <input type="radio" name="radio" <?php if(isset($_GET['pohlave'])){
              if($_GET['pohlave'] == 'Žena'){
                echo "checked";
              }
            }?> value="Žena">
            <span class="checkmark"></span>
          </label>
        </div>
    </div>
  </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Vaše adresa</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="adress" placeholder="město/ulice/číslo popisné, PSČ" required minlength="5" maxlength="99" value="<?php if(isset($_GET['adress'])){echo $_GET['adress'];}?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Telefonní číslo</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="tel" placeholder="bez předčísla..." required minlength="9" maxlength="9" value="<?php if(isset($_GET['tel'])){echo $_GET['tel'];}?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Kontaktní email</label>
      </div>
      <div class="col-75">
        <input type="email" id="lname" name="email" placeholder="Váš email..." required minlength="3" maxlength="40" value="<?php if(isset($_GET['e'])){echo $_GET['e'];}?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Heslo</label>
      </div>
      <div class="col-25">
        <input type="password" id="lname" name="psswd" placeholder="Vaše heslo..." required minlength="4" maxlength="40">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Heslo pro kontrolu</label>
      </div>
      <div class="col-25">
        <input type="password" id="lname" name="psswd1" placeholder="Vaše heslo..." required minlength="4" maxlength="40">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="lname">Země: </label>
      </div>
      <div class="col-75">
          <div style="display:flex">
          <label class="containerR">CZ
              <input type="radio" <?php if(isset($_GET['z'])){
              if($_GET['z'] == 'CZ'){
                echo "checked";
              }
            }else{
              echo "checked";
            }?> name="radio1" value="CZ"> 
              <span class="checkmark"></span>
            </label>
            <label class="containerR">SK
              <input type="radio" name="radio1" <?php if(isset($_GET['z'])){
              if($_GET['z'] == 'SK'){
                echo "checked";
              }
            } ?> value="SK">
              <span class="checkmark"></span>
            </label>
          </div>
      </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" name="posli" value="Zaregistrovat se" onclick="posilam()">
  </div>
  <div style="text-align: center;" id="loading">
  <div  class="spinner-grow text-dark"></div>
  </div>
  <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
  </form>
</div>

<script>
function posilam() {
  var x = document.getElementById("loading");
    x.style.display = "block";
}
</script>


<?php


?>

</body>
</html>
