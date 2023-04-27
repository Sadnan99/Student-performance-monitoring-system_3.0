<?php

include_once 'dbConfig.php';

$con = mysqli_connect('localhost', 'root');
 
if($con){
    echo "Connection successful";
}
else{
    echo "No connection";
}

mysqli_select_db($con, 'spms');


date_default_timezone_set('Asia/Dhaka'); 
$time = date('H:i:s');
$date = date('d-m-Y');
$date = DateTime::createFromFormat('d-m-Y', $date);
$date = $date->format('Y-m-d');

session_start();
$ID = $_SESSION['ID'];

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            
            fgetcsv($csvFile);
            
           
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $id   = $line[0];
                $year  = $line[1];
                $semester  = $line[2];
                $course = $line[3];
                $section = $line[4];
                $grade = $line[5];
                
                $db->query("INSERT INTO backlog_t (id, year, semester, course, section, grade, facultyID, date, time) VALUES ('".$id."', '".$year."', '".$semester."', '".$course."', '".$section."',  '".$grade."', '".$ID."', '".$date."', '".$time."')");




                //inserting into student table
$query = " insert into  student_t (studentID, enrollmentYear, enrollmentSemester) values ('$id', '$year', '$semester') ";

mysqli_query($con, $query);



//inserting into course table
$query1 = " insert into  course_t (courseID) values ('$course') ";

mysqli_query($con, $query1);



//inserting into section table
$query2 = " insert into  section_t (sectionNum, courseID, semester, year, facultyID) values ('$section', '$course', '$semester', '$year', '$ID') ";

mysqli_query($con, $query2);



/*selecting sectionID from section table then inserting
it into the registration table along with student id*/
$sql = "SELECT sectionID FROM section_t WHERE sectionNum = '$section' AND courseID = '$course' AND semester = '$semester' AND year = '$year'";

$result = $con->query($sql);
$row = $result->fetch_assoc();
$sectionID = $row["sectionID"];


$query3 = " insert into  registration_t (sectionID, studentID) values ('$sectionID', '$id') ";

mysqli_query($con, $query3);


$marks = 0;
switch ($grade) {
    case 'A':
        $marks = 90;
        break;
    case 'A-':
        $marks = 85;
        break;
    case 'B+':
        $marks = 80;
        break;
        case 'B':
        $marks = 75;
        break;
        case 'B-':
        $marks = 70;
        break;
        case 'C+':
        $marks = 65;
        break;
        case 'C':
        $marks = 60;
        break;
        case 'C-':
        $marks = 55;
        break;
        case 'D+':
        $marks = 50;
        break;
        case 'D':
        $marks = 45;
        break;
        case 'F':
        $marks = 0;
        break;
}

/*selecting registration id from registration table then
inserting it into answer table along with mark obtained*/
$sql1 = "SELECT registrationID FROM registration_t WHERE studentID = '$id'";

$result1 = $con->query($sql1);
$row1 = $result1->fetch_assoc();
$registrationID = $row1["registrationID"];


$query4 = " insert into  answer_t (markObtained, registrationID) values ('$marks', '$registrationID') ";

mysqli_query($con, $query4);




    
            }    
                
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: csventry.php".$qstring);
