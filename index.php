<?php
session_start();//sessna na overeni, jestli jeste prihlasen
require_once 'connect.php';//pripojeni k databazi
$znackySelect = $conn->query("SELECT znacka_nazev FROM znacka"); //nacteni znacek
?>
<!DOCTYPE html>
<!-- hlavicka -->
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Obchod</title>
  <link rel="stylesheet" href="index_css.css">
  <link rel="stylesheet" href="select/c.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/31a5950820.js" crossorigin="anonymous"></script>
<!-- boostrap nepouzivat!! -->
<style>
/* styly se tahají z index_css.css */
</style>
</head>
<body>
<div class ="marginTop"></div>
<?php //alerty (GET from url)
  //err=405 "neco se nepovedlo, zkus to znovu"
  if(isset($_GET['uspesne'])){
              if($_GET['uspesne'] == '2'){
                ?>
                  <div class="alertDone">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Úspěšně objednáno. </strong> Až bude objednávka na cestě, budeme vás informovat e-mailem.
                  </div>
                <?php
              }else{}
            if($_GET['uspesne'] == '2x'){
              ?>
                <div class="alertDone">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  <strong>Úspěšně objednáno, ale zdá se že produkt/produkty nemáme na skladě, </strong> ihned po naskladnění Vás budeme informovat e-mailem.
                </div>
              <?php
            }
            if($_GET['uspesne'] == 'trash'){
              ?>
                <div class="alertDone">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  <strong>Košík úspěšě vyprázdněn</strong>.
                </div>
              <?php
            }
          }
            if(isset($_GET['uspesne'])){
              if($_GET['uspesne'] == '6'){
                ?>
                  <div class="alertDone">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Úspěšně zaregistrováno, </strong> pod e-mailem <?php echo $_GET['e']?>. Děkujeme za registraci <?php echo $_GET['jmeno']?>.
                  </div>
                <?php
              }
            }
             //uspesne pridano do kosiku
            if(isset($_GET['uspesne'])){
              if($_GET['uspesne'] == '3'){
                ?>
                  <div class="alertDone">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Úspěšně přidáno do košíku</strong>.
                  </div>
                <?php
              }
            }
            //neni prihlasen - odhlaseni - msg from scripts/login.php
          if(isset($_GET['mssg'])){
            if($_GET['mssg'] == '1'){
              ?>
                <div class="alertDone">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  <strong>Úspěšně odhlášeno...</strong> 
                </div>
              <?php
            }
            if($_GET['mssg'] == '1a'){
              ?>
                <div class="alertDone">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  <strong>Povedlo se.</strong> 
                </div>
              <?php
            }
            if($_GET['mssg'] == '1b'){
              $errb = $_GET['err']; 
              ?>
              <div class="alertErr">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong>err_code: </strong> <?php echo $errb;?>
              </div>
            <?php
            }
          }
           //neni prihlasen - deaktivace profilu profil/deaktivace.php
           if(isset($_GET['uspesne'])){
            if($_GET['uspesne'] == 'x'){
              ?>
                <div class="alertDone">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  <strong>Profil by úspěšně smazán.</strong> 
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
//konec alertu ?>

<div class ="flex">

<ul class="breadcrumb">
  <li style="color:red;"><i class="fa fa-home" aria-hidden="true"></i>Home</li>
  <?php if(isset($_SESSION["sesJ"])){ ?>
  <li><a href="profil/profil.php">
    <?php 
    if(isset($_SESSION["sesIDP"])){
      if($_SESSION["sesIDP"] == 'Muž'){
        echo"<i class='fa fa-male' aria-hidden='true'></i>";
      }if($_SESSION["sesIDP"] == 'Žena'){
        echo "<i class='fa fa-female' aria-hidden='true'></i>";
      }if($_SESSION["sesIDP"] == 'on'){
        echo "<i class='fa fa-user' aria-hidden='true'></i>";
      }
    }else{echo "<i class='fa fa-user' aria-hidden='true'></i>";}
    
    echo $_SESSION["sesJ"] ?></a>
  </li>
  <?php }?>
  <li><a href="#"><i class="fa fa-volume-control-phone" aria-hidden="true"></i>Kontakty</a></li>
  <li><a href="kosik-objednavka/kosik-objednavka.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i></i>Košík</a></li>
  <?php
  if(isset($_SESSION["sesIDZ"]) or isset($_SESSION["sesA"])){
    echo "<li onclick='odhlas()'><a href='#'><i class='fa fa-sign-out' aria-hidden='true'></i>Odhlásit se</a></li>";
  }else{
    ?>
    <li><a href="login_formular.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Přihlášení</a></li>
    <li><a href="registrace/registrace.php"><i class="fa fa-registered" aria-hidden="true"></i>Registrovat se</a></li>
    <?php
  }
  ?>
</ul>

  <!-- rozložení LEVO => responsivne nad galerii -->
  <div class ="left">
    <div class="prihlas">
    <?php
            if(isset($_SESSION["sesA"])){
            if($_SESSION["sesA"] != 'superuser44'){
              echo "Fatal err";
              exit;
              }
              ?>
                <form action="administrace_objednavek/administrace.php" method="post">
                  <input type="submit" name="administrace" value="ADMINISTRACE">
                </form>
              <?php
            }else{}
            ?>
      <?php
        if(isset($_SESSION["sesID1"])){//prihlasen
          ?>
          <a href="profil/profil.php" class="prihlasTxt"><p class="prihlasen" style="color:green;text-align:center;width:100%;">Přihlášen.<br><?php echo $_SESSION["sesID1"]; ?><p></a>
            <!-- ! sign out call by script !! -->
            <form style="display:none;" id="odhlasit" action="scripts/login.php" method="post">
            <input type='text' name='odlasit' class='hide' value='odlasit'>
              <!-- rtlacitko na odhlaseni scripts/login.php "odhlasit" -->
              <input type="submit" name="" value="Odhlásit se">
            </form> 
          <?php
        }else{
          ?><!-- Prihlaseni = uzivatel neprihlasen, jinak se nezobrazuje -->
              <!--<form action="scripts/login.php" method="post">
                <p style="margin:2px;">Email:</p>
                <input type="email" id="" name="id" required><br>
                <p style="margin:2px;">Heslo:</p>
                <input type="password" id="" name="psswd" required ><br><br>
                <input type="submit" name="prihlasit" value="Prihlasit se" desabled>
          </form>-->
            <!-- Tlacitko na registraci registrace/registrace.php -->
            <div style="text-align:center;">
            <p>Nemáte ještě účet?</p>
            
            <button style="margin:20px;" class="reg" onclick="document.location='registrace/registrace.php'">Zaregistrovat se</button>
        </div>
              <?php
        }
        ?>
      </div>
      <!-- Nakupni kosik... -->
      <p style="text-align: center;">Nákupní košík</p>
      <p style="text-align: center;">-</p>

      <?php
        if(isset($_SESSION["sesIDZ"])){//prihlasen
          
          $idZakaznik = $_SESSION["sesIDZ"];
          $selectosik = $conn->query("SELECT kosik.id,bota_id,počet,velikost,obrazek,nazev,Cena FROM kosik inner join bota on kosik.bota_id = bota.id where zakaznik_id = $idZakaznik"); //nacteni kosiku

          if ($selectosik->num_rows > 0) {
            while($row = $selectosik->fetch_assoc()) {

              $pocetKusu = $row['počet'];
              $velikost = $row['velikost'];
              $idKosiku = $row['id'];
              $img = $row['obrazek'];
              $nazev = $row['nazev'];
              $cena = $row['Cena'];

              ?>
              <div class="gallery galleryLeft" style="" id ="<?php echo $idKosiku;?>">
                  <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($img); //konvert obrazku z databaze ?>" width="600" height="400">
                <div class="desc"><p><?php echo $nazev;?></p><p><?php echo $pocetKusu;?> <?php echo $velikost;?>EU</p><p><?php echo $cena;?></p>
                
              <form action="scripts/smazat_polozku.php" method="post">
                <input type='text' name='smazat_polozku' class='hide' value='<?php echo $idKosiku;?>'>
                <input class="smazat" style="" type="submit" name="submit" value="X">
              </form>
              </div>
            </div>
            <?php
            }
          }else{
            ?>
            <p style="text-align:center;">Zatím tu jest prázdno...<br><br>něco si vyberte<br><br><i class="fa fa-arrow-right" aria-hidden="true"></i></p>
          <?php
          }
        }else{
          ?>
            <p class="txtCenter"> Nejdříve se přihlašte...</p>
          <?php
        }
          ?>

  </div>
  
    <!-- rozložení PRAVO -->
    <div class ="right">
      <div class="filter">
        <!-- Filter ZNACKY - load z databaze + js script podle tříd třídí... -->
        <!-- zaškrtnutí "Skladem" odstrani ty co nejsou skladem, po odškrtnutí načte znova stránku... -->
        <div style="margin-left:7px;margin-right:7px;">
        <form id ="rad" action="">
                        <div onclick="razeni()" class="custom-select1" id="" style=" margin: auto;">
                        <select name ="razeni">
                            <option value="0"><?php
                                if(isset($_GET['razeni'])){
                                  if($_GET['razeni'] == '1'){
                                    echo "Nejdražší";
                                  } if($_GET['razeni'] == '2'){
                                    echo "Nejlevnější";
                                  }if($_GET['razeni'] == '3'){
                                    echo "od A do Z";
                                  }if($_GET['razeni'] == '0'){
                                    echo "Nejnovější";
                                  }
                                }else{echo "Nejnovější";}?>
                                </option>
                            <option value="0">Nejnovější</option>
                            <option value="1">Nejdražší</option>
                            <option value="2">Nejlevnější</option>
                            <option value="3">od A do Z</option>
                        </select>
                        </div>
                        <input style="display:none;margin:auto;" id="" type='submit' name='zmen' value='Ulozit'> 
                    </form>
      </div>
      <label class="containerchckBox">Skladem
        <input id="jeSkladem"type="checkbox" onclick="myFunctionBox()">
        <span class="checkmarkBox"></span>
      </label>
      <label class="containerchckBox" id="ceckBoxFiler">Filtr značek
        <input id="filterCheck" type="checkbox" onclick="myFunctionFilter()">
        <span class="checkmarkBox"></span>
      </label>
      <label class="container">Vse 
        <input type="radio" name="znacky" checked="checked" value="vse" onclick="myFunction(this.value)">
        <span class="checkmark"></span>
      </label><br class="filter-content">
      <?php if($znackySelect->num_rows > 0){ ?>
        <!-- rNacita z databaze znacky, select je nahoře u hlavičky html --> 
            <?php while($row = $znackySelect->fetch_assoc()){ ?> 
              <div class="podFiltr"><label class="container"><?php echo $row['znacka_nazev']?><input type="radio" name="znacky" value="<?php echo $row['znacka_nazev']?>" onclick="myFunction(this.value)"><span class="checkmark"></span></label><br class="filter-content"></div>
            <?php 
            } ?> 
    <?php }else{ ?> 
      <!-- Nejsou značky v databazi-->
        <p class="status error"></p> 
    <?php } ?>
              
  </div>
  <!-- 
  MAIN - BOTY 
  -->
  <div class="flex" id="loadjs">
    <!-- Nacitani boty z databaze -->
  <?php
  $orderBy = 'bota.id desc';
  if(isset($_GET['razeni'])){
    if($_GET['razeni'] == '1'){
      $orderBy = 'Cena desc';
    } if($_GET['razeni'] == '2'){
      $orderBy = 'Cena';
    }if($_GET['razeni'] == '3'){
      $orderBy = 'nazev';
    }
  }
    $selectMAIN = $conn->query("SELECT bota.id,obrazek,nazev,Cena,o_bote,znacka_nazev FROM bota inner join znacka on znacka_id = znacka.id order by $orderBy/*full outer join velikost_pocet where id_bota = bota.id group by bota.id*/"); 
  ?>
  <?php if($selectMAIN->num_rows > 0){ ?> 
    <?php while($row = $selectMAIN->fetch_assoc()){ 
      $znacka = $row['znacka_nazev'];
      $img = $row['obrazek'];
      $nazev = $row['nazev'];
      $cena = $row['Cena'];
      $botaTXT = $row['o_bote'];
      $idBota = $row['id'];
    ?> 
    <?php 
      $x = $row['id'];
      $kusovka = "";
      //počítání kusů dané boty na skladě
      $sql = "SELECT SUM(pocet_ks) FROM velikost_pocet where id_bota='$x'"; 
      $result = $conn->query($sql);
      //display data on web page
      while($row = mysqli_fetch_array($result)){
        if($row['SUM(pocet_ks)'] == ""){
          $kusovka = "0";
      }else{
          $kusovka = $row['SUM(pocet_ks)'];//nacteni poctu kusu do promene
        }
      }
      ?>
      <!-- Main kontent - boty - nacitani z databaze -->
      <!-- Alt = informace, ktere se pomoci js zobrazi po kliknuti na produkt -->
      <div class="gallery <?php echo $znacka;?> <?php echo $kusovka;?>">
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($img); //konvert obrazku z databaze ?>"
        alt="<div style='text-align:center'><p><?php echo $znacka; //class = znacka(na vyhledavani) ?></p><p><?php echo $nazev; ?></p><p>Cena: <?php echo $cena; ?>kč</p><br> 
        <?php //pokud je prihlasen admin, zmeni se form pro smazani velikosti/kusu_celkem
          if(isset($_SESSION["sesA"])){
            if($_SESSION["sesA"] == 'superuser44'){
              ?>
                <form action='scripts/smazat_velikost.php'> 
              <?php
            }
          }else{
            ?>
                <form action='scripts/do_kosiku.php' method='post'> 
            <?php
          }
        ?>
        <div class='custom-select' style='width:200px;margin:auto; text-align:center;'><select name='vybranaVelikost'><option value='0'>Vyber velikost:</option>
        <?php /* nacitani velikosti a kusu danou velikosti, ulozi se do selectu z databaze */ 
        $vyberVelikosti = $conn->query("SELECT id,velikost,pocet_ks,blokovano FROM velikost_pocet where id_bota = $idBota");  
        
        ?>
          <?php if($vyberVelikosti->num_rows > 0){ 
            ?> 
          <?php while($row = $vyberVelikosti->fetch_assoc()){  
            $velikost = $row['velikost'];
            $pocet_ks = $row['pocet_ks'];
            $idvelikosti = $row['id'];
            $blokovano = $row['blokovano'];

            $txtBlokovano = "";
            
            if($pocet_ks == "null"){
              ?>
              <option value='<?php echo $velikost;?>'>není skladem</option>
              <?php
          }else{
            ?>
            <option value='
            <?php 
            if(isset($_SESSION["sesA"])){
              if($_SESSION["sesA"] == 'superuser44'){
                $txtBlokovano = " blokovano: ".$blokovano;
                echo $idvelikosti;
              }else{
                exit; 
              }
            }else{
              echo $velikost;
            }
            ?>
            '><?php echo $velikost;?> EU - skladem <?php echo $pocet_ks;?>ks<?php echo $txtBlokovano;?></option>
            <?php
            }
          ?>
          <?php 
          } ?> 
          <?php }else{ //neni skladem ?> 
            <option value=''>není skladem</option>
          <?php 
          }
          ?>
          </select><input type='text' name='id' class='hide' value='<?php echo $idBota;?>'></div>
          <p>Pocet kusu: </p> 
          <?php
          if(isset($_SESSION["sesA"])){
            if($_SESSION["sesA"] == 'superuser44'){
              ?>
                <input type='submit' name='smazat' value='smazat'> 
              <?php
            }
          }else{
            ?>
            <?php
            if(isset($_SESSION["sesIDZ"])){
              ?>
                <input type='number' id='quantity' name='pocet' value='1' min='1' max='5'<?php // echo $kusovka;?>><input type='submit' name='pridat' value='Do košíku'> 
              <?php
              }else{
                ?>
                <div class='tooltip'><i class='fa fa-shopping-basket' aria-hidden='true'></i><span class='tooltiptext'>Nejprve se přihlašte.</span></div>
                <?php
 
              }
            ?>
            
            <?php
          }
        ?>
          
        </form> <p><?php echo $botaTXT;?></p> </div>" class="click">
    
    <div class="desc"><p><?php echo $znacka;?><br> <?php echo $nazev; ?></p><p>Cena: <?php echo $cena; ?>kč</p>
    <input type="text" class="pocetSklad" value="<?php echo $kusovka;?>"><p class="pocetSkladBarva"></p>
    </div>
            <!-- administrace boty -->
            <?php
              if(isset($_SESSION["sesA"])){
                if($_SESSION["sesA"] == 'superuser44'){

                  ?>
                
    <div class="admin">
      <div class="administrace">
        <hr>
        <form action="scripts/zapsatKSCena.php" method="post" enctype="multipart/form-data">
          <input type="text" name="id" class="hide" value="<?php echo $idBota;?>" >
          Pocet kusu: <input type="number" id="quantity" name="kusu" min="1" max="1000"><br>
          Velikost (EU) <input type="number" id="quantity" name="velikost" min="1" max="55" step=".1"><br>
          <input type="submit" name="tst" value="Upload">
        </form>
      <hr>
      <form action="scripts/smazat_produkt.php" method="post" enctype="multipart/form-data">
          <input type="text" name="id" class="hide" value="<?php echo $idBota;?>" >
          <input type="submit" name="smazat_produkt" value="Smazat produkt">
        </form>
      <hr>
      </div>
    </div>
      <?php
        }
      }
      ?>
    </div>

  <?php
          } ?> 
  <?php }else{ ?> 
      <p class="status error">Zatím žádné boty...</p> 
  <?php } ?>

  <?php
              if(isset($_SESSION["sesA"])){
                if($_SESSION["sesA"] == 'superuser44'){

                  ?>

  <div class="gallery">
  <form action="uploadBota.php" method="post" enctype="multipart/form-data">
    Select image to upload:<input type="file" name="image" id="image"><br>
    Název: <input type="text" name="nazev"><br>
    Cena: <input type="number" id="quantity" name="cena" min="1" max="1000000"><br>
    O botě:<textarea id="" name="info" rows="4" cols="24"></textarea><br>

    <div style="width:200px;margin:auto; text-align:center;"><select name="znackaVOL"><option value="0">Vyber znacku:</option>
  <?php $znackySelect2 = $conn->query("SELECT id,znacka_nazev FROM znacka");  ?>
  <?php if($znackySelect2->num_rows > 0){ ?> 
          <?php while($row = $znackySelect2->fetch_assoc()){ ?> 
            <option value="<?php echo $row['id']?>"><?php echo $row['znacka_nazev']?></option>
          <?php 
          } ?> 
  <?php }else{ ?> 
      <p class="status error">Nejdřív vytvoř značku...</p> 
  <?php } ?>
  </select>
  </div>
    <input type="submit" name="submit" value="Upload">
  </form><br><br>
  </div>

  <div class="gallery">
  <form action="scripts/vytvotitZnacku.php" method="post" enctype="multipart/form-data">

  Název značky: <input type="text" name="nazev" required><br>

    <input type="submit" name="nahratZnacku" value="nahrat novou znacku">
  </form><br><br>
  </div>

  <?php
        }
          }
      ?>

  <?php



  ?>



  </div>
  </div>
  </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal" style="z-index:111;">
  <span class="close">&times;</span>
  <div class="flex">
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
<p id="txtFoto"><i class="fab fa-instagram"style="width:35px;height:35px;font-size:22px;color:white;"></i> <i class="fab fa-facebook-f"style="width:35px;height:35px;font-size:22px;color:white;"></i><i class="fab fa-youtube"style="height:35px;font-size:22px;color:white;"></i> </p>
</div>

<script>



/*
function myFunction() {
var zaskrtnutoPocet = document.getElementsByClassName("znacky").length;
for(var i = 0;i < zaskrtnutoPocet;i ++){
var zaskrtnuto = document.getElementsByClassName("znacky")[i].value;
}


  var znackos = document.getElementsByClassName("gallery");
console.log(znackos.length);
console.log(zaskrtnuto);
}*/

</script>

<script src="select/c1.js" defer></script>
<script src="index_js.js" defer></script>
<script src="select/c.js" defer></script>

</body>
</html>
