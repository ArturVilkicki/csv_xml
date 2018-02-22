<?php
	$xml = simplexml_load_file('catalog.xml');

	$n = count($xml ->book);
	$forSCVArr = [];
	$didziausiosKainos = [];
	$res = fopen('brangiausios.csv','w');


	for($i = 0; $i <5;$i++){
		$didziausiosKaina = 0;
		$index = 0;
		for($j = $i+1;$j<$n;$j++){
			if((float)$xml->book[$j]->price[0]>$didziausiosKaina && !in_array($j, $didziausiosKainos)){
				$didziausiosKaina = (float)$xml->book[$j]->price[0];
				$index = $j;
			}
		}
		$didziausiosKainos[] = $index;
		fputcsv($res, [
        $xml->book[$index]->attributes()->id,
        $xml->book[$index]->author,
        $xml->book[$index]->title,
        $xml->book[$index]->price,
        $xml->book[$index]->genre,
        $xml->book[$index]->publish_date
    ]);
	}
fclose($res);
echo json_encode('brangiausios.csv');
?>