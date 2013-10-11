<?php

namespace Intahwebz\Tests\MBExtra;




class MBExtraTest extends \PHPUnit_Framework_TestCase {


    protected function setUp(){
        \Intahwebz\MBExtra\Functions::load();
    }

    protected function tearDown(){
        //ob_end_clean();
    }   


    function testmb_ucfirst() {
        $this->assertEquals('Daniel', mb_ucfirst('daniel'));
        $this->assertEquals('Daniel', mb_ucfirst('Daniel'));

        $this->assertEquals('Daniel ackroyd', mb_ucfirst('daniel ackroyd'));
    }

    function testmb_lcfirst() {
        $this->assertEquals('daniel', mb_lcfirst('daniel'));
        $this->assertEquals('daniel', mb_lcfirst('Daniel'));
    }

//$str = "Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός";
//$str = mb_convert_case($str, MB_CASE_UPPER, "UTF-8");
//echo $str; // Prints ΤΆΧΙΣΤΗ ΑΛΏΠΗΞ ΒΑΦΉΣ ΨΗΜΈΝΗ ΓΗ, ΔΡΑΣΚΕΛΊΖΕΙ ΥΠΈΡ ΝΩΘΡΟΎ ΚΥΝΌΣ
//$str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
//echo $str; // Prints Τάχιστη Αλώπηξ Βαφήσ Ψημένη Γη, Δρασκελίζει Υπέρ Νωθρού Κυνόσ
    
    
    function testmb_ucwords() {
        $this->assertEquals('Daniel Ackroyd', mb_ucwords('daniel ackroyd'));
        $this->assertEquals('Daniel Ackroyd', mb_ucwords('Daniel Ackroyd'));
    }

    function testmb_str_split() {
        
        $string = "DanielAckers";
        
        $result = mb_str_split($string, 6);
        
        $this->assertEquals(2, count($result));
        $this->assertEquals($result[0], 'Daniel');
        $this->assertEquals($result[1], 'Ackers');

        $string = "DanielAckers";

        $result = mb_str_split($string);
        $this->assertEquals(mb_strlen($string), count($result));
    }

    function testmb_strcasecmp() {
        $result =  mb_strcasecmp('Daniel', 'DANIEL');
        $this->assertEquals(0, $result);
    }

    function testmb_strrev() {
        $result = mb_strrev('Daniel');

        $this->assertEquals('leinaD', $result);
    }

    function testmb_substr_replace() {
        $var = 'ABCDEFGH:/MNRPQR/';
        $this->assertEquals('ABCDEFGH:/bob/', mb_substr_replace($var, 'bob', 10, -1));
        $this->assertEquals('ABCDEFGH:/MNRPQR/bob', mb_substr_replace($var, 'bob', 20, 0));
        $this->assertEquals('ABCDEFGH:/bob', mb_substr_replace($var, 'bob', 10, 10));
        $this->assertEquals('ABCDEFGH:/bob/', mb_substr_replace($var, 'bob', -7, -1));
        $this->assertEquals('bob', mb_substr_replace($var, 'bob', 0));
        $this->assertEquals('bob', mb_substr_replace($var, 'bob', 0, strlen($var)));
        $this->assertEquals('bob', mb_substr_replace($var, 'bob', 0, strlen($var) + 5));
        $this->assertEquals('bob', mb_substr_replace($var, 'bob', 0, null, "UTF-8"));
    }

    function testmb_wordwrap() {
        $string = 'thislisalongstring';
        $width = strlen($string);
        $expectedResult = $string."\n".$string."\n".$string;

        $string = $string.$string.$string;
        $result = mb_wordwrap($string, $width, "\n", true);
        $this->assertEquals($expectedResult, $result);

        $text = "A very long woooooooooord.";
        $result = mb_wordwrap($text, 8, "|", true);
        $this->assertEquals("A very|long|wooooooo|ooord.", $result);

        $expected = "The quick brown fox<br />\njumped over the lazy<br />\ndog.";
        $text = "The quick brown fox jumped over the lazy dog.";
        $result = mb_wordwrap($text, 20, "<br />\n");
        $this->assertEquals($expected, $result);

        $this->assertEquals("A very\nlong\nwooooooo\nooooord.", mb_wordwrap("A very long woooooooooooord.", 8, "\n", true));

    }

    function testmb_str_replace() {
        $subject = "longreplacephrase";
        $search  = 'replace';
        $replace = 'changed';
        
        $result = mb_str_replace($search, $replace, $subject);
        $this->assertEquals('longchangedphrase', $result);

        $subject  = ["You should eat fruits, vegetables, and fiber every day."];
        $search = array("fruits", "vegetables", "fiber");
        $replace   = array("pizza", "beer", "ice cream");

        $result = mb_str_replace($search, $replace, $subject);
        $this->assertEquals("You should eat pizza, beer, and ice cream every day.", $result[0]);
    }
}

