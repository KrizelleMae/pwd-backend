<?php

include '../../config.php';

$company = json_decode(file_get_contents('php://input'));
$email = $company->email;
$hashed_password = password_hash($company->password, PASSWORD_DEFAULT);
$firstname = $company->firstname;
$lastname = $company->lastname;
$position = $company->position;
$companyName = $company->companyName;
$website = $company->website;
$regNum = $company->regNum;
$incDate = $company->incDate;
$telNum = $company->telNum;
$compEmail = $company->compEmail;
$address = $company->address;

// CHECK IF EMAIL EXISTS
$checkEmail = $db->prepare("SELECT * FROM users WHERE EMAIL = ?;");
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
$res = $checkEmail->get_result();
$userId = rand(10000,999999);
$role = 3;

if (mysqli_num_rows($res) > 0) {
    $data = ['status' => 2, 'message' => "Email exist."];
} else {
     // sendmail($email, body($firstName), "Account Registration");
     $addUser = $db->prepare('INSERT INTO users (USER_ID, EMAIL, PASSWORD, ROLE) VALUES (?, ?, ?, ?)');
     $addUser->bind_param('issi', $userId, $email, $hashed_password, $role);

     if ($addUser->execute()) {
        $registration = $db->prepare('INSERT INTO `companyprofile` ( `COMPANY_NAME`, `COMPANY_ADDRESS`, `COMPANY_EMAIL`, `REG_NUMBER`, `INCORPORATION_DATE`, `TEL_NUMBER`, `WEBSITE`, `REP_FIRSTNAME`, `REP_LASTNAME`, `REP_POSITION`, `FK_USER_ID`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
        $registration->bind_param('ssssssssssi', $companyName, $address, $compEmail, $regNum, $incDate, $telNum, $website, $firstname, $lastname, $position, $userId);    
    
        if($registration->execute()) {

            
            $getUser = $db->prepare("SELECT * from companyprofile where FK_USER_ID = ?;");
            $getUser->bind_param("i", $userId);
            $getUser->execute();
            $res = $getUser->get_result()->fetch_assoc();


            $data = ['status' => 1, 'message' => "Successful registration.", "id" => $userId,'companyId' => $res['COMPANY_ID'], 'role' => $role];
        } else {
            $data = ['status' => 0, 'message' => "Failed to update company profile.", ];
        }
        
     } else {
         $data = ['status' => 0, 'message' => "Registration failed."];
     }
}

echo json_encode($data);

$db->close();

?>