<?php
session_start();
include 'db.php';

// ✅ If the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['username'];

// ✅ Fetch all courses from the database
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Student Portal</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9f9f9;
            margin: 0;
        }
        h2 {
            margin-bottom: 10px;
        }
        h3 {
            margin-top: 30px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background: #fff;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px #ccc;
            transition: transform 0.2s ease;
        }
        li:hover {
            transform: scale(1.02);
        }
        li a {
            text-decoration: none;
            color: #333;
            display: block;
        }
        li a:hover {
            color: #007BFF;
        }
        a.logout {
            float: right;
            text-decoration: none;
            background: #f44336;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
        }
        a.logout:hover {
            background: #c9302c;
        }
    </style>
</head>
<body>

<a href="logout.php" class="logout">Logout</a>
<h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>

<h3>Available Courses:</h3>
<ul>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($course = $result->fetch_assoc()): ?>
            <li>
                <?php if (!empty($course['link'])): ?>
                    <a href="<?php echo htmlspecialchars($course['link']); ?>" target="_blank">
                        <strong><?php echo htmlspecialchars($course['title']); ?></strong><br>
                        <?php echo htmlspecialchars($course['description']); ?>
                    </a>
                <?php else: ?>
                    <strong><?php echo htmlspecialchars($course['title']); ?></strong><br>
                    <?php echo htmlspecialchars($course['description']); ?>
                <?php endif; ?>
            </li>
        <?php endwhile; ?>
    <?php else: ?>
        <li>No courses available.</li>
    <?php endif; ?>
</ul>

</body>
</html>
