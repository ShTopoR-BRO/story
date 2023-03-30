<?php
    if (isset($_POST["add"])){
    // подключаемся к серверу
    $conn = new PDO("mysql:host=localhost;dbname=story", "root", "190687");
    // $sql = "INSERT INTO Customers (Age, FirstName, LastName) VALUES (37, 'Tom', 'Adams')";
    // $conn->exec($sql);
    $age=$_POST["Age"];
    $first = $_POST["FirstName"];
    $last = $_POST["LastName"];
    $sql = "INSERT INTO Customers (Age, FirstName, LastName) VALUES (:age, :name_first, :name_last)";
    $stmt = $conn->prepare($sql);
        // привязываем параметры к значениям
        $stmt->bindValue(":age", $age);
        $stmt->bindValue(":name_first", $first);
        $stmt->bindValue(":name_last", $last);
        // выполняем prepared statement
        $affectedRowsNumber = $stmt->execute();
        if ($affectedRowsNumber > 0){
        echo "в таблицу добавлен: $first $last "; 
        }  
    }

    if  (isset($_POST["show_all"])){
        $conn = new PDO("mysql:host=localhost;dbname=story", "root", "190687");
        $sql_1 = "SELECT * FROM Customers";
        $res = $conn->query($sql_1);
        echo "<table><tr><th>Age</th><th>FirstName</th><th>LastName</th></tr>";
        while($row = $res->fetch()){
            echo "<tr>";
                echo "<td>" . $row["Age"] . "</td>";
                echo "<td>" . $row["FirstName"] . "</td>";
                echo "<td>" . $row["LastName"] . "</td>";
                echo "<td><a href=delete_user.php?id=".$row["Id"]."> Delete </a></td>"; 
            echo "</tr>";
        }
        echo "</table>";
    }

    if  (isset($_POST["show"])){
        $age=$_POST["Age"];
        $conn = new PDO("mysql:host=localhost;dbname=story", "root", "190687");
        $sql_3 = "SELECT * FROM Customers WHERE Age = :age";
        $stmt = $conn->prepare($sql_3);
        $stmt->bindValue(":age", $age);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach ($stmt as $row) {
              $firstname = $row["FirstName"];
              $lastname = $row["LastName"];
             
              echo "<div>
                    <h3>Информация о пользователе</h3>
                    <p>$firstname</p>
                    <p>$lastname</p>
                </div>";
            }
        }
        else{
            echo "Пользователь не найден";
        }
    }

    if (isset($_POST["remove"])){
        $conn = new PDO("mysql:host=localhost;dbname=story", "root", "190687");
        $age=$_POST["Age"];
        $first = $_POST["FirstName"];
        $last = $_POST["LastName"];
        $sql_2 = "DELETE FROM Customers WHERE Age = $age";
        $stmt_2 = $conn->prepare($sql_2);
            $affectedRowsNumber = $stmt_2->execute();
            if ($affectedRowsNumber > 0){ 
            echo "из таблицы удалены все чей возраст: $age";
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
    <h1> Customers </h1>
    <form method="post" action="">
        <input type = "text" name = "Age"  placeholder = "enter Age">
        <br><input type = "text" name = "FirstName"  placeholder = "enter FirstName">
        <br><input type = "text" name = "LastName"  placeholder = "enter LastName">
        <br><input type = "submit" name = "add" value = "add">
        <button type = "submit" name = "show_all" value = "show all"> show all </button>
        <input type = "submit" name = "show" value = "show">
        <input type = "submit" name = "remove" value = "remove">
    </form>
    <a href="auth.php" class="button">
        <span class="button__line button__line--top"></span>    
        <span class="button__line button__line--right"></span>
        <span class="button__line button__line--bottom"></span>
        <span class="button__line button__line--left"></span>
        авторизироватся</a>
    
</body>
</html>