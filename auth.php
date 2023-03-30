<?php
if (isset($_POST["avtor"])){
    $firstname=$_POST["FirstName"];
    $lastname=$_POST["LastName"];
    $conn = new PDO("mysql:host=localhost;dbname=story", "root", "190687");
    $sql_3 = "SELECT * FROM Customers WHERE FirstName = :firstname AND LastName = :lastname";
    $stmt = $conn->prepare($sql_3);
    $stmt->bindValue(":firstname", $firstname);
    $stmt->bindValue(":lastname", $lastname);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        setcookie("login", 1, time() + 3600);
        header("Location: http://customers/success.php");
    }
    else{
        echo "нет  такого пользователя!!!";
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="cs_cod.css" type="text/css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1> avtor </h1>
    <form method="post" action="">
        <br><input type = "text" name = "FirstName"  placeholder = "enter FirstName">
        <br><input type = "text" name = "LastName"  placeholder = "enter LastName">
        <button type = "submit" name = "avtor" > avtor </button>
</body>
</html>