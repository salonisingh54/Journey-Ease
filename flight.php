<?php
session_start();
include('include/config.php');

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $seats = $_POST['seats'];
    $departure = $_POST['departure'];

    $sql="select * from flight_1 where Source='$source' && Destination='$destination' && date='$date' && departure='$departure' ";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $f_id=$row["flight_id"];

    $insert = "INSERT INTO flight (`id`, `source`, `destination`, `date`, `seats`, `departure`,`f_id`) VALUES ('$id', '$source', '$destination', '$date', '$seats', '$departure','$f_id')";
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
            <h2><b>Flight Booking</b></h2>
            
            <div class="form-group">
                <input type="hidden" placeholder="Id" id="id" name="id">
            </div>
            <div class="form-group">
                <select id="source" name="source">
                    <option value="paris">paris</option>
                    <option value="amsterdam">amsterdam</option>
                    <option value="tokyo">tokyo</option>
                    <option value="new york">new york</option>
                </select>
            </div>
            <div class="form-group">
                <select id="destination" name="destination">
                    <option value="bangkok">bangkok</option>
                    <option value="hanoi">hanoi</option>
                    <option value="seoul">seoul</option>
                    <option value="singapore">singapore</option>
                </select>
            </div>
            <div class="form-group">
                <input type="date" placeholder="Date" id="date" name="date">
            </div>
            <div class="form-group">
                <input type="number" placeholder="Seats" id="seats" name="seats">
            </div>
            <div class="form-group">
                <input type="time" placeholder="Departure" id="departure" name="departure">
            </div>
            <div class="form-group">
                <input type="hidden" placeholder="F_Id" id="f_id" name="f_id">
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
            var seats = document.getElementById("seats").value;
            var departure = document.getElementById("departure").value;

            if (source === "" || destination === "" || date === "" || seats === "" || departure === "") {
                alert("All fields are required");
                return false;
            }
            
            return true; // If all validations pass, the form will submit
        }
    </script>
</body>
</html>
