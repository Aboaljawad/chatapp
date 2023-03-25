<?php
session_start();
include "website/db.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$stmt = $con-> prepare(" SELECT password , id , name from user Where name=? and password= ?");
$stmt -> execute(array($_POST['usr'] ,sha1($_POST['pass'])));
$stmt->fetch();
$count = $stmt-> rowCount();
if($count > 0)
{
    $user = $_POST['usr'];
    $_SESSION['user'] = $user;
    if(isset($_SESSION['user'])){
        header("Location: website/index.php");
        exit();
    }
}
else{
    header("Location: website/none.php");
    exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="website/style.css">  
</head>
<body>
<center>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <label><h1> <br><br>Login</h1> </label><br><br>
    <input type="text" name="usr" class="usr" placeholder="Enter you username"><br><br>
    <input type="password" name="pass" class="pass" placeholder="Enter you password"><br><br>
    <input type="submit" vlaue = "Send" class="btn">
    </form>
</center>
</body>
</html>
