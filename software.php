<?php
// software.php - renders all software from filecollections.json

$rootDir  = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
$jsonFile = $rootDir . '/files/filecollections.json';

if (!file_exists($jsonFile)) {
    http_response_code(500);
    echo "<p>Error: software index not found.</p>";
    exit;
}

$data = json_decode(file_get_contents($jsonFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo "<p>Error parsing software index.</p>";
    exit;
}

$software = $data['softwareCollection'] ?? [];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Webwow Software">
    <meta name="keywords" content="">
    <meta name="author" content="webwow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software - Webwow</title>
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
                    <h1>Our Software Collection</h1>
                    <?php foreach ($software as $app): ?>
                        <table width="100%" border="0" cellpadding="10">
                            <tr valign="top">
                                <td width="70%">
                                    <h2 id="<?php echo htmlspecialchars($app['title']); ?>"><?php echo htmlspecialchars($app['title']); ?></h2>
                                    <p>
                                        Year: <?php echo htmlspecialchars($app['year']); ?><br>
                                        Developer: <?php echo htmlspecialchars($app['developer']); ?><br>
                                        Category: <?php echo htmlspecialchars($app['category']); ?>
                                    </p>
                                    <?php if (!empty($app['screenshots'])): ?>
                                        <?php foreach ($app['screenshots'] as $shot): ?>
                                            <img width="350" src="modules/delivery.php?id=<?php echo urlencode($shot['id']); ?>&stream" alt="<?php echo htmlspecialchars($shot['title']); ?>"><br>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <p><?php echo nl2br(htmlspecialchars($app['description'])); ?></p>
                                </td>
                                <td width="30%">
                                    <p><b>Downloads:</b></p>
                                    <?php if (!empty($app['downloads'])): ?>
                                        <?php foreach ($app['downloads'] as $platform => $dl): ?>
                                            <a href="modules/delivery.php?id=<?php echo urlencode($dl['id']); ?>&download"><?php echo ucfirst(htmlspecialchars($platform)); ?></a><br>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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