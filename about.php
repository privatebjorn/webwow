<?php
// about.php - structured narrative with embedded images

$rootDir  = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
$jsonFile = $rootDir . '/files/filecollections.json';

if (!file_exists($jsonFile)) {
    http_response_code(500);
    echo "<p>Error: about collection not found.</p>";
    exit;
}

$data = json_decode(file_get_contents($jsonFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo "<p>Error parsing JSON.</p>";
    exit;
}

$images = [];
if (!empty($data['aboutCollection'][0]['imageItem'])) {
    foreach ($data['aboutCollection'][0]['imageItem'] as $img) {
        $images[$img['id']] = $img;
    }
}

function img($id) {
    global $images;
    if (!isset($images[$id])) return '';
    $alt = htmlspecialchars($images[$id]['description']);
    return '<br><img width="350" halign="center" src="modules/delivery.php?id=' . urlencode($id) . '&stream" alt="' . $alt . '"><br>';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="About Webwow">
    <meta name="author" content="webwow">
    <title>About - Webwow</title>
</head>
<body bgcolor="#e6f2ff" text="#000000" link="#0033cc" vlink="#0033cc" alink="#ff0000">
    <table align="center" width="800" border="0" cellspacing="0">
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
                    <h1>About WebWow</h1>

                    <h2>Introduction</h2>
                    <p>The webwow story is a plot twist and epic jorney in itself, all the way from its humble beginnings as a meme to a large empire. Prepare to brace yourself for a wild jorney from ruins to riches.</p>

                    <h3>The meme</h3>
                    <p>WebWow has its origins all the way back in 2018, when 2 university students decided to contruct a point and click game. The game centered on the journey of a young aspiring drug dealer, and his wild quest in establishing himself in life.</p>
                    <?php echo img("0fe0ef425d9245") . img("bd7d9bf55fe142"); ?>
                    <p>The actual branding for WebWow arose after some of the game was programmed, and questions arose as to who was actually publishing the software. It was eventually decided that the name WebWow in a wordart looking font would be a great type of branding to use for a mediocre game.</p>
                    <?php echo img("0724ede859474e"); ?>

                    <h3>Legitimising the Brand</h3>
                    <p>After creating a series of meme pages and suspicious looking site itterations, the current modern webwow logo was created. This logo was the incarnated. This logo was designed to use the original orange colours that were used as part of the game CD. The shape was also modified to be wavey whilst also having a 3D look to it. At the same time, the original website was moved from a basic HTML 1.1 compliant page to a new CSS theme that was aimed at providing an old retro look, whilst also still appearing modern.</p>
                    <?php echo img("95b38886250943"); ?>

                    <h3>More Software Developments</h3>
                    <p>The brand was soon to become synonymous with basically all projects developed by the 2 original founders. The projects ranged all the way from simple CLI programs that should make life easier, all the way to networked applications for the already obsolete Mac OS 9. It is noteworthy to mention that making tasks easier would soon become synonymous with the new “EZ” line of products released by WebWow as discussed later. In terms of software development, some of the best pieces of code included networked mini games, and a YouTube client for Mac OS 9. The client would connect to a server, that would then convert videos and serve them to the ageing computers that were incapable of playing back online video content.</p>
                    <?php echo img("0fb5ab4c4cca44") . img("47635bdff68546"); ?>

                    <h3>LAN Parties and Social Events</h3>
                    <p>As WebWow was growing, so was the wish to connect it to social events that sparked joy. The first series of most successful events included a series of LAN parties using the original iMac G3 computers. The LAN parties were all conducted in real life and offered a tangible connection to the WebWow software and hardware brand. Overall, these events were the most memorable to all the individuals involved, and was critical in sharing the vision of WebWow.</p>
                    <?php echo img("1d85f196b2f24d"); ?>

                    <h3>The Website and Portal</h3>
                    <p>A bold move finally occurred when WebWow purchased the webwow.online domain in 2019. This was the start of all web development endevours. The site was constructed as an online portal for members, with the promise of being a safehaven for storing files, and chatting and interacting with other members. The site was under development for a series of months before coming online in late 2019. The new revamped theme and animations were designed to look heavy duty and over the top.</p>
                    <?php echo img("abbfa675347044"); ?>
                    <p>However, unfortunately, the main functionalities including chat were not up to the task of handling many concurrent users, and the portal was quickly decommissioned with plans for resurrecting it in the future.</p>

                    <h3>Useless Projects</h3>
                    <p>As members of WebWow worked on a series of useless projects, it was determined that these could be branded. Some examples include physical items such as USB flash drives, as well as another attempt at a point and click game. Similarly a few YouTube videos were released, featuring the WebWow logo. These videos were on various topics.</p>
                    <?php echo img("06a01c638ab846"); ?>

                    <h3>The “EZ” Brand</h3>
                    <p>In 2020 WebWow first used the “Ez” branding on a series of physical products. Some of the most noteworthy products included the EzMailer which was an envelope constructed for the purpose of mailing optical media at a low cost. The product was mostly a novelty that would bring a smile to all members who received items in the mail. Further, the “Ez” branding was used on a number of other products throughtout 2020 and 2021.</p>
                    <?php echo img("598abc7849c34a"); ?>

                    <h2>The Revived Legacy</h2>
                    <p>Since just recently it was decided that WebWow should once again work on providing a web service to all member who would like to use it. However, rather than constructing a portal from scratch, a series of well known tools were deployed on a self hosting basis. For this purpose, the domain webwow.xyz was purchased, and a server was deployed in a residential setting. This server was then dedicated to hosting a Matrix chat server, as well as FileRun file sharing platform. Thereby members could now have a public facing website with a variety of tools at their disposal, whilst having a well documented and functioning chat platform ready for use. Looking into the future, WebWow will continue to work on providing excellent services to all its members whilst also fostering a series of useless meme projects and social events.</p>
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