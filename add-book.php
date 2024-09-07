<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Redirect to login if not logged in
    exit();
}

$servername = "localhost";
$username = "root";
$password = "Charan@2007";
$dbname = "library_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];

    $sql = "INSERT INTO books (title, author, genre, year) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $author, $genre, $year);

    if ($stmt->execute()) {
        $message = "Book added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('img1.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: rgba(51, 51, 51, 0.9);
            color: white;
            padding: 22.44px 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
            padding: 0 0 10px 0;
            font-size: 42px;
        }
        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        header nav ul li {
            margin: 0 15px;
        }
        header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }
        .container {
            padding: 20px;
        }
        .form-container {
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container form label {
            margin-bottom: 5px;
        }
        .form-container form input[type="text"],
        .form-container form input[type="number"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container form input[type="submit"] {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Welcome to the Library Management System</h1>
            <nav>
                <ul>
                <li><a href="index2.html">Home</a></li>
                <li><a href="books2.php">Books</a></li>
                <li><a href="add-book.php">Add Book</a></li>
                <li><a href="view_requests.php">Requests</a></li>
                <li><a href="profile2.php">Profile</a></li>
                <li><a href="login.html">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <div class="form-container">
            <h2>Add New Book</h2>
            <?php if (isset($message)) { echo '<p class="message">' . $message . '</p>'; } ?>
            <form method="post" action="add-book.php">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" required>
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" required>
                <input type="submit" value="Add Book">
            </form>
        </div>
    </div>
</body>
</html>
