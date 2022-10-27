<?php

/**
 * Description of Config
 *
 * @author abilio.jose
 */
class Config {

    public static function configApp() {
        $Service = new ConfigServerPHP();
        $Service->Date_timezone_set();
        $Service->Default_charset();
        $Service->Error_Reporting();
    }

    public static function configAppWS() {
        $Service = new ConfigServerPHP();
        $Service->Date_timezone_set();
        $Service->Default_charset();
        $Service->Error_Reporting();
    }

}
