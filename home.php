<?php
    //Connection queries to the database
    $connection = mysqli_connect("localhost","root","","logic");
    if($connection){
        echo "<p>Database Connected</p>";
    }else{
        echo "<p>Something Went Wrong</p>";
        return $connection->mysqli_error_list();
    }
?>
<?php

    if(isset($_POST['logout'])){
        header("LOcation:index.php");
    }
    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Last Seen</title>
</head>
<body>
   <div class="container">
   
        <div class="form-wrapper">
        <!-- During Signup let lastSeen be the current timestamp which then can be updated whenever user logs in again-->
        
        <form action="index.php" method="POST">
         <input type="submit" value="Logout" name="logout">
    </form>
        
        </div>
    
   </div>
</body>
</html>