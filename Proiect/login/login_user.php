<?php
session_start();
if(isset($_POST['login_btn'])){
	//anti-SQL injection
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$parola = mysqli_real_escape_string($con, $_POST['parola']);

	if(empty($email)){
		array_push($erori, "Este necesar un email");
	}
	if(empty($parola)){
		array_push($erori, "Este necesar o parolă");
	}
	$users = mysqli_query($con, "select * from conturi where email = '$email'");
	$row = mysqli_fetch_array($users);

	if(is_array($row)){
		if(count($row)>0){
			$parola = password_verify($parola, $row['parola']);
			if(!$parola){
				array_push($erori, "Parolă incorectă");
			}
			if((count($erori) == 0) && $parola ){
			$_SESSION['user'] = $row;
			//redirectionare catre continut
			 header("Location: ../baza_date/profile ");
			}
		}else{
			array_push($erori, "Cont inexistent");
		}
	}else{
		array_push($erori, "Cont inexistent");
	}
}
?>
