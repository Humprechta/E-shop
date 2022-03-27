<?php
session_start();
require_once '../connect.php'; 
$idZ = $_SESSION["sesIDZ"];

if(isset($_POST['trash'])){ 
    // sql to delete a record
    $sql = "DELETE from kosik where zakaznik_id = $idZ";

if ($conn->query($sql) === TRUE) {
    header("location:../index.php?uspesne=trash");
    die;
  echo "Record deleted successfully";
} else {
    header("location:../../index.php?err=405&trashErr");
    die;
  echo "Error deleting record: " . $conn->error;
}

    die;
}

if(isset($_POST['id'])){ 

    $id = $_POST['id'];


        $sql = "DELETE from kosik where zakaznik_id = $idZ and id = $id;";
    
                $conn->multi_query($sql);
                //echo"id: ".$id;

                do {
                    if ($result = $conn->store_result()) {
                        var_dump($result->fetch_all(MYSQLI_ASSOC));
                        $result->free();
                    }
                } while ($conn->next_result());

                header("location:kosik-objednavka.php?y1");
                exit;
            }
            die;
?>