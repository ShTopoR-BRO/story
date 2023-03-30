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

    if  (isset($_POST["show"])){
        $conn = new PDO("mysql:host=localhost;dbname=story", "root", "190687");
        $sql_1 = "SELECT * FROM Customers";
        $res = $conn->query($sql_1);
        echo "<table><tr><th>Age</th><th>FirstName</th><th>LastName</th></tr>";
        while($row = $res->fetch()){
            echo "<tr>";
                echo "<td>" . $row["Age"] . "</td>";
                echo "<td>" . $row["FirstName"] . "</td>";
                echo "<td>" . $row["LastName"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
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