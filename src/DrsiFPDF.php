<?php
declare(strict_types=1);

namespace Drsi\FPDF;
use Drsi\FPDF\Traits\FontsTrait;
use FPDF\Scripts\PDFCode128\PDFCode128Trait;
use FPDF\Scripts\PDFHtml\PDFHTMLTrait;
use FPDF\Scripts\PDFMemImage\PDFMemImageTrait;
use FPDF\Scripts\PDFOpt\PDFOptTrait;
use FPDF\Scripts\RPDF\RPDFTrait;

class DrsiFPDF extends PDFWrapper {
    use FontsTrait;
    use PDFCode128Trait;
    use PDFMemImageTrait;
    use RPDFTrait;
    use PDFOptTrait;
    use PDFHTMLTrait;

    protected function _putresources () {
        parent::_putresources();
        $this->_putpages();
        $this->_endpage();
    }
}