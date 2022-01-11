<?php #includem functiile de lucru cu baza de date si HTML
include 'include/db_connect.php';
include 'include/db_medici.php';
include 'include/header.php';
include 'include/menu.php'; 
check_session(); ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Lista Medici</h3>
<div class="col-xs-12" style="height:30px;"></div>
<?php 
#daca este primit un mesaj, il afisam
if (isset($_GET['msg'])) { ?>
    <div class="alert alert-success" role="alert">
        <?= $_GET['msg'] ?>
    </div>
<?php } ?>

<a href="add_medic.php" class="btn btn-primary active" role="button" aria-pressed="true">Adauga medic nou</a>
<div class="col-xs-12" style="height:30px;"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nume</th>
            <th scope="col">Prenume</th>
            <th scope="col">Specialitate</th>
            <th scope="col">Pret consultatie</th>
            <th scope="col">Modifica</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ret = list_medici($conn);
        $numar_medici = $ret->num_rows;
        for ($i = 0; $i < $numar_medici; $i++) {
            $medic = $ret->fetch_assoc();
        ?>
            <tr>
                <td><?= $medic['medic_id']; ?></td>
                <td><strong><?= $medic['Nume']; ?></strong></td>
                <td><?= $medic['Prenume']; ?></td>
                <td><?= $medic['Specialitate']; ?></td>
                <td><?= $medic['Pret_consultatie']; ?></td>
                <td><a href="edit_medic.php?id=<?=$medic['medic_id'];?>" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td>
            </tr>

        <?php
        } ?>
    </tbody>
</table>
<?php include 'include/footer.php'; ?>