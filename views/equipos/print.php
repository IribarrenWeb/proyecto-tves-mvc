<?php

use Spipu\Html2Pdf\Html2Pdf;

$htm2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8',array(8, 8, 8, 8));
ob_start();

require_once './views/layouts/pdf.php';

$html = ob_get_clean();
// $htm2pdf->setDefaultFont('courier');
$htm2pdf->writeHTML($html);
ob_end_clean();
$htm2pdf->output('reporte_tves.pdf');
