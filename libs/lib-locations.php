<?php

function insertLocation($data, $userID){
    global $pdo;
    # Prevent duplicate insertion
    $sql = "SELECT COUNT(*) FROM locations WHERE lat LIKE :lat and lng LIKE :lng";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':lat' => $data['lat'], ':lng' => $data['lng']]);
    $stmt->fetch();
    if($stmt->rowCount()){
        die("موقعیت موردنظر قبلا ارسال شده است");
    }

    $sql = "INSERT INTO locations (user_id, title,lat, lng, type) VALUES (:user_id, :title, :lat, :lng, :typ);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id'=>$userID, ':title'=>$data['title'], ':lat'=>$data['lat'], ':lng'=>$data['lng'], ':typ'=>$data['type']]);
    return $stmt->rowCount();
}


function getLocations($params){
    global $pdo;
    $condition = '';
    if(isset($params['verified']) and in_array($params['verified'], ['0', '1'])){
        $condition = "WHERE verified = {$params['verified']}";
    }
    else if(isset($params['keyword'])){
        $condition = "WHERE verified = 1 and title LIKE '%{$params['keyword']}%'";
    }
    $sql = "SELECT * FROM locations $condition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


function getLocation($id){
    global $pdo;
    $sql = "SELECT * FROM locations WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}


function toggleStatus($id){
    global $pdo;
    $sql = "UPDATE locations SET verified = 1 - verified WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
}

function getWindowLocations($n, $s, $e, $w){
    global $pdo;
    $sql = "SELECT * FROM locations WHERE (lng <= :east AND lng >= :west) AND (lat <= :north AND lat >= :south)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':south' => $s, ':north' => $n,':east' => $e, ':west' => $w]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}