<?php
defined('BASEPATH') or exit('No direct script access allowed');
// panggil autoload dompdf nya
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;
class Pdf
{
    public function generate(
        $html,
        $filename = '',
        $paper = '',
        $orientation = '',
        $stream = false
    ) {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename . '.pdf', ['Attachment' => 0]);
        } else {
            $dompdf->stream($filename . '.pdf');
            // file_put_contents(
            //     FCPATH . 'assets/pdf/' . $filename.'.pdf',
            //     $dompdf->output()
            // );
        }
    }
}
