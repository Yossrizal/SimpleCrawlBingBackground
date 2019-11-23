<?php 
    // persiapkan curl
$ch = curl_init(); 

    // set url 
curl_setopt($ch, CURLOPT_URL, "www.bing.com");

    // return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
$output = curl_exec($ch); 

$result = get_string_between(html_entity_decode($output), '"Image":{"Url":"/th?id=OHR.' ,'\u0026rf=');

    // tutup curl 
curl_close($ch);      

    // menampilkan hasil curl
// echo '<img src="http://www.bing.com'.$result.'" style="width: 100%;" />';

function get_string_between($string, $start, $end){
    $result = '1';
    while ($result != '') {
           # code...
        $image = '';

        $left = strpos($string, $start);    
        $left += strlen($start);
        $string = substr($string, $left);
        // echo $string;
        echo "<hr>";    

        $right = strpos($string, $end);
        $next = $right + strlen($end);
        $result = substr($string, 0 ,$right);

        if ($result != '') {
            $image = 'http://www.bing.com/th?id=OHR.'.$result;
            echo 'IMAGE : <img src="'.$image.'" style="width: 100px;" /><br>';

            $content = file_get_contents($image);
            //Store in the filesystem.
            $fp = fopen($result.".jpg", "w");
            fwrite($fp, $content);
            fclose($fp);
        }
        $string2 = substr($string, $next);
        $string = $string2; 
    }   
    
}
?>