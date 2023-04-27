<?php

    include 'connect.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dashboard.css">
    
    <title>Student Enrollment Statistics Page</title>
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript"></script>  

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
    </div>
  </div> 

  <a href="enrollmentStatistics.php" target="_self">Enrollment Stats</a>

  <a href="performanceStats.php" target="_self">GPA Analysis</a>

  <a href="login.php" target="_self">Logout</a>

  
</div>
    
<div style="display:flex;justify-content:center;" class="row1">

    <form method="POST">
     <select  style="background-color:#FE818F;" style="margin-left:10px;" name="year" class="select">
       <option disabled selected>Year</option>
       <option value="2020">2020</option>
       <option value="2021">2021</option>
       <option value="2022">2022</option>
     </select>
       <input style="background-color:#FE818F; border-radius:10px;border:none;outline:none;color:#fff;font-size:14px;letter-spacing:2px;
              text-transform:uppercase;cursor:pointer;font-weight:bold;margin-left:10px;height: 36px;width: 100px;"
              type="submit" name="submit" value="Submit"/>
    </form>  
</div>    
  
    <div class="background">
      <div class="row2" style="text-align: center;">
        <button style="background-color:#FE818F;" style="margin-bottom:0px;" onclick="schoolWiseEnrollment()" class="School-wise">School-wise</button>
        <button onclick="departmentWiseEnrollment()" style="background-color:#FE818F;" class="Department-wise">Department-wise</button>
        <button onclick="programWiseEnrollment()" style="background-color:#FE818F;" class="Program-wise">Program-wise</button>
    </div>
          <div style="width:1000px; margin:auto; margin-top:20px;">     
             <div id="piechart" style="width: 1000px; height: 530px; background-color:#2D2C2C;"></div>  
          </div>
  </div>

  <?php
    if(isset($_POST['submit'])){
    $year=$_POST['year'];
  }?>

    <script>
    
    function departmentWiseEnrollment(){
    <?php

    $sql="SELECT d.departmentName AS department, COUNT(s.studentID) AS studentNumber
    FROM department_t AS d, student_t AS s
    WHERE s.enrollmentYear='$year' AND d.departmentID=s.departmentID
    GROUP BY s.departmentID";

    $result=mysqli_query($con,$sql);
    ?>

      google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Department', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["department"]."', ".$row["studentNumber"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Student Enrollment Statistics' 
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data,{backgroundColor:{fill:"#87CEFA"}},);  
           }  
    }

    function schoolWiseEnrollment(){
    <?php

    $sql="SELECT sch.schoolName as schoolName, COUNT(s.studentID) AS number
    FROM student_t AS s INNER JOIN department_t AS d 
    ON s.departmentID=d.departmentID
    INNER JOIN school_t AS sch
    ON d.schoolID=sch.schoolID
    WHERE s.enrollmentYear='$year' AND d.departmentID=s.departmentID
    GROUP BY sch.schoolName";

    $result=mysqli_query($con,$sql);
    ?>

      google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['School', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["schoolName"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Student Enrollment Statistics' 
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data,{backgroundColor:{fill:"#87CEFA"}},);  
           }  
    }

    function programWiseEnrollment(){
    <?php

    $sql="SELECT p.programName AS programName,COUNT(s.studentID) AS number
    FROM student_t AS s,program_t AS p
    WHERE s.enrollmentYear='$year' AND s.programID=p.programID
    GROUP BY p.programName";

    $result=mysqli_query($con,$sql);
    ?>

      google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['ProgramName', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["programName"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  

                     var options = {
                     title: 'My Daily Activities',
                     is3D: true,
                    };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data,{backgroundColor:{fill:"#87CEFA"}},);  
           }  
    }

      </script>
   
 
 
  </body>

</html>