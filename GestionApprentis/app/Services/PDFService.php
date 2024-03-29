<?php
// app/Services/PDFService.php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PDFService
{
    protected $dompdf;

    public function __construct()
    {
        $this->dompdf = new Dompdf();
    }

    public function generatePDF($view, $data = [])
    {
        $html = view($view, $data)->render();
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();

        return $this->dompdf->output();
    }
}
