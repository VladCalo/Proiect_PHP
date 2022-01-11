<?php include 'include/db_connect.php';
#incarcam fisierul cu functii mysql pentru medici
include 'include/db_admin.php';

$id = $_GET['id'];

#PROCESARE FORMULAR
if (isset($_POST['nume'])) {


    $ret = update_diagnostice($conn, array(
        'Nume' => $conn->real_escape_string($_POST['nume']), 'Tratament' => $conn->real_escape_string($_POST['tratament']),
        'Descriere' => $conn->real_escape_string($_POST['descriere']),
        'diagnostic_id' => $conn->real_escape_string($id)
    ));
    if ($ret) {
        $message = "Diagnosticul a fost modificat!";
        #redirectare in pagina de pacienti
        header('Location: lista_diagnostice.php?msg=' . $message);
    }
}

$diagnostic_rs = get_diagnostic($conn, $id);
$cnt = $diagnostic_rs->num_rows;

if ($cnt > 0)
    $diagnostic = $diagnostic_rs->fetch_assoc();
else
    $diagnostic = null;


?>

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>

<div class="col-xs-12" style="height:30px;"></div>
<h3>Modificare Diagnostic</h3>
<div class="col-xs-12" style="height:30px;"></div>
<form action="edit_diagnostic.php?id=<?= $id ?>" method="POST">
    <div class="form-group">
        <label for="nume">Nume</label>
        <input type="text" class="form-control" name="nume" id="nume" placeholder="Nume diagnostic" value="<?= $diagnostic['Nume'] ?>">
    </div>
    <div class="form-group">
        <label for="tratment">Tratament</label>
        <textarea type="text" class="form-control" name="tratament" rows="5" id="tratament" placeholder="Tratament" rows="5" value="<?= $diagnostic['Tratament'] ?>"></textarea>
    </div>
    <div class="form-group">
        <label for="descriere">Descriere</label>
        <textarea type="text" class="form-control" name="descriere" rows="5" id="descriere" placeholder="Descriere"  value="<?= $diagnostic['Descriere'] ?>"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>