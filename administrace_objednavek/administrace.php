<?php

session_start();
require_once '../connect.php'; 

if(isset($_GET['povedlose'])){
    if($_GET['povedlose'] == '1'){
      ?>
        <div class="alertDone">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong>Úspěšně aktualizováno.</strong>.
        </div>
      <?php
    }
    if($_GET['povedlose'] == 'x'){
      ?>
        <div class="alertErr">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong>Uživatel zablokován.</strong>
        </div>
      <?php
    }
    if($_GET['povedlose'] == '3'){
      ?>
        <div class="alertDone">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong>Heslo změněno.</strong>
        </div>
      <?php
    }
    if($_GET['povedlose'] == 'xs'){
      ?>
        <div class="alertErr">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong>Objednávka zrusena.</strong>
        </div>
      <?php
    }
  }
  if(isset($_GET['err'])){
    if($_GET['err'] == '405'){
      ?>
        <div class="alertErr">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong>Něco se nepovedlo</strong>, zkus to znovu.
        </div>
      <?php
    }
    if($_GET['err'] == '1'){
      ?>
        <div class="alertErr">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong>Hesla se neshodují</strong>, zkus to znovu.
        </div>
      <?php
    }
  }

if(isset($_SESSION["sesID1"])){
  if($_SESSION["sesA"] != 'superuser44'){
        echo "fatall err";
        exit;
    }
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/31a5950820.js" crossorigin="anonymous"></script>
    <title>Profil</title>
    <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="select/c.css">
    <body onload="load()">
        <?php 
         /*$selectZ = $conn->query("SELECT heslo from zakaznik where jmeno = 'admin'");
                    
         if ($selectZ->num_rows > 0) {
           while($row = $selectZ->fetch_assoc()) {
             $heslo = $row['heslo'];
             //echo "pocet kusu: ".$pocetKusu." velikost: ".$velikost." img zatim nic Nazev: ".$nazev." Cena: ".$cena."<br>";
            }
        }*/
        $selectRazeni = "Podle datumu(id)";
        if(isset($_GET['razeni'])){
          if($_GET['razeni'] == '0'){
            $selectRazeni = "Podle datumu(id)";
            $orderBy = 'idecko desc';
          } if($_GET['razeni'] == '1'){
            $selectRazeni = "Podle stavu objednávky";
            $orderBy = 'stav_objednavky';
          } if($_GET['razeni'] == '2'){
            $selectRazeni = "Podle stavu objednávky (vzestupně)";
            $orderBy = 'stav_objednavky desc';
          }if($_GET['razeni'] == '3'){
            $selectRazeni = "Podle datumu (id - vzestupně)";
            $orderBy = 'idecko';
          }
        }else{
          $orderBy = 'idecko desc';
        }

      ?>

      <div class="container">
        <button onclick="window.location.href='../index.php';">Zpět do obchodu</button>
        <p> Objednávky čekajicí na vyřízení...</p>
              <form id ="rad" action="">
                        <div onclick="razeni()" class="custom-select" id="" style=" margin: auto;">
                        <select name ="razeni">
                            <option value="0"><?php echo $selectRazeni;?></option>
                            <option value="0">Podle datumu(id)</option>
                            <option value="3">Podle datumu (id - vzestupně)</option>
                            <option value="1">Podle stavu objednávky</option>
                            <option value="2">Podle stavu objednávky (vzestupně)</option>
                        </select>
                        </div>
                        <input style="display:none;margin:auto;" id="" type='submit' name='zmen' value='Ulozit'> 
                    </form>
                    <label for="lname">id obednávky</label>
                    <input placeholder="hledej podle cisla objednavky" type="text" id="vyhledat" name="id"><br>
                    <button onclick="vyhledat(0)">Vyhledat</button>
                    <button onclick="reset()">Reset</button>
        <div id ="obchod">
        <a> Zatím je tu prázdno...</a> <button onclick="window.location.href='../index.php';">Zpět do obchodu</button>
        </div>
        <div class ="hide" id ="ceka">
        <div style="overflow-x: auto;">
          <table>
            <tr>
              <th>id</th>
              <th>Nazev</th>
              <th>Počet kusů</th>
              <th>Velikost</th>
              <th>Celková cena</th>
              <th>Stav objednávky</th>
              <th>Jmeno</th>
              <th>Způsob doručení</th>
              <th>Adresa</th>
              <th>telefoní číslo</th>
              <th>email</th>
              <th>Způsob platby</th>
              <th>Datum objednání</th>
              <th>Zrušit objednávku</th>
              <th>ZABLOKOVAT UŽIVATELE</th>
            </tr>

        <?php
        $select_objednavka = $conn->query("SELECT objednavka_bota.id as idBota,id_zakaznik as zakaznik,objednavka.id as idecko,adresa_doruceni,jmeno,prijmeni,datum,tel,predcisli,email,zpusob_doruceni,celk_cena,stav_objednavky,nazev,velikost,pocet_ks 
        from objednavka inner join objednavka_bota on id_objednavka = objednavka.id where (stav_objednavky = 1 or stav_objednavky = 2 or stav_objednavky = 3) order by $orderBy"); //nacteni kosiku
                    
         if ($select_objednavka->num_rows > 0) {
          ?>
          <script>
            document.getElementById("ceka").style.display = "block";
            document.getElementById("obchod").style.display = "none";
            </script>
        <?php
           while($row = $select_objednavka->fetch_assoc()) {

            $idBota = $row['idBota'];
            $zakaznik = $row['zakaznik'];
            $jmeno = $row['jmeno'];
            $prijmeni = $row['prijmeni'];
            $id = $row['idecko'];
            $datum = $row['datum'];
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
              
              <tr class="hl <?php echo $id;?>">
             <td><?php echo $id;?></td>
              <td style="min-width: 160px;"><?php echo $nazev;?></td>
              <td><?php echo $pocet_ks;?></td>
              <td><?php echo $velikost;?> EU</td>
              <td><?php echo $celk_cena;?> Kč</td>
              <td>
              <a style="margin:0;padding:0;"class="txt<?php echo $stav_objednavky ;?>"></a>
              <form id ="<?php echo $idBota;?>" action="zmenaStavu.php" method="post">
                        <div onclick="zmenaPoctu(<?php echo $idBota;?>)" class="custom-select" id="" style=" margin: auto;">
                        <select name ="pocetNove">
                            <option value="<?php echo $stav_objednavky;?>">Změna</option>
                            <option value="1">Naskladňujeme.</option>
                            <option value="2">Za chvíli pošleme.</option>
                            <option value="3">Posláno.</option>
                            <option value="4">Vyřízeno.</option>
                        </select>
                        </div>
                        <input type='text' name='id' class='hide' value='<?php echo $id;?>'>
                        <input type='text' name='objednavka_bota_id' class='hide' value='<?php echo $idBota;?>'>
                        <input type='text' name='orderby' class='hide' value='<?php echo $orderBy;?>'>
                        <input style="display:none;margin:auto;" id="" type='submit' name='zmen' value='Ulozit'> 
                    </form>
              </td>
              <td><?php echo $jmeno;?> <?php echo $prijmeni;?></td>
              <td><?php echo $zpusob_doruceni;?></td>
              <td style="min-width: 160px;"><?php echo $adresa_doruceni;?></td>
              <td><a href="tel:<?php echo "+".$predcisli.$tel?>"><?php echo $tel." (+".$predcisli.")";?></a></td>
              <td><a href="<?php echo $e;?>"><?php echo $e;?></a></td>
              <td>Dobírkou</td>
              <td><?php echo $datum;?></td>
              <td><i onclick ="zrusit(<?php echo $id;?>)" class="fa fa-times" aria-hidden="true"></i></td>
              <td><i onclick ="zrusitho(<?php echo $zakaznik;?>)" class="fa fa-ban" aria-hidden="true"></i></td>
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
        <div style="overflow-x: auto; max-height: 666px;">
          <table>
            <tr>
              <th>id</th>
              <th style="min-width: 160px;">Nazev</th>
              <th>Počet kusů</th>
              <th>Velikost</th>
              <th>Celková cena</th>
              <th>Stav objednávky</th>
              <th>Jmeno</th>
              <th>Způsob doručení</th>
              <th style="min-width: 160px;">Adresa</th>
              <th>telefoní číslo</th>
              <th>email</th>
              <th>Způsob platby</th>
              <th>Převzato</th>
            </tr>
        <?php
        $select_objednavka = $conn->query("SELECT objednavka_bota.id as idBota,objednavka.id as idecko,jmeno,prijmeni,prevzato,adresa_doruceni,tel,predcisli,email,zpusob_doruceni,celk_cena,stav_objednavky,nazev,velikost,pocet_ks 
        from objednavka inner join objednavka_bota on id_objednavka = objednavka.id where (stav_objednavky = 0 or stav_objednavky = 4) order by $orderBy limit 499"); 
                    
         if ($select_objednavka->num_rows > 0) {
            ?>
              <script>
                document.getElementById("done").style.display = "block";
                </script>
            <?php
           while($row = $select_objednavka->fetch_assoc()) {
            
            $idBota = $row['idBota'];
            $id = $row['idecko'];
            $jmeno = $row['jmeno'];
            $prijmeni = $row['prijmeni'];
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

              <tr class="hl <?php echo $id;?>">
              <td><?php echo $id;?></td>
              <td><?php echo $nazev;?></td>
              <td><?php echo $pocet_ks;?></td>
              <td><?php echo $velikost;?> EU</td>
              <td><?php echo $celk_cena;?> Kč</td>
              <td>
              <a style="margin:0;padding:0;"class="txt<?php echo $stav_objednavky ;?>"></a>
              <form id ="<?php echo $idBota;?>" action="zmenaStavu.php" method="post">
                        <div onclick="zmenaPoctu(<?php echo $idBota;?>)" class="custom-select" id="" style=" margin: auto;">
                        <select name ="pocetNove">
                            <option value="<?php echo $stav_objednavky;?>">Změna</option>
                            <option value="1">Naskladňujeme.</option>
                            <option value="2">Za chvíli pošleme.</option>
                            <option value="3">Posláno.</option>
                            <option value="4">Vyřízeno.</option>
                        </select>
                        </div>
                        <input type='text' name='id' class='hide' value='<?php echo $id;?>'>
                        <input type='text' name='objednavka_bota_id' class='hide' value='<?php echo $idBota;?>'>
                        <input type='text' name='orderby' class='hide' value='<?php echo $orderBy;?>'>
                        <input style="display:none;margin:auto;" id="" type='submit' name='zmen' value='Ulozit'> 
                    </form>
              </td>
              <td><?php echo $jmeno;?> <?php echo $prijmeni;?></td>
              <td><?php echo $zpusob_doruceni;?></td>
              <td><?php echo $adresa_doruceni;?></td>
              <td><a href="tel:<?php echo "+".$predcisli.$tel?>"><?php echo $tel." (+".$predcisli.")";?></a></td>
              <td><a href="<?php echo $e;?>"><?php echo $e;?></a></td>
              <td>Dobírkou</td>
              <td><?php echo $prevzato;?></td>
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
        <h4 style="text-align: center;">Zde můžete editovat Váš profil. (administrator)</h4>
        <form action="zmenaHeslaAdmin.php" method="post">
        <div class="row">
        <div class="col-25">
          <label for="lname">Heslo </label>
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
      <br>
      <div class="row">
        <input style="float:right;" type="submit" id="posli" name="posli" value="Uložit údaje" >
        </div>
        <div style="text-align: center;" id="loading">
        <div class="spinner-grow text-dark"></div>
        </div>
      </form>
      <div style="">
            <form id="" action="export.php" method="post">
            <input type="submit" value="Export dat">
            </form>
          </div>


    </div>
    <div style="display: none;">
            <form id="zrusitho" action="blokace.php" method="post" >
              <input type='text' name='id' id='zrusithoTxT' class='hide' value=''>
            </form>
          </div>
          <div style="display: none;">
            <form id="myZrus" action="zrusObjednavku.php" method="post" >
              <input type='text' name='zrus' id='zrusTxT' class='hide' value=''>
            </form>
          </div>

    <script>
     
      
    </script>

    <script src="../select/c.js" defer></script>
    <script src="js.js" defer></script>
    <?php
    
    }else{
        ?>  <head>
            <!-- neni prihlasen -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
            <?php include '../profil/css.css'; ?>
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
</body>