<?php
include '../../backend/db.php'; 

if (isset($_POST['upload'])) {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $description = $_POST['description']; 

    $uploadDir = '../../uploads/ebooks/';  

    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);  
    }

    $filename = basename($_FILES['pdf_file']['name']);
    $filepath = $uploadDir . $filename; 
    $relativePath = 'uploads/ebooks/' . $filename; 

    if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $filepath))  {
        $sql = "INSERT INTO ebooks (isbn, title, author, category, description, pdf_path) 
                VALUES ($isbn, '$title', '$author', '$category', '$description', '$filepath')";
        
        if ($conn->query($sql)) {
            echo "<script>alert('E-Book added successfully!'); window.location.href = 'ebooks.php';</script>";
        } else {
            echo "Database error: " . $conn->error;
        }
    } else {
        echo "File upload failed!";
    }
}
?>


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
            <h2 class="dashboard-titles">Add New EBook</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <div class="input-container">
                        <label for="isbn">ISBN</label>
                        <input type="text" id="isbn" required placeholder="Enter ISBN" name="isbn">
                    </div>
                    
                    <div class="input-container">
                        <label for="author">Author</label>
                        <input type="text" id="author" required placeholder="Enter author" name="author">
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

                <div class="input-group">
                    <div class="input-container">
                        <label for="title">Title</label>
                        <input type="text" id="title" required placeholder="Enter title" name="title">
                    </div>
                    <div class="input-container">
                        <label for="pdf">PDF File</label>
                        <input type="file" id="pdf" required  name="pdf_file" accept="application/pdf">
                    </div>
                </div>
                
                

                <div class="input-container">
                    <label for="description">Description (Optional)</label>
                    <textarea name="description" id="description" placeholder="Enter description" rows="4"></textarea>

                </div>

                <div class="btn-container">
                    <input style="padding-top: 8px; padding-bottom: 8px;" class="go-back" type="button" value="Go Back">
                    <input class="submit" type="submit" value="Submit" name="upload">
                </div>

            </form>
        </section>
</body>
</html>