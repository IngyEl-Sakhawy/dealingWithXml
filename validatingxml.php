<?php

$xmlString = file_get_contents('library.xml');
$dom = new DOMDocument();
$dom->loadXML($xmlString);

if (!$dom->schemaValidate('libraryschema.xsd')) {
    echo "XML validation failed!";
} else {
    echo "Validation Success !";
}
