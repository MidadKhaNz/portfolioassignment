<?php
include 'db.php';
session_start();

if(!isset($_SESSION['email'])){
    header("Location: index.php");
    exit;
}

//  DELETE functionality (if delete button clicked)
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM test WHERE id=$id");
    header("Location: users.php");
    exit;
}

//  UPDATE functionality (if edit form submitted)
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];

    mysqli_query($con, "UPDATE test SET name='$name', email='$email', phone='$phone', city='$city' WHERE id=$id");
    header("Location: users.php");
    exit;
}

//  If edit button clicked, fetch single user info
$edit_user = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = mysqli_query($con, "SELECT * FROM test WHERE id=$id");
    $edit_user = mysqli_fetch_assoc($result);
}

//  Load all users
$result = mysqli_query($con, "SELECT * FROM test");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Registered Users</title>
<style>
body {
    font-family: Arial;
    margin: 40px;
}
table {
    border-collapse: collapse;
    width: 80%;
    margin-bottom: 30px;
}
th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}
th {
    background: #007BFF;
    color: white;
}
a, button {
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}
a.edit-btn {
    background: #28a745;
    color: white;
}
a.delete-btn {
    background: #e74c3c;
    color: white;
}
a.logout {
    color: #007BFF;
}
form {
    background: #f2f2f2;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
}
input[type=text], input[type=email] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
}
input[type=submit] {
    background: #007BFF;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
}
</style>
</head>
<body>

<h2>Registered Users</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>City</th>
    <th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?= $row['id']; ?></td>
    <td><?= htmlspecialchars($row['name']); ?></td>
    <td><?= htmlspecialchars($row['email']); ?></td>
    <td><?= htmlspecialchars($row['phone']); ?></td>
    <td><?= htmlspecialchars($row['city']); ?></td>
    <td>
        <a class="edit-btn" href="users.php?edit=<?= $row['id']; ?>">Edit</a>
        <a class="delete-btn" href="users.php?delete=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<a href="index.php?logout=true" class="logout">Logout</a>

<?php if($edit_user): ?>
    <h3>Edit User</h3>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?= $edit_user['id']; ?>">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= $edit_user['name']; ?>" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $edit_user['email']; ?>" required><br>
        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?= $edit_user['phone']; ?>"><br>
        <label>City:</label><br>
        <input type="text" name="city" value="<?= $edit_user['city']; ?>"><br>
        <input type="submit" name="update" value="Save Changes">
    </form>
<?php endif; ?>

</body>
</html>
