<?php
// app/Libraries/Fpdf_lib.php

// Memanggil file FPDF
require_once(APPPATH . 'Libraries/fpdf/fpdf.php');

class Fpdf_lib extends FPDF
{
    public function __construct()
    {
        parent::__construct();
    }
}
