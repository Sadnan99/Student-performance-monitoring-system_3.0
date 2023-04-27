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
    <link rel="stylesheet" href="style.css">

    <style>
      body{
        background-image:url('mybackground.png');
        background-repeat:no-repeat;
        background-attachment:fixed;
        background-size:50% 80%;
        background-position:center;
       
      }
    </style>

  </head>

  <body>
    <!--
    <div class="container" id="logoutbutton">
    <a href="logout.php" class="btn btn-primary mb-5">Logout</a>
    </div>
    -->

   <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="employee_dashboard.php">
    <img src="logo.png" alt="logo" style="width:40px;">
  </a>
        
        <ul class="navbar-nav">
          <li><a href="ploAnalysisDepartmentProgramSchoolAverage.php" target="_self">&nbsp;&nbsp;PLO Analysis With Department/Program/School Average&nbsp;&nbsp;</a></li>
          <li><a href="ploAnalysisOverall.php" target="_self">&nbsp;&nbsp;PLO Analysis (Overall, CO Wise, Course Wise)&nbsp;&nbsp;</a></li>
          <li><a href="logout.php" target="_self">&nbsp;&nbsp;Logout&nbsp;&nbsp;</a></li>
            </ul>
        </nav>

  </body>

</html>



