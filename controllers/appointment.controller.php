<?php
require_once '../config/Database.php';
$conn =  new Database();

//client
$fullname = $_POST['fullname'];
$gender = $_POST['gender'];
$phone_number = $_POST['phone'];
$email = $_POST['email'];

//appointment
$appointment_date = $_POST['date'];
$service_id = $_POST['service'];

$sentence = "INSERT INTO clients(fullname, gender, phone_number, email) VALUES (?,?,?,?)";
$conn->sql_sentence($sentence, array($fullname, $gender, $phone_number, $email));

$client_id = $conn->get_last_insert_id();
$sentence= "INSERT INTO appointments(appointment_date, client_id, service_id) VALUES (?,?,?)";
$conn->sql_sentence($sentence, array($appointment_date, $client_id, $service_id));

header('Location: /appointment.php?message=Cita%creada%correctamente');
