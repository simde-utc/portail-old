<?php
/**
 * Description of simdePdf
 *
 * @author milk
 */
class simdePdf extends sfTCPDF
{
  protected $asso;
  protected $custom_header_title;
  protected $custom_header_string;
  public function __construct(Asso $asso, $custom_header_title = '', $custom_header_string = '') {
    parent::__construct(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,true);
    $this->asso = $asso;
    $this->custom_header_title = $custom_header_title;
    $this->custom_header_string = $custom_header_string;
  }

  public function Header() {
    $this->header_title = $this->custom_header_title;
    $this->header_string = $this->custom_header_string;
    parent::Header();
  }

  public function Footer() {
    parent::Footer();
    $this->SetY($this->y + 2);
    $this->SetX($this->original_lMargin);
    $this->SetFont(PDF_FONT_NAME_MAIN,'B');
    $this->MultiCell(100,4,$this->asso->getName(),0,'L',0,1);
    $this->SetFont(PDF_FONT_NAME_MAIN,'');
    $this->MultiCell(22,4,'Site internet :',0,'L',0,0);
    $this->SetFont(PDF_FONT_NAME_MAIN,'I');
    $this->MultiCell(70,4,'http://assos.utc.fr/'.$this->asso->getLogin(),0,'L',0,1);
    $this->SetFont(PDF_FONT_NAME_MAIN,'');
    $this->MultiCell(22,4,'Adresse email :',0,'L',0,0);
    $this->SetFont(PDF_FONT_NAME_MAIN,'I');
    $this->MultiCell(70,4,$this->asso->getLogin().'@assos.utc.fr',0,'L',0);
  }
}
?>
