<?php
// index.php - WebWow homepage with daily featured picks

$rootDir  = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
$jsonFile = $rootDir . '/files/filecollections.json';

if (!file_exists($jsonFile)) {
    http_response_code(500);
    echo "<p>Error: file index not found.</p>";
    exit;
}

$data = json_decode(file_get_contents($jsonFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo "<p>Error parsing file index.</p>";
    exit;
}

$random = isset($_GET['random']);
$seed = $random ? time() : intval(date('Ymd'));
srand($seed);

function pickOne($array) {
    if (empty($array)) return null;
    return $array[array_rand($array)];
}

$album = pickOne($data['albumCollection'] ?? []);
$imageAlbum = pickOne($data['imageCollection'] ?? []);
$imageItem = pickOne($imageAlbum['imageItem'] ?? []);
$software = pickOne($data['softwareCollection'] ?? []);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Webwow Home">
    <meta name="author" content="webwow">
    <title>Home - Webwow</title>
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
                    <h1>Welcome to WebWow!</h1>
                    <p>Explore the curious and retro world of WebWow – a place where nostalgic vibes, creative software, and community spirit come together. From our meme-driven roots to full-blown digital empire, WebWow is all about fun, functionality, and flair.</p>

                    <p>Start your journey:</p>
                    <ul>
                        <li>Read our <a href="about.php">origin story</a></li>
                        <li>Browse original <a href="software.php">software releases</a></li>
                        <li>Stream from our <a href="music.php">music collection</a></li>
                        <li>Explore retro moments in our <a href="gallery.php">image gallery</a></li>
                    </ul>

                    <hr>
                    <h2>Image of the Day</h2>
                    <?php if ($imageItem): ?>
                        <table width="100%" border="0" cellpadding="10">
                            <tr valign="top">
                                <td width="50%">
                                    <img src="modules/delivery.php?id=<?php echo urlencode($imageItem['id']); ?>&stream" alt="<?php echo htmlspecialchars($imageItem['description']); ?>">
                                </td>
                                <td width="50%">
                                    <p><b><?php echo htmlspecialchars($imageItem['title']); ?></b><br>
                                    <?php echo htmlspecialchars($imageItem['description']); ?></p>
                                </td>
                            </tr>
                        </table>
                    <?php endif; ?>

                    <hr>
                    <h2>Song of the Day</h2>
                    <?php if ($album && !empty($album['tracks'])): ?>
                        <table width="100%" border="0" cellpadding="10">
                            <tr valign="top">
                                <td width="30%">
                                    <img src="modules/delivery.php?id=<?php echo urlencode($album['albumCover']['id']); ?>&stream" alt="Album Cover">
                                </td>
                                <td width="70%">
                                    <b><?php echo htmlspecialchars($album['albumName']); ?></b><br>
                                    <?php $track = pickOne($album['tracks']); ?>
                                    <p><?php echo htmlspecialchars($track['title']); ?></p>
                                    <audio controls>
                                        <source src="modules/delivery.php?id=<?php echo urlencode($track['id']); ?>&stream">
                                    </audio>
                                    <br>
                                    <a href="modules/delivery.php?id=<?php echo urlencode($track['id']); ?>&download">Download</a>
                                </td>
                            </tr>
                        </table>
                    <?php endif; ?>

                    <hr>
                    <h2>Software of the Day</h2>
                    <?php if ($software): ?>
                        <table width="100%" border="0" cellpadding="10">
                            <tr valign="top">
                                <td width="80%">
                                    <h3><?php echo htmlspecialchars($software['title']); ?></h3>
                                    <p>
                                        Year: <?php echo htmlspecialchars($software['year']); ?><br>
                                        Developer: <?php echo htmlspecialchars($software['developer']); ?><br>
                                        Category: <?php echo htmlspecialchars($software['category']); ?><br>
                                        <?php echo nl2br(htmlspecialchars($software['description'])); ?>
                                    </p>
                                    <?php if (!empty($software['screenshots'])): ?>
                                        <?php foreach ($software['screenshots'] as $shot): ?>
                                            <img width="350" src="modules/delivery.php?id=<?php echo urlencode($shot['id']); ?>&stream" alt="<?php echo htmlspecialchars($shot['description']); ?>"><br>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </td>
                                <td width="20%">
                                    <p><b>Downloads:</b></p>
                                    <?php if (!empty($software['downloads'])): ?>
                                        <?php foreach ($software['downloads'] as $platform => $dl): ?>
                                            <a href="modules/delivery.php?id=<?php echo urlencode($dl['id']); ?>&download"><?php echo ucfirst(htmlspecialchars($platform)); ?></a><br>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    <?php endif; ?>

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