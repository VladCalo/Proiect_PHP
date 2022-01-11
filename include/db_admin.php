<?php

#Diagnostice - LIST, ADD, UPDATE
function list_diagnostice ($conn, $search = '') {
    $sql = "SELECT * FROM diagnostice WHERE upper(nume) LIKE upper('%".$search."%')";
    $result = $conn->query($sql);
    return $result;
}

function get_diagnostic($conn, $id) {
    $sql = "SELECT * FROM diagnostice WHERE diagnostic_id = ".$id;
    $result = $conn->query($sql);
    return $result;
}

function add_diagnostic ($conn, $data) {
    $sql = $conn->prepare("INSERT INTO diagnostice (nume, tratament, descriere) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $data['Nume'], $data['Tratament'], $data['Descriere']);
    $sql->execute();
    return true;
    
}

function update_diagnostice ($conn, $data) {
    $sql = $conn->prepare("UPDATE diagnostice set nume =?, tratament=?, descriere=? WHERE pacient_id=?");
    $sql->bind_param("sssi", $data['Nume'], $data['Tratament'], $data['Descriere'], $data['pacient_id']);
    $sql->execute();
    return true;
}

##STATISTICI

function count_pacienti ($conn) {
    $sql = "SELECT count(*) from pacienti";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    return $row[0];
}

function count_medici ($conn) {
    $sql = "SELECT count(*) from medici";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    return $row[0];
}

function count_internari ($conn) {
    $sql = "SELECT count(*) from internari";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    return $row[0];
}

function count_facturi ($conn) {
    $sql = "SELECT count(*) from facturi";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    return $row[0];
}

function count_plati ($conn) {
    $sql = "SELECT count(*) from plati";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    return $row[0];
}

function sum_facturi ($conn) {
    $sql = "SELECT sum(Valoare) from facturi";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    return $row[0];
}

function sum_plati ($conn) {
    $sql = "SELECT sum(Valoare) from plati";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    return $row[0];
}


?>