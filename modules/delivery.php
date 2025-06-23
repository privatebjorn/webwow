<?php
// delivery.php - located inside the modules/ folder

// Validate and fetch parameters
if (!isset($_GET['id'])) {
    http_response_code(400);
    exit('Missing file id');
}

$id = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['id']);
$download = array_key_exists('download', $_GET);
$stream   = array_key_exists('stream', $_GET);

// Paths relative to document root
$rootDir   = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
$jsonFile  = $rootDir . '/files/filecollections.json';
$fileDir   = $rootDir . '/files';

if (!file_exists($jsonFile)) {
    http_response_code(500);
    exit('File index not found');
}

// Load the JSON list
$list = json_decode(file_get_contents($jsonFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    exit('Error parsing file index');
}

// Recursive search through nested arrays for a matching id
function findEntry(array $data, string $id) {
    foreach ($data as $value) {
        if (is_array($value)) {
            if (isset($value['id']) && $value['id'] === $id
                && isset($value['mimeType'])
                && isset($value['fileExtension'])
                && isset($value['title'])) {
                return $value;
            }
            $found = findEntry($value, $id);
            if ($found) {
                return $found;
            }
        }
    }
    return null;
}

$entry = findEntry($list, $id);
if (!$entry) {
    http_response_code(404);
    exit('File metadata not found');
}

// Physical file path (files stored without extension)
$filePath = $fileDir . '/' . $id;
if (!file_exists($filePath)) {
    http_response_code(404);
    exit('File not found on disk');
}

// Prepare headers
$mime      = $entry['mimeType'];
$extension = $entry['fileExtension'];
$safeTitle  = str_replace(["\n", "\r", '"'], ['','',''], $entry['title']);
$fileName  = $safeTitle . "." . $extension;

header('Content-Type: ' . $mime);
$disposition = $download ? 'attachment' : 'inline';
header(sprintf('Content-Disposition: %s; filename="%s"', $disposition, $fileName));
header('Content-Length: ' . filesize($filePath));

// Output the file
readfile($filePath);
exit;
?>
