<?php #includem functiile de lucru cu baza de date si HTML
include 'include/db_connect.php';
include 'include/db_receptie.php';
include 'include/db_financiar.php';
include 'include/header.php';
include 'include/menu.php'; 
check_session(); ?>
<?php 

$id = $_GET['id'];

$factura_rs = get_factura($conn, $id);
$factura = $factura_rs->fetch_assoc();
$TVA = 0.19;
#daca este primit un mesaj, il afisam
if (isset($_GET['msg'])) { ?>
    <div class="alert alert-success" role="alert">
        <?= $_GET['msg'] ?>
    </div>
<?php } ?>
<div class="col-xs-12" style="height:50px;"></div>
<div class="row">   
  <div class="col-md-4">
      <strong>Vanzator</strong><br/>
        S.C. MyClinic S.R.L.<br/>
        Nr. Reg. Com:	<strong>J32/598/2008</strong>	<br/>	
        CIF:    <strong>RO 17638887</strong>			<br/>	
        Adresa:	<strong>Bd. Kisseleff 104, 432299, Bucuresti</strong><br/>
        Email:	<strong>office@myclinic.ro</strong>			<br/>
        Tel:	<strong>021 488 7000</strong><br/>
        Banca:	<strong>ING BANK</strong><br/>
        Cont:	<strong>RO44INGB9988733222</strong>		<br/>
  </div>
  <div class="col-md-4">
      <h3><p class="text-center">FACTURA</p></h3>
      <p class="text-center">Seria si numarul facturii: MC-<?=$factura['Numar']?><br>
    Termen de plata: 30 zile</p>
  </div>
  <div class="col-md-4">
    <strong>Cumparator</strong><br/>
    Nume: <strong><?= $factura['Nume']; ?> <?= $factura['Prenume']; ?></strong><br/>
    CNP: <strong><?= $factura['CNP']; ?></strong><br/>
    Adresa: <strong><?= $factura['Adresa']; ?></strong><br/>
  </div>
</div>

<div class="col-xs-12" style="height:50px;"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nr. crt.</th>
            <th scope="col">Denumirea serviciilor</th>
            <th scope="col">U.M.</th>
            <th scope="col">Cantitate</th>
            <th scope="col" class="text-right">Valoare fara TVA</th>
            <th scope="col" class="text-right">Cota TVA</th>
            <th scope="col" class="text-right">Valoarea totala</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td><?= $factura['Detalii']; ?></td>
            <td>buc</td>
            <td>1</td>
            <td class="text-right"><?= round($factura['Valoare']/(1+$TVA),2); ?></td>
            <td class="text-right"><?= round($factura['Valoare']*$TVA/(1+$TVA),2); ?></td>
            <td class="text-right"><?= $factura['Valoare']; ?></td>
        </tr>
        <tr>
            <td colspan = "7"></td>
        </tr>
        <tr>
            <td colspan = "7"></td>
        </tr>
        <tr>
            <td colspan = "7"></td>
        </tr>
        <tr>
            <td colspan = "7"></td>
        </tr>
        <tr>
            <td colspan = "6"><strong>Valoare totala - incl. TVA - RON</strong></td>
            <td class="text-right"><strong><?= $factura['Valoare']; ?></strong></td>
        </tr>
    </tbody>
</table>

<?php include 'include/footer.php'; ?>