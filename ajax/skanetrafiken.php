<?php
$cont = file_get_contents("http://www.labs.skanetrafiken.se/v2.2/querypage.asp?inpPointFr=lund&inpPointTo=helsingborg%20station");
$your_xml_response = $cont;
$clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $your_xml_response);
$xml = simplexml_load_string($clean_xml);
print_r($xml);