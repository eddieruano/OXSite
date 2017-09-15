<?php
$html ="";
$albumFratCasa = "6203964837341521025";
$albumRico = "6203964837341521025";
$url = "http://picasaweb.google.com/data/feed/api/user/cpthetachi/albumid/$albumFratCasa?imgmax=912";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$xmlresponse = curl_exec($ch);
$cleaner = file_get_contents($url);
$xml = simplexml_load_string($cleaner); 
$elem = new SimpleXMLElement($xmlresponse);
//printf("%d offers.\n", $elem->entry->count() );
$limit = $elem->entry->count();
$title = array();
$keys = array();
$stringerr = "";
$section = "";
$keyword = "";
$value_array = array(); //this array will hold the correct keyword for the gallery section name
$name = "";
$mixed_array = array();
$j = 0;
//var_dump($xml[2]);
for($i = 0; $i < $limit; $i++)
{
	$title[$i] = $xml->entry[$i]->children('media', true)->group->content->attributes();
	$keys[$i] = $xml->entry[$i]->children('media', true)->group->keywords;
	//$caption[$i] = $xml->entry[$i]->summary; //just comment out for now array of captions
	$section = ((string)$xml->entry[$i]->children('media', true)->group->description);
    $keyword = ((string)$xml->entry[$i]->children('media', true)->group->keywords);
	$mixed_array[$i]['section'] = $section;
    $mixed_array[$i]['keyword'] = $keyword;
    //make sure the keyword is there or else nah
    if(strlen($keyword) != 0)
    {
        $value_array[$section] = $keyword;
    }
    $j++;
}

//var_dump($mixed_array);

$mixed_array_size = count($mixed_array);

$single_array = array(); //will hold the sorted by frequency sections

for($i = 0; $i < $mixed_array_size; $i++)
{
    $single_array[$i] = $mixed_array[$i]['section']; //save the correct section
}




//this sortes the single array by frequency
$counts = array_count_values($single_array);
arsort($counts);
$sorted_sections = array_keys($counts);
//var_dump($sorted_sections);
//var_dump($sorted_sections);
//$stringy = $value_array[$sorted_sections[1]];
//echo "HERE";
//var_dump($mixed_array);
//var_dump($newarray);
//var_dump($stringy);
//var_dump($value_array);
//echo $sorted_sections[2];
//echo $value_array[$sorted_sections[2]];

//var_dump($title);

for($i = 0; $i < $limit; $i++)
{
	$html .= "<div class='all $keys[$i] Image_Wrapper' data-caption=''><a data-rel='lightcase:all' title='#$keys[$i]' href='$title[$i]'><img src='$title[$i]'></a></div>";
}

//$groups = array();
//$groups = javatagger($double_array);





//
//function tagger($tags)
//    {
//        $compilation = array();
//        $checks = false;
//        $stringtemp = "";
//        $counter = 0;
//        $size = count($tags);
//        $unique = array();
//    
//        for( $counter = 0; $counter < $size; $counter++)
//        {
//            if((strlen($tags[$counter]) != 0))
//           { 
//                array_push($compilation, ((string) $tags[$counter]));
//                //echo "dope";
//           }
//            else 
//            {
//                //do nothing?
//            }
//            
//       }
//    
//    $infoarray = array_count_values($compilation);
//    //$unique  = array_unique($tags, SORT_STRING);
//    //var_dump($unique);
//    asort($infoarray);
//    //var_dump($infoarray);
//    //Only send the 7 most popular links
//    $size = count($infoarray);
//    
//    foreach($infoarray as $x => $x_value) {
//        array_push($unique, $x);
//        
//    }
//    //var_dump($unique);
//    $newsize = count($unique);
//    $counter = $newsize - 1; //one less than the size to not go out of bounds
//    $boundary = $newsize - 7;// make it so that we only get the 7 top values
//    $zero_counter = 0; //to set id values for buttons
//    $tempo = array();
//    for($counter; $counter >$boundary; $counter--)
//    {
//        echo "<li class='newbutton button$zero_counter $unique[$counter]'>$unique[$counter]</li>";
//        $tempo[$zero_counter] = $unique[$counter];//when we return this array it acts as a list for the jquery on the gallery page
//        $zero_counter++;
//        
//        
//    }
//    
//    return $tempo;
//    
//}
//
//
//function javatagger($tags)
//    {
//        $group_array = array();
//        $keyword_array = array();
//        $compilation = array();
//        $checks = false;
//        $stringtemp = "";
//        $counter = 0;
//        $counterInner = 0;
//        $tempSize = 0;
//        $size = count($tags);
//        $unique = array();
//        $infoarray = array();
//        asort($tags);
//        var_dump($tags);
//        for( $counter = 0; $counter < $size; $counter++)
//        {
//            //$tempSize = count($tags[$counter]);
//            //echo "<h1 style='color: black;'>$tempSize</h1>";
//            
//            //if((strlen($tags[$counter][$counterInner]) != 0))
//            //{
//                array_push($group_array, ((string) $tags[$counter][$counter]));
//            //}
//            //if((strlen($tags[$counter][$counterInner + 1]) != 0))
//            //{
//                array_push($keyword_array, ((string) $tags[$counter][$counter + 1]));
//            //}
//            $counterInner = 0;
//       }
//    //array_multisort ($tags, SORT_DESC, SORT_STRING,$group_array);
//    //asort($tags);
//    var_dump($group_array);
//    var_dump($keyword_array);
//    //$infoarray = array();
//    //$unique  = array_unique($tags, SORT_STRING);
//    //var_dump($unique);
//    array_multisort($group_array, SORT_DESC, SORT_STRING, $keyword_array);
//    //var_dump($infoarray);
//    //Only send the 7 most popular links
//    
//    var_dump($group_array);
//    var_dump($keyword_array);
//    
//    
//    for($counter = 0; $counter < $size; $counter++)
//    {
//        
//    }
//    
//    
//    $size = count($group_array);
//    foreach($group_array as $x => $x_value) {
//        array_push($unique, $x);
//        
//    }
//    //var_dump($unique);
//    $newsize = count($unique);
//    $counter = $newsize - 1; //one less than the size to not go out of bounds
//    $boundary = $newsize - 4;// make it so that we only get the 7 top values
//    $zero_counter = 0; //to set id values for buttons
//    $tempo = array();
//    for($counter; $counter >$boundary; $counter--)
//    {
//        //echo "<li class='newbutton button$zero_counter $unique[$counter]'>$unique[$counter]</li>";
//        $tempo[$zero_counter] = $unique[$counter];//when we return this array it acts as a list for the jquery on the gallery page
//        $zero_counter++;
//        
//        
//    }
//    
//    return $tempo;
//    
//}
//
//

/*
function javatagger($tags)
    {
        $compilation = array();
        $checks = false;
        $stringtemp = "";
        $counter = 0;
        $size = count($tags);
        $unique = array();
    
        for( $counter = 0; $counter < $size; $counter++)
        {
            if((strlen($tags[$counter]) != 0))
           { 
                array_push($compilation, ((string) $tags[$counter]));
                //echo "dope";
           }
            else 
            {
                //do nothing?
            }
            
       }
    
    $infoarray = array_count_values($compilation);
    //$unique  = array_unique($tags, SORT_STRING);
    //var_dump($unique);
    asort($infoarray);
    //var_dump($infoarray);
    //Only send the 7 most popular links
    $size = count($infoarray);
    
    foreach($infoarray as $x => $x_value) {
        array_push($unique, $x);
        
    }
    //var_dump($unique);
    $newsize = count($unique);
    $counter = $newsize - 1; //one less than the size to not go out of bounds
    $boundary = $newsize - 4;// make it so that we only get the 7 top values
    $zero_counter = 0; //to set id values for buttons
    $tempo = array();
    for($counter; $counter >$boundary; $counter--)
    {
        //echo "<li class='newbutton button$zero_counter $unique[$counter]'>$unique[$counter]</li>";
        $tempo[$zero_counter] = $unique[$counter];//when we return this array it acts as a list for the jquery on the gallery page
        $zero_counter++;
        
        
    }
    
    return $tempo;
    
}*/

?>
