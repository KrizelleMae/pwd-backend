<?php

include '../config.php';

$user = json_decode(file_get_contents('php://input'));
$email = $user->email;
$password = $user->password;

$stmt = $db->prepare("SELECT * from users where EMAIL = ?;");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) > 0) {
    // $data = ['status' => 1, 'message' => "Record successfully created"];
    while ($user = mysqli_fetch_assoc($result)) {

        if(password_verify($password, $user['PASSWORD'])) {
            // IF TAMA PASSWORD  
            $data = ['status' => 1, "id" => $user['USER_ID'], 'role' => $user['ROLE']];

        }else {

            $data = ['status' => 0, 'message' => "Invalid password"];

        }
    }
} else {

    $data = ['status' => 2, 'message' => "Email does not exist"];

}

echo json_encode($data);
 



?>