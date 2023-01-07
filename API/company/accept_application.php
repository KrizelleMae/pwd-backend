<?php
include '../../config.php';
include '../send_email.php';
include '../body.php';

$job = json_decode(file_get_contents('php://input'));
$userId = $job->userId;

$stmt = $db->prepare('UPDATE `pwdprofile` SET JOB_STATUS = "ACCEPTED" WHERE FK_USER_ID = ?');
$stmt->bind_param('i', $userId);

if($stmt->execute()){
    
    $getEmail = $db->prepare('SELECT email FROM users WHERE USER_ID = ?');
    $getEmail->bind_param('i', $userId);
    $getEmail->execute();
    $result = $getEmail->get_result();
    $res = $result->fetch_row();
    $email = $res[0];

    $getApp = $db->prepare('SELECT * FROM application a INNER JOIN job_description b ON b.FK_COMPANY_ID = a.FK_COMPANY_ID INNER JOIN pwdprofile p ON p.FK_USER_ID = a.FK_PWD_ID WHERE a.FK_PWD_ID = ? GROUP BY a.APPLICATION_ID');
    $getApp->bind_param('i', $userId);
    $getApp->execute();
    $resu = $getApp->get_result();
    $output = $resu->fetch_assoc();

    sendmail($email, body($output['TITLE'], $output['POSITION']), "Application Accepted");

    $data = ['status' => 1, 'message' => "Success."];

} else {    
    $data = ['status' => 0, 'message' => "Failed to updated record."];  
}

echo json_encode($data);
$db->close();

?>