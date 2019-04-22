<?php
$timestamp = time(); 
$today =  date("F d, Y h:i:s A", $timestamp);
/* Change to the correct path if you copy this example! */
require __DIR__ . '/../../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\%COMPUTERNAME%\Receipt Printer"
 *  del testfile
 */
try {
    // Enter the share name for your USB printer here
    //$connector = null;
    $connector = new WindowsPrintConnector("58Printer");

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    $printer -> setLineSpacing(1);
    $tux = EscposImage::load("../resources/puplogo.png", false);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> bitImageColumnFormat($tux);
    // $printer -> feed();

    $printer -> setTextSize(1, 1);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text("Polytechnic University\n");
    $printer -> text("of the Philippines\n");

    // $printer -> inlineImage($tux);
    // $printer -> text("Polytechnic University of the Philippines");
    // $printer -> text("-test test\n");

    $printer -> setTextSize(3, 3);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text($_POST['code']."\n");
    
    $printer -> setTextSize(1, 1);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text($today);
    $printer -> cut();
    
    /* Close printer */
    $printer -> close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
