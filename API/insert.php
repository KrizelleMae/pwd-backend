<?php

include '../config.php';

$user = json_decode(file_get_contents('php://input'));
$email = $user->email;
$password = $user->password;


$stmt = $db->prepare('INSERT INTO user (email, password) VALUES (?, ?);');
$stmt->bind_param('ss', $email, $password);

if($stmt->execute()){
    echo json_encode('success');
} else {
    echo json_encode('failed');
}

?>