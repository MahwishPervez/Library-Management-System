<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/add.css">
    <link rel="stylesheet" href="../styles/add-user.css">
    <title>Document</title>
</head>

<body>
    <section>
        <h2 class="dashboard-titles">Add New User</h2>
        <form action="../../backend/add_user.php" method="post">
            <div class="input-group">
                <div class="input-container">
                    <label for="name">Name</label>
                    <input type="text" id="name" required name="name">
                </div>
                <div class="input-container">
                    <label for="email">Email</label>
                    <input type="email" id="email" required name="email">
                </div>
            </div>

            <div class="input-group">
                <div class="input-container">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" required maxlength="10" minlength="10" name="phone">
                </div>
                <div class="input-container">
                    <label for="student-id">University Id</label>
                    <input type="text" id="student-id" required maxlength="9" minlength="9" name="university-id">
                </div>
            </div>



            <div class="input-container">
                <label for="role">Select Role</label>
                <select id="role" name="role">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="librarian">Librarian</option>
                </select>
            </div>


            <input style="border: 2px solid #CA254C;" type="submit" class="register-btn" value="Register">
        </form>
    </section>
</body>

</html>