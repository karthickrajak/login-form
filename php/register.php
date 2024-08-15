<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
    $stmt->execute();

    echo "Registration successful";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
