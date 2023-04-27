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
    
    <script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  google.charts.load('current', {packages: ['corechart']});
  google.charts.setOnLoadCallback(drawChart);
</script>


</head>

  <body>
    

      <div class="navbar"> 
        <a class="navbar-brand" href="employee_dashboard.php">SPMS</a>
        <label style="color: white;">Graph Of Course Outcome</label>
        <a href="logout.php" target="_self">Logout</a>
      </div>


      <div class="form-container text-center">
  <form onclick="viewCO()" method="post">
    <label for="student_id" style="color: white;">Student ID:</label>
    <input type="text" name="studentID" id="studentID">

    <br>

    <label for="year" style="color: white;">Year: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
    <input type="text" name="enrollmentYear" id="enrollmentYear">

    <br>

     <label for="semester" style="color: white;">Semester: &nbsp;</label>
     <input type="text" name="enrollmentSemester" id="enrollmentSemester">

     <br> 

    <input type="submit" value="Submit">
  </form>
</div>




 <script>
  
  function viewCO(){
    
    <?php
// Retrieve student ID and year from POST data
$id = $_POST['studentID'];
$year = $_POST['enrollmentYear'];
$semester = $_POST['enrollmentSemester'];



$conn = mysqli_connect('localhost', 'root');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn, 'spms');
$sql = "SELECT course, grade FROM backlog_t WHERE id = '$id' AND year = '$year' AND semester = '$semester'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // Create arrays to store course names and marks
  $course = array();
  $marks = array();
  
  // Loop through query results and store data in arrays
  while ($row = $result->fetch_assoc()) {
    $course[] = $row['course'];
    
    // Convert grade to marks
    switch ($row['grade']) {
      case 'A':
        $marks[] = 90;
        break;
      case 'A-':
        $marks[] = 85;
        break;
      case 'B+':
        $marks[] = 80;
        break;
        case 'B':
        $marks[] = 75;
        break;
        case 'B-':
        $marks[] = 70;
        break;
        case 'C+':
        $marks[] = 65;
        break;
        case 'C':
        $marks[] = 60;
        break;
        case 'C-':
        $marks[] = 55;
        break;
        case 'D+':
        $marks[] = 50;
        break;
        case 'D':
        $marks[] = 45;
        break;
        case 'F':
        $marks[] = 44;
        break;
      // Add cases for other grades
      default:
        $marks[] = 0;
    }
  }
  
  
  // Display bar graph using Google Charts API
echo '<html>';
echo '<head>';
echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
echo '<script type="text/javascript">';
echo 'google.charts.load("current", {"packages":["corechart"]});';
echo 'google.charts.setOnLoadCallback(drawChart);';
echo 'function drawChart() {';
echo 'var data = google.visualization.arrayToDataTable([';
echo '["Course Name", "Marks"],';

for ($i = 0; $i < count($course); $i++) {
  echo '["' . $course[$i] . '", ' . $marks[$i] . '],';
}

echo ']);';

echo 'var options = {';
echo 'title: "Course Marks for ' . $semester . '  ' . $year . '",';
echo 'width: 400,';
echo 'height: 300,';
echo '};';

echo 'var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));';
echo 'chart.draw(data, options);';
echo '}';
echo '</script>';
echo '</head>';
echo '<body>';
echo '<div style="display: flex; justify-content: center;">';
echo '<div id="chart_div"></div>';
echo '</div>';
echo '</body>';
echo '</html>';

}
?>

 

  }




 </script>

  </body>

</html>