<?php
//============================================================+
// File name   : example_009.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 009 for TCPDF class
//               Test Image
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Test Image
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('HAYAT.IN');
$pdf->SetTitle('TCPDF Example 009');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default header data
#$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);

// set header and footer fonts
#$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
#$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
#$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
#$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
#$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
#$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// -------------------------------------------------------------------

// add a page
$pdf->AddPage();

// set JPEG quality
$pdf->setJPEGQuality(100);

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Image example with resizing
$pdf->Image('images/image_demo.jpg', '', '', 100, 150, 'JPG', '', '', true, 300, 'L', false, false, 1, false, false, false);



// Add name:

// set some text to print
/*$txt = <<<EOD
TCPDF Example 002

Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
EOD;*/

$txtStatus = <<<EOD
<span color="#ffffff">VISITOR</span>
EOD;

// print a block of text using Write()
$pdf->SetY(86);
$pdf->SetFont('helvetica', 'B', 25);

#$pdf->Cell(100, 0, $txt, 1, 1, 'C', 0, 'M', 'M');

$pdf->writeHTMLCell(100, 0, '', '', $txtStatus, 0, 1, 0, true, 'C', true); //(100, 5, $txtStatus, 0, 'C', 0, 0, '10', '', true);

$fname = $name = "Jannatul Samser Mihiron";
$lname = "Samser Mihiron";
$company = "Hayat Infosystems";
$email = "info@hayat.in";

$txt = substr($name,0,50);

// print a block of text using Write()
$pdf->SetY(102);
$pdf->SetFont('helvetica', 'B', 16);

#$pdf->Cell(100, 0, $txt, 1, 1, 'C', 0, 'M', 'M');

$pdf->MultiCell(100, 5, $txt, 0, 'C', 0, 0, '10', '', true);

//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);


$pdf->SetY(116);
$pdf->SetFont('helvetica', 'BI', 10);
$txt = "HAYAT INFOSYSTEMS\nKolkata, India";
$pdf->MultiCell(100, 5, $txt, 0, 'C', 0, 0, '10', '', true);
#$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);



// set style for barcode
$style = array(
	'border' => 2,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 1, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);

$phone = '919062702627';

$codeContents  = 'BEGIN:VCARD'."\n";
$codeContents .= 'FN:'.$fname."\n";
$codeContents .= 'EMAIL:'.$email."\n";
$codeContents .= 'ORG:'.$company."\n";
$codeContents .= 'TEL;WORK;VOICE:'.$phone."\n";
$codeContents .= 'END:VCARD'; 


// QRCODE,M : QR-CODE Medium error correction
$pdf->write2DBarcode($codeContents, 'QRCODE,M', 87, 128, 20, 20, $style, 'N');


$pdf->SetY(129);
$pdf->SetFont('helvetica', 'B', 10);
$txt = " Registration Number";
$pdf->MultiCell(100, 8, $txt, 0, 'L', 0, 0, '11', '', true);
#$pdf->Write(0, $txt, '0', 0, '', true, 0, false, false, 10);

$pdf->SetY(132);
// define barcode style
$style = array(
	'position' => 'L',
	'align' => 'C',
	'stretch' => false,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => false,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 3
);

// CODE 128 AUTO
$pdf->write1DBarcode('CHLIN000078678', 'C128', '', '', '', 17, 0.3, $style, 'N');


//Close and output PDF document
$pdf->Output('C:/xampp5/htdocs/tcpdf/examples/example_009.pdf', 'FI');

//============================================================+
// END OF FILE
//============================================================+
