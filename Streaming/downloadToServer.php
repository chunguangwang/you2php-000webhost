<?php
/**
 * Description of VideoStream
 *
 * @author Rana
 * @link http://codesamplez.com/programming/php-html5-video-streaming-tutorial
 */

$url = "https://r5---sn-nx5s7n7z.googlevideo.com/videoplayback?expire=1581813658&ei=OjtIXui4H5Clkgbu-o2QCQ&ip=73.109.129.109&id=o-ANNvj6U_jnTzK2qR5STte6Zap1CNnDTDpeWygazdE-CN&itag=278&aitags=133%2C134%2C135%2C136%2C137%2C160%2C242%2C243%2C244%2C247%2C248%2C278%2C394%2C395%2C396%2C397%2C398%2C399%2C597%2C598&source=youtube&requiressl=yes&mm=31%2C29&mn=sn-nx5s7n7z%2Csn-nx57ynld&ms=au%2Crdu&mv=m&mvi=0&pl=16&initcwndbps=2367500&vprv=1&mime=video%2Fwebm&gir=yes&clen=12101720&dur=1182.147&lmt=1581472630173127&mt=1581791974&fvip=1&keepalive=yes&fexp=23842630,23872990,23878762&c=WEB&txp=5431432&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=ALgxI2wwRgIhAILUsgFeTrS4Ds5uksBXHUuqLntHUA93L5uRyC5oBpTcAiEA2kOj25u9O1sCxFrTEykPuQwPcTmiVBIThlAJIDy1t3c%3D&lsparams=mm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=AHylml4wRQIhAI5iUe0cmHiwyvtLeBULrnZGsuPs8agE9xJ_FbxShWGrAiAUb4GV20Yb_LxUUuCw3qblD6JfY25bP8bPhhtfi4LeIA%3D%3D&ir=1&rr=12";
$filename = "videoplayback.webm"; //"huoshenshan.mp4";

//    function file_put_contents($filename, $data, $file_append = false) {
//        $fp = fopen($filename, (!$file_append ? 'w+' : 'a+'));
//        if(!$fp) {
//            trigger_error('file_put_contents cannot write in file.', E_USER_ERROR);
//            return;
//        }
//        fputs($fp, $data);
//        fclose($fp);
//    }

//    file_put_contents($filename, fopen($url,'r'));


echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<video id="video-help" width="530" controls>
    <source id="videoPath" src="whatever.php?video='.$filename.'" type="video/mp4">
</video>
</body>
</html>';

