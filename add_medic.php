<?php include 'include/db_connect.php'; ?>

<?php
#PROCESARE FORMULAR
if (isset($_POST['nume'])) {
    #incarcam fisierul cu functii mysql pentru medici
    include 'include/db_medici.php';
    #sanitizare input cu real_escape_string
    $ret = add_medic($conn, array(
        'Nume' => $conn->real_escape_string($_POST['nume']), 'Prenume' => $conn->real_escape_string($_POST['prenume']),
        'Specialitate' => $conn->real_escape_string($_POST['specialitate']), 'Pret_consultatie' => $conn->real_escape_string($_POST['pret'])
    ));
    if ($ret) {
        $message = "Medicul a fost adaugat!";
        #redirectare in pagina de pacienti
        header('Location: lista_medici.php?msg=' . $message);
    }
}
?> 

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Adaugare Medic</h3>
<div class="col-xs-12" style="height:30px;"></div>
<form action="add_medic.php" method="POST">
    <div class="form-group">
        <label for="nume">Nume</label>
        <input type="text" class="form-control" name="nume" id="nume" placeholder="Nume medic">
    </div>
    <div class="form-group">
        <label for="prenume">Prenume</label>
        <input type="text" class="form-control" name="prenume" id="prenume" placeholder="Prenume medic">
    </div>
    <div class="form-group">
        <label for="specialitate">Specialitate</label>
        <input type="text" class="form-control" name="specialitate" id="specialitate" placeholder="Specialitatea medicului">
    </div>
    <div class="form-group">
        <label for="pret">Pret Consultatie (RON)</label>
        <input type="text" class="form-control" name="pret" id="pret" placeholder="Pret Consultatie">
    </div>
    <button type="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>