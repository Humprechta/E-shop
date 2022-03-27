<?php
require_once 'zabezpeceniAdmin.php';
require_once '../connect.php'; 

$id = $_GET['vybranaVelikost'];

        // sql to delete a record
        $sql = "DELETE FROM velikost_pocet WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            header("location:../index.php?mssg=1a");
            exit;
        } else {
        echo "Error deleting record: " . $conn->error;
        }

        $conn->close();
        exit;



?>