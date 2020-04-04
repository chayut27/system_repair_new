<?php


function validate($req, $required){
    foreach($required as $key => $value){
        if(!isset($req[$key]) || empty($req[$key]) && $req[$key] != "0"){
            return false;
        }
    }
    return true;
}

function filter_var_string($req ,$name = NULL){
    $response = filter_var($req,FILTER_SANITIZE_STRING);
    if($response){
        return $response;
    }else{
        die("$name is not a valid string");
    }
    
}

function filter_var_email($req ,$name = NULL){
    $response = filter_var($req,FILTER_VALIDATE_EMAIL);
    if($response){
        return $response;
    }else{
        die("$name is not a valid email address");
    }
}

function filter_var_int($req ,$name = NULL){
    $response = (int)filter_var($req,FILTER_VALIDATE_INT);
    if($response){
        return $response;
    }else{
        die("$name is not a valid integer");
    }
}

// class CRUD extends DB{
//     function login($req){
//         try{
//             $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `username` = :username ");
//             $stmt->bindParam(":username",$req["username"]);
//             // $stmt->bindParam(":password",$req["password"]);
//             $stmt->execute();
//             $data = array();
//             // if($count = $stmt->rowCount() > 0){
//             $data = $stmt->fetch(PDO::FETCH_ASSOC);
//             if($data === FALSE){
//                 $response = array(
//                     "status" => FALSE,
//                     "msg" => "Incorrect username / password combination!",
//                 );
//             }else{

//                 $validPassword = password_verify($req["password"], $data['password']);

//                 if($validPassword){
//                     $_SESSION["LOGIN"] = TRUE;
//                     $_SESSION["USER_ID"] = $data["id"];
//                     $_SESSION["USERNAME"] = $data["username"];
    
//                     $response = array(
//                         "status" => TRUE,
//                         "msg" => "Login Success.",
//                     );
//                 }else{
//                     $response = array(
//                         "status" => FALSE,
//                         "msg" => "Incorrect username / password combination!",
//                     );
//                 }
               
//             }
           
//             return $response;

//         }catch(PDOException $e){
//             echo "Error: " . $e->getMessage();
//             die();
//         }
        
//     }
// }


function lang($text, $echo = true){
    global $conn;

    $lang = isset($_SESSION["LANGUAGE"]) ? $_SESSION["LANGUAGE"] : "en" ;

    $stmt =  $conn->prepare(" DESCRIBE ui_language   ");
    $stmt->bindParam(":lang",$lang);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // $sql = "SELECT column_name FROM information_schema.columns WHERE table_name =?";
    // $stm = $pdo->prepare($sql);
    // $stm->execute([$table]);
    // return $stm->fetchAll(PDO::FETCH_COLUMN);
    $conditions = false;
    if($data === FALSE){
        if($echo){
            echo $text;
        }else{
            return $text;
        }
        
    }else{
        // print_r($data);
        foreach($data as $row){
            if($row["Field"] == $lang){
                $conditions = true;
            }
        }

        if($conditions){
            $stmt =  $conn->prepare("SELECT * FROM ui_language WHERE en = :txt OR th = :txt ");
            // $txt = "$text";
            // $txt = "%$text%";
            $stmt->bindParam(":txt",$text, PDO::PARAM_STR);
            $stmt->execute();
            $data = array();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if($data === FALSE){

                $sql = "INSERT INTO `ui_language` SET ";
                $sql .= " en = :txt ";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":txt",$text);
                $result = $stmt->execute();
            
                if($echo){
                    echo $text;
                }else{
                    return $text;
                }   
           
            }else{
                $txt_lang = !empty($data[$lang]) ? $data[$lang] : $data["en"];

                if($echo){
                    echo $txt_lang;
                }else{
                    return $txt_lang;
                }
                
            }
        }
       
    }

   
}


function login($req){
    global $conn;
    try{
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = :username AND `is_active` = 'Y' ");
        $stmt->bindParam(":username",filter_var_string($req["username"], "Username"));
        // $stmt->bindParam(":password",$req["password"]);
        $stmt->execute();
        $data = array();
        // if($count = $stmt->rowCount() > 0){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data === FALSE){
            $response = array(
                "status" => FALSE,
                "msg" => "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง กรุณาลองอีกครั้ง",
            );
        }else{

            $validPassword = password_verify(filter_var_string($req["password"], "Password"), $data['password']);

            if($validPassword){
                $_SESSION["LOGIN"] = TRUE;
                $_SESSION["USER_ID"] = $data["id"];
                $_SESSION["USERNAME"] = $data["username"];
                $_SESSION["FIRST_NAME"] = $data["first_name"];
                $_SESSION["LAST_NAME"] = $data["last_name"];
                $_SESSION["PROFILE"] = $data["profile"];
                $_SESSION["POSITION"] = $data["position"];

                $response = array(
                    "status" => TRUE,
                    "msg" => "เข้าสู่ระบบสำเร็จ",
                );
            }else{
                $response = array(
                    "status" => FALSE,
                    "msg" => "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง กรุณาลองอีกครั้ง",
                );
            }
            
        }
        
        return $response;

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }
    
}

function fetch_all($fields, $table, $conditions = NULL , $req = NULL){
    global $conn;
    try{
        $stmt = $conn->prepare("SELECT $fields FROM `$table` $conditions ");
        if(!empty($req)){
            foreach($req as $key => $v){
                $stmt->bindParam(":".$key,$v);
            }
        }
        $result = $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $data[] = $row;
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }
   
    return $data;
}

function num_rows($table){
    global $conn;
    try{
        $stmt = $conn->prepare("SELECT * FROM `$table` WHERE `status` = 'Y' ");
        $result = $stmt->execute();
        $count = $stmt->rowCount();
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }
   
    return $count;
}


?>