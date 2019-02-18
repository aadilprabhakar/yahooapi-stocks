<?php 
	$url	=	"https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20csv%20where%20url%3D'http%3A%2F%2Fdownload.finance.yahoo.com%2Fd%2Fquotes.csv%3Fs%3DNM9.F%2CNOU.V%2CNMGRF%26f%3Dsl1c1vkjj1w%26e%3D.csv'%20and%20columns%3D'symbol%2Cprice%2Cchange%2Cvolume%2Cyearhigh%2Cyearlow%2Cmarketcap%2Cyearrange'&format=json&callback=";

	$session = curl_init($url);
	curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
	$json = curl_exec($session);
	
	$data 	= json_decode($json);  
?>
<link rel="stylesheet" src="./css/index.css" />
<div class='xyz123 container'>
<?php	
	$ress	=	$data->query->results->row;	
	
	foreach( $ress as $resss ):

		if( $resss->symbol == 'NOU.V' ):
			$nouv = $resss;
		endif;

		$sym = $resss->symbol;
		$prc = $resss->price;
		$chn = $resss->change;
	
		if( strpos($chn, '+') !== false )
			$class = 'green';
		else 
			$class = 'red';
		
		print "<span><strong>$sym</strong> $prc <em class='$class'>($chn)</em></span>";
	endforeach;
	
?>
</div>
