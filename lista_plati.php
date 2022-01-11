<?php #includem functiile de lucru cu baza de date si HTML
include 'include/db_connect.php';
include 'include/db_financiar.php';
include 'include/header.php';
include 'include/menu.php'; 
check_session(); ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Lista Plati</h3>
<?php 
#daca este primit un mesaj, il afisam
if (isset($_GET['msg'])) { ?>
    <div class="alert alert-success" role="alert">
        <?= $_GET['msg'] ?>
    </div>
<?php } ?>
<div class="col-xs-12" style="height:30px;"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Pacient</th>
            <th scope="col">Data platii</th>
            <th scope="col">Valoare plata</th>
            <th scope="col">Numar factura</th>
            <th scope="col">Data factura</th>
            <th scope="col">Valoare factura</th>
            <th scope="col">Modifica</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $ret = list_plati($conn);
        $numar_facturi = $ret->num_rows;
        $total_facturi = 0;
        for ($i = 0; $i < $numar_facturi; $i++) {
            $factura = $ret->fetch_assoc();
            $total_facturi += $factura['Valoare'];
        ?>
            <tr>
                <td><?= $factura['Nume']; ?> <?= $factura['Prenume']; ?></td>
                <td><?= $factura['Data']; ?></td>
                <td><?= $factura['Valoare']; ?></td>
                <td><?= $factura['NumarFactura']; ?></td>
                <td><?= $factura['DataFactura']; ?></td>
                <td><?= $factura['ValoareFactura']; ?></td>
                <td><a href="edit_plata.php?id=<?=$factura['plata_id'];?>" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td>
            </tr>

        <?php
        } ?>
    </tbody>
</table>
<?php include 'include/footer.php'; ?>