<?php
/**
 * Description of ConfigHTML
 *
 * @author Abílio José
 */
class ConfigHTML {
    
    private $lang;
    private $titlepage;
    private $metaCharset;
    private $metaHttpEquiv;    
    private $metaViewport;    
    
    function __construct() {
        $confiBD = new ConfigBDClass();
        $this->lang='pt-BR';//en-US || pt-BR
        $this->metaCharset='utf-8';//utf-8 || UTF-16 || ISO-8859-1
        //width=device-width,initial-scale=1 || width=device-width, initial-scale=1.0
        //width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no
        $this->metaViewport = 'width=device-width, initial-scale=1.0';
        $this->metaHttpEquiv='text/html; charset=utf-8';
        if($confiBD->getOptDB()==0):$this->titlepage = "Pykota DEV"; endif;
        if($confiBD->getOptDB()==1):$this->titlepage = "Pykota";endif;
        
    }
    public function getLang() {
        return $this->lang;
    }

    public function getTitlepage() {
        return $this->titlepage;
    }

    public function getMetaCharset() {
        return $this->metaCharset;
    }

    public function getMetaHttpEquiv() {
        return $this->metaHttpEquiv;
    }

    public function getMetaViewport() {
        return $this->metaViewport;
    }

}
