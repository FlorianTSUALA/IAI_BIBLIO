<?php

include('../../lib/pdfparser/vendor/autoload.php');


class PDFHelper{

    public static function lire_pdf($fichier)
    {
        $doc = new \Smalot\PdfParser\Parser();
        $pdf = $doc->parseFile($fichier);
        $pages = $pdf->getPages();
        $content = '';
        foreach ($pages as $page) {
            $content = $content.$page->getText();
        }
        return $content;
    }

}