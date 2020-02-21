<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fpdf_master
{

    public function __construct()
    {

        define('FPDF_FONTPATH', APPPATH . 'third_party/fpdf/font/');
        require_once APPPATH . 'third_party/fpdf/fpdf.php';
        // require_once APPPATH . 'third_party/fpdf/fpdf2file.php';

        $pdf = new FPDF();
        $pdf->AddPage();

        // $pdf = new FPDF2File();
        // $pdf->Open(base_url('resources/pdf/reg_ta.pdf'));

        $CI = &get_instance();
        $CI->fpdf = $pdf;
    }
}
