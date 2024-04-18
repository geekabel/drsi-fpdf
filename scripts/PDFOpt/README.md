# PDFOptTrait

This trait handles Memory Optimization.

Normally FPDF compresses the entire PDF at the very end of PDF generation, this trait can help lead to a large uncompressed PDF being stored in memory. This modification compresses each page as soon as it is finished, reducing the overall memory usage when generating large PDFs.

## Example

```php
<?php
declare(strict_types=1);

require dirname(dirname(__DIR__)) . '/fpdf/fpdf.php';
require __DIR__ . '/PDFOptTrait.php';

use FPDF\Scripts\PDFCode128\PDFOptTrait;


$pdf = new class extends FPDF {
  use PDFOptTrait;
};

$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$txt = str_repeat('Il était une fois',200);
for($i=0;$i<1000;$i++){
    $pdf->Write(9,$txt);
}

$pdf->Output('F', __DIR__ . '/example.pdf');
```
