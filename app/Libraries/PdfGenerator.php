<?php

namespace App\Libraries;

use TCPDF;

class PdfGenerator
{
    protected $pdf;

    public function __construct()
    {
        $this->pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
    }

    public function generatePdf($data)
    {
        // Set informasi PDF
        $this->pdf->SetTitle('Dokumen');
        $this->pdf->SetHeaderData('', '', 'Judul Header', 'L', array(0, 64, 255), array(0, 64, 128));
        $this->pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // Buat halaman baru
        $this->pdf->AddPage();

        // Tambahkan konten ke halaman
        $this->pdf->SetFont('helvetica', '', 12);
        $this->pdf->MultiCell(0, 10, $data, 0, 'L', 0, 1, '', '', true);

        // Output file PDF
        $this->pdf->Output('pembayaran.pdf', 'D');
    }
}
