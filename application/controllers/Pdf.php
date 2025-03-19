<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pdf extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        include APPPATH . 'third_party/fpdf/pdf.php';
    }
    function index()
    {
        $pdf = new XPDF('L', 'mm', 'Letter');

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->WriteHTML(
            'You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr>'
        );
        $pdf->Output(FCPATH . "assets/pdf/sapi.pdf","F");
    }
}
