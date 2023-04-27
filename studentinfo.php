<?php 

$con = mysqli_connect('localhost', 'root');
 
if($con){
	echo "Connection successful";
}
else{
	echo "No connection";
}

mysqli_select_db($con, 'spms');

$studentID = $_POST['studentID'];
$enrollmentYear = $_POST['enrollmentYear'];
$enrollmentSemester = $_POST['enrollmentSemester'];
$courseID = $_POST['courseID'];
$sectionNum = $_POST['sectionNum'];
$grade = $_POST['grade'];

date_default_timezone_set('Asia/Dhaka'); 
$time = date('H:i:s');
$date = date('d-m-Y');
$date = DateTime::createFromFormat('d-m-Y', $date);
$date = $date->format('Y-m-d');

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


session_start();
$ID = $_SESSION['ID'];

//inserting into backlog table
$query0 = " insert into  backlog_t (id, year, semester, course, section, grade, facultyID, date, time) values ('$studentID', '$enrollmentYear', '$enrollmentSemester', '$courseID', '$sectionNum', '$grade', '$ID', '$date', '$time') ";

mysqli_query($con, $query0);



//inserting into student table
$query = " insert into  student_t (studentID, enrollmentYear, enrollmentSemester) values ('$studentID', '$enrollmentYear', '$enrollmentSemester') ";

mysqli_query($con, $query);



//inserting into course table
$query1 = " insert into  course_t (courseID) values ('$courseID') ";

mysqli_query($con, $query1);



//inserting into section table
$query2 = " insert into  section_t (sectionNum, courseID, semester, year, facultyID) values ('$sectionNum', '$courseID', '$enrollmentSemester', '$enrollmentYear', '$ID') ";

mysqli_query($con, $query2);



/*selecting sectionID from section table then inserting
it into the registration table along with student id*/
$sql = "SELECT sectionID FROM section_t WHERE sectionNum = '$sectionNum' AND courseID = '$courseID' AND semester = '$enrollmentSemester' AND year = '$enrollmentYear'";

$result = $con->query($sql);
$row = $result->fetch_assoc();
$sectionID = $row["sectionID"];


$query3 = " insert into  registration_t (sectionID, studentID) values ('$sectionID', '$studentID') ";

mysqli_query($con, $query3);



/*selecting registration id from registration table then
inserting it into answer table along with mark obtained*/
$sql1 = "SELECT registrationID FROM registration_t WHERE studentID = '$studentID'";

$result1 = $con->query($sql1);
$row1 = $result1->fetch_assoc();
$registrationID = $row1["registrationID"];


$query4 = " insert into  answer_t (markObtained, registrationID) values ('$marks', '$registrationID') ";

mysqli_query($con, $query4);




header('location:entry.php');

 ?>
