<?php
session_start();
require_once '../connect.php';

    $id = $_POST['id'];
    $velikost = $_POST['pocetNove'];
    //echo "vel: ".$velikost. " id: ".$id;

    $sql = "UPDATE kosik SET počet=$velikost WHERE id=$id";

    header("location:kosik-objednavka.php?povedlose=1");

        if ($conn->query($sql) === TRUE) {
        echo " Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }

    $conn->close();



?>