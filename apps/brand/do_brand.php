<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "save_brand"){


    if(!empty($_POST["brand_id"])){

        $req = array(
            "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "",
            "type" => isset($_POST["type"]) ? $_POST["type"] : "",
            "brand_name" => isset($_POST["brand_name"]) ? $_POST["brand_name"] :  "",
            "brand_id" => isset($_POST["brand_id"]) ? $_POST["brand_id"] : "",
        );
    
        $required = array(
            "type" => "Type",   
            "brand_name" => "Brand Name",   
            "brand_id" => "Brand ID",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = lang("Invalid Data.", false);
            header("location:../../index.php?page=brand");
            exit();
        }

        $req["brand_name"] = filter_var_string($_POST["brand_name"], "brand Name");

        try{
            $sql = "UPDATE `brand` SET ";
            $sql .= " `is_active` = :is_active, ";
            $sql .= " `type` = :type, ";
            $sql .= " `name` = :brand_name ";
            $sql .= "  WHERE `id` = :brand_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":is_active",$req["is_active"]);
            $stmt->bindParam(":type",$req["type"]);
            $stmt->bindParam(":brand_name",$req["brand_name"]);
            $stmt->bindParam(":brand_id",$req["brand_id"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = lang("Data update successful.", false);
                header("location:../../index.php?page=brand");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }

    }else{
        $req = array(
            "type" => isset($_POST["type"]) ? $_POST["type"] : "",
            "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "",
            "brand_name" => isset($_POST["brand_name"]) ? $_POST["brand_name"] :  "",
        );
    
        $required = array(
            "type" => "Type",   
            "brand_name" => "Brand Name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = lang("Invalid Data.", false);
            header("location:../../index.php?page=brand");
            exit();
        }

        $req["brand_name"] = filter_var_string($_POST["brand_name"], "brand Name");

        try{
            $sql = "INSERT INTO `brand` SET ";
            $sql .= " `is_active` = :is_active, ";
            $sql .= " `type` = :type, ";
            $sql .= " `name` = :brand_name ";
            // $sql .= "  WHERE `id` = :id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":is_active",$req["is_active"]);
            $stmt->bindParam(":type",$req["type"]);
            $stmt->bindParam(":brand_name",$req["brand_name"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = lang("Successfully saved data.", false);
                header("location:../../index.php?page=brand");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "brand_id" => $_GET["brand_id"],
    );

    $required = array(  
        "brand_id" => "Brand ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=brand");
        exit();
    }

try{
    $sql = "UPDATE `brand` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` = :brand_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":brand_id",$req["brand_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=brand");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "brand_id" => $_POST["ch"],
    );

    $required = array(  
        "brand_id" => "Brand ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=brand");
        exit();
    }

    $arr = array();
    $brand_id = implode(",", $req["brand_id"]);

try{
    $sql = "UPDATE `brand` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` IN ($brand_id) ";

    echo $sql;
    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=brand");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "confirm_delete"){

    $req = array(
        "brand_id" => $_GET["brand_id"],
    );

    $required = array(  
        "brand_id" => "Brand ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=brand");
        exit();
    }

    try{
        $sql = "DELETE FROM `brand`  ";
        $sql .= "  WHERE `id` = :brand_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":brand_id",$req["brand_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Successful data deletion.", false);
            header("location:../../index.php?page=brand/delete");
            exit();
        
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}elseif(isset($_GET["action"]) && $_GET["action"] == "cancel_delete"){

    $req = array(
        "brand_id" => $_GET["brand_id"],
    );

    $required = array(  
        "brand_id" => "Brand ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=brand");
        exit();
    }

    try{
        $sql = "UPDATE `brand` SET  ";
        $sql .= " `is_delete` = 'N'  ";
        $sql .= "  WHERE `id` = :brand_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":brand_id",$req["brand_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Cancel successful.", false);
            header("location:../../index.php?page=brand/delete");
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