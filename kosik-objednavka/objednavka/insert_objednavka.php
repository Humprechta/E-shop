<?php
session_start();
require_once '../../connect.php'; 

$zamek = 0;

    if(isset($_SESSION["sesID1"])){
        $idZakaznik = $_SESSION["sesIDZ"];

        if(isset($_POST['firstname'])){ 

        $jmeno = $_POST['firstname'];
        $prijmeni = $_POST['lastname'];
        $adresa = $_POST['adress'];
        $tel = $_POST['tel'];
        $e = $_POST['email'];
        $predcisli = $_POST['radio'];
        $doruceni = $_POST['doruceni'];
        $cena = $_POST['cnna'];

        $neniSklad = 2;// 2 = je na skladě, 1 není

        $datum = date("Y-m-d h:i:s");

            $selectosik = $conn->query("SELECT bota.id as botaID,počet,velikost,nazev,Cena FROM kosik inner join bota on kosik.bota_id = bota.id where zakaznik_id = $idZakaznik"); //nacteni kosiku
                    
            if ($selectosik->num_rows > 0) {
              while($row = $selectosik->fetch_assoc()) {

                $botaID = $row['botaID'];
                //echo "Bota id ".$botaID;
                $pocetKusu = $row['počet'];
                $velikost = $row['velikost'];
                //echo "Velikost ".$velikost; //err zaukrouhluje!!
                //exit;
                $nazev = $row['nazev'];
                $cena = $row['Cena'];

                $selecPocet = $conn->query("SELECT pocet_ks,blokovano FROM velikost_pocet where id_bota = $botaID and velikost=$velikost"); //nacteni poctu na sklade

                if ($selecPocet->num_rows > 0) {
                    while($row = $selecPocet->fetch_assoc()) {

                        $pocetSklad = $row['pocet_ks'];
                        $pocetBlok0 = $row['blokovano'];
                        $pocetBlok1 = $pocetBlok0 + $pocetKusu;
                        $vysledek = $pocetSklad - $pocetKusu;
                        if($vysledek < 0){
                            //neni na sklade dostatek.
                            $vysledek = 0;
                            $neniSklad = 1;
                        }

                        $sql = "UPDATE velikost_pocet set pocet_ks = '$vysledek', blokovano = '$pocetBlok1'
                        where id_bota = $botaID and velikost=$velikost";

                        if ($conn->query($sql) === TRUE) {
                            //echo "Record updated successfully";
                            //exit;
                        } else {
                            //echo "Error updating record: " . $conn->error;
                            //exit;
                        }


                    }
                }
                if($zamek == '0'){
                    $sql = "insert into objednavka (jmeno,prijmeni,adresa_doruceni,tel,email,predcisli,zpusob_doruceni,id_zakaznik,celk_cena,stav_objednavky,datum,prevzato) 
                values('$jmeno','$prijmeni','$adresa','$tel','$e','$predcisli','$doruceni','$idZakaznik','$cena','$neniSklad','$datum','000-00-00')";
                $zamek = 1 ;
                if ($conn->query($sql) === TRUE) {
                    
                }else{ 
                    //err
                  header("location:../../index.php?err=405&0");
                  exit;
                    }
                 }
                
                $sql = "insert into objednavka_bota (nazev,velikost,pocet_ks,cena_kus,id_objednavka) 
                values('$nazev','$velikost','$pocetKusu','$cena',(select id from objednavka where id_zakaznik = $idZakaznik  order by id DESC limit 1))";
                if ($conn->query($sql) === TRUE) {
                    }else{
                        header("location:../../index.php?err=405&1");
                            exit;
                        }
              }
            }else{
                header("location:../../index.php?err=405&2");
                exit;
            }
            //smazani vseho z kosiku
            $sql = "DELETE from kosik where zakaznik_id = $idZakaznik";

            if ($conn->query($sql) === TRUE) {
                if($neniSklad == "1"){
                    header("location:../../index.php?uspesne=2x");
                    exit;
                }
                header("location:../../index.php?uspesne=2");
                exit;
                //echo "Record deleted successfully";
            } else {
                header("location:../../index.php?err=405&3");
                exit;
                //echo "Error deleting record: " . $conn->error;
            }

           
        }

        header("location:../../index.php?err=405&4");
          
          exit;

    }


?>