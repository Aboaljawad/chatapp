<?php
session_start();
include "db.php";
$counter =0;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$stmt = $con-> prepare("INSERT INTO `chat` (`id`, `name`, `message`, `date`) VALUES (NULL, ? , ? , CURRENT_TIMESTAMP)");
$stmt->execute([$_SESSION['user'] , $_POST["msg"]]);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Room</title>
    <link rel="stylesheet" href="style.css">
   <!-- <script>
        function aj(){
            var req = new XMLHttpRequest();
            req.onreadystatechange = function(){
                if(req.readyState==4 && req.status==200)
                {
                    decument.getElementById('chat').innerHTML = req.responseText;
                }
            }
            req.open('GET' , 'chat.php' ,true);
            req.send();
        }
    </script>-->
</head>
<body>
    <div id="container">
    <input type = "button" value="clear" class="sub1">
        <div id="chatbox">
           <!-- <div id="chat"> -->
        <div id="chatdata">
                <?php
                $sta = $con-> prepare("SELECT * from chat order by id desc ");
                $sta -> execute();
                while($row = $sta->fetch())
                {
                    $name = $row['name'];
                    $message = $row['message'];
                    $date = $row['date'];
                    if(empty($message))
                     continue;
                    ?>
                    <span class = "s1"><?php echo $name; ?></span>
                    <span class = "s2">:</span>
                    <span class = "s3"><?php echo $message; ?></span>
                    <span class = "s4"><?php echo $date; ?></span>
                    <?php
                    echo "<br>";
                }
                ?>
                </div>
           </div>
        <!--</div> -->
        <br><br>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
             <textarea name="msg" placeholder="enter your message"></textarea> 
             <input type="submit" value="Send" class="sub">
             
        </form>
    </div>
</body>
</html>