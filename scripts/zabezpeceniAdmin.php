<?php
session_start();
if(isset($_SESSION["sesA"])){
    if($_SESSION["sesA"] != 'superuser44'){
        echo "fatall err 1";
        exit;
    }
}else{
    echo "fatall err 2";
    die;
}

?>