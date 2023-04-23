<?php
require_once('includes/TCPDF/tcpdf.php');
session_start();
include "../dbcon.php";

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo.png';
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('times', 'B', 20);
        // Title
        $this->Cell(0, 15, 'BOHOL ISLAND STATE UNIVERISTY', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->setMargins('PDF_MARGIN_TOP', 15);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('Monthly Report');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'B', 12);

// add a page
$pdf->AddPage();

// set some text to print
$txt = <<<EOD
BALILIHAN CAMPUS


INVENTORY CUSTODIAN SLIP

EOD;
$printname = $_SESSION['useridname'];
$txtheader = <<<EOD
Custodian Name : $printname   


EOD;

$html = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td>Barcode Number</td>
        <td>Supply Name</td>
        <td>Quantity</td>
        <td>Unit Price</td>
        <td>Date Borrowed</td>
        <td>Date Returned</td>
    </tr>
</table>
EOD;

$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(0, $txtheader, '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);  

$sql = "SELECT * FROM transactions WHERE `borrower_name`='" .$_SESSION['useridname'] . "';";
$actresult = mysqli_query($conn, $sql);
while ($result = mysqli_fetch_assoc($actresult)) {
    $sql1 = "SELECT s.unit_price FROM `supplies` s WHERE s.name='" . $result['supply_name'] . "';";
    $actresult1 = mysqli_query($conn, $sql1);
    $result1 = mysqli_fetch_assoc($actresult1);
    $barcode = $result['barcode'];
    $sname = $result['supply_name'];
    $quan = $result['quantity'];
    $uprice = $result1['unit_price'];
    $breleased = $result['date_released'];
    $breturned = $result['date_returned'];

$newhtml = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td>$barcode</td>
        <td>$sname</td>
        <td>$quan</td>
        <td>$uprice</td>
        <td>$breleased</td>
        <td>$breturned</td>
    </tr>
</table>
EOD;


$pdf->writeHTMLCell(0, 0, '', '', $newhtml, 0, 1, 0, true, '', true);   
}

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output();

//============================================================+
// END OF FILE
//============================================================+
?>