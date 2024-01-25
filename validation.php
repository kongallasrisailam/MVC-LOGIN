<?php
function regivalidation($arr)
{
 // print_r($arr);
 $firstname = $arr['firstname'];
$lastname = $arr['lastname'];
$password = $arr['password'];
$cpassword = $arr['conpassword'];
    $errors =[];
    if(!ctype_alpha($firstname)){
        array_push($errors,"firstname should have only alphabets");
        
      }
    
      if(!ctype_alpha($lastname)){
        array_push($errors,"lastname should have only alphabets");
      }

    if($password == $cpassword)
    {
      if(strlen($password)<=8)
      {
        array_push($errors,"password character sholud be > 8");
      }
      if(!preg_match("@[0-9]@",$password)){
        array_push($errors,"password should atleast one number");
      }
      if(!preg_match("@[A-Z]@",$password)){
        array_push($errors,"password should atleast one capital letter");
      }
      if(!preg_match("@[a-z]@",$password)){
        array_push($errors,"password should atleast one smal letter");
      }
      if(!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',$password)){
        array_push($errors,"password should atleast one special character");
      }
  }
  else{
    
    array_push($errors,"two passwords should match");
  }

  return $errors;
}

function reginserting($arr,$conn)
{
    $reg = [];
    $email = $arr['email'];
  
    $num = register_check($email,$conn);
    if($num>0)
    {
      array_push($reg,"this mail is already exist please login");
    }
    else{
        
        if (register_validation($arr,$conn)) {
          echo '<script type="text/JavaScript">';
            echo 'alert("Registration is done successfully....");';
            echo 'window.location.href = "index.php?path=login";'; 
            echo '</script>';
            //header('Location:index.php?path=login');
            exit();
        } else  {
            echo "sql query not executed";
        }
        
        
    }
    return $reg;
}





