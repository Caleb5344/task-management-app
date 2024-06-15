<?php
// Start the session
session_start();

// Initialize task list if not already done
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Handle form submission to add a new task
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = trim($_POST['task']);
    if (!empty($task)) {
        $_SESSION['tasks'][] = $task;
    }
}

// Handle task deletion
if (isset($_GET['delete'])) {
    $deleteIndex = $_GET['delete'];
    if (isset($_SESSION['tasks'][$deleteIndex])) {
        unset($_SESSION['tasks'][$deleteIndex]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindex the array
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management Application</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 400px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        justify-content: space-between;
    }

    input[type="text"] {
        width: 70%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    button {
        padding: 10px;
        border: none;
        background-color: #28a745;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    ul li {
        padding: 10px;
        background-color: #f4f4f4;
        margin: 5px 0;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    a {
        color: #dc3545;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Task Management Application</h2>
        <form method="POST" action="">
            <input type="text" name="task" placeholder="Enter new task" required>
            <button type="submit">Add Task</button>
        </form>
        <ul>
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
            <li>
                <?php echo htmlspecialchars($task); ?>
                <a href="?delete=<?php echo $index; ?>">Delete</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>