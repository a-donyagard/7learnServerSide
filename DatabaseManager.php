<?php

/**
 * Created by PhpStorm.
 * User: Saeed Shahini
 * Date: 8/15/2016
 * Time: 11:21 PM
 */
class DatabaseManager
{
    const DATABASE_NAME = "7learn_db";

    function createDatabase()
    {
        $connection = mysqli_connect("localhost", "root", "");
        $sqlCommand = "CREATE DATABASE " . DatabaseManager::DATABASE_NAME;
        if (mysqli_query($connection, $sqlCommand)) {
            echo "Database created successfully";
        }
    }


    function createPostsTable()
    {
        $connection = mysqli_connect("localhost", "root", "", DatabaseManager::DATABASE_NAME);
        $sqlCommand = "CREATE TABLE posts (id INTEGER PRIMARY KEY AUTO_INCREMENT,
                              title TEXT,
                              content TEXT,
                              image_url TEXT,
                               date DATE )";
        if (mysqli_query($connection, $sqlCommand)) {
            echo "Post table created successfully";
        }
    }


    function addPost($title, $content, $imageUrl, $date)
    {
        $connection = mysqli_connect("localhost", "root", "", DatabaseManager::DATABASE_NAME);
        $sqlCommand = "INSERT INTO posts(title,content,image_url,date) VALUES('$title','$content','$imageUrl','$date')";
        if (mysqli_query($connection, $sqlCommand)) {
            echo "Post added to table successfully";
        } else {
            echo "Error in adding post to table";
        }
    }


    function getPosts()
    {
        $connection = mysqli_connect("localhost", "root", "", DatabaseManager::DATABASE_NAME);

        $sqlQuery = "SELECT * FROM posts";

        $result = $connection->query($sqlQuery);

        $postsArray = array();
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $postsArray[$i] = $result->fetch_assoc();
            }
        }

        echo json_encode($postsArray);
    }

    function createUsersTable(){
        $connection = mysqli_connect("localhost", "root", "", DatabaseManager::DATABASE_NAME);
        $sqlCommand = "CREATE TABLE users (id INTEGER PRIMARY KEY AUTO_INCREMENT,
                              email TEXT NOT NULL,
                               password TEXT NOT NULL)COLLATE='utf8_general_ci'";
        if (mysqli_query($connection, $sqlCommand)) {
            echo "Users table created successfully";
        }else{
            echo mysqli_error($connection);
        }
    }

    function addUser($email, $password)
    {
        if ($this->isUserEmailExist($email)) {
            return 2;
        }
        if (empty($email)) {
            return 0;
        }
        $connection = mysqli_connect("localhost", "root", "", DatabaseManager::DATABASE_NAME);
        $sqlCommand = "INSERT INTO users(email,password) 
                        VALUES('$email','$password')";
        if (mysqli_query($connection, $sqlCommand)) {
            return 1;
        } else {
            return 0;
        }
    }

    function isUserEmailExist($email)
    {
        $connection = mysqli_connect("localhost", "root", "", DatabaseManager::DATABASE_NAME);
        $sqlCommand = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $sqlCommand);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function loginUser($email, $password)
    {
        $connection = mysqli_connect("localhost", "root", "", DatabaseManager::DATABASE_NAME);
        $sqlCommand = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $sqlCommand);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            $databasePassword = $row['password'];
            if ($databasePassword == $password) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}