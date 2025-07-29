<?php
include 'db.php'; 

if (isset($_GET['isbn']) && !empty($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    

    
    $query = $conn->prepare("SELECT pdf_path FROM ebooks WHERE isbn = ?");
    $query->bind_param("s", $isbn);
    $query->execute();
    $query->bind_result($pdf_path);
    $query->fetch();
    $query->close();

    
    if (!empty($pdf_path) && file_exists('../../' . $pdf_path)) {
        unlink('../../' . $pdf_path);
    }

    
    $stmt = $conn->prepare("DELETE FROM ebooks WHERE isbn = ?");
    $stmt->bind_param("s", $isbn);
    
    if ($stmt->execute()) {
        echo "<script>alert('E-Book deleted successfully!'); window.location.href = '../frontend/Librarian/ebooks.php';</script>";
    } else {
        echo "Error deleting eBook: " . $stmt->error;
    }

    $stmt->close();
} else {
    die("Invalid request! No valid ISBN received.");
}
?>
