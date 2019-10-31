<?php
/**
 * Created by PhpStorm.
 * User: Saeed Shahini
 * Date: 10/6/2016
 * Time: 10:08 PM
 */
$json = file_get_contents('php://input');
$userInfo = json_decode($json);
$email = $userInfo->email;
$password = $userInfo->password;

include 'DatabaseManager.php';
$databaseManager = new DatabaseManager();
$response = $databaseManager->addUser($email, $password);
echo json_encode(["response" => $response]);
