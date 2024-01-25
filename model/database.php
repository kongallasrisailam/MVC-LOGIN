<?php


//require_once("controller/index.php");

$conn = mysqli_connect('localhost','root','','srisailam3');

if(!$conn)
{
    echo "not connected";
    die();
}

function login_database($data,$conn)
{
    
        $sql = "SELECT * FROM register WHERE email='{$data['username']}' or phone='{$data['username']}'";
        $query=mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);

        return $row;
        
}
function register_check($email,$conn)
{
    $sql = "select * from register where email='$email'";
    $num = mysqli_num_rows(mysqli_query($conn,$sql));
    return $num;
    
}
function register_validation($arr,$conn)
{
    $qry = "INSERT INTO register (firstname, lastname, email, password, gender, BOD, phone) 
        VALUES ('{$arr["firstname"]}', '{$arr["lastname"]}', '{$arr["email"]}', '{$arr["password"]}', '{$arr["gender"]}', '{$arr["BOD"]}', '{$arr["phone"]}')"; 


        $result= mysqli_query($conn,$qry);
        
        return $result;
}

function update_databsae($arr,$conn)
{
    $sql = "UPDATE register SET firstname='{$arr["firstname"]}', lastname='{$arr["lastname"]}',email='{$arr["email"]}', phone='{$arr["phone"]}', gender='{$arr["gender"]}', BOD='{$arr["db"]}' WHERE id='{$arr["id"]}'";
        if (mysqli_query($conn, $sql)) {
            return mysqli_affected_rows($conn);
        }
        else{
            echo "sql query is not executed";
        }

}
function update_display($id,$conn)
{
    $qry = "SELECT * FROM register WHERE id='$id'";
    $result =mysqli_fetch_assoc(mysqli_query($conn, $qry));
    return $result;
}

?>