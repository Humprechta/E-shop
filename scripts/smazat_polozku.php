<?php

session_start();
require_once '../connect.php'; 

if(isset($_POST["submit"])){

    $id = $_POST['smazat_polozku'];
    $idZ = $_SESSION["sesIDZ"];

            $sql = "DELETE from kosik where zakaznik_id = $idZ and id = $id;";
        
                    $conn->multi_query($sql);

                    
                    do {
                        if ($result = $conn->store_result()) {
                            var_dump($result->fetch_all(MYSQLI_ASSOC));
                            $result->free();
                        }
                    } while ($conn->next_result());

                    header("location:../index.php");
                    exit;

}
?>