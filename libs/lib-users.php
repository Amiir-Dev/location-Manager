<?php

function isLoggedin(){
    return isset($_SESSION['login']);
}


function logout(){
    unset($_SESSION['login']);
}


function login($username, $password){
    global $admins;
    if(array_key_exists($username, $admins) and
   password_verify($password, $admins[$username])){
        $_SESSION['login'] = 1;
        return true;
    }
    return false;
}

# user verify
function checkUser($userEmail){
    global $pdo;
    $sql = "SELECT id FROM users WHERE email LIKE :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $userEmail]);
    $record = $stmt->fetch();
    return $record['id'];
}

function addUser($userName, $userEmail){
    global $pdo;
    $sql = "INSERT INTO users (name,email) VALUES (:name, :email);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name'=>$userName, ':email'=>$userEmail]);
    return $pdo->lastInsertId();
}

function checkUserId($userName, $userEmail){
    if(checkUser($userEmail)){
        $user_id = checkUser($userEmail);
    }
    else{
        $user_id = addUser($userName, $userEmail);
    }
    return $user_id;
}