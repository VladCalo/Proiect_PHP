<?php #includem functiile de lucru cu baza de date si HTML
include 'include/db_connect.php';
include 'include/db_receptie.php';
include 'include/header.php';
include 'include/menu.php'; 
check_session(); ?>

<?php
$show = 'toate';
if (isset ($_GET['active'])) {
    if ($_GET['active']=='1')
        $show = 'curente';
    else   
        $show = 'trecute';
}
?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Lista Internari (<?=$show?>)</h3>


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
            <th scope="col">Diagnostic</th>
            <th scope="col">Data internare</th>
            <th scope="col">Data Externare</th>
            <th scope="col">Camera</th>
            <th scope="col">Pat</th>
            <th scope="col">Modifica</th>
        </tr>
    </thead>
    <tbody>
        <?php
        switch ($show) {
            case 'curente': $ret = list_internari_curente($conn); break;
            case 'trecute': $ret = list_externari($conn); break;
            default: $ret = list_internari($conn);
        }
        $numar_internari = $ret->num_rows;
        for ($i = 0; $i < $numar_internari; $i++) {
            $internare = $ret->fetch_assoc();
        ?>
            <tr>
                <td><strong><?= $internare['Nume']; ?> <?= $internare['Prenume']; ?></strong></td>
                <td><?= $internare['Diagnostic']; ?></td>
                <td><?= $internare['Data_checkin']; ?></td>
                <td><?= $internare['Data_checkout']; ?></td>
                <td><?= $internare['Camera']; ?></td>
                <td><?= $internare['Pat']; ?></td>
                <td><a href="edit_internare.php?id=<?=$internare['internare_id'];?>" class="btn btn-warning active" role="button" aria-pressed="true">Modifica</a></td>
            </tr>

        <?php
        } ?>
    </tbody>
</table>
<?php include 'include/footer.php'; ?>