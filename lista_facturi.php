<?php #includem functiile de lucru cu baza de date si HTML
include 'include/db_connect.php';
include 'include/db_financiar.php';
include 'include/header.php';
include 'include/menu.php'; 
check_session(); ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Lista Facturi</h3>

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
            <th scope="col">Numar</th>
            <th scope="col">Data</th>
            <th scope="col">Detalii</th>
            <th scope="col">Valoare</th>
            <th scope="col">Vizualizare</th>
            <!-- <th scope="col">Modifica</th> -->
        </tr>
    </thead>
    <tbody>
    <?php
        $ret = list_facturi($conn);
        $numar_facturi = $ret->num_rows;
        $total_facturi = 0;
        for ($i = 0; $i < $numar_facturi; $i++) {
            $factura = $ret->fetch_assoc();
            $total_facturi += $factura['Valoare'];
        ?>
            <tr>
                <td><?= $factura['Nume']; ?> <?= $factura['Prenume']; ?></td>
                <td><?= $factura['Numar']; ?></td>
                <td><?= $factura['Data']; ?></td>
                <td><?= $factura['Detalii']; ?></td>
                <td><?= $factura['Valoare']; ?></td>
                <td><a href="detalii_factura.php?id=<?=$factura['factura_id'];?>" class="btn btn-primary active" role="button" aria-pressed="true">Vizualizare</a></td>
                <!-- <td><a href="#" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td> -->
            </tr>

        <?php
        } ?>
    </tbody>
</table>
<?php include 'include/footer.php'; ?>