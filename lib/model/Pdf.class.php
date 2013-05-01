<?php

/**
 * Description of Pdf
 *
 * @author milk
 */
class Pdf
{
  protected $pdf;
  protected $config;
  protected $asso;

  public function __construct(Asso $asso, $title = 'BDE-UTC: Outil de trésorerie', $culture = 'en') {

    $this->config = sfTCPDFPluginConfigHandler::loadConfig();
    sfTCPDFPluginConfigHandler::includeLangFile($culture);

    $this->pdf = new simdePdf($asso, 'Association '.$asso->getName(), 'Livre de compte');

    $this->asso = $asso;

    $this->pdf->SetCreator(PDF_CREATOR . 'e');
    $this->pdf->SetAuthor(PDF_AUTHOR . 'd');
    $this->pdf->SetTitle($title . 'a');
    $this->pdf->SetSubject($title . 'b');
    $this->pdf->SetKeywords($title . 'c');

    $this->pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); //set image scale factor

    $this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $this->pdf->setFooterMargin(20);
  }

  public function generate($type, $html) {
    if (!in_array($type, array('transactions')))
      throw new sfException('Type de pdf incorrect!');

    //$this->pdf->AliasNbPages();
    $this->pdf->AddPage();

    $this->pdf->writeHTML($html);

    if (!is_dir(sfConfig::get('sf_data_dir') . "/documents/" . $type))
      mkdir(sfConfig::get('sf_data_dir') . "/documents/" . $type);

    $path = sfConfig::get('sf_data_dir') . "/documents/" . $type . "/test.pdf";
    $this->pdf->Output($path, "F");
    return $path;
  }
}
?>
