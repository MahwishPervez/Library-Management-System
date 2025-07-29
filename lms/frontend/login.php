<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="styles/utility.css">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="icon" type="image/svg+xml" href="images/logo.svg">
    <title>Login | Lexora - Your Library, Anytime, Anywhere.</title>

</head>

<body>

    <div class="image-container">
        <img src="images/login.jpg" alt="">
    </div>

    <div class="login-form">
        <div class="form-container">
            <h2>Login</h2>
            <form action="../backend/login.php" method="post">
                <div class="input-container">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="email" required>
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-container">
                    <label for="role">Select Role</label>
                    <select id="role" name="role">
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="librarian">Librarian</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <input type="submit" class="login-btn" value="Login">
            </form>

            <div class="form-footer">
                <p class="register-link">New User? <a href="signup.php">Register here</a></p>
                <div class="go-back-btn">
                    <span class="material-symbols-outlined">arrow_back</span><a href="index.php">Go Back</a>
                </div>
            </div>
        </div>
    </div>

    

</body>

</html>