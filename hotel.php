<?php
session_start();
include('include/config.php');

if(isset($_POST['submit'])){
    $hname = $_POST['hname'];
    $id = $_POST['id'];
    $hdate = $_POST['date'];
    $hguest = $_POST['hguest'];
    $hn = $_POST['hn'];
    $hr = $_POST['hr'];
    $hd = $_POST['hd'];

    $sql = "SELECT * FROM hotel WHERE name='$hname'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $hid = $row["hotel_id"];

    $insert = "INSERT INTO hotel_1(`Hotel Name`, `Id`, `Date`, `No. of guests`, `Name of guest`, `No. of rooms`, `No. of days`, `hid`) VALUES ('$hname', '$id', '$hdate', '$hguest', '$hn', '$hr', '$hd', '$hid')";
    mysqli_query($conn, $insert);
    header('location: menu.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travel & Tour - Create Account</title>
    <link rel="stylesheet" href="css/hotel.css"/>
</head>
<body>
    <div class="container">
        <form method="post" class="book-form" onsubmit="return validations()">
            <h2><b>Hotel Booking</b></h2>
            <div class="form-group">
                <select id="hname" name="hname">
                    <option value="Louvre Hotel">Louvre Hotel</option>
                    <option value="Radisson Hotel">Radisson Hotel</option>
                    <option value="Ramada Hotel">Ramada Hotel</option>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" placeholder="Id" id="id" name="id">
            </div>
            <div class="form-group">
                <input type="date" placeholder="Date" id="date" name="date">
            </div>
            <div class="form-group">
                <input type="number" placeholder="No. of guests" id="hguest" name="hguest">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Name of guest" id="hn" name="hn">
            </div>
            <div class="form-group">
                <input type="number" placeholder="No. of rooms" id="hr" name="hr">
            </div>
            <div class="form-group">
                <input type="number" placeholder="No. of days" id="hd" name="hd">
            </div>
            <div class="form-group">
                <input type="hidden" placeholder="hotel_id" id="hid" name="hid">
            </div>
            
            <input type="submit" value="Submit" id="submit" name="submit">
        </form>
    </div>
    <script>
        function validations() {
            var hname = document.getElementById("hname").value;
            var date = document.getElementById("date").value;
            var hguest = document.getElementById("hguest").value;
            var hn = document.getElementById("hn").value;
            var hr = document.getElementById("hr").value;
            var hd = document.getElementById("hd").value;

            if (hname === "" || date === "" || hguest === "" || hn === "" || hr === "" || hd === "") {
                alert("All fields are required");
                return false;
            }
            
            return true; // If all validations pass, the form will submit
        }
    </script>
</body>
</html>