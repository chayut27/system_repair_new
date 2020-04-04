<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "save_category"){


    if(!empty($_POST["category_id"])){

        $req = array(
            "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "N",
            "category_name" => isset($_POST["category_name"]) ? $_POST["category_name"] : "",
            "category_id" => isset($_POST["category_id"]) ? $_POST["category_id"] : "",
        );

        $required = array(
            "category_name" => "category_name",   
            "category_id" => "category_id",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = lang("Invalid Data.", false);
            header("location:../../index.php?page=category");
            exit();
        }

        $req["category_name"] = filter_var_string($_POST["category_name"], "Category Name");

        try{
            $sql = "UPDATE `category` SET ";
            $sql .= " `is_active` = :is_active, ";
            $sql .= " `name` = :category_name ";
            $sql .= "  WHERE `id` = :category_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":is_active",$req["is_active"]);
            $stmt->bindParam(":category_name",$req["category_name"]);
            $stmt->bindParam(":category_id",$req["category_id"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = lang("Data update successful.", false);
                header("location:../../index.php?page=category");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }

    }else{
        $req = array(
            "is_active" => isset($_POST["is_active"]) ? $_POST["is_active"] : "",
            "category_name" => isset($_POST["category_name"]) ? $_POST["category_name"] : "",
        );
    
        $required = array(
            "category_name" => "category_name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = lang("Invalid Data.", false);
            header("location:../../index.php?page=category");
            exit();
        }

        $req["category_name"] = filter_var_string($_POST["category_name"], "Category Name");

        try{
            $sql = "INSERT INTO `category` SET ";
            $sql .= " `is_active` = :is_active, ";
            $sql .= " `name` = :category_name ";
            // $sql .= "  WHERE `id` = :id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":is_active",$req["is_active"]);
            $stmt->bindParam(":category_name",$req["category_name"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = lang("Successfully saved data.", false);
                header("location:../../index.php?page=category");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "cate_id" => $_GET["cate_id"],
    );

    $required = array(  
        "cate_id" => "Category ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=category");
        exit();
    }

try{
    $sql = "UPDATE `category` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` = :cate_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":cate_id",$req["cate_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=category");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "cate_id" => $_POST["ch"],
    );

    $required = array(  
        "cate_id" => "Category ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=category");
        exit();
    }

    $arr = array();
    $cate_id = implode(",", $req["cate_id"]);

try{
    $sql = "UPDATE `category` SET  ";
    $sql .= " `is_delete` = 'Y'  ";
    $sql .= "  WHERE `id` IN ($cate_id) ";

    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=category");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "confirm_delete"){

    $req = array(
        "cate_id" => $_GET["cate_id"],
    );

    $required = array(  
        "cate_id" => "Category ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=category");
        exit();
    }

    try{
        $sql = "DELETE FROM `category`  ";
        $sql .= "  WHERE `id` = :cate_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":cate_id",$req["cate_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Successful data deletion.", false);
            header("location:../../index.php?page=category/delete");
            exit();
        
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}elseif(isset($_GET["action"]) && $_GET["action"] == "cancel_delete"){

    $req = array(
        "cate_id" => $_GET["cate_id"],
    );

    $required = array(  
        "cate_id" => "Category ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=category");
        exit();
    }

    try{
        $sql = "UPDATE `category` SET  ";
        $sql .= " `is_delete` = 'N'  ";
        $sql .= "  WHERE `id` = :cate_id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":cate_id",$req["cate_id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Cancel successful.", false);
            header("location:../../index.php?page=category/delete");
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