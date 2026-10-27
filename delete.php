    <?php
        require('database.php');

        if (isset($_POST['delete'])) {
            $id = $_POST['id'] ?? '';

            if ($id === '' || !ctype_digit((string)$id)) {
                die("Delete Failed: Missing or invalid ID.");
            }
            $id = (int)$id;
            
            $queryDelete = "DELETE FROM students WHERE id = ?";
            $stmt = mysqli_prepare($connection, $queryDelete);
            mysqli_stmt_bind_param($stmt, "i", $id);
            $sqlDelete = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if (!$sqlDelete) {
                die("Delete Failed: " . mysqli_error($connection));
            }

            echo '<script>alert("Data Deleted Successfully")</script>';
            echo '<script>window.location.href = "index.php"</script>';
        }
    ?>
    
