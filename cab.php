<?php
session_start();
include('include/config.php');

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql="select * from cab_1 where Source='$source' && Destination='$destination' && Date='$date' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $cid = $row["c_id"];
    
    $insert = "INSERT INTO cab (`id`, `Source`, `Destination`, `Date`,  `Time`, `cid`) VALUES ('$id', '$source', '$destination', '$date', '$time','$cid')";
    mysqli_query($conn, $insert);
    header('location: menu.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travel & Tour - Create Account</title>
    <link rel="stylesheet" href="css/flight.css"/>
</head>
<body>
    <div class="container">
        <form method="post" class="book-form" onsubmit="return validations()">
            <h2><b>Cab Booking</b></h2>
            
            <div class="form-group">
                <input type="hidden" placeholder="Id" id="id" name="id">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Source" id="source" name="source">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Destination" id="destination" name="destination">
            </div>
            <div class="form-group">
                <input type="date" placeholder="Date" id="date" name="date">
            </div>
           
            <div class="form-group">
                <input type="time" placeholder="Time" id="time" name="time">
            </div>

            <div class="form-group">
                <input type="hidden" placeholder="cab_id" id="cid" name="cid">
            </div>
            
            <input type="submit" value="Submit" id="submit" name="submit">
        </form>
    </div>
    <script>
        function validations() {
            var id = document.getElementById("id").value;
            var source = document.getElementById("source").value;
            var destination = document.getElementById("destination").value;
            var date = document.getElementById("date").value;
            var departure = document.getElementById("time").value;

            if (source === "" || destination === "" || date === "" || time === "") {
                alert("All fields are required");
                return false;
            }
            
            return true; // If all validations pass, the form will submit
        }
    </script>
</body>
</html>