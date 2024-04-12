<?php
// Include the configuration and session files
require_once "config.php";
require_once "session.php";

// Initialize error variable
$error = '';

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username (checking if it's empty)
    if (empty($username)) {
        $error .= '<p>Username is required</p>';
    }

    // Validate password (checking if it's empty)
    if (empty($password)) {
        $error .= '<p>Password is required</p>';
    }

    // Proceed if there are no input validation errors
    if (empty($error)) {
        // Prepare and execute a SELECT query to retrieve user by username
        $query = $db->prepare("SELECT * FROM cychessdb.users WHERE PlayerUsername = ?");
        $query->bind_param('s', $username);
        $query->execute();

        // Get result set
        $result = $query->get_result();

        // Check if a user with the given username exists
        if ($result->num_rows > 0) {
            // Fetch the user row
            $row = $result->fetch_assoc();

            // Verify the password using password_verify function
            if (password_verify($password, $row['PlayerPwd'])) {
                // Password is correct, start a session and redirect to welcome.php
                $_SESSION["userid"] = $row['userID']; // Assuming 'userID' is the primary key of the user
                $_SESSION["user"] = $row;
                header("location: welcome.php");
                exit;
            } else {
                // Password is not valid
                $error .= '<p class="error">Incorrect password</p>';
            }
        } else {
            // No user found with the provided username
            $error .= '<p class="error">No user found with that username</p>';
        }

        // Close the prepared statement
        $query->close();
    }

    // Close the database connection
    mysqli_close($db);
}
?>
