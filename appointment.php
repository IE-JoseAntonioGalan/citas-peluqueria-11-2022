<?php
require_once './layouts/layout.php';
require_once './config/Database.php';

$conn = new Database();

$services = $conn->sql_sentence('SELECT * FROM services');
?>

<form action="controllers/appointment.controller.php" method="post" class="card w-75 m-auto">
    <h2 class="card-header">Agendar una cita</h2>
    <div class="card-body row">
        <div class="form-group col-md-6">
            <label for="fullname" class="form-label">Nombre completo*</label>
            <input type="text" name="fullname" id="fullname" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="gender" class="form-label">Sexo*</label>
            <input type="text" name="gender" id="gender" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="phone" class="form-label">Numero de telefono*</label>
            <input type="tel" name="phone" id="phone" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Servicios</label>
            <div id="service" class="row ms-1">
                <?php foreach ($services->fetchAll() as $service) : ?>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" value="<?= $service['id'] ?>" name="services[]" type="checkbox" id="service-<?= $service['id'] ?>">
                        <label class="form-check-label" for="service-<?= $service['id'] ?>">
                            <?= $service['service'] ?>
                        </label>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="date" class="form-label">Fecha de la cita*</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>
        <div class="px-2 mt-4">
            <button type="submit" class="btn btn-primary fs-5 w-100">Agendar cita</button>
        </div>
    </div>
</form>

<script>
    let href = window.location.href.split('?');
    console.log(href);
    let param = href[1] ? href[1].split('=') : [];
    if (param[0] == 'message') {
        alert(param[1].replace(/\%/g, ' '));
    }
</script>
<?php require_once './layouts/end_layout.php'; ?>