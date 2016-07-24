<?php

$notification = $_POST['notification'];
$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load('admin_notification.xml');
$newItem = $xml->createElement('note', $_POST['notification']);
$xml->getElementsByTagName('entries')->item(0)->appendChild($newItem);

$xml->save('admin_notification.xml');


?>