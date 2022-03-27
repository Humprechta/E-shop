<?php
session_start();
require_once '../connect.php'; 

    if(isset($_SESSION["sesID1"])){
        $datum = date("Y-m-d");
           
        $query = $conn->query("SELECT objednavka.id as idecko,jmeno,prijmeni,prevzato,adresa_doruceni,tel,predcisli,email,zpusob_doruceni,celk_cena,stav_objednavky,nazev,velikost,pocet_ks 
        from objednavka inner join objednavka_bota on id_objednavka = objednavka.id");
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "members-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('id','jmeno', 'prijmeni', 'adresa_doruceni', 'tel', 'email', 'zpusob_doruceni', 'celk_cena', 'stav_objednavky', 'stav_objednavky', 'stav_objednavky', 'stav_objednavky', 'stav_objednavky'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['idecko'],$row['jmeno'], $row['prijmeni'], $row['adresa_doruceni'], $row['tel'], $row['email'], $row['zpusob_doruceni'], $row['celk_cena'],$row['stav_objednavky'],$row['prevzato'],$row['nazev'],$row['celk_cena'],$row['velikost'],$row['pocet_ks']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
    exit;
} 

    }
    header("location:administrace.php?err=405");
    exit;

?>