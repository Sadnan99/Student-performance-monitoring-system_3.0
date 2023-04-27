<?php
  include 'connect.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Employee Dashboard</title>
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">


  </head>

  <body>

    <div class="navbar"> 
        <a class="navbar-brand" href="employee_dashboard.php">SPMS</a>

        <a href="school_department_program_stats.php" target="_self">School/Department/Program-wise</a>
        <a href="courseWisePerformance.php" target="_self">Course-wise</a>
        <a href="instructorWisePerformance.php" target="_self">Instructor-wise</a>
        <a href="instructorWiseChosenCourse.php" target="_self">Instructor-wise (Chosen Course)</a>
        <a href="enrollmentStatistics.php" target="_self">VC/Dean/Head-wise</a>
        <a href="logout.php" target="_self">Logout</a>
      </div>

  </body>

</html>