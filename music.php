<?php
// music.php - renders all albums from filecollections.json

// Path to the JSON index
$rootDir  = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
$jsonFile = $rootDir . '/files/filecollections.json';

if (!file_exists($jsonFile)) {
    http_response_code(500);
    echo "<p>Error: music index not found.</p>";
    exit;
}

// Load and decode JSON
$data = json_decode(file_get_contents($jsonFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo "<p>Error parsing music index.</p>";
    exit;
}

$albums = $data['albumCollection'] ?? [];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Webwow Music">
    <meta name="keywords" content="">
    <meta name="author" content="webwow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music - Webwow</title>
</head>
<body bgcolor="#e6f2ff" text="#000000" link="#0033cc" vlink="#0033cc" alink="#ff0000">
    <table align="center" width="800" border="0" cellspacing="0" cellpadding="0">
        <tr bgcolor="#003366">
            <td align="center" colspan="4" height="40">
                <font face="Arial, Helvetica, sans-serif" color="#ffffff" size="3">
                    <a href="index.php" style="text-decoration: none;"><font color="#ffffff">Home</font></a> &nbsp;|&nbsp;
                    <a href="about.php" style="text-decoration: none;"><font color="#ffffff">About</font></a> &nbsp;|&nbsp;
                    <a href="software.php" style="text-decoration: none;"><font color="#ffffff">Software</font></a> &nbsp;|&nbsp;
                    <a href="music.php" style="text-decoration: none;"><font color="#ffffff">Music</font></a> &nbsp;|&nbsp;
                    <a href="gallery.php" style="text-decoration: none;"><font color="#ffffff">Gallery</font></a>
                </font>
            </td>
        </tr>
        <tr><td colspan="4" height="10"></td></tr>
        <tr>
            <td colspan="4" bgcolor="#cce0ff" valign="top">
                <font face="Verdana, Geneva, sans-serif" size="3">
                    <h1>Our Music Collection</h1>
                    <?php foreach ($albums as $album): ?>
                        <table width="100%" border="0" cellpadding="10">
                            <tr valign="top">
                                <td width="50%">
                                    <h2><?php echo htmlspecialchars($album['albumName']); ?></h2>
                                    <p>
                                        Artist: <?php echo htmlspecialchars($album['artist']); ?><br>
                                        Year: <?php echo htmlspecialchars($album['year']); ?><br>
                                        Label: <?php echo htmlspecialchars($album['label']); ?><br>
                                        Genre: <?php echo htmlspecialchars($album['genre']); ?>
                                    </p>
                                    <?php if (!empty($album['albumCover']['id'])): ?>
                                        <img src="modules/delivery.php?id=<?php echo urlencode($album['albumCover']['id']); ?>&stream" alt="<?php echo htmlspecialchars($album['albumCover']['title']); ?>">
                                    <?php endif; ?>
                                </td>
                                <td width="50%">
                                    <table border="0" width="100%" cellpadding="10">
                                        <?php foreach ($album['tracks'] as $track): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($track['title']); ?></td>
                                                <td>
                                                    <audio controls>
                                                        <source src="modules/delivery.php?id=<?php echo urlencode($track['id']); ?>&stream">
                                                    </audio>
                                                </td>
                                                <td>
                                                    <a href="modules/delivery.php?id=<?php echo urlencode($track['id']); ?>&download">Download</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <hr>
                    <?php endforeach; ?>
                </font>
            </td>
        </tr>
        <tr><td colspan="4" height="10"></td></tr>
        <tr bgcolor="#003366">
            <td align="center" colspan="4" height="30">
                <font face="Arial, Helvetica, sans-serif" color="#ffffff" size="2">
                    &copy; 2025 WebWow! All rights reserved.
                </font>
            </td>
        </tr>
    </table>
</body>
</html>