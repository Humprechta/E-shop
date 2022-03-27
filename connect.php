<?php

				$servername = "localhost";
				$username = "id18288063_prihlasovani2";
				$password = "";
				$dbname = "id18288063_obchod";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>