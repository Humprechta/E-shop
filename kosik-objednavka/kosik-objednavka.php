<?php
session_start();
require_once '../connect.php'; 

$kosik = 0;

    if(isset($_SESSION["sesID1"])){
        $idZakaznik = $_SESSION["sesIDZ"];
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/31a5950820.js" crossorigin="anonymous"></script>
        <title>Košík</title>
        <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
        <style>
            
            <?php include 'cssKosik.css'; ?>
            <?php include 'select/c.css'; ?>
            </style>
            <div class ="marginTop"></div>
            <ul class="breadcrumb">
  <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
  <?php if(isset($_SESSION["sesJ"])){ ?>
  <li><a href="../profil/profil.php">
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
  <li><a href="#"><a><i class="fa fa-volume-control-phone" aria-hidden="true"></i>Kontakty</a></a></li>
  <li style="color:red;"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Košík</li>
  <?php
  if(isset($_SESSION["sesIDZ"]) or isset($_SESSION["sesA"])){
    echo "<li onclick='odhlas()'><a href='#'><i class='fa fa-sign-out' aria-hidden='true'></i>Odhlásit se</a></li>";
  }
  ?>
</ul>

        <div class="container">
        <button id="goBack" onclick="window.location.href='../index.php'">Zpět do obchodu
          <lord-icon
          src="https://cdn.lordicon.com/dzydjxom.json"
        trigger="loop-on-hover"
        delay="250"
        style="width:35px;height:35px">
    </lord-icon>
        </button>
        <p style="text-align: center;">Košík</p>
        
        <div style="overflow-x: auto;">
          <table id="kosikTable">
            <tr>
              <th>Nahledový obrazek</th>
              <th>Nazev</th>
              <th>Velikost</th>
              <th>Počet kusů</th>
              <th>Cena za kus</th>
              <th>Smazat</th>
            </tr>
            
                <?php
                    $celCena = 0;
                    $selectosik = $conn->query("SELECT kosik.id as idecko,počet,velikost,obrazek,nazev,Cena FROM kosik inner join bota on kosik.bota_id = bota.id where zakaznik_id = $idZakaznik"); //nacteni kosiku
                    
                    if ($selectosik->num_rows > 0) {
                      while($row = $selectosik->fetch_assoc()) {
          
                        $pocetKusu = $row['počet'];
                        $velikost = $row['velikost'];
                        $img = $row['obrazek'];
                        $nazev = $row['nazev'];
                        $cena = $row['Cena'];
                        $botaId = $row['idecko'];
                        //echo "pocet kusu: ".$pocetKusu." velikost: ".$velikost." img zatim nic Nazev: ".$nazev." Cena: ".$cena."<br>";
                        $celCena = $celCena + $cena * $pocetKusu;

                        ?>

            <tr>
              <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($img); //konvert obrazku z databaze ?>" alt="" width="75" height="75" style="margin: 0;"></td>
              <td><?php echo $nazev;?></td>
              <td><?php echo $velikost;?> EU</td>
              <td>
                  <form id ="<?php echo $botaId;?>" action="zmenaPoctu.php" method="post">
                        <div onclick="zmenaPoctu(<?php echo $botaId;?>)" class="custom-select" id="" style="width:100px; margin: auto;">
                        <select name ="pocetNove">
                            <option value="<?php echo $pocetKusu;?>"><?php echo $pocetKusu;?> ks</option>
                            <option value="1">1 ks</option>
                            <option value="2">2 ks</option>
                            <option value="3">3 ks</option>
                            <option value="4">4 ks</option>
                            <option value="5">5 ks</option>
                        </select>
                        </div>
                        <input type='text' name='id' class='hide' value='<?php echo $botaId;?>'>
                        <input style="display:none;margin:auto;" id="" type='submit' name='zmen' value='Ulozit'> 
                    </form>
              </td>
              <td><?php echo $cena;?> Kč</td>
                <td>
                  <form action="smazat_polozku.php" method="post" id="<?php echo $botaId;?>Smazat"><div class="fufu" onclick="smazat1('<?php echo $botaId;?>Smazat')"><i class="fa fa-times-circle-o" aria-hidden="true"></i><input type='text' name='id' class='hide' value='<?php echo $botaId;?>'></div></form>
                </td>
            </tr>

            <?php
                }
                }else{
                  $kosik = 1;
                  ?>
                    <div id ="obchod" style="text-align:center;">
                    <a> Zatím je tu prázdno...</a>
                     <button onclick="window.location.href='../index.php';">Zpět do obchodu
                      <lord-icon
                          src="https://cdn.lordicon.com/dzydjxom.json"
                          trigger="loop-on-hover"
                          delay="250"
                          style="width:35px;height:35px">
                        </lord-icon>
                      </button>
                    </div>
                  <?php
                    }
                  ?>

          </table>
        </div>
        <div id="kosikComponent">
        <p style="text-align: center;">Cena bez dopravy:<?php echo $celCena;?> Kč s DPH</p>
        <button onclick="dal()" id="zpet">Objednat
          <lord-icon
        src="https://cdn.lordicon.com/kzwbetjp.json"
        trigger="loop-on-hover"
        delay="250"
        style="width:35px;height:35px">
    </lord-icon>
        </button>
        <button onclick="trash()" id="trash">Vysipat košík
        <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
          <lord-icon
            src="https://cdn.lordicon.com/qsloqzpf.json"
            trigger="loop-on-hover"
            delay="250"
            style="width:35px;height:35px">
          </lord-icon>
      </button>
              </div>
      </div>

      <?php
      //pokud je kosik prazdny kosik!=0 skryje se vse
      if($kosik != 0){
        ?>
          <script>
            document.getElementById("goBack").style.display = "none";
            document.getElementById("kosikTable").style.display = "none";
            document.getElementById("kosikComponent").style.display = "none";
          </script>
        <?php
      }
         $selectZ = $conn->query("SELECT jmeno,prijmeni,email,adresa,tel,zem from zakaznik where zakaznik.id = $idZakaznik"); //nacteni kosiku
                    
         if ($selectZ->num_rows > 0) {
           while($row = $selectZ->fetch_assoc()) {

             $jmeno = $row['jmeno'];
             $prijmeni = $row['prijmeni'];
             $e = $row['email'];
             $adresa = $row['adresa'];
             $tel = $row['tel'];
             $zem = $row['zem'];

             //echo "pocet kusu: ".$pocetKusu." velikost: ".$velikost." img zatim nic Nazev: ".$nazev." Cena: ".$cena."<br>";
            }
        }
      ?>
    
    <div class="container anamtion12" id = "dal">
      <p style="text-align: center;">Dodací informace</p>
      <form action="objednavka/insert_objednavka.php" method="post">
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
            <label for="lname">Předčíslí</label>
          </div>
        <div class="col-75">
          <div style="display:flex">
          <label class="containerR">CZ (+ 420)
              <input type="radio" 
              <?php 
              if($zem == 'CZ'){
                echo "checked";
            }?> 
            name="radio" value="420"> 
              <span class="checkmark"></span>
            </label>
            <label class="containerR">SK (+421)
              <input type="radio" name="radio" 
              <?php
              if($zem == 'SK'){
                echo "checked";
            } ?> value="421">
              <span class="checkmark"></span>
            </label>
          </div>
        </div>
    </div>
        <div class="row">
            <div class="col-25">
                <label for="lname">Vyber způsob doručení</label>
            </div>
            <div class="col-75">
                <div onclick="doruceni()" class="custom-select" style="max-width:333px;">
                    <select name ="doruceni" id="doruceni">
                        <option value="0">Vyber možnost doručení</option>
                        <option value="ZDARMA0">Osobní odběr -ZDARMA-</option>
                        <option value="ZASILKOVNA120">Zásilkovna +120Kč</option>
                        <option value="PPL130">PPL +130KČ</option>
                    </select>
                    </div>
                </div>
            </div>
    
        <div class="row">
          <div class="col-25">
            <label for="lname">Souhlasím s podmínakami firmy </label>
          </div>
          <div class="col-75">
              <div style="display:flex">
              <label class="containerR">Ano
                  <input type="radio" checked="" name="radio1" value="CZ"> 
                  <span class="checkmark"></span>
                </label>
                <label class="containerR">Ne
                  <input type="radio" name="radio1" value="SK">
                  <span class="checkmark"></span>
                </label>
              </div>
          </div>
      </div>
      <br>
      <p style="text-align: center;">Celková cena s DPH:<a id="innerCena"></a> Kč</p>
      <div class="row">
        <input style="float:right;    background-color: gray;" type="submit" id="posli" name="posli" value="Objednat" onclick="posilam()" disabled>
      </div>
      <div style="text-align: center;" id="loading">
      <div class="spinner-grow text-dark"></div>
      </div>
      <input type='text' name='cnna' id='cnna' class='hide' value=''>
      </form>
    </div>

    <form style="display:none;" id="odhlasit" action="../scripts/login.php" method="post">
            <input type='text' name='odlasit' class='hide' value='odlasit'>
              <!-- rtlacitko na odhlaseni scripts/login.php "odhlasit" -->
              <input type="submit" name="" value="Odhlásit se">
            </form> 
            
            <form style="display:none;" id="trash1" action="smazat_polozku.php" method="post">
            <input type='text' name='trash' class='hide' value='trash'>
              <!-- rtlacitko na odhlaseni scripts/login.php "odhlasit" -->
              <input type="submit" name="" value="VysipatKOs">
            </form> 
    
    <script>
    function posilam() {
      var x = document.getElementById("loading");
        x.style.display = "block";
    }
    //vysipani kosiku
    function trash(){
      //console.log("trashh");
      document.getElementById("trash1").submit();
    }
    function dal() {
      document.getElementsByClassName("anamtion12")[0].style.animationPlayState = "running";
      var x = document.getElementById("dal");
        x.style.display = "block";
        var y = document.getElementById("zpet");
        y.style.display = "none";
        celcenajs = parseInt(<?php echo $celCena;?>);
        document.getElementById("innerCena").innerHTML = celcenajs;
    }
    function smazat1(x){
        document.getElementById(x).submit();
    }
    function zmenaPoctu(x1){
        document.getElementById(x1).submit();
        //var j = this.id;
        console.log(x1);
        //var jj = document.getElementById(x1);;
        //jj.style.display = "block";
        //document.getElementById("posli").disabled = true
        //document.getElementById("posli").style.backgroundColor = "grey";
    }  
     function doruceni(){
        var x = document.getElementById("doruceni").value;
        var regex = x.replace(/[A-Z]/g, "");
        var celcenajs = parseInt(<?php echo $celCena;?>) + parseInt(regex);
        //console.log(celcenajs);
        document.getElementById("innerCena").innerHTML = celcenajs;
        document.getElementById("posli").value = "Objednat za "+celcenajs+" Kč";
        document.getElementById("cnna").value = celcenajs;
        document.getElementById("posli").style.backgroundColor = "DodgerBlue";
        document.getElementById("posli").disabled = false;
    }
    function odhlas(){
	document.getElementById("odhlasit").submit();
  }
    </script>
    <script src="select/c.js" defer></script>
    <?php
    
    }else{
      //neni prihlasen
      header("location:../login_formular.php");
    }




?>