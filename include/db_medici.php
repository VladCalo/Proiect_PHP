<?php

#MEDICI - LIST, ADD, UPDATE
function list_medici ($conn, $search = '') {
    $sql = "SELECT * FROM medici WHERE upper(nume) LIKE upper('%".$search."%') OR upper(prenume) LIKE upper('%".$search."%')";
    $result = $conn->query($sql);
    return $result;
}

function get_medic($conn, $id) {
    $sql = "SELECT * FROM medici WHERE medic_id = ".$id;
    $result = $conn->query($sql);
    return $result;
}

function add_medic ($conn, $data) {
    $sql = $conn->prepare("INSERT INTO medici (nume, prenume, specialitate, pret_consultatie) VALUES (?, ?, ?, ?)");
    $sql->bind_param("sssi", $data['Nume'], $data['Prenume'], $data['Specialitate'], $data['Pret_consultatie']);
    $sql->execute();
    return true;
}

function update_medic ($conn, $data) {
    $sql = $conn->prepare("UPDATE medici set nume =?, prenume=?, specialitate=?, pret_consultatie=? WHERE medic_id=?");
    $sql->bind_param("sssii", $data['Nume'], $data['Prenume'], $data['Specialitate'], $data['Pret_consultatie'], $data['medic_id']);
    $sql->execute();
    return true;
}
?>