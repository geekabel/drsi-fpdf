<?php
namespace FPDF\Scripts\PDFHtml;


trait PDFHTMLTrait
{
    //variables of html parser
    protected bool $B = false;
    protected bool $I = false;
    protected bool $U = false;
    protected string $HREF = '';
    protected array $fontlist = ['arial', 'times', 'courier', 'helvetica', 'symbol'];
    protected bool $issetfont = false;
    protected bool $issetcolor = false;

    public function WriteHTML(string $html): void
    {
        //HTML parser
        $html = strip_tags($html, "<b><u><i><a><img><p><br><strong><em><font><tr><blockquote>"); //supprime tous les tags sauf ceux reconnus
        $html = str_replace("\n", ' ', $html); //remplace retour à la ligne par un espace
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE); //éclate la chaîne avec les balises
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                //Text
                if ($this->HREF)
                    $this->PutLink($this->HREF, $e);
                else
                    $this->Write(5, $this->txtentities($e));
            } else {
                //Tag
                if ($e[0] == '/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    //Extract attributes
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = [];
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag, $attr);
                }
            }
        }
    }

    protected function OpenTag(string $tag, array $attr): void
    {
        //Opening tag
        match ($tag) {
            'STRONG' => $this->SetStyle('B', true),
            'EM' => $this->SetStyle('I', true),
            'B', 'I', 'U' => $this->SetStyle($tag, true),
            'A' => $this->HREF = $attr['HREF'] ?? '',
            'IMG' => $this->handleImageTag($attr),
            'TR', 'BLOCKQUOTE', 'BR' => $this->Ln(5),
            'P' => $this->Ln(10),
            'FONT' => $this->handleFontTag($attr),
        };
    }

    protected function CloseTag(string $tag): void
    {
        //Closing tag
        match ($tag) {
            'STRONG' => $tag = 'B',
            'EM' => $tag = 'I',
            'B', 'I', 'U' => $this->SetStyle($tag, false),
            'A' => $this->HREF = '',
            'FONT' => $this->handleFontClosingTag(),
        };
    }

    protected function SetStyle(string $tag, bool $enable): void
    {
        //Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach (['B', 'I', 'U'] as $s) {
            if ($this->$s > 0)
                $style .= $s;
        }
        $this->SetFont('', $style);
    }

    protected function PutLink(string $URL, string $txt): void
    {
        //Put a hyperlink
        $this->SetTextColor(0, 0, 255);
        $this->SetStyle('U', true);
        $this->Write(5, $txt, $URL);
        $this->SetStyle('U', false);
        $this->SetTextColor(0);
    }

    protected function txtentities(string $html): string
    {
        $trans = get_html_translation_table(HTML_ENTITIES);
        $trans = array_flip($trans);
        return strtr($html, $trans);
    }

    protected function handleImageTag(array $attr): void
    {
        if (isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
            if (!isset($attr['WIDTH']))
                $attr['WIDTH'] = 0;
            if (!isset($attr['HEIGHT']))
                $attr['HEIGHT'] = 0;
            $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), $this->px2mm($attr['WIDTH']), $this->px2mm($attr['HEIGHT']));
        }
    }

    protected function handleFontTag(array $attr): void
    {
        if (isset($attr['COLOR']) && $attr['COLOR'] != '') {
            $coul = $this->hex2dec($attr['COLOR']);
            $this->SetTextColor($coul['R'], $coul['V'], $coul['B']);
            $this->issetcolor = true;
        }
        if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
            $this->SetFont(strtolower($attr['FACE']));
            $this->issetfont = true;
        }
    }

    protected function handleFontClosingTag(): void
    {
        if ($this->issetcolor == true) {
            $this->SetTextColor(0);
        }
        if ($this->issetfont) {
            $this->SetFont('arial');
            $this->issetfont = false;
        }
    }

    protected function px2mm(int $px): float
    {
        return $px * 25.4 / 72;
    }

    protected function hex2dec(string $couleur = "#000000"): array
    {
        $R = substr($couleur, 1, 2);
        $rouge = hexdec($R);
        $V = substr($couleur, 3, 2);
        $vert = hexdec($V);
        $B = substr($couleur, 5, 2);
        $bleu = hexdec($B);
        return ['R' => $rouge, 'V' => $vert, 'B' => $bleu];
    }
}