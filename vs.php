<?php
@error_reporting(E_ALL&~E_NOTICE&~E_WARNING);
@ignore_user_abort(0);
@set_time_limit(0);
include_once('./YouTubeDownloader.php');

function strencode($string,$key='09KxDsIIe|+]8Fo{YP<l+3!y#>a$;^PzFpsxS9&d;!l;~M>2?N7G}`@?UJ@{FDI') {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if (@$j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        @$j++;
    @$hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return 'Urls://'.$hash;
}
function strdecode($string,$key='09KxDsIIe|+]8Fo{YP<l+3!y#>a$;^PzFpsxS9&d;!l;~M>2?N7G}`@?UJ@{FDI') {
    $string= ltrim($string, 'Urls://');
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if (@$j == $keyLen) { @$j = 0; }
        $ordKey = ord(substr($key,@$j,1));
        @$j++;
        @$hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}

$yt=new YouTubeDownloader();
$u="https://www.youtube.com/watch?v=".$_GET['vv'];
$links="https://r1---sn-nx57ynld.googlevideo.com/videoplayback?expire=1581593049&ei=ed1EXqK5LJutkwbI1ZbYCg&ip=2601%3A601%3A1301%3A4360%3Ab5f3%3A7ac8%3A44c6%3A23e9&id=o-AAOKqBaJgFH64ff3YYKZVG8JprDDO9YebNw_-EHyQR_4&itag=160&aitags=133%2C134%2C135%2C136%2C137%2C160%2C242%2C243%2C244%2C247%2C248%2C278%2C597%2C598&source=youtube&requiressl=yes&mm=31%2C26&mn=sn-nx57ynld%2Csn-n4v7sn7s&ms=au%2Conr&mv=m&mvi=0&pl=32&initcwndbps=2275000&vprv=1&mime=video%2Fmp4&gir=yes&clen=5903524&dur=1182.147&lmt=1581468290935594&mt=1581571408&fvip=1&keepalive=yes&fexp=23842630&c=WEB&txp=5432432&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=ALgxI2wwRgIhANxC7S0mvCVLD9O8yiJIbTw3eluiD0U7ShwtYLSaNBg0AiEA5NnbVAKVTGY-xr5PTWyBnTrRIoVgFrHfTghF7IJcus8%3D&lsparams=mm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=AHylml4wRQIhAPGplfwu2aioc9zX5A2gEeZWs2qV3zL-XcpQO-Oy42uYAiANnJLR2cX7uPiF1I58_F0F2ZDXQYVoWW52YyD_6dYkyA%3D%3D"//$yt->getDownloadLinks($u);
if($_GET['quality']=='720'){
	$file_path=$links['22']['url'];
}
elseif(isset($_GET["uhash"])){
	$file_path=strdecode($_GET["uhash"],'vEeUq6O}$HTX9$O');
}
else{
	$file_path=$links['18']['url'];
}
$url=trim($file_path);
$urlArgs=parse_url($url);
$host=$urlArgs['host'];
$requestUri=$urlArgs['path'];
if(isset($urlArgs['query'])){
	$requestUri.='?'.$urlArgs['query'];
}
$protocol=($urlArgs['scheme']=='http')?'tcp':
'ssl';
$port=$urlArgs['port'];
if(empty($port)){
	$port=($protocol=='tcp')?80:
	443;
}
$header="{$_SERVER['REQUEST_METHOD']} {$requestUri} HTTP/1.1\r\nHost: {$host}\r\n";
unset($_SERVER['HTTP_HOST']);
$_SERVER['HTTP_CONNECTION']='close';
if($_SERVER['CONTENT_TYPE']){
	$_SERVER['HTTP_CONTENT_TYPE']=$_SERVER['CONTENT_TYPE'];
}
foreach($_SERVER as $x=>$v){
	if(substr($x,0,5)!=='HTTP_'){
		continue;
	}
	$x=strtr(ucwords(strtr(strtolower(substr($x,5)),'_',' ')),' ','-');
	$header.="{$x}: {$v}\r\n";
}
$header.="\r\n";
$remote="{$protocol}://{$host}:{$port}";
$context=stream_context_create();
stream_context_set_option($context,'ssl','verify_host',false);
$p=stream_socket_client($remote,$err,$errstr,60,STREAM_CLIENT_CONNECT,$context);
if(!$p){
	exit ;
}
fwrite($p,$header);
$pp=fopen('php://input','r');
while($pp && !feof($pp)){
	fwrite($p,fread($pp,1024));
}
fclose($pp);
$header='';
$x=0;
$len=false;
$off=0;
while(!feof($p)){
	if($x==0){
		$header.=fread($p,1024);
		if(($i=strpos($header,"\r\n\r\n"))!==false){
			$x=1;
			$n=substr($header,$i+4);
			$header=substr($header,0,$i);
			$header=explode(PHP_EOL,$header);
			foreach($header as $m){
				if(stripos($m,'302')!==FALSE){
					continue;
				}
				if(stripos($m,'Location')!==FALSE){
					$LocationUrl=ltrim($m,"Location: ");
					$LocationUrl='./vs.php?uhash='.strencode($LocationUrl,'vEeUq6O}$HTX9$O');
					header("Location: $LocationUrl");
					exit();
					continue;
				}
				if(preg_match('!^\\s*content-length\\s*:!is',$m)){
					$len=trim(substr($m,15));
				}
				header($m);
			}
			$fname=$_GET['vv'].'.mp4';
			header("Content-Disposition: attachment;filename=\"$fname\"");
			$off=strlen($n);
			echo $n;
			flush();
		}
	}
	else{
		if($len!==false && $off>=$len){
		break;
	}
	$n=fread($p,1024);
	$off+=strlen($n);
	echo $n;
	flush();
}
}
fclose($p);
return ;
?>
