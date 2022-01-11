<?php include 'include/db_connect.php'; ?>

<?php
#PROCESARE FORMULAR
if (isset($_POST['nume'])) {
    #incarcam fisierul cu functii mysql pentru medici
    include 'include/db_admin.php';
    #sanitizare input cu real_escape_string
    $ret = add_diagnostic($conn, array(
        'Nume' => $conn->real_escape_string($_POST['nume']), 'Tratament' => $conn->real_escape_string($_POST['tratament']),
        'Descriere' => $conn->real_escape_string($_POST['descriere'])
    ));
    if ($ret) {
        $message = "Diagnosticul a fost adaugat!";
        #redirectare in pagina de diagnostice
        header('Location: lista_diagnostice.php?msg=' . $message);
    }
}
?> 

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>
<div class="col-xs-12" style="height:30px;"></div>
<h3>Adaugare Diagnostic</h3>
<div class="col-xs-12" style="height:30px;"></div>
<form action="add_diagnostic.php" method="POST">
    <div class="form-group">
        <label for="nume">Nume</label>
        <input type="text" class="form-control" name="nume" id="nume" placeholder="Nume diagnostic">
    </div>
    <div class="form-group">
        <label for="tratament">Tratament</label>
        <textarea  class="form-control" name="tratament" id="tratament" placeholder="Tratament" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label for="descriere">Specialitate</label>
        <textarea  class="form-control" name="descriere" id="descriere" placeholder="Descriere" rows="5"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>