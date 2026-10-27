<?php 
    require('database.php');

    if(isset($_POST['create'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $course = $_POST['course'];
        $yearlevel = $_POST['year_level'];

        if ($yearlevel === '') {
            echo '<script>alert("Year Level is missing. Please enter a year level.")</script>';
            echo '<script>window.location.href = "index.php"</script>';
            exit;
        }

        $queryCreate = "INSERT INTO students (name, email, course, year_level) VALUES(?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $queryCreate);
        
        if (!$stmt) {
            die("Prepare Failed: " . mysqli_error($connection));
        }

        mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $course, $yearlevel);
        $sqlCreate = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if (!$sqlCreate) {
            die("Execute Failed: " . mysqli_error($connection));
        }

        echo '<script>alert("Student Data Created Successfully")</script>';
        echo '<script>window.location.href = "index.php"</script>';
    }
?>
