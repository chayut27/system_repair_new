<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "create_inventory"){


    if (!empty($_FILES["photo"]["name"])) {
        $file = $_FILES["photo"];
        $temp = explode(".", $file["name"]);
        $photo = round(microtime(true)) . '_' . $_SESSION["USER_ID"] . '.' . end($temp);

        if (!empty($_POST["old_photo"])) {
            unlink("../../uploads/inventory/" . $_POST["old_photo"]);
        }

        if (move_uploaded_file($file["tmp_name"], '../../uploads/inventory/' . $photo)) { } else {
            $_SESSION["alert"] = array("status" => "error", "msg" => "Upload file failed");
            header("location:../../index.php?page=inventory");
            return false;
        }
    }

    $req = array(
        "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "N",
        "name" => isset($_POST["name"]) ? $_POST["name"] : "",
        "serial_number" => isset($_POST["serial_number"]) ? $_POST["serial_number"] :  "",
        "category" => $_POST["category"],
        "type" => $_POST["type"],
        "brand" => $_POST["brand"],
        "photo" => isset($photo) ? $photo : "",
    );

    $required = array(
        "name" => "Name",   
        "serial_number" => "Serial Number",   
        "category" => "Category",
        "type" => "Type",
        "brand" => "Brand",
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=inventory");
        exit();
    }

    $req["name"] = filter_var_string($_POST["name"], "Name");
    $req["serial_number"] = filter_var_string($_POST["serial_number"], "Serial Number");

try{

    $sql = "INSERT INTO `inventory` SET ";
    $sql .= " `is_active` = :is_active, ";
    $sql .= " `name` = :name, ";
    $sql .= " `serial_number` = :serial_number, ";
    $sql .= " `category` =:category, ";
    $sql .= " `type` = :type, ";
    $sql .= " `brand` = :brand, ";
    $sql .= " `photo` = :photo ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":is_active",$req["is_active"]);
    $stmt->bindParam(":name",$req["name"]);
    $stmt->bindParam(":serial_number",$req["serial_number"]);
    $stmt->bindParam(":category",$req["category"]);
    $stmt->bindParam(":type",$req["type"]);
    $stmt->bindParam(":brand",$req["brand"]);
    $stmt->bindParam(":photo",$req["photo"]);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successfully saved data.", false);
        header("location:../../index.php?page=inventory");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "update_inventory"){

    if (!empty($_FILES["photo"]["name"])) {
        $file = $_FILES["photo"];
        $temp = explode(".", $file["name"]);
        $photo = round(microtime(true)) . '_' . $_SESSION["USER_ID"] . '.' . end($temp);

        if (!empty($_POST["old_photo"])) {
            unlink("../../uploads/inventory/" . $_POST["old_photo"]);
        }

        if (move_uploaded_file($file["tmp_name"], '../../uploads/inventory/' . $photo)) { } else {
            $_SESSION["alert"] = array("status" => "error", "msg" => "Upload file failed");
            header("location:../../index.php?page=inventory");
            return false;
        }
    }


    $req = array(
        "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "N",
        "name" => isset($_POST["name"]) ? $_POST["name"] : "",
        "serial_number" => isset($_POST["serial_number"]) ? $_POST["serial_number"] :  "",
        "category" => $_POST["category"],
        "type" => $_POST["type"],
        "brand" => $_POST["brand"],
        "photo" => isset($photo) ? $photo : "",
        "inventory_id" => $_GET["inventory_id"],
    );

    $required = array(
        "inventory_id" => "Inventory ID",   
        "name" => "Name",   
        "serial_number" => "Serial Number",   
        "category" => "Category",
        "type" => "Type",
        "brand" => "Brand",
    );


    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=inventory");
        exit();
    }

    $req["name"] = filter_var_string($_POST["name"], "Name");
    $req["serial_number"] = filter_var_string($_POST["serial_number"], "Serial Number");

try{

    $sql = "UPDATE `inventory` SET ";
    $sql .= " `is_active` = :is_active, ";
    $sql .= " `name` = :name, ";
    $sql .= " `serial_number` =:serial_number, ";
    $sql .= " `category` = :category, ";
    $sql .= " `type` = :type, ";
    if(!empty($req["photo"])){
        $sql .= " `photo` = :photo, ";
    }
    $sql .= " `brand` = :brand ";
    $sql .= "  WHERE `id` = :inventory_id  ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":is_active",$req["is_active"]);
    $stmt->bindParam(":name",$req["name"]);
    $stmt->bindParam(":serial_number",$req["serial_number"]);
    $stmt->bindParam(":category",$req["category"]);
    $stmt->bindParam(":type",$req["type"]);
    $stmt->bindParam(":brand",$req["brand"]);
    $stmt->bindParam(":inventory_id",$req["inventory_id"]);
    if(!empty($req["photo"])){
        $stmt->bindParam(":photo",$req["photo"]);
    }
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Data update successful.", false);
        header("location:../../index.php?page=inventory/edit&inventory_id=".$req["inventory_id"]);
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "inventory_id" => $_GET["inventory_id"],
        // "profile" => $_GET["photo"],
    );

    $required = array(  
        "inventory_id" => "Inventory ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=inventory");
        exit();
    }

    // if($req["profile"]){
    //     unlink("../../uploads/inventory/" . $req["photo"]);
    // }

try{
    $sql = "UPDATE `inventory` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` = :inventory_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":inventory_id",$req["inventory_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=inventory");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "inventory_id" => $_POST["ch"],
    );

    $required = array(  
        "inventory_id" => "Inventory ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=inventory_id");
        exit();
    }

    $arr = array();
    $inventory_id = implode(",", $req["inventory_id"]);
    // foreach($_POST["ch"] as $v){
    //     $arr[] = explode(",",$v);
    // }

    // $inventory_id = "";
    // $photo = "";

    // foreach($arr as $v){
    //     $inventory_id .= $v[0].",";
    //     $photo .= $v[1].",";

    // }

    // $photo_ex = explode(",", $photo);
    // foreach($photo_ex as $v){
    //     if($v){
    //         unlink("../../uploads/inventory/" . $v);
    //     }
    // }

    // $inventory_id = substr($inventory_id, 0,-1);
try{
    $sql = "UPDATE `inventory` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` IN ($inventory_id) ";

    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=inventory");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "confirm_delete"){

    $req = array(
        "inventory_id" => $_GET["inventory_id"],
        "photo" => $_GET["photo"],
    );

    $required = array(  
        "inventory_id" => "Inventory ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=inventory");
        exit();
    }

    if($req["photo"]){
        unlink("../../uploads/inventory/" . $req["photo"]);
    }

    try{
        $sql = "DELETE FROM `inventory`  ";
        $sql .= "  WHERE `id` = :inventory_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":inventory_id",$req["inventory_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Successful data deletion.", false);
            header("location:../../index.php?page=inventory/delete");
            exit();
        
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}elseif(isset($_GET["action"]) && $_GET["action"] == "cancel_delete"){

    $req = array(
        "inventory_id" => $_GET["inventory_id"],
    );

    $required = array(  
        "inventory_id" => "Inventory ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=inventory");
        exit();
    }

    try{
        $sql = "UPDATE `inventory` SET  ";
        $sql .= " `is_delete` = 'N'  ";
        $sql .= "  WHERE `id` = :inventory_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":inventory_id",$req["inventory_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Cancel successful.", false);
            header("location:../../index.php?page=inventory/delete");
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