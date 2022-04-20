<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('assets/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

class Pdf
{
    protected $ci;

    public function __construct()
    {

        $this->ci = &get_instance();
    }

    public function generate(
        $view,
        $data,
        $paper = 'A4',
        $orientation = 'potrait'
    ) {
        $dompdf = new Dompdf();
        $html = $this->ci->load->view($view, $data, TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        //Render the HTML as PDF
        $dompdf->render();
        if ($data['judul'] == 'Laba Rugi') {
            $dompdf->stream("Laba Rugi " . format_indo($data['tanggal1labarugi']) . "- " . format_indo($data['tanggal2labarugi']) . ".pdf", array('Attachment' => TRUE));
        } else {
            $dompdf->stream("Neraca " . format_indo($data['tanggal2neraca']) . ".pdf", array('Attachment' => TRUE));
        }
    }
}
