<?php #includem functiile de lucru cu baza de date si HTML
include 'include/db_connect.php';
include 'include/db_admin.php';
include 'include/header.php';
include 'include/menu.php'; 
check_session(); ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Lista Diagnostice</h3>
<div class="col-xs-12" style="height:30px;"></div>


<a href="add_diagnostic.php" class="btn btn-primary active" role="button" aria-pressed="true">Adauga diagnostic nou</a>
<div class="col-xs-12" style="height:30px;"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <!-- <th scope="col">#</th> -->
            <th scope="col">Nume</th>
            <th scope="col">Tratament</th>
            <th scope="col">Descriere</th>
            <th scope="col">Modifica</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ret = list_diagnostice($conn);
        $numar_diagnostice = $ret->num_rows;
        for ($i = 0; $i < $numar_diagnostice; $i++) {
            $diagnostic = $ret->fetch_assoc();
        ?>
            <tr>
                <!-- <td><?= $diagnostic['diagnostic_id']; ?></td> -->
                <td><strong><?= $diagnostic['Nume']; ?></strong></td>
                <td><?= $diagnostic['Tratament']; ?></td>
                <td><?= $diagnostic['Descriere']; ?></td>
                <td><a href="edit_diagnostic.php?id=<?=$diagnostic['diagnostic_id'];?>" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td>
            </tr>

        <?php
        } ?>
    </tbody>
</table>
<?php include 'include/footer.php'; ?>