<?php

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require('../asset/fpdf/vendor/autoload.php');



$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('../asset/image/logosmkblm.png',10,8,20);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,6,'YAYASAN BANGUN BINA ANAK INDONESIA',0,1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,10,'SMK PLUS BERKUALITAS LENGKONG MANDIRI',0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,5,'Jl. Lengkong Raya, Kel. Lengkong Wetan, Kec. Serpong, Kota Tangerang Selatan, Banten 15310. Telp.021-53191575, E-mail: smkplusblm@gmail.com',0,1,'C');


$pdf->Cell(190,5,'','T',10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,10,'LAPORAN REKAP DATA SURAT MASUK',0,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,10,'','B',1);
$pdf->Cell(10,10,'No',0,0,'C',0);
$pdf->Cell(40,10,'Perihal Surat',0,0,'C');
$pdf->Cell(60,10,'Nomor Surat',0,0,'C');
$pdf->Cell(20,10,'Tanggal Surat',0,0,'C');
$pdf->Cell(60,10,'Asal Surat',0,1,'C');
$pdf->Cell(190,1,'','T',1);
$pdf->Ln();



$pdf->SetFont('Arial','',12);
$no = 1;
$dataSm = getData("SELECT * FROM tbl_sm");
foreach($dataSm as $data){
    $pdf->Cell(10,8,$no++,0,0,'C');
    $pdf->Cell(40,8,$data['perihalsm'],0,0);
    $pdf->Cell(60,8,$data['no_sm'],0,0,'C');
    $pdf->Cell(20,10,tgl_indo($data['tglsuratmasuk']),0,0,'C');
    $pdf->Cell(60,10,$data['instansi'],0,1,'C');
}
$pdf->Cell(190,1,'','T',1);

$pdf->Output();


?>