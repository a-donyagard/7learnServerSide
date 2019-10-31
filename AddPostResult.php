<?php
/**
 * Created by PhpStorm.
 * User: Saeed Shahini
 * Date: 8/16/2016
 * Time: 12:17 AM
 */
$postTitle=$_POST['post_title'];
$postContent=$_POST['post_content'];
$imageUrl=$_POST['post_image_url'];
$date=date("Y m d");


include 'DatabaseManager.php';

$databaseManager=new DatabaseManager();
$databaseManager->addPost($postTitle,$postContent,$imageUrl,$date);