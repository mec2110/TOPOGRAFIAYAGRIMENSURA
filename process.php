<?php

//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$name = ($_GET['name']) ? $_GET['name'] : $_POST['name'];
$email = ($_GET['email']) ?$_GET['email'] : $_POST['email'];
$tel = ($_GET['tel']) ?$_GET['tel'] : $_POST['tel'];
$localidad = ($_GET['localidad']) ?$_GET['localidad'] : $_POST['localidad'];
$comment = ($_GET['comment']) ?$_GET['comment'] : $_POST['comment'];

//flag to indicate which method it uses. If POST set it to 1
if ($_POST) $post=1;

//Simple server side validation for POST data, of course, you should validate the email
if (!$name) $errors[count($errors)] = 'Ingresa tu nombre';
if (!$email) $errors[count($errors)] = 'Ingresa tu email.'; 
if (!$tel) $errors[count($errors)] = 'Ingresa tu teléfono.'; 
if (!$localidad) $errors[count($errors)] = 'Ingresa tu localidad.'; 
if (!$comment) $errors[count($errors)] = 'Dinos tu consulta'; 

//if the errors array is empty, send the mail
if (!$errors) {

	//recipient - YOUR EMAIL..
	$to = 'Topografia y Agrimensores <agrimensor.carrion@gmail.com>';	
	//sender - from the form
	$from = $name . ' <' . $email . '>';
	
	//subject and the html message
	$subject =   $name . 'Quiere cotizar ';	
	$message = '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head></head>
	<body>
	<table>
		<tr><td>Nombre</td><td>' . $name . '</td></tr>
		<tr><td>Email</td><td>' . $email . '</td></tr>
		<tr><td>Email</td><td>' . $tel . '</td></tr>
		<tr><td>Email</td><td>' . $localidad . '</td></tr>
		<tr><td>Mensaje</td><td>' . nl2br($comment) . '</td></tr>
	</table>
	</body>
	</html>';

	//send the mail
	$result = sendmail($to, $subject, $message, $from);

}

//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from) {
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: ' . $from . "\r\n";
	
	$result = mail($to,$subject,$message,$headers);
	
	if ($result) return 1;
	else return 0;
}

?>