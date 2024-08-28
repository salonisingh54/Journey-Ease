<?php
// Include your database connection file
include('include/config.php');

// Check if a delete request is made
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Use prepared statement to prevent SQL injection
    $delete_query = "DELETE FROM user WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $delete_id);
    mysqli_stmt_execute($stmt);
    
    // Redirect back to the admin panel after deletion
    header('Location: admin.php');
    exit();
}

// Check if a modify request is made
if(isset($_POST['modify_id'])) {
    $modify_id = $_POST['modify_id'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    
    // Use prepared statement to prevent SQL injection
    $update_query = "UPDATE user SET username = ?, email = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, "ssi", $new_username, $new_email, $modify_id);
    mysqli_stmt_execute($stmt);
    
    // Redirect back to the admin panel after modification
    header('Location: admin.php');
    exit();
}

// Fetch all users from the database
$select_query = "SELECT * FROM user";
$result = mysqli_query($conn, $select_query);

// Display users in a table
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr>";
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['username']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>
          <a href='admin.php?delete_id=".$row['id']."'>Delete</a> |
          <a href='admin.php?modify_id=".$row['id']."'>Modify</a>
          </td>";
    echo "</tr>";
}
echo "</table>";

// Display form for modifying user information if modify_id is set
if(isset($_GET['modify_id'])) {
    $modify_id = $_GET['modify_id'];
    $select_query = "SELECT * FROM user WHERE id = $modify_id";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_fetch_assoc($result);
?>

<!-- Form for modifying user information -->
<form action="admin.php" method="post">
    <input type="hidden" name="modify_id" value="<?php echo $modify_id; ?>">
    <label for="new_username">New Username:</label>
    <input type="text" id="new_username" name="new_username" value="<?php echo $row['username']; ?>" required><br><br>
    <label for="new_email">New Email:</label>
    <input type="email" id="new_email" name="new_email" value="<?php echo $row['email']; ?>" required><br><br>
    <button type="submit">Modify User</button>
</form>

<?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

h1, h2 {
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid #ccc;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
button {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

button {
    background-color: #333;
    color: #fff;
    cursor: pointer;
}

button:hover {
    background-color: #555;
}
</style>
</head>
<body>
<body>
    <h1>User Management</h1>

    <hr>
    <h2>Add New User</h2>
    <form action="admin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <button type="submit">Add User</button>
    </form>
</body>
</html>
