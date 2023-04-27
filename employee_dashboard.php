<?php

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="dashboard.css?<?php echo time(); ?>" />
</head>


<body>

<div class="navbar"> 
<a class="navbar-brand" href="employee_dashboard.php">SPMS</a>


           <!--dropdown1-->
  <div class="dropdown">
    <button class="dropbtn">PLO Analysis 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="ploAnalysisDepartmentProgramSchoolAverage.php">Department Program School Average</a>
      <a href="ploAnalysisOverall.php">Analysis Overall</a>
    </div>
  </div> 

  <a href="ploAchieveStats.php" target="_self">PLO Achievement Stats</a>

  <a href="spiderChart.php" target="_self">Spider Chart Analysis</a>



           <!--dropdown2-->
  <div class="dropdown">
    <button class="dropbtn">Exam 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="addExam.php">Add Exam</a>
      <a href="viewExam.php">View Exam</a>
      <a href="viewStudentAnswerScript.php">Evaluate Exam Script</a>
    </div>
  </div> 

   <!--dropdown3-->
  <div class="dropdown">
    <button class="dropbtn">Student Perfomance 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="entry.php">Manual Entry</a>
      <a href="csventry.php">CSV Entry</a>
      <a href="co.php">Course Outcome</a>
    </div>
  </div> 

  <a href="enrollmentStatistics.php" target="_self">Enrollment Stats</a>

  <a href="performanceStats.php" target="_self">GPA Analysis</a>

  <a href="login.php" target="_self">Logout</a>

  
</div>

</body>
</html>





 