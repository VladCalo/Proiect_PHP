<?php include 'include/db_connect.php'; ?>

<?php
#PROCESARE FORMULAR
if (isset($_POST['nume'])) {
    #incarcam fisierul cu functii mysql pentru receptie
    include 'include/db_receptie.php';
    #sanitizare input cu real_escape_string
    $ret = add_pacient($conn, array(
        'Nume' => $conn->real_escape_string($_POST['nume']), 'Prenume' => $conn->real_escape_string($_POST['prenume']),
        'CNP' => $conn->real_escape_string($_POST['cnp']), 'Adresa' => $conn->real_escape_string($_POST['adresa'])
    ));
    if ($ret) {
        $message = "Pacientul a fost adaugat!";
        #redirectare in pagina de pacienti
        header('Location: lista_pacienti.php?msg=' . $message);
    }
}
?> 

<?php #incarcam HTML
include 'include/header.php';
include 'include/menu.php'; ?>

<h3>Adaugare Pacient</h3>

<form action="add_pacient.php" method="POST">
    <div class="form-group">
        <label for="nume">Nume</label>
        <input type="text" class="form-control" name="nume" id="nume" placeholder="Nume pacient">
    </div>
    <div class="form-group">
        <label for="prenume">Prenume</label>
        <input type="text" class="form-control" name="prenume" id="prenume" placeholder="Prenume pacient">
    </div>
    <div class="form-group">
        <label for="cnp">CNP</label>
        <input type="text" class="form-control" name="cnp" id="cnp" placeholder="CNP pacient">
    </div>
    <div class="form-group">
        <label for="adresa">Adresa</label>
        <input type="text" class="form-control" name="adresa" id="adresa" placeholder="Adresa pacient">
    </div>
    <button type="submit" name="submit" id="submit" class="btn btn-primary">Salveaza</button>
</form>

<?php include 'include/footer.php'; ?>