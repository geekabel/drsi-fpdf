# FPDF
## What is FPDF?
FPDF is a PHP class which allows to generate PDF files with pure PHP, that is to say without using the PDFlib library. F from FPDF stands for Free: you may use it for any kind of usage and modify it to suit your needs.

FPDF has other advantages: high level functions. Here is a list of its main features:

- Choice of measure unit, page format and margins
- Page header and footer management
- Automatic page break
- Automatic line break and text justification
- Image support (JPEG, PNG and GIF)
- Colors
- Links
- TrueType, Type1 and encoding support
- Page compression

FPDF requires no extension (except Zlib to enable compression and GD for GIF support). The latest version requires at least PHP 5.1.


## Installation

You can install the package via composer:

```sh
composer require drsi/drsi-fpdf
```

## What languages can I use?
The class can produce documents in many languages other than the Western European ones: Central European, Cyrillic, Greek, Baltic and [Thai](http://fpdf.org/en/script/script87.php), provided you own TrueType or Type1 fonts with the desired character set. [UTF-8 support](http://fpdf.org/en/script/script92.php) is also available.

## What about performance?
Of course, the generation speed of the document is less than with PDFlib. However, the performance penalty keeps very reasonable and suits in most cases, unless your documents are particularly complex or heavy.



## About this repository
The `/fpdf` directory contains a clone of the official FPDF releases, available at http://www.fpdf.org. No modifications will be made to that directory, which contains the history of changes between versions.

# DrsiFPDF Class
## What is DrsiFPDF?
DrsiFPDF is a wrapper FPDF class, DrsiFPDF already includes all the available scripts in the [scripts section](scripts). Also, it includes support for [Setasign/FPDI](https://github.com/Setasign/FPDI).

## Usage

In your php file that you want to use the class add a use statement.

```php
use Drsi\DrsiFpdf;
```

Then use as per the [FPDF documentation](http://fpdf.org/en/tutorial/index.php).

``` php
$pdf = new DrsiFPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
```

Alternatively you can extend as a typical php class and add your own custom scripts.

```php
class CustomPdf extends DrsiFPDF
{
    public function __construct(
        $orientation = 'P',
        $unit = 'mm',
        $size = 'letter'
    ) {
        parent::__construct( $orientation, $unit, $size );
        // ...
    }
}
```