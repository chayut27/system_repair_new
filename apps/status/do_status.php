<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "save_status"){


    if(!empty($_POST["status_id"])){

        $req = array(
            "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "N",
            "status_name" => isset($_POST["status_name"]) ? $_POST["status_name"] : "",
            "bg_color" => isset($_POST["bg_color"]) ? $_POST["bg_color"] : "",
            "text_color" => isset($_POST["text_color"]) ? $_POST["text_color"] : "",
            "status_id" => isset($_POST["status_id"]) ? $_POST["status_id"] : "",
        );

    
        $required = array(
            "status_name" => "status_name",   
            "status_id" => "status_id",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = lang("Invalid Data.", false);
            header("location:../../index.php?page=status");
            exit();
        }

        $req["status_name"] = filter_var_string($_POST["status_name"], "Status Name");

        try{
            $sql = "UPDATE `status` SET ";
            $sql .= " `is_active` = :is_active, ";
            $sql .= " `name` = :status_name, ";
            $sql .= " `bg_color` = :bg_color, ";
            $sql .= " `text_color` = :text_color ";
            $sql .= "  WHERE `id` = :status_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":is_active",$req["is_active"]);
            $stmt->bindParam(":status_name",$req["status_name"]);
            $stmt->bindParam(":bg_color",$req["bg_color"]);
            $stmt->bindParam(":text_color",$req["text_color"]);
            $stmt->bindParam(":status_id",$req["status_id"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = lang("Data update successful.", false);
                header("location:../../index.php?page=status");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }

    }else{
        $req = array(
            "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "N",
            "status_name" => isset($_POST["status_name"]) ? $_POST["status_name"] : "",
            "bg_color" => isset($_POST["bg_color"]) ? $_POST["bg_color"] : "",
            "text_color" => isset($_POST["text_color"]) ? $_POST["text_color"] : "",
            "color" => isset($_POST["color"]) ? $_POST["color"] : "",
        );
    
        $required = array(
            "status_name" => "Status Name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = lang("Invalid Data.", false);
            header("location:../../index.php?page=status");
            exit();
        }

        $req["status_name"] = filter_var_string($_POST["status_name"], "Status Name");

        try{
            $sql = "INSERT INTO `status` SET ";
            $sql .= " `is_active` = :is_active, ";
            $sql .= " `bg_color` = :bg_color, ";
            $sql .= " `text_color` = :text_color, ";
            $sql .= " `name` = :status_name ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":is_active",$req["is_active"]);
            $stmt->bindParam(":status_name",$req["status_name"]);
            $stmt->bindParam(":bg_color",$req["bg_color"]);
            $stmt->bindParam(":text_color",$req["text_color"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = lang("Successfully saved data.", false);
                header("location:../../index.php?page=status");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "status_id" => $_GET["status_id"],
    );

    $required = array(  
        "status_id" => "Status ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=status");
        exit();
    }

try{
    $sql = "UPDATE `status` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` = :status_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":status_id",$req["status_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=status");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "status_id" => $_POST["ch"],
    );

    $required = array(  
        "status_id" => "Status ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=status");
        exit();
    }

    $arr = array();
    $status_id = implode(",", $req["status_id"]);

try{

    $sql = "UPDATE `status` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` IN ($status_id) ";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=status");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "confirm_delete"){

    $req = array(
        "status_id" => $_GET["status_id"],
    );

    $required = array(  
        "status_id" => "Status ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=status");
        exit();
    }

    try{
        $sql = "DELETE FROM `status`  ";
        $sql .= "  WHERE `id` = :status_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":status_id",$req["status_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Successful data deletion.", false);
            header("location:../../index.php?page=status/delete");
            exit();
        
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}elseif(isset($_GET["action"]) && $_GET["action"] == "cancel_delete"){

    $req = array(
        "status_id" => $_GET["status_id"],
    );

    $required = array(  
        "status_id" => "Status ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=status");
        exit();
    }

    try{
        $sql = "UPDATE `status` SET  ";
        $sql .= " `is_delete` = 'N'  ";
        $sql .= "  WHERE `id` = :status_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":status_id",$req["status_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Cancel successful.", false);
            header("location:../../index.php?page=status/delete");
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