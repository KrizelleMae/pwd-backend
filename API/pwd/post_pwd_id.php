<?php
include '../../config.php';

$job = json_decode(file_get_contents('php://input'));
$file = $job->file;
$userId = $job->userId;

$stmt = $db->prepare('UPDATE `pwdprofile` SET PWD_ID = ? WHERE FK_USER_ID = ?');
$stmt->bind_param('si', $file, $userId);

if($stmt->execute()){

    $data = ['status' => 1, 'message' => "Success."];

} else {    
    $data = ['status' => 0, 'message' => "Failed to updated record."];  
}

echo json_encode($data);
$db->close();


?>