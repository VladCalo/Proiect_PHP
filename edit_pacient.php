<?php include 'include/db_connect.php'; 
#incarcam fisierul cu functii mysql pentru receptie
include 'include/db_receptie.php';

$id = $_GET['id'];

#PROCESARE FORMULAR
if (isset($_POST['nume'])) {


    $ret = update_pacient($conn, array(
        'Nume' => $conn->real_escape_string($_POST['nume']), 'Prenume' => $conn->real_escape_string($_POST['prenume']),
        'CNP' => $conn->real_escape_string($_POST['cnp']), 'Adresa' => $conn->real_escape_string($_POST['adresa']),
        'pacient_id'=>$conn->real_escape_string($id)
    ));
    if ($ret) {
        $message = "Pacientul a fost modificat!";
        #redirectare in pagina de pacienti
        header('Location: lista_pacienti.php?msg=' . $message);
    }
}

$pacient_rs = get_pacient($conn, $id);
$cnt = $pacient_rs->num_rows;

if ($cnt>0)
    $pacient = $pacient_rs->fetch_assoc();
else 
    $pacient = null;

?> 

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Modificare Pacient</h3>
<div class="col-xs-12" style="height:30px;"></div>
<form action="edit_pacient.php?id=<?=$id?>" method="POST">
    <div class="form-group">
        <label for="nume">Nume</label>
        <input type="text" class="form-control" name="nume" id="nume" value="<?=$pacient['Nume']?>">
    </div>
    <div class="form-group">
        <label for="prenume">Prenume</label>
        <input type="text" class="form-control" name="prenume" id="prenume" value="<?=$pacient['Prenume']?>">
    </div>
    <div class="form-group">
        <label for="cnp">CNP</label>
        <input type="text" class="form-control" name="cnp" id="cnp" value="<?=$pacient['CNP']?>">
    </div>
    <div class="form-group">
        <label for="adresa">Adresa</label>
        <input type="text" class="form-control" name="adresa" id="adresa" value="<?=$pacient['Adresa']?>">
    </div>
    <button type="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>