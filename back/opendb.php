<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'password';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die
                      ('Error connecting to mysql');

$dbname = 'colmena';
mysql_select_db($dbname);
mysql_set_charset('utf8',$conn);

function strtolowerExtended($str)
{     
        $low = array(chr(193) => chr(225), //á
                     chr(201) => chr(233), //é
                     chr(205) => chr(237), //í
                     chr(211) => chr(243), //ó
                     chr(218) => chr(250), //ú
                     chr(220) => chr(252), //ü
                     chr(209) => chr(241)  //ñ
                     );
 
 
      return utf8_encode(strtolower(strtr(utf8_decode($str),$low)));
 
}?>