<?php

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$nik = $_POST["nik"];
$name = $_POST["name"];
$alamat = $_POST["alamat"];
$pekerjaan = $_POST["pekerjaan"];
$status = $_POST["status"];
$padah = $_POST["padah"];
$kelamin = $_POST["kelamin"];
$namas = $_POST["namas"];
$harij = $_POST["harij"];
$saksi1 = $_POST["saksi1"];
$saksi2 = $_POST["saksi2"];


//$html = '<h1 style="color: green">Example</h1>';
//$html .= "Hello <em>$name</em>";
//$html .= '<img src="example.png">';
//$html .= "Quantity: $quantity";

/**
 * Set the Dompdf options
 */
$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

/**
 * Set the paper size and orientation
 */
$dompdf->setPaper("A4", "composure");

/**
 * Load the HTML and replace placeholders with values from the form
 */
$html = file_get_contents("template1.html");

$html = str_replace(["{{ nik }}", "{{ name }}", "{{ alamat }}", "{{ pekerjaan }}", "{{ status }}", "{{ padah }}", "{{ kelamin }}", "{{ namas }}", "{{ harij }}", "{{ saksi1 }}", "{{ saksi2 }}"], [$nik, $name, $alamat, $pekerjaan, $status, $padah, $kelamin, $namas, $harij, $saksi1, $saksi2], $html);

$dompdf->loadHtml($html);
//$dompdf->loadHtmlFile("template1.html");

/**
 * Create the PDF and set attributes
 */
$dompdf->render();

$dompdf->addInfo("Title", "An Example PDF"); // "add_info" in earlier versions of Dompdf

/**
 * Send the PDF to the browser
 */
$dompdf->stream("invoice.pdf", ["Attachment" => 0]);

/**
 * Save the PDF file locally
 */
$output = $dompdf->output();
file_put_contents("file.pdf", $output);