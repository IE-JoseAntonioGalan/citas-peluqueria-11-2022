<?php 
require_once('./layouts/layout.php'); 
require_once('./config/Database.php');

$conn = new Database();

$appointments = $conn->sql_sentence('SELECT ap.id, c.fullname, ap.appointment_date FROM appointments as ap LEFT JOIN clients as c ON(c.id = ap.client_id);');

$appointments = $appointments->fetchAll();

function get_services($appointment_id)
{
    global $conn;
    $services = $conn->sql_sentence('SELECT s.service, s.price FROM appointments_services as ap INNER JOIN services as s ON(s.id = ap.service_id) WHERE ap.appointment_id = ?', array($appointment_id));
    $servicesArray = $services->fetchAll();
    $temp_services = [];
    $total_price = 0;
    foreach ($servicesArray as $item) {
      $total_price += $item['price'];
      array_push($temp_services, $item['service']);
    }
    return array('services' => implode(', ', $temp_services), 'total_price' => $total_price) ;
}

?>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre del cliente</th>
        <th scope="col">Fecha de la cita</th>
        <th scope="col">Servicios</th>
        <th scope="col">Precio de la cita</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($appointments as $data) : 
            $data['services'] = get_services($data['id']);
        ?>
            <tr>
                <td><?= $data['id'] ?></td>
                <td><?= $data['fullname'] ?></td>
                <td><?= $data['appointment_date'] ?></td>
                <td><?= $data['services']['services'] ?></td>
                <td><?= $data['services']['total_price'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php require_once('./layouts/end_layout.php'); ?>