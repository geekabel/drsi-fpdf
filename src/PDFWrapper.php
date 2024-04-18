<?php
declare(strict_types=1);

namespace Drsi\FPDF;

if (class_exists('setasign\Fpdi\Fpdi')) {
    class PDFWrapper extends \setasign\Fpdi\Fpdi {};
} else {
    class PDFWrapper extends \FPDF {};
}