<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($_POST['password'], $user['password'])) {
        // Start Redis connection
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);

        // Store session information
        $token = bin2hex(random_bytes(32));
        $redis->set($token, $user['id'], 3600); // 1 hour expiration

        echo "success&token=" . $token;
    } else {
        echo "Invalid username or password";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
