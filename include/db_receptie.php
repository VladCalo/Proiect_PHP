<?php

#PACIENTI - LIST, ADD, UPDATE
function list_pacienti ($conn, $search = '') {
    $sql = "SELECT * FROM pacienti WHERE upper(nume) LIKE upper('%".$search."%') OR upper(prenume) LIKE upper('%".$search."%')";
    $result = $conn->query($sql);
    return $result;
}

function get_pacient($conn, $id) {
    $sql = "SELECT * FROM pacienti WHERE pacient_id = ".$id;
    $result = $conn->query($sql);
    return $result;
}

function add_pacient ($conn, $data) {
    $sql = $conn->prepare("INSERT INTO pacienti (nume, prenume, CNP, adresa) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $data['Nume'], $data['Prenume'], $data['CNP'], $data['Adresa']);
    $sql->execute();
    return true;
    #return $conn->insert_id;
}

function update_pacient ($conn, $data) {
    $sql = $conn->prepare("UPDATE pacienti set nume =?, prenume=?, CNP=?, adresa=? WHERE pacient_id=?");
    $sql->bind_param("ssssi", $data['Nume'], $data['Prenume'], $data['CNP'], $data['Adresa'], $data['pacient_id']);
    $sql->execute();
    return true;
}


#CONSULTATII - LIST, ADD, UPDATE
function list_consultatii ($conn, $pacient) {
    $sql = "SELECT * FROM consultatii WHERE pacient_id = ".$pacient;
    $result = $conn->query($sql);
    return $result;
}

function add_consultatie ($conn, $data) {
    $sql = $conn->prepare("INSERT INTO consultatii (pacient_id, medic_id, diagnostic_id, tip, data, ora, internare) VALUES (?, ?, ?, ?, ?, ?, 0)");
    $sql->bind_param("iiisss", $data['pacient_id'], $data['medic_id'], $data['diagnostic_id'], $data['Tip'], $data['data'], $data['ora']);
    $sql->execute();
    echo $sql->error;
    return true;
}

function update_consultatie ($conn, $data) {
    $sql = $conn->prepare("UPDATE consultatii set pacient_id=?, medic_id=?, diagnostic_id=?, tip=?, data=?, ora=?, internare=? where consultatie_id=? VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("iiisssii", $data['pacient_id'], $data['medic_id'], $data['diagnostic_id'], $data['Tip'], $data['data'], $data['ora'], $data['Internare'], $data['consultatie_id']);
    $sql->execute();
    return true;
}

function list_consultatii_pacient ($conn, $pacient) {
    $sql = "SELECT c.*, m.nume as NumeMedic, m.prenume as PrenumeMedic, d.Nume as Diagnostic, m.Pret_consultatie 
        FROM consultatii c 
        JOIN medici m on c.medic_id = m.medic_id 
        LEFT JOIN diagnostice d on c.diagnostic_id = d.diagnostic_id
        WHERE c.pacient_id = ".$pacient;
    $result = $conn->query($sql);
    return $result;
}


#FISE - LIST, ADD, UPDATE, DESCHIDERE, INCHIDERE
function list_fise ($conn) {
    $sql = "SELECT * FROM fise";
    $result = $conn->query($sql);
    return $result;
}

function list_fise_pacient ($conn, $pacient) {
    $sql = "SELECT * FROM fise WHERE pacient_id = ".$pacient;
    $result = $conn->query($sql);
    return $result;
}

function add_fisa ($conn, $data) {
    $sql = $conn->prepare("INSERT INTO fise (pacient_id, consultatie_id, data, status) VALUES (?, ?, ?, 'Noua')");
    $sql->bind_param("iis", $data['pacient_id'], $data['consultatie_id'], $data['data']);
    $sql->execute();
    return true;
}

function update_fisa ($conn, $data) {
    $sql = $conn->prepare("UPDATE fise set data=?, status=? WHERE pacient_id=? and consultatie_id=?) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssii", $data['data'], $data['status'], $data['pacient_id'], $data['consultatie_id']);
    $sql->execute();
    return true;
}

function deschide_fisa ($conn, $data) {
    $sql = $conn->prepare("UPDATE fise SET status='Deschisa' where WHERE pacient_id=? and consultatie_id=?) VALUES (?, ?)");
    $sql->bind_param("ii", $data['pacient_id'], $data['consultatie_id']);
    $sql->execute();
    return true;
}

function inchide_fisa ($conn, $data) {
    $sql = $conn->prepare("UPDATE fise SET status='Inchisa' where WHERE pacient_id=? and consultatie_id=?) VALUES (?, ?)");
    $sql->bind_param("ii", $data['pacient_id'], $data['consultatie_id']);
    $sql->execute();
    return true;
}


#INTERNARI si EXTERNARI
function list_internari ($conn) {
    $sql = "SELECT i.*, p.Nume, p.Prenume, d.Nume as Diagnostic 
    FROM internari i join consultatii c on i.consultatie_id = c.consultatie_id 
    join pacienti p on c.pacient_id = p.pacient_id 
    left join diagnostice d on c.diagnostic_id = d.diagnostic_id  ORDER BY i.internare_id DESC";
    $result = $conn->query($sql);
    return $result;
}

function list_internari_curente ($conn) {
    $sql = "SELECT i.*, p.Nume, p.Prenume, d.Nume as Diagnostic 
    FROM internari i join consultatii c on i.consultatie_id = c.consultatie_id 
    join pacienti p on c.pacient_id = p.pacient_id 
    left join diagnostice d on c.diagnostic_id = d.diagnostic_id  
    where data_checkout is null ORDER BY i.internare_id DESC";
    $result = $conn->query($sql);
    return $result;
}

function list_externari ($conn) {
    $sql = "SELECT i.*, p.Nume, p.Prenume, d.Nume as Diagnostic 
    FROM internari i join consultatii c on i.consultatie_id = c.consultatie_id 
    join pacienti p on c.pacient_id = p.pacient_id 
    left join diagnostice d on c.diagnostic_id = d.diagnostic_id  
    where data_checkout is not null ORDER BY i.internare_id DESC";
    $result = $conn->query($sql);
    return $result;
}

function list_internari_pacient ($conn, $pacient_id) {
    $sql = "SELECT i.* FROM internari i join consultatii c on i.consultatie_id = c.consultatie_id 
    where c.pacient_id = ".$pacient_id." ORDER BY i.internare_id DESC";
    $result = $conn->query($sql);
    return $result;
}

function add_internare ($conn, $data) {
    $sql = $conn->prepare("INSERT INTO internari (consultatie_id, data_checkin, data_checkout, camera, pat) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("issss", $data['consultatie_id'], $data['Data_checkin'], $data['Data_checkout'], $data['Camera'], $data['Pat']);
    $sql->execute();
    return true;
}

?>