<?php #includem functiile de lucru cu baza de date si HTML
include 'include/db_connect.php';
include 'include/db_receptie.php';
include 'include/db_financiar.php';
include 'include/header.php';
include 'include/menu.php'; 
check_session(); ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Detalii pacient</h3>
<div class="col-xs-12" style="height:30px;"></div>
<?php 
$id = $_GET['id'];
?>

<a href="add_consultatie.php?id=<?=$id?>" class="btn btn-primary active" role="button" aria-pressed="true">Adauga consultatie</a>
<a href="add_internare.php?id=<?=$id?>" class="btn btn-info active" role="button" aria-pressed="true">Adauga internare</a>
<a href="add_factura.php?id=<?=$id?>" class="btn btn-success active" role="button" aria-pressed="true">Adauga factura</a>
<a href="add_plata.php?id=<?=$id?>" class="btn btn-warning active" role="button" aria-pressed="true">Adauga plata</a>
<div class="col-xs-12" style="height:30px;"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nume</th>
            <th scope="col">Prenume</th>
            <th scope="col">CNP</th>
            <th scope="col">Adresa</th>
            <th scope="col">Modifica</th>
        </tr>
    </thead>
    <tbody>
<?php
$ret = get_pacient($conn, $id);
$pacient = $ret->fetch_assoc();
?>
        <tr>
            <td><strong><?= $pacient['Nume']; ?></strong></td>
            <td><?= $pacient['Prenume']; ?></td>
            <td><?= $pacient['CNP']; ?></td>
            <td><?= $pacient['Adresa']; ?></td>
            <td><a href="edit_pacient.php?id=<?=$pacient['pacient_id'];?>" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td>
        </tr>
    </tbody>
</table>
<div class="col-xs-12" style="height:30px;"></div>
<h4>Consultatii</h4>
<div class="col-xs-12" style="height:30px;"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Medic</th>
            <th scope="col">Tip</th>
            <th scope="col">Data si ora</th>
            <th scope="col">Diagnostic</th>
            <th scope="col">Internare</th>
            <th scope="col">Pret</th>
            <th scope="col">Fisa</th>
            <!-- <th scope="col">Modifica</th> -->
        </tr>
    </thead>
    <tbody>
    <?php
        $ret = list_consultatii_pacient($conn, $id);
        $numar_consultatii = $ret->num_rows;
        for ($i = 0; $i < $numar_consultatii; $i++) {
            $consultatie = $ret->fetch_assoc();
        ?>
            <tr>
                <td><?= $consultatie['NumeMedic']; ?> <?= $consultatie['PrenumeMedic']; ?></td>
                <td><?= $consultatie['Tip']; ?></td>
                <td><?= $consultatie['Data']; ?> <?= $consultatie['Ora']; ?></td>
                <td><?= $consultatie['Diagnostic']; ?></td>
                <td><?=($consultatie['Internare']==1)?"DA":"NU"; ?></td>
                <td><?= $consultatie['Pret_consultatie']; ?></td>
                <td><a href="#" class="btn btn-info active" role="button" aria-pressed="true">Fisa</a></td>
                <!-- <td><a href="#" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td> -->
            </tr>

        <?php
        } ?>
    </tbody>
</table>
<div class="col-xs-12" style="height:30px;"></div>
<h4>Internari</h4>
<div class="col-xs-12" style="height:30px;"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Status</th>
            <th scope="col">Data checkin</th>
            <th scope="col">Data checkout</th>
            <th scope="col">Camera</th>
            <th scope="col">Pat</th>
            <!-- <th scope="col">Modifica</th> -->
        </tr>
    </thead>
    <tbody>
    <?php
        $ret = list_internari_pacient($conn, $id);
        $numar_internari = $ret->num_rows;
        for ($i = 0; $i < $numar_internari; $i++) {
            $internare = $ret->fetch_assoc();
        ?>
            <tr>
                <td><?php if ($internare['Data_checkout']=="") echo "Internat"; else echo "Externat"; ?></td>
                <td><?= $internare['Data_checkin']; ?></td>
                <td><?= $internare['Data_checkout']; ?></td>
                <td><?= $internare['Camera']; ?></td>
                <td><?= $internare['Pat']; ?></td>
                <!-- <td><a href="#" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td> -->
            </tr>

        <?php
        } ?>
    </tbody>
</table>
<div class="col-xs-12" style="height:30px;"></div>
<h4>Facturi</h4>
<div class="col-xs-12" style="height:30px;"></div>
<table class="table table-hover">
    <thead>
        <tr>
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
        $ret = list_facturi_pacient($conn, $id);
        $numar_facturi = $ret->num_rows;
        $total_facturi = 0;
        for ($i = 0; $i < $numar_facturi; $i++) {
            $factura = $ret->fetch_assoc();
            $total_facturi += $factura['Valoare'];
        ?>
            <tr>
                <td><?= $factura['Numar']; ?></td>
                <td><?= $factura['Data']; ?></td>
                <td><?= $factura['Detalii']; ?></td>
                <td><?= $factura['Valoare']; ?></td>
                <td><a href="detalii_factura.php?id=<?=$factura['factura_id'];?>" class="btn btn-info active" role="button" aria-pressed="true">Vizualizare</a></td>
                <!-- <td><a href="#" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td> -->
            </tr>

        <?php
        } ?>
    </tbody>
</table>
<div class="col-xs-12" style="height:30px;"></div>
<h4>Plati</h4>
<div class="col-xs-12" style="height:30px;"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Numar factura</th>
            <th scope="col">Data</th>
            <th scope="col">Valoare</th>
            <!-- <th scope="col">Modifica</th> -->
        </tr>
    </thead>
    <tbody>
    <?php
        $ret = list_plati_pacient($conn, $id);
        $numar_plati = $ret->num_rows;
        $total_plati = 0;
        for ($i = 0; $i < $numar_plati; $i++) {
            $plata = $ret->fetch_assoc();
            $total_plati += $plata['Valoare'];
        ?>
            <tr>
                <td><?= $plata['Numar']; ?></td>
                <td><?= $plata['Data']; ?></td>
                <td><?= $plata['Valoare']; ?></td>
                <!-- <td><a href="#" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td> -->
            </tr>

        <?php
        } ?>
    </tbody>
</table>
<div class="col-xs-12" style="height:30px;"></div>
<h4>Sold: <?=($total_facturi-$total_plati)?></h4>
<div class="col-xs-12" style="height:50px;"></div>
<div></div>
<?php include 'include/footer.php'; ?>