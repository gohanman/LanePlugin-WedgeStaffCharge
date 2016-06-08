<?php
ini_set('error_reporting', E_ALL);

/* mock COREPOS API classes for testing */

if (!class_exists('Plugin', false)) {
    class Plugin 
    {
        public function pluginUrl()
        {
            return '';
        }
    }
}

if (!class_exists('ProductSearch', false)) {
    class ProductSearch{}
}

if (!class_exists('SpecialUPC', false)) {
    class SpecialUPC {}
}

if (!class_exists('PreParser', false)) {
    class PreParser {}
}

if (!class_exists('Parser', false)) {
    class Parser
    {
        public function default_json() { return array(); }
    }
}

if (!class_exists('AutoLoader', false)) {
    class AutoLoader
    {
        public static function dispatch(){}
    }
}

if (!class_exists('BasicCorePage', false)) {
    class BasicCorePage
    {
        protected $page_url = '';
        public function change_page($url){}
        public function input_header(){}
        public function default_parsewrapper_js($a,$b){}
        public function addOnloadCommand($foo){}
    }
}

if (!class_exists('NoInputCorePage', false)) {
    class NoInputCorePage extends BasicCorePage{}
}

if (!class_exists('DisplayLib', false)) {
    class DisplayLib
    {
        public static function printfooter()
        {
            return '';
        }

        public static function boxMsg($msg, $header, $noBeep, $buttons=array())
        {
            return $msg . $header;
        }

        public static function xboxMsg($msg, $buttons=array())
        {
            return $msg;
        }

        public static function standardClearButton()
        {
            return array();
        }
        
        public static function lastpage()
        {
            return '';
        }
    }
}

if (!class_exists('MiscLib', false)) {
    class MiscLib
    {
        public static function goodBeep(){}
        public static function baseURL()
        {
            return '';
        }

        public static function win32()
        {
            return false;
        }

        public static function truncate2($val)
        {
            return $val;
        }

        public static function nullwrap($val)
        {
            return $val;
        }
    }
}

if (!class_exists('CoreLocal', false)) {
    class CoreLocal
    {
        private static $data = array();
        public static function get($k)
        {
            return isset(self::$data[$k]) ? self::$data[$k] : '';
        }

        public static function set($k, $v)
        {
            self::$data[$k] = $v;
        }
    }
}

if (!class_exists('SQLManager', false)) {
    class SQLManager
    {
        private static $mock = array();

        public function __construct($host, $dbms, $db, $user, $passwd)
        {
        }

        public function tableExists($table)
        {
            return true;
        }

        public function insertID()
        {
            return 1;
        }

        public function curdate()
        {
            return 'curdate()';
        }

        public function now()
        {
            return 'now()';
        }

        public static function addResult($row)
        {
            self::$mock[] = $row;
        }

        public static function clear()
        {
            self::$mock = array();
        }

        public function sep()
        {
            return '.';
        }

        public function query($str)
        {
            return true;
        }

        public function numRows($res)
        {
            return count(self::$mock);
        }

        public function fetchRow($res)
        {
            $row = array_shift(self::$mock);
            return $row === null ? false : $row;
        }

        public function getRow($prep, $args=array())
        {
            return $this->fetchRow(null);
        }

        public function prepare($query)
        {
            return $query;
        }

        public function execute($prep, $args)
        {
            return true;
        }
    }
}

if (!class_exists('Database', false)) {
    class Database
    {
        public static function setglobalvalue($k, $v)
        {
        }

        public static function getsubtotals(){}

        public static function pDataConnect()
        {
            return new SQLManager('', '', '', '', '');
        }

        public static function tDataConnect()
        {
            return new SQLManager('', '', '', '', '');
        }

        public static function mDataConnect()
        {
            return new SQLManager('', '', '', '', '');
        }
    }
}

if (!class_exists('DiscountType', false)) {
    class DiscountType
    {
        public static $MAP = array(1=>'DiscountType');
        public function isSale() { return true; }
        public function priceInfo($row, $qty)
        {
            return array('unitPrice'=>1, 'regPrice'=>2, 'memDiscount'=>1);
        }
    }
}

if (!class_exists('COREPOS\\pos\\lib\\FormLib')) {
    include(__DIR__ . '/mocks/FormLib.php');
}

include(__DIR__ . '/self.php');

