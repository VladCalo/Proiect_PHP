<?php include 'include/db_connect.php'; 
#incarcam fisierul cu functii mysql pentru medici
include 'include/db_medici.php';

$id = $_GET['id'];

#PROCESARE FORMULAR
if (isset($_POST['nume'])) {

    $ret = update_medic($conn, array(
        'Nume' => $conn->real_escape_string($_POST['nume']), 'Prenume' => $conn->real_escape_string($_POST['prenume']),
        'Specialitate' => $conn->real_escape_string($_POST['specialitate']), 'Pret_consultatie' => $conn->real_escape_string($_POST['pret']),
        'medic_id'=>$conn->real_escape_string($id)
    ));
    if ($ret) {
        $message = "Medicul a fost modificat!";
        #redirectare in pagina de pacienti
        header('Location: lista_medici.php?msg=' . $message);
    }
}

$medic_rs = get_medic($conn, $id);
$cnt = $medic_rs->num_rows;

if ($cnt>0)
    $medic = $medic_rs->fetch_assoc();
else 
    $medic = null;

?> 

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>

<h3>Modificare Medic</h3>

<form action="edit_medic.php?id=<?=$id?>" method="POST">
    <div class="form-group">
        <label for="nume">Nume</label>
        <input type="text" class="form-control" name="nume" id="nume" value="<?=$medic['Nume']?>">
    </div>
    <div class="form-group">
        <label for="prenume">Prenume</label>
        <input type="text" class="form-control" name="prenume" id="prenume" value="<?=$medic['Prenume']?>">
    </div>
    <div class="form-group">
        <label for="specialitate">Specialitate</label>
        <input type="text" class="form-control" name="specialitate" id="specialitate" value="<?=$medic['Specialitate']?>">
    </div>
    <div class="form-group">
        <label for="pret">Pret Consultatie</label>
        <input type="text" class="form-control" name="pret" id="pret" value="<?=$medic['Pret_consultatie']?>">
    </div>
    <button type="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>