<?php

$invalid=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    include 'connect.php';
    
    $userType=$_POST['userType'];
    $ID=$_POST['ID'];
    $password=$_POST['password'];

  if($userType!='student'){
    $sql="SELECT * from employee_t where employeeID='$ID' and password='$password'";
    $result=mysqli_query($con,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
          $invalid=0;
            session_start();
            $_SESSION['ID']=$ID;
            header('location:employee_dashboard.php');
        }
     }
  }    

  else if($userType=='student'){
    $sql="SELECT * from student_t where studentID='$ID' and password='$password'";
    $result=mysqli_query($con,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
          $invalid=0;
            session_start();
            $_SESSION['ID']=$ID;
            header('location:employee_dashboard.php');
        }
     }
  }    

        else{
            $invalid=1;
        }
  }
  ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="loginpage.css?<?php echo time(); ?>" />

 
  </head>
  <body>

 <?php
 if($invalid==1){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong></strong> Invalid credentials!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  ?>


<form action="login.php" method="post">
<div class="login">
  
    <select name="userType" class="select selectNew">
             <option disabled selected>User Type</option>
             <option value="student">Student</option>
             <option value="faculty">Faculty</option>
             <option value="department head">Department Head</option>
             <option value="dean">Dean</option>
         </select>

  <input type="text" class="form-control" id="ID" placeholder="Enter Your ID" name="ID" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>


  <input type="password" class="form-control" id="pwd" placeholder="Enter Your Password" name="password" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>

  <button type="login" class="btn btn-primary">Submit</button>
  </form>
</div>


</body>
</html> 


