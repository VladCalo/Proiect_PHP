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

#citim toate consultatiile
$consultatii = list_consultatii_pacient($conn, $pacient_id);


#PROCESARE FORMULAR
if (isset($_POST['camera'])) {

    #sanitizare input cu real_escape_string
    $ret = add_internare($conn, array(
        'consultatie_id' => $conn->real_escape_string($_POST['consultatie']),
        'Data_checkin' => ($_POST['data_checkin']=='')?NULL:$conn->real_escape_string($_POST['data_checkin']), 'Data_checkout' => ($_POST['data_checkout']=='')?NULL:$conn->real_escape_string($_POST['data_checkout']),
        'Camera' => $conn->real_escape_string($_POST['camera']), 'Pat' => $conn->real_escape_string($_POST['pat'])
    ));
    if ($ret) {
        $message = "Internarea a fost adaugata!";
        #redirectare in pagina de pacient
        header('Location: detalii_pacient.php?id='.$pacient_id.'&msg=' . $message);
    }
}
?> 

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Adaugare Internare</h3>
<div class="col-xs-12" style="height:30px;"></div>
<div>Pacient: <strong><?=$pacient['Nume']?> <?=$pacient['Prenume']?></strong></div>
<form action="add_internare.php?id=<?=$pacient_id?>" method="POST">
    <div class="form-group">
        <label for="consultatie">Consultatie</label>
        <select class="form-control" name="consultatie" id="consultatie">
            <?php for ($i=0; $i<$consultatii->num_rows;$i++) {
                $consultatie = $consultatii->fetch_assoc();?>
                <option value="<?=$consultatie['consultatie_id']?>">Doctor <?=$consultatie['NumeMedic']?> <?=$consultatie['PrenumeMedic']?> / <?=$consultatie['Data']?> (<?=$consultatie['Diagnostic']?>)</option>
            <?php }?>
        </select>
    </div>
    <div class="form-group">
        <label for="data_checkin">Data checkin</label>
        <input type="text" class="form-control" name="data_checkin" id="data_checkin" placeholder="Data internare in format YYYY-MM-DD">
    </div>
    <div class="form-group">
        <label for="data_checkout">Data checkout</label>
        <input type="text" class="form-control" name="data_checkout" id="data_checkout" placeholder="Data externare in format YYYY-MM-DD">
    </div>
    <div class="form-group">
        <label for="camera">Camera</label>
        <input type="text" class="form-control" name="camera" id="camera" placeholder="Numarul camerei">
    </div>
    <div class="form-group">
        <label for="pat">Pat</label>
        <input type="text" class="form-control" name="pat" id="pat" placeholder="Pat">
    </div>
    <button type="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>