<?php
declare(strict_types=1);

namespace Drsi\FPDF;

use Drsi\FPDF\PDFWrapper;
use Drsi\FPDF\Traits\FontsTrait;
use FPDF\Scripts\RPDF\RPDFTrait;
use FPDF\Scripts\PDFOpt\PDFOptTrait;
use FPDF\Scripts\PDFHtml\PDFHTMLTrait;
use FPDF\Scripts\PDFCode128\PDFCode128Trait;
use FPDF\Scripts\PDFMemImage\PDFMemImageTrait;

class DrsiFPDF extends PDFWrapper {
    use FontsTrait;
    use PDFCode128Trait;
    use PDFMemImageTrait;
    use RPDFTrait;
    // use PDFOptTrait  // TODO: Issue à resoudre
    use PDFHTMLTrait;

    protected function _putresources () {
        parent::_putresources();
    }
}
