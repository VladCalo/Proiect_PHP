<?php

#Facturi - LIST, ADD, UPDATE
function list_facturi ($conn, $search = '') {
    $sql = "SELECT f.*, p.Nume, p.Prenume FROM facturi f join pacienti p on f.pacient_id = p.pacient_id 
        WHERE upper(detalii) LIKE upper('%".$search."%')";
    $result = $conn->query($sql);
    return $result;
}

function get_factura($conn, $id) {
    $sql = "SELECT * FROM facturi f JOIN pacienti p on f.pacient_id = p.pacient_id  WHERE factura_id = ".$id;
    $result = $conn->query($sql);
    return $result;
}

function get_facturi_pacient ($conn, $pacient_id) {
    $sql = "SELECT * FROM facturi f JOIN pacienti p on f.pacient_id = p.pacient_id 
        WHERE f.pacient_id = ".$pacient_id;
    $result = $conn->query($sql);
    return $result;
}

function add_factura ($conn, $data) {
    $sql = $conn->prepare("INSERT INTO facturi (pacient_id, numar, data, detalii, valoare) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("iisss", $data['pacient_id'], $data['Numar'], $data['Data'], $data['Detalii'], $data['Valoare']);
    $sql->execute();
    return true;
}

function update_factura ($conn, $data) {
    $sql = $conn->prepare("UPDATE facturi set numar =?, data=?, detalii=?, valoare=? WHERE pacient_id=? and factura_id=?");
    $sql->bind_param("isssii", $data['Numar'], $data['Data'], $data['Detalii'], $data['Valoare'], $data['pacient_id'], $data['factura_id']);
    $sql->execute();
    return true;
}

function list_facturi_pacient ($conn, $pacient_id) {
    $sql = "SELECT * FROM facturi WHERE pacient_id = ".$pacient_id;
    $result = $conn->query($sql);
    return $result;
}

function list_plati_pacient ($conn, $pacient_id) {
    $sql = "SELECT p.*, f.Numar FROM plati p JOIN facturi f ON p.factura_id = f.factura_id 
    WHERE f.pacient_id = ".$pacient_id;
    $result = $conn->query($sql);
    return $result; 
}

function list_plati ($conn) {
    $sql = "SELECT p.*, f.Numar as NumarFactura, f.Data as DataFactura, f.Valoare as ValoareFactura,
    c.Nume, c.Prenume
    FROM plati p JOIN facturi f ON p.factura_id = f.factura_id 
    join pacienti c on f.pacient_id = c.pacient_id";
    $result = $conn->query($sql);
    return $result; 
}

function add_plata ($conn, $data) {
    $sql = $conn->prepare("INSERT INTO plati (factura_id, data, valoare) VALUES (?, ?, ?)");
    $sql->bind_param("iss", $data['factura_id'], $data['Data'], $data['Valoare']);
    $sql->execute();
    return true;
}
function update_plati ($conn, $data) {
    $sql = $conn->prepare("UPDATE plati set valoare =?, data=? WHERE plata_id=?");
    $sql->bind_param("ssi", $data['Valoare plata'], $data['Data platii'], $data['plata_id']);
    $sql->execute();
    return true;
}

function get_plata($conn, $id) {
    $sql = "SELECT * FROM plati WHERE plata_id = ".$id;
    $result = $conn->query($sql);
    return $result;
}

?>