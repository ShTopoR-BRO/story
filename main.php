<?php
echo "hello world!!!";
$conn = new PDO("mysql:host=localhost; dbname = story", "root", "190687");
$sql = "INSERT INTO Customers(Age, FirstName, LastName) VALUES (35, 'Alex', 'Smirnov')";
$affectedRowsNumber = $conn->exec($sql);
echo $affectedRowsNumber;

?>