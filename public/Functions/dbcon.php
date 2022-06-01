<?
$connect = mysqli_connect("Localhost","root","","Quiz_DB");

if ($connect->connect_error) {
	printf("Connection failed");
}

$q = mysqli_query($connect,"SELECT MAX(id) FROM `Quizes`");
$row = mysqli_fetch_assoc($q);


?>