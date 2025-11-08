<?php
session_start();
include 'db.php';

// Handle login
$login_msg = "";
if (isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $_POST['email'];
    $pass  = $_POST['pass'];

    $sql = "SELECT * FROM test WHERE email='$email' AND password='$pass'";
    $res = mysqli_query($con, $sql);

    if (mysqli_num_rows($res) > 0) {
        $_SESSION['email'] = $email;
        $login_msg = " Login successful! Welcome " . $email;
    } else {
        $login_msg = " Invalid email or password!";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login & Signup</title>
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
</head>
<body>

<div class="box">
<?php if(isset($_SESSION['email'])): ?>
    <h2>Welcome, <?php echo $_SESSION['email']; ?></h2>
    <a href="index.php?logout=true">Logout</a>
    <p><a href="users.php">View Users</a></p>
<?php else: ?>
    <!-- LOGIN FORM -->
    <div id="loginForm">
        <h2>Login Form</h2>
        <?php if($login_msg){ echo "<p style='color:red;'>$login_msg</p>"; } ?>
        <form method="post" action="">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
        <p>Don’t have an account? <a href="javascript:void(0);" onclick="showSignup()">Sign Up here</a></p>
    </div>

    <!-- SIGNUP FORM -->
    <div id="signupForm" style="display:none;">
        <h2>Sign Up Form</h2>
        <form method="post" action="save.php">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="tel" name="phone" placeholder="Enter Number">
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" placeholder="Enter City">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Sign Up">
            </div>
        </form>
    </div>
<?php endif; ?>
</div>

</body>
</html>
