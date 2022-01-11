<?php include 'include/db_connect.php'; 
include 'include/db_receptie.php';
include 'include/db_financiar.php';?>

<?php

#Citim parametrul din GET si cautam pacientul dupa ID
$pacient_id = $_GET['id'];
$pacient_rs = get_pacient($conn, $pacient_id);
if ($pacient_rs->num_rows>0)
    $pacient = $pacient_rs->fetch_assoc();

$facturi_rs = get_facturi_pacient($conn, $pacient_id);


#PROCESARE FORMULAR
if (isset($_POST['valoare'])) {

    #sanitizare input cu real_escape_string
    $ret = add_plata($conn, array(
        'factura_id' => $conn->real_escape_string($_POST['factura']), 
        'Data' => ($_POST['data']=='')?NULL:$conn->real_escape_string($_POST['data']), 'Valoare' => $conn->real_escape_string($_POST['valoare'])
    ));
    if ($ret) {
        $message = "Plata a fost adaugata!";
        #redirectare in pagina de pacient
        header('Location: detalii_pacient.php?id='.$pacient_id.'&msg=' . $message);
    }
}
?> 

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>

<h3>Adaugare Plata</h3>

<div>Pacient: <strong><?=$pacient['Nume']?> <?=$pacient['Prenume']?></strong></div>
<form action="add_plata.php?id=<?=$pacient_id?>" method="POST">
    <div class="form-group">
        <label for="factura">Factura</label>
        <select class="form-control" name="factura" id="factura">
            <?php for ($i=0; $i<$facturi_rs->num_rows;$i++) {
                $factura = $facturi_rs->fetch_assoc();?>
                <option value="<?=$factura['factura_id']?>">Factura <?=$factura['Numar']?>/<?=$factura['Data']?> (<?=$factura['Valoare']?> RON)</option>
            <?php }?>
        </select>
    </div>
    <div class="form-group">
        <label for="data">Data</label>
        <input type="text" class="form-control" name="data" id="data" placeholder="Data in format YYYY-MM-DD">
    </div>
    <div class="form-group">
        <label for="valoare">Valoare</label>
        <input type="text" class="form-control" name="valoare" id="valoare" placeholder="Valoarea facturii (RON)">
    </div>
    <button type="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>