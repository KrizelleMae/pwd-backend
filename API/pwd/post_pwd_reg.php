<?php

include '../../config.php';

$user = json_decode(file_get_contents('php://input'));
$firstname = $user->firstname;
$lastname = $user->lastname;
$email = $user->email;
$hashed_password = password_hash($user->password, PASSWORD_DEFAULT);

// CHECK IF EMAIL EXISTS
$checkEmail = $db->prepare("SELECT * FROM users WHERE EMAIL = ?;");
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
$res = $checkEmail->get_result();
$userId = rand(10000,999999);
$role = 2;

if (mysqli_num_rows($res) > 0) {

    $data = ['status' => 2, 'message' => "Email exist."];

} else {

    // PREPARE QUERY
    $registration = $db->prepare('INSERT INTO users (USER_ID, EMAIL, PASSWORD, ROLE) VALUES (?, ?, ?, ?)');
    $registration->bind_param('issi', $userId, $email, $hashed_password, $role);

    if($registration->execute()) {
        // sendmail($email, body($firstName), "Account Registration");
        $user_details = $db->prepare('INSERT INTO pwdprofile (FIRSTNAME, LASTNAME, EMAIL_ADDRESS, FK_USER_ID) VALUES (?, ?, ?, ?)');
        $user_details->bind_param('sssi', $firstname, $lastname, $email, $userId);

        if ($user_details->execute()) {
            $data = ['status' => 1, 'message' => "Successful registration.", 'id' => $userId, 'role' => $role];
        } else {
            $data = ['status' => 0, 'message' => "Registration failed."];
        }
        
       
    } else {

        $data = ['status' => 0, 'message' => "Registration failed.", ];

    }
}

echo json_encode($data);

$db->close();

?>