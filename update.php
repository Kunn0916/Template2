<?php 
require('database.php');

$idValue = '';
$nameValue = '';
$emailValue = '';
$courseValue = '';
$yearlevelValue = '';
$message = '';

if (isset($_POST['update_submit'])) {
    $idValue = $_POST['id'] ?? '';
    $nameValue = $_POST['name'] ?? '';
    $emailValue = $_POST['email'] ?? '';
    $courseValue = $_POST['course'] ?? '';
    $yearlevelValue = $_POST['year_level'] ?? '';

    // Validate fields
    if ($nameValue == '' || $emailValue == '' || $courseValue == '') {
        $message = 'All fields are required.';
    } else {
        // Use prepared statements for safety
        $queryUpdate = "UPDATE students 
                        SET name = ?, email = ?, course = ?
                        WHERE id = ?";
        $stmt = mysqli_prepare($connection, $queryUpdate);
        if (!$stmt) {
            die("Prepare Failed: " . mysqli_error($connection));
        }

        mysqli_stmt_bind_param($stmt, "sssi", $nameValue, $emailValue, $courseValue, $idValue);
        $sqlUpdate = mysqli_stmt_execute($stmt);

        if (!$sqlUpdate) {
            die("Update Failed: " . mysqli_error($connection));
        }

        mysqli_stmt_close($stmt);

        echo '<script>alert("Data Updated Successfully")</script>';
        echo '<script>window.location.href = "index.php"</script>';
        exit;
    }
}

elseif (isset($_POST['id'])) {
    $idValue = $_POST['id'];
    $querySelect = "SELECT * FROM students WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($connection, $querySelect);
    if (!$stmt) die("Prepare Failed: " . mysqli_error($connection));

    mysqli_stmt_bind_param($stmt, "i", $idValue);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $nameValue = $row['name'];
        $emailValue = $row['email'];
        $courseValue = $row['course'];
    } else {
        $message = 'Student not found.';
    }

    mysqli_stmt_close($stmt);
} else {
    $message = 'Missing student ID.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <form class="create-main" action="update.php" method="post">
            <h3>UPDATE STUDENT</h3>
            <?php if ($message != '') { ?>
                <p><?php echo $message; ?></p>
            <?php } ?>

            <input type="hidden" name="id" value="<?php echo $idValue; ?>">

            <input type="text" name="name" placeholder="Student Name" value="<?php echo $nameValue; ?>" required>
            <input type="text" name="email" placeholder="Email" value="<?php echo $emailValue; ?>" required>
            <input type="text" name="course" placeholder="Course" value="<?php echo $courseValue; ?>" required>

            <input type="submit" name="update_submit" value="Update Student Data">
        </form>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>