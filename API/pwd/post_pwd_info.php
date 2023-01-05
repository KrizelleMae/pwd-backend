<?php

include '../../config.php';

$user = json_decode(file_get_contents('php://input'));
$birthdate = $user->birthdate;
$contact = $user->contact;
$street = $user->street;
$city = $user->city;
$province = $user->province;
$zip = $user->zip;
$disType = $user->disType;
$disInborn = $user->disInborn;
$disCause = $user->disCause;
$education = $user->education;
$skills = $user->skills;
$other = $user->other;
$userId = $user->id;

$stmt = $db->prepare('UPDATE pwdprofile SET CONTACT_NUMBER = ?, BIRTHDATE = ?, STREET = ?, CITY = ?, PROVINCE = ?, ZIP = ?, DISABILITY_TYPE = ?, DISABILITY_INBORN = ?, DISABILITY_CAUSE = ?, EDUCATION = ? WHERE FK_USER_ID = ?');
$stmt->bind_param('ssssssisssi', $contact, $birthdate, $street, $city, $province, $zip, $disType, $disInborn, $disCause, $education, $userId);

if($stmt->execute()) {
    
    foreach($other as $key => $value) {

        $val = $value->skill;

        $otherSkills = $db->prepare('INSERT INTO pwdskills (SKILL_NAME, FK_USER_ID) VALUES (?, ?)');
        $otherSkills->bind_param('si', $val, $userId);
        $otherSkills->execute();
    } 

    foreach($skills as $key => $value) {

        $insertSkills = $db->prepare('INSERT INTO pwdskills (SKILL_NAME, FK_USER_ID) VALUES (?, ?)');
        $insertSkills->bind_param('si', $value, $userId);
        $insertSkills->execute();
    }

    $data = ['status' => 1, 'message' => "Success."];

} else {
    $data = ['status' => 0, 'message' => "Failed to updated record."];
}

echo json_encode($data);

$db->close();


?>