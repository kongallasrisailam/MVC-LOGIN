<?php
session_start();
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:/xampp/htdocs/jobs/views');


function login($postData,$conn) {
    //print_r($postData);
   
    if(isset($postData['login'])) {

        $row= login_database($postData,$conn);
        if(count($row)){
            if (($row['email']===$postData['username'] || (string)$row['phone'] === $postData['username']) && $row['password'] === $postData['password']) {
                $_SESSION['details']=$row;
                header('Location:index.php');
                die();
            } else {
               $_SESSION['login']="please enter valid password"; 
            }
            
        } else {
            $_SESSION['login']="this email or phone not registered";
            
        }
    }
    else{
        if(empty($_SESSION['details']))
        {
            include_once("views/login.tpl.php");
        }else{
            header("Location:index.php");
        }
        
    }
}
function register($postData, $conn) {
    include_once("validation.php");
    
    // print_r($postData)."<br>";
    // echo $_SERVER['REQUEST_METHOD'];

    
    if (!empty($_POST)) {
        
        $errors = regivalidation($postData);
        $_SESSION['register'] = $errors;

       
        if (empty($errors)) {
            $reg = reginserting($postData, $conn);
            if (!empty($reg)) {
                $_SESSION['register'] = $reg;
            }
        }
    }
        if(empty($_SESSION['details']))
        {
            include_once("views/register.tpl.php");
        }else{
            header("Location:index.php");
        }
        
    
}


 function Index() {

    
    
    if(!empty($_SESSION['details']))
    {
        if(!empty($_SESSION['uperrors']))
            {
                echo $_SESSION['uperrors'];
            }
        include_once("views/index.tpl.php");
    }
    else{
        header('location:index.php?path=login');
    }
}

function logout()
{
     session_unset();
     session_destroy();
     header("Location:index.php");
}
function profileUpdate($postdata,$conn)
{
    
    $id=$_GET['id'];
    $result=update_display($id,$conn);
    
    if(!empty($_POST))
    {
        $rows = update_databsae($postdata,$conn);
        if ($rows > 0) {
            $result=update_display($id,$conn);
            $_SESSION['details']=null;
            $_SESSION['details']=$result;
            echo '<script type="text/JavaScript">';
            echo 'alert("Updation is done successfully....");';
            echo 'window.location.href = "index.php";'; 
            echo '</script>';
                die();
        } else {
            $_SESSION['uperrors']="details are not updated";
            header("Location:index.php") ;
        }    
    }
    else{
        if(!empty($_SESSION['details']))
         {
            
            include_once("views/update.tpl.php");
         }
         else{
            header("Location:index.php");
         }
    }
}




