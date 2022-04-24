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
$services_id = $_POST['services'];
    
$sentence = "INSERT INTO clients(fullname, gender, phone_number, email) VALUES (?,?,?,?)";
$conn->sql_sentence($sentence, array($fullname, $gender, $phone_number, $email));

$client_id = $conn->get_last_insert_id();
$sentence= "INSERT INTO appointments(appointment_date, client_id) VALUES (?,?)";
$conn->sql_sentence($sentence, array($appointment_date, $client_id));

$appointment_id = $conn->get_last_insert_id();
foreach ($services_id as $service) {
    $conn->sql_sentence('INSERT INTO appointments_services(appointment_id, service_id) VALUES (?,?)', array($appointment_id, $service));
}

header('Location: /appointment.php?message=Cita%creada%correctamente');
