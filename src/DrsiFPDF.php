<?php
declare(strict_types=1);

namespace Drsi\FPDF;

use Drsi\FPDF\PDFWrapper;
use Drsi\FPDF\Traits\FontsTrait;
use FPDF\Scripts\RPDF\RPDFTrait;
use Drsi\FPDF\Traits\PDFMacroableTrait;
use FPDF\Scripts\PDFCode128\PDFCode128Trait;
use FPDF\Scripts\PDFMemImage\PDFMemImageTrait;
use FPDF\Scripts\PDFMultiCellsTable\PDFMultiCellsTableTrait;

class DrsiFPDF extends PDFWrapper {
	// use PDFOptTrait  // TODO: Issue à resoudre
	  use PDFMacroableTrait;
    use FontsTrait;
    use PDFCode128Trait;
    use PDFMemImageTrait;
    use RPDFTrait;
		use PDFMultiCellsTableTrait;

    protected function _putresources () {
        parent::_putresources();
    }
}
