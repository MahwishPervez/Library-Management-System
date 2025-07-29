<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="styles/utility.css">
    <link rel="stylesheet" href="styles/signup.css">
    <link rel="icon" type="image/svg+xml" href="images/logo.svg">
    <title>SignUp | Lexora - Your Library, Anytime, Anywhere.</title>

</head>

<body>

    <div class="image-container">
        <img src="images/signup.jpg" alt="">
    </div>

    <div class="signup-form">
        <div class="form-container">
            <h2>Sign Up</h2>
            <form action="../backend/register.php" method="post">
                <div class="input-container">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-container">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" required maxlength="10" minlength="10">
                </div>
                <div class="id-role-grp">
                    <div class="input-container">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-container">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>
                
                
                <div class="id-role-grp">
                    <div class="input-container">
                        <label for="student-id">University Id</label>
                        <input type="text" id="student-id" name="university-id" required maxlength="9" minlength="9">
                    </div>
                    <div class="input-container">
                        <label for="role">Select Role</label>
                        <select id="role" name="role">
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            <option value="librarian">Librarian</option>
                        </select>
                    </div>
                </div>
                

                <input type="submit" value="Register" class="register-btn">
            </form>
            <div class="form-footer">
                <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
                <div class="go-back-btn">
                    <span class="material-symbols-outlined">arrow_back</span><a href="index.php">Go Back</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>