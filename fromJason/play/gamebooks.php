<?php
require( '/home/figh/public_html/wp-load.php' );

/**
 * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
 * array containing the HTTP server response header fields and content.
 */
function get_web_page( $url,$user_login ){
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;

	if(preg_match('/application\/octet-stream/',$header['content_type'])){
		header("Content-type: application/octet-stream");
		header("Content-disposition: attachment; filename=\"$user_login.zip\"");
		echo $header['content'];
		exit;
	}
	elseif(preg_match('/download\+xhtml/',$header['content_type'])){
		$filename=$header['downloadname'];
		header("Content-type: application/xml");
		header("Content-disposition: attachment; filename=FF_Download.xhtml");
		echo $header['content'];
		exit;
	}
	else{

    	return $header;
	}

};

function do_post_request($url,$data, $user_login){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST , 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS , $data);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 1);
	curl_setopt($ch, CURLOPT_HEADER , 0);  // DO NOT RETURN HTTP HEADERS
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);  // RETURN THE CONTENTS OF THE CALL
	curl_setopt($ch, CURLOPT_AUTOREFERER , 1);
	curl_setopt($ch, CURLOPT_USERAGENT , 'spider');
	curl_setopt($ch, CURLOPT_ENCODING , "");

	$result=array();

	$result= curl_exec($ch);
	$info=curl_getinfo($ch);
	curl_close( $ch );

	if(preg_match('/application\/octet-stream/',$info['content_type'])){
		header("Content-type: application/octet-stream");
		header("Content-disposition: attachment; filename=$user_login.zip");
		echo $result;
		exit;
	}
	elseif(preg_match('/download\+xhtml/',$info['content_type'])){
		$filename=$info['downloadname'];
		header("Content-type: application/xml");
		header("Content-disposition: attachment; filename=FF_Download.xhtml");
		echo $result;
		exit;
	}
	else{
		return $result;
	}

};

// echo "Hello";
// exit;

if ( is_user_logged_in() ) {
	// need to check filename exists else redirect to CMS failed url page (or custom one for play area)

	$login_key="11223344556677889900";

	// $path = $_SERVER['REQUEST_URI'];
	$filename=preg_replace('/\/.*\//','',$_SERVER['REQUEST_URI']);

	if(preg_match('/\?/',$filename) ){
		$filename=preg_replace('/\?/', "?user=$user_login&key=".$login_key."&", $filename);
	}
	else{
		$filename.="?user=".$user_login."&key=".$login_key;
	}

	// full url construction-  use perl_scriptlocation.txt here sometime
	$url="http://www.fightingfantasy.net/gamebooks/".$filename;

 	if($_SERVER['REQUEST_METHOD']==='POST') {

		// get post data
		foreach(array_keys($_POST) as $key){

			$value=$_POST[$key];

			$key=urlencode($key);

			// if there are underscores in the key name create equivalent with spaces instead
			if(preg_match('/_/',$key)){
				$key1=preg_replace('/\_/',' ',$key);
				$substitute=1;
			}
			else{
				$substitute=0;
			}

			// for multiple selects etc.
			if(is_array($value)){
				foreach($value as $entry){
					$entry=stripslashes($entry);

					if($substitute){$data.=$key1."=".$entry."&";}
					$data.=$key."=".$entry."&";
				}
			}
			else{
				$value=urlencode(stripslashes($value));

				if($substitute){$data.=$key1."=".$value."&";}
				$data.=$key."=".$value."&";
			}

		}

		$data=preg_replace('/\&$/','',$data);

		// call url and pass POST data
		$page=do_post_request($url,$data,$user_login);
		header('Content-Type:text/html; charset=UTF-8');

		print($page);
	}
	else{
		// just call url
		$page=get_web_page($url,$user_login);
		header('Content-Type:text/html; charset=UTF-8');
		print($page['content']);
	}
 }
 else {
 	header( 'Location: http://www.fightingfantasy.net/gamebooks-menu/playcreate-gamebooks/' ) ;
 }



?>
