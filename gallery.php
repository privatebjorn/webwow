<?php
// gallery.php - renders all image albums from filecollections.json

$rootDir  = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
$jsonFile = $rootDir . '/files/filecollections.json';

if (!file_exists($jsonFile)) {
    http_response_code(500);
    echo "<p>Error: gallery index not found.</p>";
    exit;
}

$data = json_decode(file_get_contents($jsonFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo "<p>Error parsing gallery index.</p>";
    exit;
}

$albums = $data['imageCollection'] ?? [];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Webwow Gallery">
    <meta name="keywords" content="">
    <meta name="author" content="webwow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Webwow</title>
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
                    <h1>Gallery</h1>
                    <?php foreach ($albums as $album): ?>
                        <h2><?php echo htmlspecialchars($album['albumName']); ?></h2>
                        <p><?php echo htmlspecialchars($album['description']); ?></p>

                        <?php
                        $flip = true;
                        foreach ($album['imageItem'] as $item):
                        ?>
                            <table width="100%" border="0" cellpadding="10">
                                <tr valign="top">
                                    <?php if ($flip): ?>
                                        <td width="60%">
                                            <p><b><?php echo htmlspecialchars($item['title']); ?></b><br>
                                            <?php echo htmlspecialchars($item['description']); ?></p>
                                        </td>
                                        <td width="40%">
                                            <img src="modules/delivery.php?id=<?php echo urlencode($item['id']); ?>&stream" alt="<?php echo htmlspecialchars($item['title']); ?>">
                                        </td>
                                    <?php else: ?>
                                        <td width="40%">
                                            <img src="modules/delivery.php?id=<?php echo urlencode($item['id']); ?>&stream" alt="<?php echo htmlspecialchars($item['title']); ?>">
                                        </td>
                                        <td width="60%">
                                            <p><b><?php echo htmlspecialchars($item['title']); ?></b><br>
                                            <?php echo htmlspecialchars($item['description']); ?></p>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            </table>
                        <?php
                            $flip = !$flip;
                        endforeach;
                        ?>
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
