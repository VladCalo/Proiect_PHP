<?php include 'include/db_connect.php'; 
#incarcam fisierul cu functii mysql pentru medici
include 'include/db_financiar.php';

$id = $_GET['id'];

#PROCESARE FORMULAR
if (isset($_POST['valoare'])) {


    $ret = update_plati($conn, array(
        'Valoare Plata' => $conn->real_escape_string($_POST['valoare']), 'Data platii' => $conn->real_escape_string($_POST['data']),
        'plata_id'=>$conn->real_escape_string($id)
    ));
    if ($ret) {
        $message = "Plata a fost modificat!";
        #redirectare in pagina de pacienti
        header('Location: lista_plati.php?msg=' . $message);
    }
}

$plata_rs = get_plata($conn, $id);
$cnt = $plata_rs->num_rows;

if ($cnt>0)
    $plata = $plata_rs->fetch_assoc();
else 
    $plata = null;
 

?> 

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>

<h3>Modificare Plata</h3>

<form action="edit_plata.php?id=<?=$pacient_id?>" method="POST">
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
        <input type="text" class="form-control" name="data" id="data" placeholder="Data in format YYYY-MM-DD" value="<?=$plata['Data platii']?>">
    </div>
    <div class="form-group">
        <label for="valoare">Valoare</label>
        <input type="text" class="form-control" name="valoare" id="valoare" placeholder="Valoarea facturii (RON)" value="<?=$plata['Valoare Plata']?>">
    </div>
    <button type="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>