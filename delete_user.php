<?php
$conn = new PDO("mysql:host=localhost;dbname=story", "root", "190687");
$sql = "DELETE FROM Customers WHERE Id=:id;";
$stmt = $conn->prepare($sql);
$stmt->bindValue(":id", $_GET["id"]);
$stmt->execute();
header("Location: http://customers/main.php")
?>