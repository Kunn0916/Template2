<?php 
    require('read.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">

    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    <form class="create-main" action ="create.php" method="post">
        <h3>ADD STUDENT</h3>
        ...

    <div class="main">
        <form class="create-main" action ="create.php" method="post">
            <h3>ADD STUDENT</h3>
            <input type="text" name="name" placeholder="Student Name" required>
            <input type="text" name="email" placeholder="Email Address" required>
            <input type="text" name="course" placeholder="Course" required>
            <input type="number" name="year_level" placeholder="Year Level" required>
            <input type="submit" name="create" value="Add Student">
        </form>

        <table class="read-main">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Course</th>
                <th>Year Level</th>
            </tr>
            <?php while($results = mysqli_fetch_assoc($sqlAccounts)) {?>
            <tr>
                <td><?php echo $results['id']?></td>
                <td><?php echo $results['name']?></td>
                <td><?php echo $results['email']?></td>
                <td><?php echo $results['course']?></td>
                <td><?php echo $results['year_level']?></td>
                <td>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $results['id']?>">
                        <input type="submit" name="delete" value="Delete Data">
                    </form>
                    <form action="update.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $results['id']?>">
                        <input type="submit" name="update" value="Update Data">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
