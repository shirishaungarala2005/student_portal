<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $user, $pass);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $_SESSION['username'] = $user;
    header('Location: dashboard.php');
    exit();
  } else {
    $error = "Invalid username or password!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - Student Portal</title>
  <style>
    body { font-family: Arial; padding: 20px; background:#f2f2f2;}
    form { background:#fff; padding:20px; max-width:300px; margin:auto; border-radius:5px; }
    input { width: 100%; padding:10px; margin:10px 0;}
    button { width: 100%; padding:10px; }
    .error { color: red; }
    p.success { color: green; text-align:center; }
    p.register-link { text-align:center; margin-top: 15px; }
  </style>
</head>
<body>

<h2 style="text-align: center;">Student Login</h2>

<?php if (isset($_GET['registered'])): ?>
  <p class="success">Registration successful! Please login.</p>
<?php endif; ?>

<form method="post" action="">
  <input type="text" name="username" placeholder="Username" required />
  <input type="password" name="password" placeholder="Password" required />
  <button type="submit">Login</button>
</form>

<?php if ($error) echo "<p class='error'>$error</p>"; ?>

<p class="register-link">
  Don't have an account? <a href="register.php">Register here</a>
</p>

</body>
</html>
