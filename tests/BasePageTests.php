<?php
class BasePageTests extends SapphireTest {

	public static $fixture_file = 'BasePageTests.yml';

	public function setUp() {
		parent::setUp();

		Config::inst()->update('BasePage', 'pdf_export', true);
		Config::inst()->update('BasePage', 'generated_pdf_path', 'assets/_generated_pdfs');
	}

	public function testPdfFilename() {
		$page = $this->objFromFixture('Page', 'test-page-one');
		$this->assertContains('assets/_generated_pdfs/test-page-one-1.pdf', $page->getPdfFilename(), 'Generated filename for PDF');
	}

	public function testPdfLink() {
		$page = $this->objFromFixture('Page', 'test-page-one');
		$this->assertContains('test-page-one/downloadpdf', $page->PdfLink(), 'Link to download PDF');
	}

	public function testHomePagePdfLink() {
		$page = $this->objFromFixture('Page', 'home-page');
		$this->assertContains('home/downloadpdf', $page->PdfLink(), 'Link to download PDF');
	}

	public function testPdfLinkDisabled() {
		Config::inst()->update('BasePage', 'pdf_export', false);
		$page = $this->objFromFixture('Page', 'test-page-one');
		$this->assertFalse($page->PdfLink(), 'No PDF link as the functionality is disabled');
	}
}