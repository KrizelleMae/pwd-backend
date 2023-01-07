<?php
include '../../config.php';

$job = json_decode(file_get_contents('php://input'));
$userId = $job->userId;

$stmt = $db->prepare('UPDATE `pwdprofile` SET VERIFIED = 1 WHERE FK_USER_ID = ?');
$stmt->bind_param('i', $userId);

if($stmt->execute()){

    $data = ['status' => 1, 'message' => "Success."];

} else {    
    $data = ['status' => 0, 'message' => "Failed to updated record."];  
}

echo json_encode($data);
$db->close();


?>