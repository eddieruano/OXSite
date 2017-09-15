<?php

$insta_token = '1102870375.467ede5.97ee1d3b06304f2d87e3c6bc1e08c4df';
$first = "This is the first picture";
$notfirst = "This isn't";


 
    $tag = 'ThetaChi';
    $client_id = "78789d8afa0d45f0b1256f10bc04b210";
    $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;
    //https://api.instagram.com/v1/tags/{tag-name}/media/recent?access_token=ACCESS-TOKEN
 
    $all_result  = processURL($url);
    $decoded_results = json_decode($all_result, true);
    //var_dump($decoded_results);

    $next = $decoded_results['pagination']['next_url'];
    $next_results = processURL($next);
    $more = json_decode($next_results, true);
    //var_dump($more);
//var_dump($more['caption']);
    //Now parse through the $results array to display your results... 
    print_photos($decoded_results, $first);
    print_photos($more, $notfirst);
//print_captions($more);


function print_photos($results, $firstcheck)
{
    $realfirst = 1;
    foreach($results['data'] as $item)
    {
        
        $image_link = $item['images']['low_resolution']['url'];
        //$captiontext = $item['caption']['text'];
        
        if($firstcheck == "This is the first picture" && $realfirst == 1)
        {
            echo "<img class='instapics firstpic' src='$image_link' />";
            $realfirst = 0;
        }
        else
        {
            echo "<img class='instapics' src='$image_link' />";
        }
    }

}

function print_captions($results)
{
    foreach($results['data'] as $item)
    {
        
        $captiontext = $item['caption']['text'];
        //var_dump($item)['caption'];
        if(strlen($captiontext) > 200)
        {
            $captiontext = explode( "\n", wordwrap( $captiontext, 200));
            $captiontext = $captiontext[0] . ' ...';
        }

        $names = $item['caption']['from']['full_name'];
        $handles = $item['caption']['from']['username'];
        
        echo "<div class='single-caption'><span class='names'>$names | @$handles</span><p>$captiontext</p></div>";
        
        
        
        
    }
    
}
    

function processURL($url)
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2
        ));
 
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

?>