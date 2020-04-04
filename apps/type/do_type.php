<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "save_type"){


    if(!empty($_POST["type_id"])){

        $req = array(
            "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "",
            "category" => isset($_POST["category"]) ? $_POST["category"] : "",
            "type_name" => isset($_POST["type_name"]) ? $_POST["type_name"] : "",
            "type_id" => isset($_POST["type_id"]) ? $_POST["type_id"] : "",
        );
    
        $required = array(
            "category" => "category",   
            "type_name" => "type_name",   
            "type_id" => "type_id",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = lang("Invalid Data.", false);
            header("location:../../index.php?page=type");
            exit();
        }

        $req["type_name"] = filter_var_string($_POST["type_name"], "type Name");

        try{
            $sql = "UPDATE `type` SET ";
            $sql .= " `is_active` = :is_active, ";
            $sql .= " `category` = :category, ";
            $sql .= " `name` = :type_name ";
            $sql .= "  WHERE `id` = :type_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":is_active",$req["is_active"]);
            $stmt->bindParam(":category",$req["category"]);
            $stmt->bindParam(":type_name",$req["type_name"]);
            $stmt->bindParam(":type_id",$req["type_id"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = lang("Data update successful.", false);
                header("location:../../index.php?page=type");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }

    }else{
        $req = array(
            "category" => isset($_POST["category"]) ? $_POST["category"] : "",
            "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "",
            "type_name" => isset($_POST["type_name"]) ? $_POST["type_name"] : "",
        );
    
        $required = array(
            "category" => "category",   
            "type_name" => "type_name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = lang("Invalid Data.", false);
            header("location:../../index.php?page=type");
            exit();
        }

        $req["type_name"] = filter_var_string($_POST["type_name"], "type Name");

        try{
            $sql = "INSERT INTO `type` SET ";
            $sql .= " `is_active` = :is_active, ";
            $sql .= " `category` = :category, ";
            $sql .= " `name` = :type_name ";
            // $sql .= "  WHERE `id` = :id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":is_active",$req["is_active"]);
            $stmt->bindParam(":category",$req["category"]);
            $stmt->bindParam(":type_name",$req["type_name"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = lang("Successfully saved data.", false);
                header("location:../../index.php?page=type");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "type_id" => $_GET["type_id"],
    );

    $required = array(  
        "type_id" => "type ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=type");
        exit();
    }

try{
    $sql = "UPDATE `type` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` = :type_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":type_id",$req["type_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=type");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "type_id" => $_POST["ch"],
    );

    $required = array(  
        "type_id" => "type ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=type");
        exit();
    }

    $arr = array();
    $type_id = implode(",", $req["type_id"]);

try{
    $sql = "UPDATE `type` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` IN ($type_id) ";

    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=type");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "confirm_delete"){

    $req = array(
        "type_id" => $_GET["type_id"],
    );

    $required = array(  
        "type_id" => "Type ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=type");
        exit();
    }

    try{
        $sql = "DELETE FROM `type`  ";
        $sql .= "  WHERE `id` = :type_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":type_id",$req["type_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Successful data deletion.", false);
            header("location:../../index.php?page=type/delete");
            exit();
        
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}elseif(isset($_GET["action"]) && $_GET["action"] == "cancel_delete"){

    $req = array(
        "type_id" => $_GET["type_id"],
    );

    $required = array(  
        "type_id" => "Type ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=type");
        exit();
    }

    try{
        $sql = "UPDATE `type` SET  ";
        $sql .= " `is_delete` = 'N'  ";
        $sql .= "  WHERE `id` = :type_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":type_id",$req["type_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Cancel successful.", false);
            header("location:../../index.php?page=type/delete");
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