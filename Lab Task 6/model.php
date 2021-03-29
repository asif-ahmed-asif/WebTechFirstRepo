<?php 

require_once 'db_connect.php';

function UserId()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $query = "SELECT uid FROM `login` ORDER BY uid DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $lastid = $row['uid'];
    if ($lastid == null) {
        return "USER1";
    }else{
        $temp = substr($lastid, 4);
        $temp1 = intval($temp);
        return "USER".($temp1 + 1);
    }
}

function AddIntoLogin($login)
{
    $conn = db_conn();
    $selectQuery = "INSERT into login (uid, password, type, status)
VALUES (:uid, :password, :type, :status)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':uid' => $login['uid'],
            ':password' => $login['password'],
            ':type' => $login['type'],
            ':status' => $login['status']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
    $conn = null;
}

function AddIntoLibrarian($librarian)
{
    $conn = db_conn();
    $selectQuery = "INSERT into librarian (uid, name, email, dob, address, gender, picture)
VALUES (:uid, :name, :email, :dob, :address, :gender, :picture)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':uid' => $librarian['uid'],
            ':name' => $librarian['name'],
            ':email' => $librarian['email'],
            ':dob' => $librarian['dob'],
            ':address' => $librarian['address'],
            ':gender' => $librarian['gender'],
            ':picture' => $librarian['picture']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
    $conn = null;
}

function Logins($userid, $pass)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $query = "SELECT * FROM `login` WHERE uid ='$userid' && password ='$pass'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function View($id)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $query = "SELECT * FROM `librarian` WHERE uid ='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function DataUpdate($data){
    $conn = db_conn();
    $selectQuery = "UPDATE librarian set name = ?, email = ?, dob = ?, address = ?, gender = ? where uid = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['name'], $data['email'], $data['dob'], $data['address'], $data['gender'], $data['uid']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
    $conn = null;
    return true;
}

function PictureUpdate($data){
    $conn = db_conn();
    $selectQuery = "UPDATE librarian set picture = ? where uid = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['picture'], $data['uid']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
    $conn = null;
}

function PassUpdate($data)
{
    $conn = db_conn();
    $selectQuery = "UPDATE login set password = ? where uid = ?";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['password'], $data['uid']
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
    $conn = null;
}

function ViewLogin($id)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $query = "SELECT * FROM `login` WHERE uid ='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

