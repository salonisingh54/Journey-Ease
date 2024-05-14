<?php
session_start();
include('include/config.php');

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $restaurant_name = $_POST['name']; // Changed from 'name' to 'restaurant_name'
    $hn = $_POST['hn'];
    $time = $_POST['time'];
    $date = $_POST['date'];

    $sql="select * from restaurant_1 where name='$restaurant_name' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $rid = $row["r_id"];
    
    $insert = "INSERT INTO restaurant (`Id`, `Restaurant Name`, `No of guests`, `Time`, `Date`,`rid`) VALUES ('$id', '$restaurant_name', '$hn', '$time', '$date','$rid')";
    mysqli_query($conn, $insert);
    header('location: menu.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travel & Tour - Create Account</title>
    <link rel="stylesheet" href="css/restaurant.css"/>
</head>
<body>
    <div class="container">
        <form method="post" class="book-form" onsubmit="return validations()">
            <h2><b>Restaurant Booking</b></h2>
            
            <div class="form-group">
                <input type="hidden" placeholder="Id" id="id" name="id">
            </div>
            <div class="form-group">
                <select id="name" name="name">
                    <option value="burger farm">burger farm</option>
                    <option value="dominoz">dominoz</option>
                    <option value="stardom">stardom</option>
                    
                </select>
            </div>
            
            
            <div class="form-group">
                <input type="text" placeholder="No of guests" id="hn" name="hn">
            </div>
            <div class="form-group">
                <input type="time" placeholder="Time" id="time" name="time">
            </div>
            <div class="form-group">
                <input type="date" placeholder="Date" id="date" name="date">
            </div>
           
            <div class="form-group">
                <input type="hidden" placeholder="R_Id" id="rid" name="rid">
            </div>
            <input type="submit" value="Submit" id="submit" name="submit">
        </form>
    </div>
    <script>
        function validations() {
            var id = document.getElementById("id").value;
            var name = document.getElementById("name").value;
            var hn = document.getElementById("hn").value;
            var time = document.getElementById("time").value;
            var date = document.getElementById("date").value;

            if (name === "" || hn === "" || time === "" || date === "") {
                alert("All fields are required");
                return false;
            }
            
            return true; // If all validations pass, the form will submit
        }
    </script>
</body>
</html>
