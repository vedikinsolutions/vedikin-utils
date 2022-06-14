<?php
defined('BASEPATH') or exit('No direct script access allowed');

 define('DOMPDF_ENABLE_AUTOLOAD', false);
class Pdfgenerator
{

    public function generate($html, $filename = '', $stream = TRUE, $paper = 'A4', $orientation = "portrait")
    {
        require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");
       // define('DOMPDF_ENABLE_AUTOLOAD', false);
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        ob_end_clean();
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 1));
        } else {
            return $dompdf->output();
        }
    }
}