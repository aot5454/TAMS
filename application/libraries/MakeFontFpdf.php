<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MakeFontFpdf
{

    public function __construct()
    {
        require_once APPPATH . 'third_party/fpdf/makefont/makefont.php';
    }
}
