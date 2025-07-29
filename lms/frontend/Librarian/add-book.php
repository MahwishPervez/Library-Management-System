<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/utility.css">
    <link rel="stylesheet" href="../styles/add.css">
    <title>Document</title>
</head>
<body>
        <section>
            <h2 class="dashboard-titles">Add New Book</h2>
            <form action="../../backend/add_book.php" method="post">
                <div class="input-group">
                    <div class="input-container">
                        <label for="isbn">ISBN</label>
                        <input type="text" id="isbn" name="isbn" required placeholder="Enter ISBN">
                    </div>
                    
                    <div class="input-container">
                        <label for="author">Author</label>
                        <input type="text" id="author" name="author" required placeholder="Enter author">
                    </div>
                    <div class="input-container">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <option value="" disabled selected>Select category</option>
                            <option value="textbooks">Textbooks</option>
                            <option value="reference">Reference Books</option>
                            <option value="research-papers">Research Papers</option>
                            <option value="engineering">Engineering</option>
                            <option value="medical">Medical</option>
                            <option value="law">Law</option>
                            <option value="business-management">Business & Management</option>
                            <option value="humanities">Humanities</option>
                            <option value="science">Science</option>
                            <option value="computer-science">Computer Science</option>

                        </select>
                    </div>
                </div>
                
                <div class="input-container">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required placeholder="Enter title">
                </div>

                <div class="input-container">
                    <label for="description">Description (Optional)</label>
                    <textarea name="description" id="description" placeholder="Enter description" rows="4"></textarea>

                </div>

                <div class="btn-container">
                    <input style="padding-top: 8px; padding-bottom: 8px;" class="go-back" type="button" value="Go Back">
                    <input class="submit" type="submit" value="Submit">
                </div>

            </form>
        </section>
</body>
</html>