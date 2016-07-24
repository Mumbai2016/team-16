<?php
$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load('admin_notification.xml');
$x=$xml->getElementsByTagName('note');
foreach($x as $note){
    echo $note->nodeValue, PHP_EOL;
}

$xml->save('admin_notification.xml');


?>