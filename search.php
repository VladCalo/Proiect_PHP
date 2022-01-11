<?php 
include 'include/db_connect.php';
include 'include/db_receptie.php';
include 'include/header.php';
include 'include/menu.php'; 
check_session(); ?>
<div class="col-xs-12" style="height:30px;"></div>
<?php
        $search = $_POST['search'];
        $ret = list_pacienti($conn, $conn->real_escape_string($search));
        $numar_pacienti = $ret->num_rows;
?>

<h3>Cautare dupa cuvantul "<?=$search?>"</h3>
<div class="col-xs-12" style="height:30px;"></div>

<?php if ($numar_pacienti==0) {?>
    <h4>Nu au fost gasite rezultate!</h4>
<?php } 
else {?>
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
<?php }
?>
<?php include 'include/footer.php'; ?>