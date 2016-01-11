<?php

class TcPdfDriver
{
	public $pdf;
	public $filename_Str = '';

	public function __construct()
	{
		if (@file_exists( realpath('fanswoo-framework/libraries/tcpdf/tcpdf.php') )) {
			require_once( realpath('fanswoo-framework/libraries/tcpdf/tcpdf.php') );
		}

		// create new PDF document
		$this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	}

	public function config($arg = [])
	{
		$creator_Str = $arg['creator_Str'] ? $arg['creator_Str'] : 'fansWoo';
		$author_Str = $arg['author_Str'] ? $arg['author_Str'] : 'fansWoo';
		$title_Str = $arg['title_Str'] ? $arg['title_Str'] : 'fansWoo Example';
		$subject_Str = $arg['subject_Str'] ? $arg['subject_Str'] : 'http://fanswoo.com';
		$keywords_Str = $arg['keywords_Str'] ? $arg['keywords_Str'] : 'fansWoo, PDF, example, test, guide';
		$logo_path_Str = $arg['logo_path_Str'] ? $arg['logo_path_Str'] : PDF_HEADER_LOGO;
		$logo_width_Num = $arg['logo_width_Num'] ? $arg['logo_width_Num'] : PDF_HEADER_LOGO_WIDTH;
		$filename_Str = $arg['filename_Str'] ? $arg['filename_Str'] : 'fansWoo';

		// set document information
		$this->pdf->SetCreator($creator_Str);
		$this->pdf->SetAuthor($author_Str);
		$this->pdf->SetTitle($filename_Str);
		$this->pdf->SetSubject($subject_Str);
		$this->pdf->SetKeywords($keywords_Str);
		$this->pdf->SetHeaderData($logo_path_Str, $logo_width_Num, $title_Str, $subject_Str);
		$this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$this->pdf->setLanguageArray([
			'a_meta_charset' => 'UTF-8',
			'a_meta_dir' => 'ltr',
			'a_meta_language' => 'en',
			'w_page' => 'Page'
		]);
		$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$this->filename_Str = $filename_Str;

		// set font
		$this->pdf->SetFont('DroidSansFallback', '', 10);
	}

	public function set_font($arg = [])
	{
		$this->pdf->SetFont($arg['font_Str'], '', $arg['size_Num']);
	}

	public function add_page()
	{
		$this->pdf->AddPage();
	}

	public function last_page()
	{
		$this->pdf->lastPage();
	}

	public function write_html($arg = [])
	{
		$html_Str = $arg['html_Str'];
		$this->pdf->writeHTML($html_Str, true, false, true, false, '');
	}

	public function output()
	{
		$this->pdf->Output('pdf-'.$this->filename_Str.'.pdf', 'I');
	}
}