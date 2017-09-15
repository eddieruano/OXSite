<?php
$token = '2835409394-lTMEF7M9NFvOHJSagSMiigTdPXfNEYNjzoV9t24';
$token_secret = '5cOArCtS5VqmI5nGyntGgccdIT8SVc55KFPzXpXl68FLa';
$consumer_key = 'wtW0u1KSuUc0GCm3wAtNeFQl1';
$consumer_secret = 'GC7IKkAu9yh6r1rMVTVYrSSaPc8fRCQiW9XPc3ZvKyQAwDnOnf';
$insta_token = '1102870375.467ede5.97ee1d3b06304f2d87e3c6bc1e08c4df';


$host = 'api.twitter.com';
$method = 'GET';
$path = '/1.1/statuses/user_timeline.json'; // api call path

$query = array( // query parameters
    'screen_name' => 'thetachislo',
    'count' => '2'
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


$new_twitter_data = json_decode($json, true);

//var_dump($new_twitter_data);

$tweets = array();
$dates = array();
$pics = array();
$enty = array();
$refined_tweets = array();
$count = 0;
//var_dump($new_twitter_data);
foreach($new_twitter_data as $i){
    $tweets[$count] = $i['text'];
    $refined_tweets[$count] = extract_text($i['text']);
    $dates[$count] = time_elapsed_string($i['created_at']);
    $pics[$count] = get_picture_url($tweets[$count]);
    $profilepic = $i['user']['profile_image_url_https'];
    $count = ($count + 1);
    //$enty[$count] = $i['entities']['media']['media_url_https'];
}



//var_dump($enty);
/*These calls are in the html code so we print where needed
build_tweets($count, $refined_tweets);
//var_dump($new_twitter_data);
*/

//new_build_links($new_twitter_data);





function new_build_links($twitter_data, $refined_tweets){
    //echo $pics[0];
    //$lala = "tank";
    $insta_token = '1102870375.467ede5.97ee1d3b06304f2d87e3c6bc1e08c4df';
    
    $string1 = $twitter_data[1]['entities']['urls'][0]['expanded_url'];
    $string2 = $twitter_data[0]['entities']['media'][0]['media_url_https'];
    
    if($string2 == null) //picture on instagram
    {
        $picture_link = $string1;
        $shortposition = strpos($picture_link, "p/");//check position of shortcode
        $shortcode = substr($picture_link, ($shortposition + 2), 10);//cut out shortcode
        $instapic = "https://api.instagram.com/v1/media/shortcode/$shortcode?access_token=$insta_token"; //Build api call for instagram
        if($instapic === null)
        {   
            $imagehtml = "<div class='follow'></div>";
        }
        else
        {
            $content = file_get_contents($instapic);
            $thedata = json_decode($content, true);
            $imagelink = $thedata['data']['images']['low_resolution']['url'];
            $bigimagelink = $thedata['data']['images']['standard_resolution']['url'];
            $usertext = $thedata['data']['user']['full_name'];
            $imagehtml = "<a data-rel='lightcase:all' href='$bigimagelink'><img class='wrapone' src='$imagelink' alt='$refined_tweets[0]' /></a>";
            echo $imagehtml;
        }
    }
    else if($string2 == null) //no picture present
    {
        $imagehtml = "<div class='follow'></div>";
    }
    else // picture on twitter
    {
        $picture_link = $string2;
        
        $imagehtml = "<a data-rel='lightcase:all' href='$picture_link'><img class='wrapone' src='$picture_link' alt='$refined_tweets[0]'/></a>";
        echo $imagehtml;
    }
    
}

function thetime($dates, $count){
    for($counter = 0; $counter < $count; $counter++)
    {
        if($counter == 0){echo "<div class='timeago wrapone'>$dates[$counter]</div>";}
        else if($counter == 1){echo "<div class='timeago wraptwo'>$dates[$counter]</div>";}
        else{echo "<div class='timeago wrapthree'>$dates[$counter]</div>";}
        
    }
}


function build_links($tempcount, $pics, $twitterdata, $tweets){
    //echo $pics[0];
    //$lala = "tank";
    $insta_token = '1102870375.467ede5.97ee1d3b06304f2d87e3c6bc1e08c4df';
        for($counter = 0; $counter < 1 ; $counter++){
            if($pics[$counter] == "none"){echo "<div class='noimage'></div>";}
            else{
            $link = substr($tweets[$counter],strpos($tweets[$counter],"http"), strlen($tweets[$counter]));
            $instalink = unshorten_url($link); //unshorted the link in the tweet
            $shortposition = strpos($instalink, "p/");//check position of shortcode
            $failsafe = strpos($instalink,"insta");//make sure it's a instagram URL
            if( ($shortposition === false) || ($failsafe === false))
            {
              //die("Error, not instagram");
                if($instapic === null)
                {   
                    $imagehtml = "<div class='follow'></div>";
                }
                  else
                {
                    //echo $instapic;
                    $content = file_get_contents($instapic);
                   // $thedata = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $instapic, true ));
                    $thedata = json_decode($content, true);
                    //var_dump($thedata);
                    $imagelink = $thedata['data']['images']['low_resolution']['url'];
                    $usertext = $thedata['data']['user']['full_name'];
                      
                    if($counter == 0){
                        $imagehtml = "<a href='$instalink'><img class='wrapone' src='$imagelink' alt='$usertext' /></a>";
                        echo $imagehtml;
                    }
                    else if($counter == 1)
                    {
                        $imagehtml = "<a href='$instalink'><img class='wraptwo' src='$imagelink' alt='$usertext' /></a>";
                        echo $imagehtml;
                    }
                    else
                    {
                        $imagehtml = "<a href='$instalink'><img class='wrapthree' src='$imagelink' alt='$usertext' /></a>";
                        echo $imagehtml;
                    }
                  }         
            }
            else{
                $shortcode = substr($instalink, ($shortposition + 2), 10);//cut out shortcode
                $instapic = "https://api.instagram.com/v1/media/shortcode/$shortcode?access_token=$insta_token"; //Build api call for instagram
                if($instapic === null)
                {   
                    $imagehtml = "<div class='follow'></div>";
                }
                  else
                {
                    //echo $instapic;
                    $content = file_get_contents($instapic);
                   // $thedata = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $instapic, true ));
                    $thedata = json_decode($content, true);
                    //var_dump($thedata);
                    $imagelink = $thedata['data']['images']['low_resolution']['url'];
                    $usertext = $thedata['data']['user']['full_name'];
                      
                    if($counter == 0){
                        $imagehtml = "<a href='$instalink'><img class='wrapone' src='$imagelink' alt='$usertext' /></a>";
                        echo $imagehtml;
                    }
                    else if($counter == 1)
                    {
                        $imagehtml = "<a href='$instalink'><img class='wraptwo' src='$imagelink' alt='$usertext' /></a>";
                        echo $imagehtml;
                    }
                    else
                    {
                        $imagehtml = "<a href='$instalink'><img class='wrapthree' src='$imagelink' alt='$usertext' /></a>";
                        echo $imagehtml;
                    }
                  }            
            }
        
        
        
        
    }
    
        }
    
}



function build_tweets($tempcount, $refined_tweets){
    $tweethtml ="";

    for($counter = 0; $counter < $tempcount ; $counter++){
        if($counter == 0)
        {
            $tweethtml = "<p class='twitter-response wrapone'>$refined_tweets[$counter]</p>";
        }
        else if($counter == 1){
            $tweethtml = "<p class='twitter-response wraptwo'>$refined_tweets[$counter]</p>";
        }
        else{
            $tweethtml = "<p class='twitter-response wraptwo'>$refined_tweets[$counter]</p>";
        }
            echo $tweethtml;

    }

}


function extract_text($tweet){
    $theposition = strpos($tweet, "htt"); //check position of string http in case of link
    if( $theposition === false) //if no http is found, then there is no link so we return tweet
    {
        return $tweet;    
    }
    else
    {
        $extracted_text = substr($tweet, 0, $theposition);//cut out good text;
        return $extracted_text;
    }
}
    

function get_picture_url($tweet){
    $insta_token = '1102870375.467ede5.97ee1d3b06304f2d87e3c6bc1e08c4df';
    $theposition = strpos($tweet, "htt");//check position of string http in case of link
    if( $theposition === false)
    {
        return "none"; //no url so return none
    }
    else //if yes link
    {
        //$extracted_text = substr($tweet, 0, $theposition);//cut out good text
        $link = substr($tweet,strpos($tweet,"http"), strlen($tweet)); //isolate the link
        //$ahtml = "<p class='twitter-response'>$tweet</p>"; //Build Style Scaffolding
        //echo $html; //send to html
        $instalink = unshorten_url($link);
        $shortposition = strpos($instalink, "p/");//check position of shortcode
        $failsafe = strpos($instalink,"insta");//make sure it's a instagram URL
        if( ($shortposition === false) || ($failsafe === false)){
            return null;
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
            else{
                $thejson = file_get_contents($instapic);
                $thedata = json_decode($thejson, true);

                $imagelink = $thedata['data']['images']['low_resolution']['url'];
                $usertext = $thedata['data']['user']['full_name'];
                $imagehtml = "<a href='$instalink'><img src='$imagelink' alt='$usertext' /></a>";

            }



    }
    return $imagehtml;
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

//rework time /*credit to glavic*/

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>