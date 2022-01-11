<?php include 'include/db_connect.php'; 
include 'include/db_receptie.php';
include 'include/db_financiar.php';?>

<?php

#Citim parametrul din GET si cautam pacientul dupa ID
$pacient_id = $_GET['id'];
$pacient_rs = get_pacient($conn, $pacient_id);
if ($pacient_rs->num_rows>0)
    $pacient = $pacient_rs->fetch_assoc();

#PROCESARE FORMULAR
if (isset($_POST['numar'])) {

    #sanitizare input cu real_escape_string
    $ret = add_factura($conn, array(
        'pacient_id' => $conn->real_escape_string($pacient_id), 'Numar' => $conn->real_escape_string($_POST['numar']),
        'Data' => ($_POST['data']=='')?NULL:$conn->real_escape_string($_POST['data']), 'Valoare' => $conn->real_escape_string($_POST['valoare']),
        'Detalii' => $conn->real_escape_string($_POST['detalii'])
    ));
    if ($ret) {
        $message = "Factura a fost adaugata!";
        #redirectare in pagina de pacient
        header('Location: detalii_pacient.php?id='.$pacient_id.'&msg=' . $message);
    }
    
}
?> 

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Adaugare Factura</h3>
<div class="col-xs-12" style="height:30px;"></div>
<div>Pacient: <strong><?=$pacient['Nume']?> <?=$pacient['Prenume']?></strong></div>
<form action="add_factura.php?id=<?=$pacient_id?>" method="POST">
    <div class="form-group">
        <label for="numar">Numar</label>
        <input type="text" class="form-control" name="numar" id="numar" placeholder="Numar factura">
    </div>
    <div class="form-group">
        <label for="data">Data</label>
        <input type="text" class="form-control" name="data" id="data" placeholder="Data in format YYYY-MM-DD">
    </div>
    <div class="form-group">
        <label for="detalii">Detalii factura</label>
        <input type="text" class="form-control" name="detalii" id="detalii" placeholder="Detalii factura">
    </div>
    <div class="form-group">
        <label for="valoare">Valoare</label>
        <input type="text" class="form-control" name="valoare" id="valoare" placeholder="Valoarea facturii (RON)">
    </div>
    <button type="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>