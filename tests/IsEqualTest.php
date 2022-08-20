<?php

use MrMuminov\PhpI18n\I18n;
use PHPUnit\Framework\TestCase;

final class IsEqualTest extends TestCase
{
    public $_i18n;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->_i18n = new I18n([
            'languages' => ['en', 'uz'],
            'language' => 'en',
        ]);
    }

    public function testCanGetLanguage()
    {
        $this->assertTrue($this->_i18n->getLanguage() === 'en');
    }

    public function testCanGetChangedLanguage()
    {
        $this->_i18n->setLanguage('uz');
        $this->assertTrue($this->_i18n->getLanguage() === 'uz');
    }

    public function testCanGetChangeNotExistLanguage()
    {
        $this->_i18n->setLanguage('uz');
        $this->assertTrue($this->_i18n->getLanguage() === 'uz');
        $this->_i18n->setLanguage('qwer');
        $this->assertTrue($this->_i18n->getLanguage() === 'en');
    }

    public function testCanSayHome()
    {
        $this->assertEquals(
            'Home',
            $this->_i18n->get('Home')
        );
    }

    public function testCanSayHelloMyName()
    {
        $this->assertEquals(
            'Hello Bahriddin',
            $this->_i18n->get('Hello %s', 'Bahriddin')
        );
    }

    public function testCanSayHelloMyNameUzLanguage()
    {
        $this->_i18n->setLanguage('uz');
        $this->assertEquals(
            'Salom Bahriddin',
            $this->_i18n->get('Hello %s', 'Bahriddin')
        );
    }

    public function testCanSayHomeUzLanguage()
    {
        $this->_i18n->setLanguage('uz');
        $this->assertEquals(
            'Uy',
            $this->_i18n->get('Home')
        );
    }
}
