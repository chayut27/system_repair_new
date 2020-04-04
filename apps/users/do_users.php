<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "create_users"){


    if (!empty($_FILES["photo"]["name"])) {
        $file = $_FILES["photo"];
        $temp = explode(".", $file["name"]);
        $photo = round(microtime(true)) . '_' . $_SESSION["USER_ID"] . '.' . end($temp);

        if (!empty($_POST["old_profile"])) {
            unlink("../../uploads/users/" . $_POST["old_profile"]);
        }

        if (move_uploaded_file($file["tmp_name"], '../../uploads/users/' . $photo)) { } else {
            $_SESSION["alert"] = array("status" => "error", "msg" => "Upload file failed");
            header("location:../../index.php?page=profile");
            return false;
        }
    }

    $req = array(
        "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "N",
        "position" => isset($_POST["position"]) ? $_POST["position"] : "",
        "username" => isset($_POST["username"]) ? $_POST["username"] : "",
        "password" => isset($_POST["password"]) ? $_POST["password"] : "",
        "email" => isset($_POST["email"]) ? $_POST["email"] : "",
        "first_name" => isset($_POST["first_name"]) ? $_POST["first_name"] : "",
        "last_name" => isset($_POST["last_name"]) ? $_POST["last_name"] : "",
        "gender" => $_POST["gender"],
        "birthdate" => $_POST["birthdate"],
        "phone_number" => isset($_POST["phone_number"]) ? $_POST["phone_number"] : "",
        "profile" => isset($photo) ? $photo : "",
    );

    $required = array(
        "username" => "Username",   
        "password" => "Password",   
        "email" => "Email",
        "first_name" => "First Name",
        "last_name" => "Last Name",
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

    $req["username"] = filter_var_string($_POST["username"], "Username");
    $req["password"] = filter_var_string(password_hash($_POST["password"], PASSWORD_DEFAULT), "Password");
    $req["email"] = filter_var_email($_POST["email"], "Email");
    $req["first_name"] = filter_var_string($_POST["first_name"], "First Name");
    $req["last_name"] = filter_var_string($_POST["last_name"], "Last Namne");

try{

    $sql = "INSERT INTO `users` SET ";
    if(!empty($req["is_active"])){
        $sql .= " `is_active` = :is_active, ";
    }
    if(!empty($req["position"])){
        $sql .= " `position` =:position, ";
    }
    $sql .= " `username` = :username, ";
    $sql .= " `password` = :password, ";
    $sql .= " `email` =:email, ";
    $sql .= " `first_name` = :first_name, ";
    $sql .= " `last_name` = :last_name, ";
    $sql .= " `gender` = :gender, ";
    $sql .= " `birthdate` = :birthdate, ";
    $sql .= " `profile` = :profile, ";
    $sql .= " `phone_number` = :phone_number ";
    // $sql .= "  WHERE `id` = :id  ";
    $stmt = $conn->prepare($sql);
    if(!empty($req["is_active"])){
    $stmt->bindParam(":is_active",$req["is_active"]);
    }
    if(!empty($req["position"])){
    $stmt->bindParam(":position",$req["position"]);
    }
    $stmt->bindParam(":username",$req["username"]);
    $stmt->bindParam(":password",$req["password"]);
    $stmt->bindParam(":email",$req["email"]);
    $stmt->bindParam(":first_name",$req["first_name"]);
    $stmt->bindParam(":last_name",$req["last_name"]);
    $stmt->bindParam(":gender",$req["gender"]);
    $stmt->bindParam(":birthdate",$req["birthdate"]);
    $stmt->bindParam(":profile",$req["profile"]);
    $stmt->bindParam(":phone_number",$req["phone_number"]);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successfully saved data.", false);
        header("location:../../index.php?page=users");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "update_users"){

    $req = array(
        "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "N",
        "position" => isset($_POST["position"]) ? $_POST["position"] : "",
        "username" => isset($_POST["username"]) ? $_POST["username"] : "",
        "email" => isset($_POST["email"]) ? $_POST["email"] : "",
        "first_name" => isset($_POST["first_name"]) ? $_POST["first_name"] : "",
        "last_name" => isset($_POST["last_name"]) ? $_POST["last_name"] : "",
        "gender" => $_POST["gender"],
        "birthdate" => $_POST["birthdate"],
        "phone_number" => isset($_POST["phone_number"]) ? $_POST["phone_number"] : "",
        "user_id" => $_POST["user_id"],
    );

    $required = array(
        "user_id" => "User ID",   
        "username" => "Username",     
        "email" => "Email",
        "first_name" => "First Name",
        "last_name" => "Last Name",
    );


    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

    $req["username"] = filter_var_string($_POST["username"], "Username");
    $req["email"] = filter_var_email($_POST["email"], "Email");
    $req["first_name"] = filter_var_string($_POST["first_name"], "First Name");
    $req["last_name"] = filter_var_string($_POST["last_name"], "Last Namne");

try{

    $sql = "UPDATE `users` SET ";
    if(!empty($req["is_active"])){
        $sql .= " `is_active` = :is_active, ";
    }
    if(!empty($req["position"])){
        $sql .= " `position` =:position, ";
    }
    $sql .= " `username` = :username, ";
    $sql .= " `email` =:email, ";
    $sql .= " `first_name` = :first_name, ";
    $sql .= " `last_name` = :last_name, ";
    $sql .= " `gender` = :gender, ";
    $sql .= " `birthdate` = :birthdate, ";
    $sql .= " `phone_number` = :phone_number ";
    $sql .= "  WHERE `id` = :user_id  ";
    $stmt = $conn->prepare($sql);
    if(!empty($req["is_active"])){
    $stmt->bindParam(":is_active",$req["is_active"]);
    }
    if(!empty($req["position"])){
    $stmt->bindParam(":position",$req["position"]);
    }
    $stmt->bindParam(":username",$req["username"]);
    $stmt->bindParam(":email",$req["email"]);
    $stmt->bindParam(":first_name",$req["first_name"]);
    $stmt->bindParam(":last_name",$req["last_name"]);
    $stmt->bindParam(":gender",$req["gender"]);
    $stmt->bindParam(":birthdate",$req["birthdate"]);
    $stmt->bindParam(":phone_number",$req["phone_number"]);
    $stmt->bindParam(":user_id",$req["user_id"]);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Data update successful.", false);
        header("location:../../index.php?page=users/edit&user_id=".$req["user_id"]);
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "check_username"){

    $req = array(
        "username" => $_POST["username"],
    );

    $required = array(
        "username" => "Username",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

    if (!preg_match('/[A-Za-z0-9]/', $req["username"])) // '/[^a-z\d]/i' should also work.
    {
        echo json_encode('Username is not a valid string.');
        exit();
    }

    try{
        $sql = "SELECT COUNT(username) AS num FROM `users` WHERE `username` = :username ";
        if(!empty($_POST["user_id"])){
            $sql .= " AND `id` != :user_id";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $req["username"]);
        if(!empty($_POST["user_id"])){
        $stmt->bindValue(':user_id', $_POST["user_id"]);
        }
        // $stmt->bindValue(':id', $_SESSION["USER_ID"]);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['num'] > 0){
            echo json_encode('This username is already taken.');
        }else{
            echo json_encode('true');
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

    
}elseif(isset($_GET["action"]) && $_GET["action"] == "check_email"){

    $req = array(
        "email" => $_POST["email"],
    );

    $required = array(
        "email" => "Email",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

    try{
        $sql = "SELECT COUNT(email) AS num FROM `users` WHERE `email` = :email ";
        if(!empty($_POST["user_id"])){
            $sql .= " AND `id` != :user_id";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $req["email"]);
        if(!empty($_POST["user_id"])){
        $stmt->bindValue(':user_id', $_POST["user_id"]);
        }
        // $stmt->bindValue(':id', $_SESSION["USER_ID"]);   
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['num'] > 0){
            echo json_encode('This email is already taken.');
        }else{
            echo json_encode('true');
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}elseif(isset($_GET["action"]) && $_GET["action"] == "check_password"){

    $req = array(
        "current_password" => $_POST["current_password"],
    );

    $required = array(
        "current_password" => "Current Password",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

    try{
        $sql = "SELECT `password` FROM `users` WHERE `id` = :user_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $_SESSION["USER_ID"]);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $validPassword = password_verify($req["current_password"], $row['password']);
        if($validPassword){
            echo json_encode('true');
        }else{
            echo json_encode('Current password does not match!');
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}elseif(isset($_GET["action"]) && $_GET["action"] == "change_password"){
    $req = array(
        "new_password" => password_hash($_POST["new_password"], PASSWORD_DEFAULT),
    );

    $required = array(
        "new_password" => "New Password",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

try{

    $stmt = $conn->prepare("UPDATE `users` SET `password` = :password WHERE `id` = :user_id ");
    $stmt->bindParam(":password",$req["new_password"]);
    $stmt->bindParam(":user_id",$_SESSION["USER_ID"]);
    $result = $stmt->execute();
    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Change Password Success.";
        header("location:../../index.php?page=users");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "upload_profile"){

    if (!empty($_FILES["photo"]["name"])) {
        $file = $_FILES["photo"];
        $temp = explode(".", $file["name"]);
        $photo = round(microtime(true)) . '_' . $_SESSION["USER_ID"] . '.' . end($temp);

        if (!empty($_POST["old_profile"])) {
            unlink("../../uploads/users/" . $_POST["old_profile"]);
        }

        if (move_uploaded_file($file["tmp_name"], '../../uploads/users/' . $photo)) { } else {
            $_SESSION["alert"] = array("status" => "error", "msg" => "Upload file failed");
            header("location:../../index.php?page=users");
            return false;
        }
    }

    $req = array(
        "profile" => $photo,
        "user_id" => $_GET["user_id"],
    );

    $required = array(
        "profile" => "Profile",   
        "user_id" => "User ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

try{

    $stmt = $conn->prepare("UPDATE `users` SET `profile` = :profile WHERE `id` = :user_id ");
    $stmt->bindParam(":profile",$req["profile"]);
    $stmt->bindParam(":user_id",$req["user_id"]);
    $result = $stmt->execute();
    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Upload Success.";
        header("location:../../index.php?page=users/edit&user_id=".$req["user_id"]);
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "user_id" => $_GET["user_id"],
        // "profile" => $_GET["profile"],
    );

    $required = array(  
        "user_id" => "User ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

    // if($req["profile"]){
    //     unlink("../../uploads/users/" . $req["profile"]);
    // }

try{
    $sql = "UPDATE `users` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` = :user_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":user_id",$req["user_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=users");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "user_id" => $_POST["ch"],
    );

    $required = array(  
        "user_id" => "User ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

    // $arr = array();
    $user_id = implode(",", $req["user_id"]);
    // foreach($_POST["ch"] as $v){
    //     $arr[] = explode(",",$v);
    // }

    // $user_id = "";
    // $profile = "";

    // foreach($arr as $v){
    //     $user_id .= $v[0].",";
    //     $profile .= $v[1].",";

    // }

    // $profile_ex = explode(",", $profile);
    // foreach($profile_ex as $v){
    //     if($v){
    //         unlink("../../uploads/users/" . $v);
    //     }
    // }

    // $user_id = substr($user_id, 0,-1);
    // $user_id = implode(",", $req["user_id"]);
    // die();

try{
    $sql = "UPDATE `users` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` IN ($user_id) ";


    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=users");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "confirm_delete"){

    $req = array(
        "user_id" => $_GET["user_id"],
        "profile" => $_GET["profile"],
    );

    $required = array(  
        "user_id" => "User ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

    if($req["profile"]){
        unlink("../../uploads/users/" . $req["profile"]);
    }

    try{
        $sql = "DELETE FROM `users`  ";
        $sql .= "  WHERE `id` = :user_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":user_id",$req["user_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Successful data deletion.", false);
            header("location:../../index.php?page=users/delete");
            exit();
        
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}elseif(isset($_GET["action"]) && $_GET["action"] == "cancel_delete"){

    $req = array(
        "user_id" => $_GET["user_id"],
    );

    $required = array(  
        "user_id" => "User ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=users");
        exit();
    }

    try{
        $sql = "UPDATE `users` SET  ";
        $sql .= " `is_delete` = 'N'  ";
        $sql .= "  WHERE `id` = :user_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":user_id",$req["user_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Cancel successful.", false);
            header("location:../../index.php?page=users/delete");
            exit();
        
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}else{
    defined('APPS') OR exit('No direct script access allowed');
}






?>