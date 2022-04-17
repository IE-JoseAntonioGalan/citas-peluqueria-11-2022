<?php 
require_once('./layouts/layout.php'); 
require_once('./config/Database.php');

$conn = new Database();

$appointments = $conn->sql_sentence('SELECT ap.id, c.fullname, ap.appointment_date, s.service FROM appointments as ap LEFT JOIN clients as c ON(c.id = ap.client_id) LEFT JOIN services as s ON(s.id = ap.service_id);')

?>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre del cliente</th>
        <th scope="col">Fecha de la cita</th>
        <th scope="col">Servicio</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($appointments->fetchAll() as $data) : ?>
            <tr>
                <td><?= $data['id'] ?></td>
                <td><?= $data['fullname'] ?></td>
                <td><?= $data['appointment_date'] ?></td>
                <td><?= $data['service'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php require_once('./layouts/end_layout.php'); ?>