<?php #includem functiile de lucru cu baza de date si HTML
include 'include/db_connect.php';
include 'include/db_receptie.php';
include 'include/header.php';
include 'include/menu.php'; 
check_session(); ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Lista Pacienti</h3>
<div class="col-xs-12" style="height:30px;"></div>
<?php 
#daca este primit un mesaj, il afisam
if (isset($_GET['msg'])) { ?>
    <div class="alert alert-success" role="alert">
        <?= $_GET['msg'] ?>
    </div>
<?php } ?>

<a href="add_pacient.php" class="btn btn-primary active" role="button" aria-pressed="true">Adauga pacient nou</a>
<div class="col-xs-12" style="height:30px;"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nume</th>
            <th scope="col">Prenume</th>
            <th scope="col">CNP</th>
            <th scope="col">Adresa</th>
            <th scope="col">Modifica</th>
            <th scope="col">Detalii</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ret = list_pacienti($conn);
        $numar_pacienti = $ret->num_rows;
        for ($i = 0; $i < $numar_pacienti; $i++) {
            $pacient = $ret->fetch_assoc();
        ?>
            <tr>
                <td><?= $pacient['pacient_id']; ?></td>
                <td><strong><?= $pacient['Nume']; ?></strong></td>
                <td><?= $pacient['Prenume']; ?></td>
                <td><?= $pacient['CNP']; ?></td>
                <td><?= $pacient['Adresa']; ?></td>
                <td><a href="edit_pacient.php?id=<?=$pacient['pacient_id'];?>" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td>
                <td><a href="detalii_pacient.php?id=<?=$pacient['pacient_id'];?>" class="btn btn-info active" role="button" aria-pressed="true">Detalii</a></td>
            </tr>

        <?php
        } ?>
    </tbody>
</table>
<?php include 'include/footer.php'; ?>