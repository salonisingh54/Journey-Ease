<?php
session_start();

if(isset($_POST['submit'])){
    include('include/config.php');
   
    $username= $_POST['username'];
    $password= $_POST['password'];
    
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($row){
        if($password == $row['password']){
            header('Location: menu.php'); // Assuming homep.php is in the same directory as this file
            exit();
        }else{
            echo '<script>alert("Incorrect password");</script>';
        }
    }else{
        echo '<script>alert("Invalid username");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="css/loginpage.css"/>
</head>
<body>
    <div class="login_box">
        <h2 id="a"style="color: black;"><b>Login</b></h2>
        <form method="post" onsubmit=" return validation()">
            <input type="text" placeholder="Username" required id="b" name="username">
            <input type="password" placeholder="Password" required id="c" name="password">
            
            
            <input type="submit" value="Login" id="d" name="submit">
            <div class="create_account">
                <p><b>Don't have an account?</b> <a href="register.php">Register Here</a></p>
            </div>
        </form>
    </div>
    <script>
        function validation() {
            
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username === "" || password === "") {
                alert("All fields are required");
                return false;
            }
            
            return true; // If all validations pass, the form will submit
        }
    </script>
</body>
</html>
