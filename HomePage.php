<?php
/**
 * Created by PhpStorm.
 * User: Saeed Shahini
 * Date: 8/15/2016
 * Time: 11:16 PM
 */
include "DatabaseManager.php";
$databaseManager = new DatabaseManager();
$databaseManager->createDatabase();
$databaseManager->createPostsTable();
$databaseManager->createUsersTable();
include "AddPostForm.php";

