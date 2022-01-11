<?php include 'include/db_connect.php'; 
include 'include/db_receptie.php';
include 'include/db_medici.php';
include 'include/db_admin.php';?>

<?php

#Citim parametrul din GET si cautam pacientul dupa ID
$pacient_id = $_GET['id'];
$pacient_rs = get_pacient($conn, $pacient_id);
if ($pacient_rs->num_rows>0)
    $pacient = $pacient_rs->fetch_assoc();

#citim toti medicii
$medici = list_medici($conn);

#citim toate diagnosticele
$diagnostice = list_diagnostice($conn);


#PROCESARE FORMULAR
if (isset($_POST['tip'])) {

    #sanitizare input cu real_escape_string
    $ret = add_consultatie($conn, array(
        'pacient_id' => $conn->real_escape_string($pacient_id), 'medic_id' => $conn->real_escape_string($_POST['medic']),
        'diagnostic_id' => ($_POST['diagnostic']=='')?NULL:$conn->real_escape_string($_POST['diagnostic']), 'Tip' => $conn->real_escape_string($_POST['tip']),
        'data' => $conn->real_escape_string($_POST['data']), 'ora' => $conn->real_escape_string($_POST['ora'])
    ));
    if ($ret) {
        $message = "Consultatia a fost adaugata!";
        #redirectare in pagina de pacient
        header('Location: detalii_pacient.php?id='.$pacient_id.'&msg=' . $message);
    }
}
?> 

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Adaugare Consultatie</h3>
<div class="col-xs-12" style="height:30px;"></div>
<div>Pacient: <strong><?=$pacient['Nume']?> <?=$pacient['Prenume']?></strong></div>
<form action="add_consultatie.php?id=<?=$pacient_id?>" method="POST">
    <div class="form-group">
        <label for="medic">Medic</label>
        <select class="form-control" name="medic" id="medic">
            <?php for ($i=0; $i<$medici->num_rows;$i++) {
                $medic = $medici->fetch_assoc();?>
                <option value="<?=$medic['medic_id']?>"><?=$medic['Nume']?> <?=$medic['Prenume']?> (<?=$medic['Specialitate']?>)</option>
            <?php }?>
        </select>
    </div>
    <div class="form-group">
        <label for="diagnostic">Diagnostic</label>
        <select class="form-control" name="diagnostic" id="diagnostic">
            <option value=''>-Fara diagnostic-</option>
            <?php for ($i=0; $i<$diagnostice->num_rows;$i++) {
                $diagnostic = $diagnostice->fetch_assoc();?>
                <option value="<?=$diagnostic['diagnostic_id']?>"><?=$diagnostic['Nume']?></option>
            <?php }?>
        </select>
    </div>
    <div class="form-group">
        <label for="tip">Tip</label>
        <input type="text" class="form-control" name="tip" id="tip" placeholder="Online sau Clinica">
    </div>
    <div class="form-group">
        <label for="data">Data</label>
        <input type="text" class="form-control" name="data" id="data" placeholder="Data in format YYYY-MM-DD">
    </div>
    <div class="form-group">
        <label for="ora">Ora</label>
        <input type="text" class="form-control" name="ora" id="ora" placeholder="Ora programarii">
    </div>
    <button type="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>