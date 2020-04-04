<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "create_repair"){


    $req = array(
        "problem" => isset($_POST["problem"]) ? $_POST["problem"] : "",
        "technician" => isset($_POST["technician"]) ? $_POST["technician"] : "0",
        "description" => isset($_POST["description"]) ? $_POST["description"] : "",
        "inventory" => isset($_POST["inven"]) ? $_POST["inven"] : "",
        "user_id" => $_SESSION["USER_ID"],
    );

    $required = array(
        "problem" => "Problem",   
        "technician" => "technician",   
        "description" => "Description",   
        "inventory" => "Inventory",
        "user_id" => "User ID",
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=repair");
        exit();
    }

    $req["description"] = filter_var_string($_POST["description"], "Description");

try{

    $sql = "INSERT INTO `repair` SET ";
    $sql .= " `problem` = :problem, ";
    $sql .= " `description` = :description, ";
    $sql .= " `inventory_id` = :inventory, ";
    $sql .= " `technician` = :technician, ";
    $sql .= " `user_id` = :user_id ";
    // $sql .= "  WHERE `id` = :id  ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":problem",$req["problem"]);
    $stmt->bindParam(":description",$req["description"]);
    $stmt->bindParam(":inventory",$req["inventory"]);
    $stmt->bindParam(":technician",$req["technician"]);
    $stmt->bindParam(":user_id",$req["user_id"]);
    $result = $stmt->execute();
    $id = $conn->lastInsertId();
    $status_id = "14";
    if($result){
       
    $sql = "INSERT INTO `repair_detail` SET ";
    $sql .= " `repair_id` = :repair_id, ";
    $sql .= " `status_id` = :status_id ";
    // $sql .= "  WHERE `id` = :id  ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":repair_id",$id, PDO::PARAM_INT);
    $stmt->bindParam(":status_id",$status_id, PDO::PARAM_INT);
    $result = $stmt->execute();
    

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successfully saved data.", false);
        header("location:../../index.php?page=repair");
        exit();
     
    }

      
}
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "repair_id" => $_GET["repair_id"],
    );

    $required = array(  
        "repair_id" => "Repair ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=repair");
        exit();
    }


try{
    $sql = "DELETE FROM `repair`  ";
    $sql .= "  WHERE `id` = :repair_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":repair_id",$req["repair_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=repair");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "repair_id" => $_POST["ch"],
    );

    $required = array(  
        "repair_id" => "Repair ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=repair");
        exit();
    }

    $arr = array();

    foreach($_POST["ch"] as $v){
        $arr[] = explode(",",$v);
    }

    $user_id = "";

    foreach($arr as $v){
        $user_id .= $v[0].",";

    }


    $repair_id = substr($user_id, 0,-1);


try{
    $sql = "DELETE FROM `repair`  ";
    $sql .= "  WHERE `id` IN ($repair_id) ";

    echo $sql;
    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=repair");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "created_detail"){

    $req = array(
        "note" => filter_var_string($_POST["note"], "Note"),
        "status" => $_POST["status"],
        "repair_id" => $_POST["repair_id"],
    );

    $required = array(
        "status" => "status",   
        "repair_id" => "repair_id",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=repair/edit&repair_id=".$req["repair_id"]);
        exit();
    }

try{

    $sql = "INSERT INTO `repair_detail` SET ";
    $sql .= " `repair_id` = :repair_id, ";
    $sql .= " `note` = :note, ";
    $sql .= " `status_id` = :status ";
    // $sql .= "  WHERE `id` = :id  ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":repair_id",$req["repair_id"]);
    $stmt->bindParam(":note",$req["note"]);
    $stmt->bindParam(":status",$req["status"]);
    $result = $stmt->execute();
    $id = $conn->lastInsertId();
 
    

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successfully saved data.", false);
        header("location:../../index.php?page=repair/edit&repair_id=".$req["repair_id"]);
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