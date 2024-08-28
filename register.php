<?php
session_start();
include('include/config.php');


if(isset($_POST['submit'])){
   
    $name= $_POST['name'];
    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $username= $_POST['username'];
    $password= $_POST['password'];
    $city= $_POST['city'];
    
$select = " SELECT * FROM user WHERE username = '$username' && password = '$password' ";

$result = mysqli_query($conn, $select);

if(mysqli_num_rows($result) >0 ){


   echo"<script>
   alert('user already exists!!!');
   window.location.href='loginpage.php';
   </script>";
header("Location:loginpage.php");

}else{

      $insert = "INSERT INTO user(name,email,phone,username,password,city) VALUES('$name','$email','$phone','$username','$password','$city')";
      mysqli_query($conn, $insert);
      header('location:loginpage.php');
   
}

};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travel & Tour - Create Account</title>
    <link rel="stylesheet" href="css/register.css"/>
</head>
<body>
    <div class="container">
        <form method="post" class="book-form" onsubmit="return validations()">
            <h2 style="color: black;"><b>Registration</b></h2>
            <div class="form-group">
                <input type="text" placeholder="Name" id="name" name="name">
            </div>
            <div class="form-group">
                <input type="email" placeholder="Email" id="email" name="email">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Phone" id="phone" name="phone">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Username" id="username" name="username">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" id="password" name="password">
            </div>
            <div class="form-group">
                <label><b>City:</b></label>
                <select id="city" name="city">
                    <option value="new-york">New York</option>
                    <option value="london">London</option>
                    <option value="paris">Paris</option>
                    <option value="tokyo">Tokyo</option>
                    <option value="sydney">Sydney</option>
                </select>
            </div>
            <input type="submit" value="Submit" id="submit" name="submit">
        </form>
    </div>
    <script>
        function validations() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (name === "" || username === "" || email === "" || phone === "" || password === "") {
                alert("All fields are required");
                return false;
            }
            if (password.length < 4) {
                alert("Password is too short");
                return false;
            }
            if (password.length > 10) {
                alert("Password is too long");
                return false;
            }
            if (phone.length !== 10 || isNaN(phone)) {
                alert("Contact number should have 10 digits and must be numeric");
                return false;
            }
            return true; // If all validations pass, the form will submit
        }
    </script>
</body>
</html>
