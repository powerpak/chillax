<?php
/**
 * This page proxies an HTTP request so that Chillax can fetch external RSS feeds via AJAX.
 *
 * To prevent abuse, it only performs GET requests and if a content-type header is fetched,
 * it has to contain "xml".  This restricts usage of this proxy to (mostly) RSS and other
 * public XML content, hopefully curbing any desire to use it illicitly.
 **/
if (!isset($_GET['url']) || !preg_match('#^https?://#', $_GET['url'])) { 
  header('HTTP/1.1 404 Not Found');
  exit;
}

$ch = curl_init($_GET['url']);

$header = '';

// Shove all header data into a global variable
function receive_header_data($ch, $header_data) {
  global $header;
  $header .= $header_data;
  return strlen($header_data);
}


function receive_body($ch, $body_data) {
  global $header, $header_parsed;
  $len = strlen($body_data);
  $content_type = NULL;
  $header_lines = preg_split('/[\\r\\n]+/', $header);
  foreach ($header_lines as $index=>$line) {
    if (preg_match('/^\\s*Content-Type\\s*:\\s*(.*)/i', $line, $matches)) { $content_type = $matches[1]; }
  }
  if ($content_type !== NULL && !in_array('xml', preg_split('/\\W/', $content_type))) { 
    if (!headers_sent()) { header('HTTP/1.1 403 Forbidden'); }
    return $len;
  }
  if (!headers_sent()) { header('Content-Type: ' . $content_type); }
  echo $body_data;
  return $len;
}

curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADERFUNCTION, 'receive_header_data');
curl_setopt($ch, CURLOPT_WRITEFUNCTION, 'receive_body');
curl_exec($ch);
curl_close($ch);
