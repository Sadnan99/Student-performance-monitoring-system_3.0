<?php
session_start();
include 'connect.php';
include_once 'dbConfig.php';


?>

<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>



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
    

    <script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>

</head>

  <body>
    

    <div class="navbar"> 
        <a class="navbar-brand" href="employee_dashboard.php">SPMS</a>
        <a href="logout.php" target="_self">Logout</a>
        
 </div>

 <div class="row">
    <!-- Import link -->
<div class="col-md-12 head text-center">
    <div class="d-inline-block">
        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
    </div>
</div>

<!-- CSV file upload form -->
<div class="col-md-12 text-center" id="importFrm" style="display: none;">
    <form action="importData.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" title="Select a file to import" />
        <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
    </form>
</div>

   <!-- Data list table --> 
    <div class="container">
    <div class="table-responsive text-center">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Get member rows
            $result = $db->query("SELECT * FROM backlog_t ORDER BY id DESC");
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['semester']; ?></td>
                    <td><?php echo $row['course']; ?></td>
                    <td><?php echo $row['section']; ?></td>
                    <td><?php echo $row['grade']; ?></td>
                </tr>
            <?php } }else{ ?>
                <tr><td colspan="5">No member(s) found...</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

  </body>

</html>


