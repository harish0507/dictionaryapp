<?php
error_reporting(0);
ini_set('display_error', 0);

// http://letsventure.0x10.info/api/dictionary?type=json&query=list_cars
// http://letsventure.0x10.info/api/dictionary?type=json&query=api_hits

// Headers to allow external API calls; and to tackle browser's client-side security policy towards script execution.
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');

$count = file_get_contents("hitcounter.txt");
$count = $count + 1;
$myfile = fopen("hitcounter.txt", "w") or die("");
$txt = $count;
fwrite($myfile, $txt);
fclose($myfile);



if(isset($_REQUEST["type"]))
        $type = strtolower($_REQUEST["type"]);

if(isset($_REQUEST["query"]))
        $query = strtolower($_REQUEST["query"]);


if($type == null) die("parameter 'type' can't be null. it accepts either json or csv.");


if($query == null) die("parameter 'query' can't be null. it accepts either alphabets [A..Z] or api_hits.");


if($query == "api_hits")
{
        $count_my_page = ("hitcounter.txt");
        $hits = file($count_my_page);
        $hits[0]++;
        echo json_encode(array("api_hits"=>trim($hits[0])));
}

if(strlen(trim($query)) == 1){

	if($type == "csv")
	{
	        echo str_ireplace(array("||","\n"), array(",","\n\r"), file_get_contents("cars.chunk"));
	}
	elseif($type == "json")
	{

		$_file_location = "../data/" . strtoupper($query) . ".log";

		$_products = explode("\n" ,  file_get_contents($_file_location));
		
		unset($_products[count($_products)-1]);
		foreach ($_products as $key => $value) {
		        # code...
		        $_tmp = null;
		        $_tmp = explode("||",$value);
                $_product[] = array( "word"          =>$_tmp[0],
                                     "description"   =>$_tmp[1]);
		}
	    array_shift($_product);
	    echo json_encode($_product);
	}
}

?>
