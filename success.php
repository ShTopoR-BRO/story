<?php
if ($_COOKIE["login"]){
}
else{
    header("Location: http://customers/auth.php");
}



if (isset($_POST["add"]) && $_COOKIE["login"]){
    $name=$_POST["name"];
    $price=$_POST["price"];
    $conn = new PDO("mysql:host=localhost;dbname=story", "root", "190687");
    $sql_3 = "INSERT INTO goods VALUES (:name, :price)";
    $stmt = $conn->prepare($sql_3);
    $stmt->bindValue(":name", $name);
    $stmt->bindValue(":price", $price);
    $stmt->execute();
    echo "товар добавлен";
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
<h1> Private Office </h1>
    <form method="post" action="">
        <br><input type = "text" name = "name"  placeholder = "enter name">
        <br><input type = "text" name = "price"  placeholder = "enter price">
        <button type = "submit" name = "add" > add </button>
</body>
</html>