<?php
namespace App\Service;

use Dompdf\DomPdf;
use Dompdf\Options;

class PdfService
{
    
    private $domPdf;
    public function _construct(){

        $this->domPdf = new DomPdf;

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Garamond');

        $this->domPdf->setOptions($pdfOptions);
    }
#[Route('/all/showPdf', name: 'app_traduction_all_showPdf')]
public function showPdfFile($html){
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->stream(filename:'details.pdf', 
        );

}

public function downloadPdf($html){
    $this->domPdf->loadHtml($html);
    $this->domPdf->render();
        $this->domPdf->Output();
        
    }


}