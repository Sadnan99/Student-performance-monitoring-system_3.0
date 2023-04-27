<?php
session_start();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="courseOutline.css">
    <link rel="stylesheet" href="questionform.css">


</head>

  <body>
    

  	<div class="navbar"> 
        <a class="navbar-brand" href="employee_dashboard.php">SPMS</a>

        <label>Manually Enter Student Data</label>
        <a href="logout.php" target="_self">Logout</a>
      </div>


<style>
  /* change the color of the label text */
  label {
    color: white;
  }
</style>


	<div class="w-50 m-auto" >
		<form action="studentinfo.php" method="post">
			<div class="form-group">
				<label>Student ID</label>
				<input type="text" name="studentID" autocomplete="off" class="form-control">
			</div>
			<div class="form-group">
				<label>Educational Year</label>
				<input type="text" name="enrollmentYear" autocomplete="off" class="form-control">
			</div>
			<div class="form-group">
				<label>Educational Semester</label>
				<input type="text" name="enrollmentSemester" autocomplete="off" class="form-control">
			</div>
			<div class="form-group">
				<label>Enrolled Course</label>
				<input type="text" name="courseID" autocomplete="off" class="form-control">
			</div>
			<div class="form-group">
				<label>Enrolled Section</label>
				<input type="text" name="sectionNum" autocomplete="off" class="form-control">
			</div>
			<div class="form-group">
				<label>Obtained Grade</label>
				<input type="text" name="grade" autocomplete="off" class="form-control">
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>

	

  </body>

</html>


