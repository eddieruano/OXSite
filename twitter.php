<?php
$token = '2835409394-w80SeDeasVksNK8ek8QXU7F3QPyXOmGG1fyE5RR';
$token_secret = 'XrDq5ixIkLbMuMRzUM8n2yyjJoMj1dn9avDd4GbeHq79z';
$consumer_key = 'wtW0u1KSuUc0GCm3wAtNeFQl1';
$consumer_secret = 'GC7IKkAu9yh6r1rMVTVYrSSaPc8fRCQiW9XPc3ZvKyQAwDnOnf';
$insta_token = '1102870375.467ede5.97ee1d3b06304f2d87e3c6bc1e08c4df';


$host = 'api.twitter.com';
$method = 'GET';
$path = '/1.1/statuses/user_timeline.json'; // api call path

$query = array( // query parameters
    'screen_name' => 'thetachislo',
    'count' => '1'
);

$oauth = array(
    'oauth_consumer_key' => $consumer_key,
    'oauth_token' => $token,
    'oauth_nonce' => (string)mt_rand(), // a stronger nonce is recommended
    'oauth_timestamp' => time(),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_version' => '1.0'
);

$oauth = array_map("rawurlencode", $oauth); // must be encoded before sorting
$query = array_map("rawurlencode", $query);

$arr = array_merge($oauth, $query); // combine the values THEN sort

asort($arr); // secondary sort (value)
ksort($arr); // primary sort (key)

// http_build_query automatically encodes, but our parameters
// are already encoded, and must be by this point, so we undo
// the encoding step
$querystring = urldecode(http_build_query($arr, '', '&'));

$url = "https://$host$path";

// mash everything together for the text to hash
$base_string = $method."&".rawurlencode($url)."&".rawurlencode($querystring);

// same with the key
$key = rawurlencode($consumer_secret)."&".rawurlencode($token_secret);

// generate the hash
$signature = rawurlencode(base64_encode(hash_hmac('sha1', $base_string, $key, true)));

// this time we're using a normal GET query, and we're only encoding the query params
// (without the oauth params)
$url .= "?".http_build_query($query);
$url=str_replace("&amp;","&",$url); //Patch by @Frewuill

$oauth['oauth_signature'] = $signature; // don't want to abandon all that work!
ksort($oauth); // probably not necessary, but twitter's demo does it

// also not necessary, but twitter's demo does this too
function add_quotes($str) { return '"'.$str.'"'; }
$oauth = array_map("add_quotes", $oauth);

// this is the full value of the Authorization line
$auth = "OAuth " . urldecode(http_build_query($oauth, '', ', '));

// if you're doing post, you need to skip the GET building above
// and instead supply query parameters to CURLOPT_POSTFIELDS
$options = array( CURLOPT_HTTPHEADER => array("Authorization: $auth"),
                  //CURLOPT_POSTFIELDS => $postfields,
                  CURLOPT_HEADER => false,
                  CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_SSL_VERIFYPEER => false);

// do our business
$feed = curl_init();
curl_setopt_array($feed, $options);
$json = curl_exec($feed);
curl_close($feed);

$twitter_data = json_decode($json);
$new_twitter_data = json_decode($json, true);
var_dump($twitter_data);


foreach($new_twitter_data as $i){
    echo $i['created_at'];
    echo $i['text'];
}



//echo $time_ago;
/*OLD CODE WITHOUT USING JSON AS ARRAY*/
/*
foreach ($twitter_data as &$value) {
   $tweetout .= preg_replace("/(http:\/\/|(www\.))(([^\s<]{4,68})[^\s<]*)/", '<a href="http://$2$3" target="_blank">$1$2$4</a>', $value->text);
   $tweetout = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $tweetout);
   $tweetout = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $tweetout);
}*/


foreach($new_twitter_data as $i)
{
    $tweetout =$i['text'];
    

//check to see if the tweet comes with an included link
$position = strpos($tweetout, "htt");//check position of string http in case of link
if( $position === false){
	//echo $tweetout;
	//$html = "<p class='twitter-response'>$tweetout</p>";//Just text no need for second p tag
    die("Error");
}
else //if yes link
{
	$tweet = substr($tweetout, 0, $position);//cut out good text
	$link = substr($tweetout,strpos($tweetout,"http"), strlen($tweetout));//isolate the link
	$html = "<p class='twitter-response'>$tweet</p><p class='twitter-time'></p>"; //Build Style Scaffolding
	echo $html; //send to html

	$break ="<br>";
	$instalink = unshorten_url($link);
	//echo $instalink;
	//echo $break;
	//Sample String ==> https://instagram.com/p/2ptGnbBeB3/
	//Need to keep everthing after /p/
	
	$shortposition = strpos($instalink, "p/");//check position of shortcode
	$failsafe = strpos($instalink,"insta");//make sure it's a instagram URL
	if( ($position === false) || ($failsafe === false)){
		//echo $tweetout;
		//$html = "<p class='twitter-response'>$tweetout</p>";//Just text no need for second p tag
		die("Error, not instagram");
	}
	else //if yes insta
	{
		$shortcode = substr($instalink, ($shortposition + 2), 10);//cut out shortcode
		$instapic = "https://api.instagram.com/v1/media/shortcode/$shortcode?access_token=$insta_token"; //Build api call for instagram
		
		}
        if($instapic === null)
        {   
            $imagehtml = "<div class='follow'></div>";
        }
		else
            //$thejson = file_get_contents($instapic);
            $thedata = json_decode($instapic, true);

            $imagelink = $thedata['data']['images']['low_resolution']['url'];
            $usertext = $thedata['data']['user']['full_name'];
            $imagehtml = "<a href='$instalink'><img src='$imagelink' alt='$usertext' /></a>";
        }

}
}

function unshorten_url($url) {
    $ch = curl_init($url);
    curl_setopt_array($ch, array(
        CURLOPT_FOLLOWLOCATION => TRUE,  // the magic sauce
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_SSL_VERIFYHOST => FALSE, // suppress certain SSL errors
        CURLOPT_SSL_VERIFYPEER => FALSE, 
    ));
    curl_exec($ch);
    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    return $url;
}

?>