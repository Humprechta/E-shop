<?php
require_once 'connect.php'; 
require_once 'scripts/zabezpeceniAdmin.php'; 
?>
<?php
$status = $statusMsg = ''; 

if(isset($_POST["submit"])){ 

    $znacka = $_POST['znackaVOL'];
    $nazev =  $_POST['nazev'];
    $cena =  $_POST['cena'];
    $popisek =  $_POST['info'];
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            //echo "po kontrole .jpg";
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
            // Insert image content into database 

            $insert = $conn->query("INSERT into bota (obrazek, nazev,Cena,o_bote,znacka_id) VALUES ('$imgContent','$nazev','$cena','$popisek','$znacka')"); 
            if($insert){ 
                header("location:index.php?mssg=1a");
                exit;
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 

} 
header("location:index.php?mssg=1b&err=$statusMsg");
exit;
?>