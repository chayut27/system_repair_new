<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "update_language"){

foreach($_POST["en"] as $k => $row){
    foreach($row as $k2 => $row2){
        try{
            $sql = "UPDATE `ui_language` SET ";
            $sql .= " `en` = :en, ";
            $sql .= " `th` = :th ";
            $sql .= "  WHERE `id` = :id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":en",$row2);
            $stmt->bindParam(":th",$_POST["th"][$k][$k2]);
            $stmt->bindParam(":id",$k);
            $result = $stmt->execute();
        
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }
    }
}

$_SESSION["STATUS"] = TRUE;
$_SESSION["MSG"] = lang("Data update successful.", false);
header("location:../../index.php?page=language");
exit();


       
}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "id" => $_GET["id"],
    );

    $required = array(  
        "id" => "Language ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=language");
        exit();
    }

    try{
        $sql = "DELETE FROM `ui_language`  ";
        $sql .= "  WHERE `id` = :id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id",$req["id"], PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = lang("Successful data deletion.", false);
            header("location:../../index.php?page=language");
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