
<?php include 'include/db_connect.php'; ?>
<?php include 'include/db_access.php'; ?>
<?php include 'include/db_admin.php'; ?>
<?php include 'include/header.php'; ?>
<?php include 'include/menu.php'; ?>

<?php
$nr_pacienti = count_pacienti($conn);
$nr_medici = count_medici($conn);
$nr_internari = count_internari($conn);
$nr_facturi = count_facturi($conn);
$nr_plati = count_plati($conn);
$total_facturi = sum_facturi($conn);
$total_plati = sum_plati ($conn);
?>

<div class="col-xs-12" style="height:30px;"></div>
<h3>Dashboard</h3>
<div class="col-xs-12" style="height:30px;"></div>
<div class="row">
    <div class="col-sm">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Pacienti <span class="badge badge-primary"><?=$nr_pacienti;?></span></h5>
                <p class="card-text">Pacientii prezenti in sistem. Din pagina de detalii pacient se pot adauga consultatii, internari, facturi, plati.</p>
                <a href="lista_pacienti.php" class="card-link">Lista pacienti</a>
                <a href="add_pacient.php" class="card-link">Adaugare pacient</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Medici <span class="badge badge-primary"><?=$nr_medici;?></span></h5>
                <p class="card-text">Medicii clinicii, impreuna cu informatii referitoare la specialitatile acestora si tariful pentru consultatie.</p>
                <a href="lista_medici.php" class="card-link">Lista medici</a>
                <a href="add_medic.php" class="card-link">Adaugare medic</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Internari <span class="badge badge-primary"><?=$nr_internari;?></span></h5>
                <p class="card-text">Lista internarilor, atat cele prezente, cat si cele trecute (externari).</p>
                <a href="lista_internari.php?active=1" class="card-link">Internari curente</a>
                <a href="lista_internari.php?active=0" class="card-link">Externari</a>
            </div>
        </div>
    </div>
</div>
<div class="col-xs-12" style="height:50px;"></div>    
<div class="row">
    <div class="col-sm">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Facturi <span class="badge badge-primary"><?=$nr_facturi;?></span></h5>
                <p class="card-text">Lista facturilor si optiunea de adugare factura</p>
                <a href="lista_facturi.php" class="card-link">Lista facturi</a>
                <a href="add_factura.php" class="card-link">Adaugare factura</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Plati  <span class="badge badge-primary"><?=$nr_plati;?></span></h5>
                <p class="card-text">Lista platilor si optiunea de adugare plata</p>
                <a href="lista_plati.php" class="card-link">Lista plati</a>
                <a href="add_plata.php" class="card-link">Adaugare plata</a>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Situatie finaciara</h5>
                <p class="card-text">Total facturat: <span class="badge badge-success"><?=$total_facturi;?> RON</span></br>Total incasat: <span class="badge badge-warning"><?=$total_plati;?> RON</span></br>Diferenta: <span class="badge badge-danger"><?=$total_facturi-$total_plati;?> RON</span></p>
            </div>
        </div>
    </div>
</div> 
<?php include 'include/footer.php'; ?>