<?php
  include 'connect.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <title>Employee Dashboard</title>

   

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script type="text/javascript"></script>  
    <!-- JS Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

#chartdiv {
  width: 100%;
  height: 500px;
  background-color:pink;
}

    </style>

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
      <a href="viewStudentAnswerScript.php">Evaluate Exam Script</a>
    </div>
  </div> 

  <a href="enrollmentStatistics.php" target="_self">Enrollment Stats</a>

  <a href="performanceStats.php" target="_self">GPA Analysis</a>

  <a href="login.php" target="_self">Logout</a>

  
</div>

<div class="background">

<!-- div row-1 starts here -->
     <div style="display:flex;justify-content:center;padding-top:15px;" class="row1">
     <form method="POST">

     <input  style="background-color:#FE818F;" style="margin-bottom:0px;" class="studentID" type="text" placeholder="Enter Student ID" name="studentID"/>

    <input style="background-color:#FE818F;" style="margin-bottom:0px;" class="enterButton" type="submit" name="submit" value="Enter"/>

    </form>       
    </div>  <!-- div row-1 ends here -->

       
        <!-- div row-2 -->
    <div style="display:flex;justify-content:center;margin-bottom:10px;">

        <button onclick="poView()" style="background-color:#FE818F;" style="width:200px;" class="viewButton">view PO analysis</button>
        <button onclick="coView()" style="background-color:#FE818F;" style="width:200px;" class="viewButton">View CO analysis</button>
    
    </div> <!-- div row-2 ends here -->

        <div style="display:flex;justify-content:center;margin-top:5px;height:600px;width:100%;"class="row3"> 
        <canvas style="background-color:white;height:500px;width:400px;" id="myChart"></canvas>
        </div> <!-- div row-3 ends here -->

     </div>  <!-- background div ends here -->

    <?php
    if(isset($_POST['submit'])){
    $studentID=$_POST['studentID'];
    }?>


<script>
  
  function poView(){
  <?php
   $sql="SELECT po.poNum AS poNum, 
   AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
   FROM registration_t AS r, answer_t AS ans, question_t AS q, 
   co_t AS co, po_t AS po
   WHERE r.registrationID=ans.registrationID 
   AND ans.examID=q.examID
   AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
   AND q.courseID=co.courseID AND co.poID=po.poID 
   AND r.studentID='$studentID'
   GROUP BY po.poNum";

   $result=mysqli_query($con,$sql);

   $po=array();
   $percent=array();

   while($data=mysqli_fetch_array($result)){
             
    array_push($po,"PO ".$data['poNum']);
    array_push($percent,$data['percent']);
    
  }

  ?>

 
  var po=<?php echo json_encode($po); ?>;
  var percent=<?php echo json_encode($percent); ?>;

  for(var i=0;i<percent.length;i++){
    percent[i]=parseFloat(percent[i]);
  }
    
    const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'radar',
  data: {
    labels: po,
    datasets: [{
      label: 'PO Achieved',
      data: percent,
      fill: true,
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
    borderColor: 'rgb(54, 162, 235)',
    pointBackgroundColor: 'rgb(54, 162, 235)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(54, 162, 235)'}]
  },
  options: {
    elements: {
      line: {
        borderWidth: 3
      }
    }
  }
});

  }

  function coView(){
  <?php
   $sql="SELECT ans.markObtained
   FROM registration_t AS r, answer_t AS ans
   WHERE r.registrationID=ans.registrationID
   AND r.studentID='$studentID'";

   $result=mysqli_query($con,$sql);

   $co=array();
   $percent=array();

   while($data=mysqli_fetch_array($result)){
      $markObtained = $data['markObtained'];
      if ($markObtained > 11) {         
         array_push($co,"CO 1");
         array_push($co,"CO 2");
         array_push($co,"CO 3");
         array_push($percent,$markObtained);
         array_push($percent,$markObtained);
         array_push($percent,$markObtained);
      }
      else{
        $sql="SELECT q.coNum, 
         AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
         FROM registration_t AS r, answer_t AS ans, question_t AS q, 
         co_t AS co, po_t AS po
         WHERE r.registrationID=ans.registrationID 
         AND ans.examID=q.examID
         AND ans.answerNum=q.questionNum AND q.coNum=co.coNum
         AND r.studentID='$studentID'
         GROUP BY q.coNum";

         $result=mysqli_query($con,$sql);

         $co=array();
         $percent=array();

         while($data=mysqli_fetch_array($result)){
                   
          array_push($co,"CO ".$data['coNum']);
          array_push($percent,$data['percent']);
          
        }
      }
   }

  ?>

 
  var co=<?php echo json_encode($co); ?>;
  var percent=<?php echo json_encode($percent); ?>;

  for(var i=0;i<percent.length;i++){
    percent[i]=parseFloat(percent[i]);
  }
    
    const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'radar',
  data: {
    labels: co,
    datasets: [{
      label: 'CO Achieved',
      data: percent,
      fill: true,
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
    borderColor: 'rgb(54, 162, 235)',
    pointBackgroundColor: 'rgb(54, 162, 235)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(54, 162, 235)'}]
  },
  options: {
    elements: {
      line: {
        borderWidth: 3
      }
    }
  }
});

  }


</script>



</body>

</html>



