<?php

session_start();
require_once '../connect.php'; 

if(isset($_SESSION["sesIDZ"])){
    $idZakaznik = $_SESSION["sesIDZ"];
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/31a5950820.js" crossorigin="anonymous"></script>
    <title>Profil</title>
    <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
    <link rel="stylesheet" href="css.css">
    <style>
      .marginTop{
        margin: 25px !important;
      }
      @media only screen and (max-width: 600px) {
        .marginTop{
          margin: 28px !important;
        }
      }
      </style>
        <?php 



         $selectZ = $conn->query("SELECT jmeno,prijmeni,email,adresa,tel,zem,pohlave from zakaznik where zakaznik.id = $idZakaznik"); //nacteni kosiku
                    
         if ($selectZ->num_rows > 0) {
           while($row = $selectZ->fetch_assoc()) {

             $jmeno = $row['jmeno'];
             $prijmeni = $row['prijmeni'];
             $e = $row['email'];
             $adresa = $row['adresa'];
             $tel = $row['tel'];
             $zem = $row['zem'];
             $pohlave = $row['pohlave'];

             //echo "pocet kusu: ".$pocetKusu." velikost: ".$velikost." img zatim nic Nazev: ".$nazev." Cena: ".$cena."<br>";
            }
        }
      ?>
      <div class ="marginTop"></div>
      <?php
      if(isset($_GET['uspesne'])){
        if($_GET['uspesne'] == '4'){
          ?>
            <div class="alertDone">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
              <strong>Úspěšně aktualizováno</strong>.
            </div>
          <?php
        }
        if($_GET['uspesne'] == 'x'){
          ?>
            <div class="alertErr">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
              <strong>Objednávka zrusena.</strong>
            </div>
          <?php
        }
      }
      if(isset($_GET['err'])){
        if($_GET['uspesne'] == '405'){
          ?>
            <div class="alertDone">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
              <strong>Něco se nepovedlo</strong>, zkus to znovu.
            </div>
          <?php
        }
      }
      ?>
<ul class="breadcrumb">
  <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
  <?php if(isset($_SESSION["sesJ"])){ ?>
  <li style="color:red;">
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
    
    echo $_SESSION["sesJ"] ?>
  </li>
  <?php }?>
  <li><a href="#"><i class="fa fa-volume-control-phone" aria-hidden="true"></i>Kontakty</a></li>
  <li><a href="../kosik-objednavka/kosik-objednavka.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i></i>Košík</a></li>
  <?php
  if(isset($_SESSION["sesIDZ"]) or isset($_SESSION["sesA"])){
    echo "<li onclick='odhlas()'><a href='#'><i class='fa fa-sign-out' aria-hidden='true'></i>Odhlásit se</a></li>";
  }
  ?>
</ul>
      <div class="container">
        <p> Objednávky čekajicí na vyřízení...</p>
        <div id ="obchod">
        <a> Zatím je tu prázdno...</a> <button onclick="window.location.href='../index.php';">Zpět do obchodu</button>
        </div>
        <div class ="hide" id ="ceka">
        <div style="overflow-x: auto;">
          <table>
            <tr>
              <th>Objednávka id</th>
              <th>Nazev</th>
              <th>Počet kusů</th>
              <th>Velikost</th>
              <th>Celková cena</th>
              <th>Stav objednávky</th>
              <th>Způsob doručení</th>
              <th>Adresa</th>
              <th>telefoní číslo</th>
              <th>email</th>
              <th>Způsob platby</th>
              <th>Zrušit objednávku</th>
            </tr>

        <?php
        $select_objednavka = $conn->query("SELECT objednavka.id as idecko,adresa_doruceni,tel,predcisli,email,zpusob_doruceni,celk_cena,stav_objednavky,nazev,velikost,pocet_ks 
        from objednavka inner join objednavka_bota on id_objednavka = objednavka.id where id_zakaznik = $idZakaznik and (stav_objednavky = 1 or stav_objednavky = 2 or stav_objednavky = 3) order by idecko desc"); //nacteni kosiku
                    
         if ($select_objednavka->num_rows > 0) {
          ?>
          <script>
            document.getElementById("ceka").style.display = "block";
            document.getElementById("obchod").style.display = "none";
            </script>
        <?php
           while($row = $select_objednavka->fetch_assoc()) {

            $id = $row['idecko'];
            $predcisli = $row['predcisli'];
             $adresa_doruceni = $row['adresa_doruceni'];
             $tel = $row['tel'];
             $e = $row['email'];
             $zpusob_doruceni = $row['zpusob_doruceni'];
             $celk_cena = $row['celk_cena'];
             $stav_objednavky = $row['stav_objednavky'];
             $nazev = $row['nazev'];
             $velikost = $row['velikost'];
             $pocet_ks = $row['pocet_ks']; 
             //echo $nazev;

             ?>

             <tr>
             <td><?php echo $id;?></td>
              <td style="min-width: 160px;"><?php echo $nazev;?></td>
              <td><?php echo $pocet_ks;?></td>
              <td><?php echo $velikost;?> EU</td>
              <td><?php echo $celk_cena;?> Kč</td>
              <td style="min-width: 170px;"class ="<?php echo $stav_objednavky ;?>"><a class="txt<?php echo $stav_objednavky ;?>"></a></td>
              <td><?php echo $zpusob_doruceni;?></td>
              <td style="min-width: 160px;"><?php echo $adresa_doruceni;?></td>
              <td><?php echo $tel." (+".$predcisli.")";?></td>
              <td><?php echo $e;?></td>
              <td>Dobírkou</td>
              <td><i onclick ="zrusit(<?php echo $id;?>)" class="fa fa-times" aria-hidden="true"></i></td>
            </tr>

            <?php

             //echo "pocet kusu: ".$pocetKusu." velikost: ".$velikost." img zatim nic Nazev: ".$nazev." Cena: ".$cena."<br>";
            }
        }
        
        //vyrezene nebo zrusene objednávky ?>
        </table>
        </div>
        </div>
        </div>
        <div class="container hide" id = "done">
        <p>Vyřízené či zrušené objednávky</p>
        <div style="overflow-x: auto;">
          <table>
            <tr>
              <th>Objednávka id</th>
              <th>Nazev</th>
              <th>Počet kusů</th>
              <th>Velikost</th>
              <th>Celková cena</th>
              <th>Stav objednávky</th>
              <th>Způsob doručení</th>
              <th>Adresa</th>
              <th>Telefoní číslo</th>
              <th>E-mail</th>
              <th>Způsob platby</th>
              <th>Datum převzetí</th>
            </tr>
        <?php
        $select_objednavka = $conn->query("SELECT objednavka.id as idecko,adresa_doruceni,prevzato,tel,predcisli,email,zpusob_doruceni,celk_cena,stav_objednavky,nazev,velikost,pocet_ks 
        from objednavka inner join objednavka_bota on id_objednavka = objednavka.id where id_zakaznik = $idZakaznik and (stav_objednavky = 0 or stav_objednavky = 4) order by idecko desc"); //nacteni kosiku
                    
         if ($select_objednavka->num_rows > 0) {
            ?>
              <script>
                document.getElementById("done").style.display = "block";
                </script>
            <?php
           while($row = $select_objednavka->fetch_assoc()) {

            $id = $row['idecko'];
            $prevzato = $row['prevzato'];
            $predcisli = $row['predcisli'];
             $adresa_doruceni = $row['adresa_doruceni'];
             $tel = $row['tel'];
             $e = $row['email'];
             $zpusob_doruceni = $row['zpusob_doruceni'];
             $celk_cena = $row['celk_cena'];
             $stav_objednavky = $row['stav_objednavky'];
             $nazev = $row['nazev'];
             $velikost = $row['velikost'];
             $pocet_ks = $row['pocet_ks']; 
             //echo $nazev;

             ?>

             <tr>
             <td><?php echo $id;?></td>
              <td style="min-width: 160px;"><?php echo $nazev;?></td>
              <td><?php echo $pocet_ks;?></td>
              <td><?php echo $velikost;?> EU</td>
              <td><?php echo $celk_cena;?> Kč</td>
              <td style="min-width: 206px;"class ="<?php echo $stav_objednavky ;?>"><a class="txt<?php echo $stav_objednavky ;?>"></a></td>
              <td><?php echo $zpusob_doruceni;?></td>
              <td style="min-width: 160px;"><?php echo $adresa_doruceni;?></td>
              <td><?php echo $tel." (+".$predcisli.")";?></td>
              <td><?php echo $e;?></td>
              <td>Dobírkou</td>
              <td style="min-width: 100px;"><?php echo $prevzato;?></td>
            </tr>
            <?php
             //echo "pocet kusu: ".$pocetKusu." velikost: ".$velikost." img zatim nic Nazev: ".$nazev." Cena: ".$cena."<br>";
            }
        }
        ?>
        </table>
        </div>
        </div>
        </div>
    
    <div class="container">
        <button style="margin:2px;" onclick="window.location.href='../index.php';">Zpět do obchodu</button>
        <button style="margin:2px;" onclick="delat()">Deaktivovat profil</button>
      <h4 style="text-align: center;">Zde můžete editovat Váš profil.</h4>
      <p style="text-align: center;">Mějte na paměti, že vámi zadané nové informace, se objeví až u příštích objednávkách.</p>
      <form action="insert_profil.php" method="post">
      <div class="row">
        <div class="col-25">
          <label for="fname">Jméno</label>
        </div>
        <div class="col-75">
          <input type="text" id="fname" name="firstname" placeholder="Vaše jméno..." required="" minlength="4" maxlength="20" value="<?php echo $jmeno;?>">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Přijmení</label>
        </div>
        <div class="col-75">
          <input type="text" id="lname" name="lastname" placeholder="Vaše Přijmení..." required="" minlength="4" maxlength="20" value="<?php echo $prijmeni;?>">
        </div>
      </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Vaše adresa</label>
          </div>
          <div class="col-75">
            <input type="text" id="lname" name="adress" placeholder="město/ulice/číslo popisné, PSČ" required="" minlength="5" maxlength="99" value="<?php echo $adresa;?>">
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Telefonní číslo</label>
          </div>
          <div class="col-75">
            <input type="text" id="lname" name="tel" placeholder="bez předčísla..." required="" minlength="9" maxlength="9" value="<?php echo $tel;?>">
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Kontaktní email</label>
          </div>
          <div class="col-75">
            <input type="email" id="lname" name="email" placeholder="Váš email..." required="" minlength="3" maxlength="40" value="<?php echo $e;?>">
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Země</label>
          </div>
        <div class="col-75">
          <div style="display:flex">
          <label class="containerR">CZ
              <input type="radio" 
              <?php 
              if($zem == 'CZ'){
                echo "checked";
            }?> 
            name="radio" value="CZ"> 
              <span class="checkmark"></span>
            </label>
            <label class="containerR">SK
              <input type="radio" name="radio" 
              <?php
              if($zem == 'SK'){
                echo "checked";
            } ?> value="SK">
              <span class="checkmark"></span>
            </label>
          </div>
        </div>
    </div>
    <div class="row">
          <div class="col-25">
            <label for="lname">Phlavé</label>
          </div>
        <div class="col-75">
          <div style="display:flex">
          <label class="containerR">Nechci uvádět
              <input type="radio" 
              <?php 
              if($pohlave == 'on'){
                echo "checked";
            }?> 
            name="radio2" value="on"> 
              <span class="checkmark"></span>
            </label>
            <label class="containerR">Muž
              <input type="radio" name="radio2" 
              <?php
              if($pohlave == 'Muž'){
                echo "checked";
            } ?> value="Muž">
              <span class="checkmark"></span>
            </label>
            <label class="containerR">Žena
              <input type="radio" name="radio2" 
              <?php
              if($pohlave == 'Žena'){
                echo "checked";
            } ?> value="Žena">
              <span class="checkmark"></span>
            </label>
          </div>
        </div>
    </div>
          
          
    
      <br>
      <div class="row">
        <input style="float:right;" type="submit" id="posli" name="posli" value="Uložit údaje" >
      </div>
      <div style="text-align: center;" id="loading">
      <div class="spinner-grow text-dark"></div>
      </div>
      <input type='text' name='cnna' id='cnna' class='hide' value=''>
      </form>
    </div>
    <div style="display: none;">
            <form id="myForm" action="deaktivace.php" method="post" >
              <input type='text' name='cnna' id='cnna' class='hide' value='38'>
            </form>
          </div>
          <div style="display: none;">
            <form id="myZrus" action="zrusObjednavku.php" method="post" >
              <input type='text' name='zrus' id='zrusTxT' class='hide' value=''>
            </form>
          </div>

          <form style="display:none;" id="odhlasit" action="../scripts/login.php" method="post">
            <input type='text' name='odlasit' class='hide' value='odlasit'>
              <!-- rtlacitko na odhlaseni scripts/login.php "odhlasit" -->
              <input type="submit" name="" value="Odhlásit se">
            </form> 

    <script>
     
      
    </script>

    <script src="select/c.js" defer></script>
    <script src="js.js"></script>
    <?php
    
    }else{
        ?>  <head>
            <!-- neni prihlasen -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
            <?php include 'css.css'; ?>
            </style>
            </head>
            <div class="log-form">
            <h2>Prosím, přihlašte se...</h2>
            <form  action="../scripts/login.php" method="post">
                <input type="email" title="username" placeholder="email" name="id">
                <input type="password" title="username" placeholder="heslo" name="psswd">
                <input type="submit" name="prihlasit" value="Prihlasit se">
            </form>
            </div>
            
        <?php
    }
?>