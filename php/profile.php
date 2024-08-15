<?php
require 'vendor/autoload.php'; // MongoDB PHP Library

use MongoDB\Client;

$mongoClient = new Client("mongodb://localhost:27017");
$collection = $mongoClient->mydatabase->profiles;

// Check if user is logged in
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$token = $_POST['token'];
$userId = $redis->get($token);

if (!$userId) {
    echo 'Unauthorized';
    exit;
}

$profileData = [
    'age' => $_POST['age'],
    'dob' => $_POST['dob'],
    'contact' => $_POST['contact']
];

$collection->updateOne(
    ['user_id' => $userId],
    ['$set' => $profileData],
    ['upsert' => true]
);

echo 'Profile updated successfully';
?>
