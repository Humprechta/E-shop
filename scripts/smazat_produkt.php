<?php

session_start();
require_once '../connect.php'; 

if(isset($_POST["id"])){

    $id = $_POST['id'];


            $sql = "DELETE from velikost_pocet where id_bota = $id;
            DELETE FROM kosik WHERE bota_id = $id;
            DELETE FROM bota WHERE id=$id
            ;
                 ";
        
                    $conn->multi_query($sql);
                    

                    
                    do {
                        if ($result = $conn->store_result()) {
                            var_dump($result->fetch_all(MYSQLI_ASSOC));
                            $result->free();
                        }
                    } while ($conn->next_result());

                    if ($conn->multi_query($sql) === TRUE) {

                    }else{
                      echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    header("location:../index.php?mssg=1a");
              exit;


      
}
?>