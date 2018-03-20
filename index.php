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

<!-- Delete a users who is inactive for 2 years and above  -->
<?php 

    //This gives the differnce between last login and current login time of a user
    // Now if the differnce is 2 years we can delete a users we want to

    //This is current Time and Date which is our first Date 
    $f = date("Y-m-d H:i:s");
    $first_date =  new DateTime($f);
    
    //This chunk gives the lastSeen row data from database  and remember this is a static , you should 
    // make this dynamic as well , feel free to apply your own logic
    $email = "test@test.com";
    $sql_lastDateTime = "select lastSeen from users where email='$email'";
    $result = mysqli_query($connection ,$sql_lastDateTime);
    $rows = $result->fetch_array();
    $s = $rows[0];

    $second_date = new DateTime($s);
    
    include_once('timeDifference.php');
    //Difference from above php file
    $myDate = format_interval($difference);

    include_once('timeDifference.php');
    
    //Now you can actually delete a user
    //The above if statement simply checks whether it contains a given string or not

     //Testing the code if last login is more than 1 minutes because 2 years is more time to wait,
     //feel free to implement you own logic
     //this only executes when time difference is exactly 5 minutes , if time is more than 5 minutes 
     //it doesnt work but thats fine because we need to check the time difference of "2 years" ,
     // and that is a long period of time , so this is okay for extremely long period of time
    if(strpos($myDate , '5 minutes')!==false){
        echo "<p>You should delete this user</p>";
        //This is just a test to see whether users gets deleted or not
        $email = "test@test.com";
        $sql_deleteUser = "delete from users where email='$email'";
        mysqli_query($connection ,$sql_deleteUser);

    }


?>




<!-- Login -->
<?php

    if(isset($_POST['submit'])){
        //Escaping string , simply understand it as sanitizing data for data entry
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection ,$_POST['password'] );
        
        $sql = "select * from users where email='$email' and password='$password'"; 
    
        $result = mysqli_query($connection , $sql);
        
        if(mysqli_num_rows($result)>0){
            echo "<p>Welcome</p>";
            //Accuquiring current date and time from php Data
            $current_date = date("Y-m-d H:i:s");
            echo $current_date;
            //Updating the Time stamp for the currently logged in user , you can apply certain condition 
            // in here by specifying user id or anything else , feel free to apply your own logic
            $sql_timestamp = "update users set lastSeen='$current_date'";
            mysqli_query($connection, $sql_timestamp);
            header('Location:home.php');
        }else{
            echo "<p>User doesn't exists </p>";
            header("Location:index.php");
            return;
        }
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
    <!-- This is just a static status for a test user -->
    <div class="user-status">
        <!-- Users last seen status , for now its only for a static user named test , feel free to apply your own logic -->

        <div class="user-status">Last Seen:
            <?php
                //This is just to test the last seen status functionality for this website
                //Hardcoded email address for now , feel free to apply your own logic like selecting an id of
                //Currently logged in users, etc.
                $email = "test@test.com";
                $sql_lastS= "select lastSeen from users where email='$email'";
                $result = mysqli_query($connection ,$sql_lastS);
                $rows = $result->fetch_array();
                echo $rows[0];
                

            ?>
        
        </div>
    </div>
   <div class="container">

        <div class="form-wrapper">
        
        <!-- During Signup let lastSeen be the current timestamp which then can be updated whenever user logs in again-->
        <!-- For more advance setup current locale time and date should be inserted into database and updated as well -->
        <form action="index.php" method="POST">
        Email:
        <input type="text" name="email" />
        <br> <br> <br>
            Password
        <input type="text" name="password"/>
        <br> <br> <br>
         <input type="submit" name="submit"/>
    </form>
        
        </div>
    
   </div>
</body>
</html>