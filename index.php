<?php 
	$url	=	"https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20csv%20where%20url%3D'http%3A%2F%2Fdownload.finance.yahoo.com%2Fd%2Fquotes.csv%3Fs%3DNM9.F%2CNOU.V%2CNMGRF%26f%3Dsl1c1vkjj1w%26e%3D.csv'%20and%20columns%3D'symbol%2Cprice%2Cchange%2Cvolume%2Cyearhigh%2Cyearlow%2Cmarketcap%2Cyearrange'&format=json&callback=";

	$session = curl_init($url);
	curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
	$json = curl_exec($session);
	
	$data 	= json_decode($json);  
	
?>

<style type="text/css">
	div.xyz123.container { font-family: "arial narrow"; }
	div.xyz123.container span { display:inline-block; margin-right:10px }
	div.xyz123.container h1, div.xyz123.container h3 { margin-bottom: 0; margin-top: 0 }
	div.xyz123.container strong { color: #0d74b4;font-weight: bold }
	div.xyz123.container em.green { color: green }
	div.xyz123.container em.red { color: red }
	div.xyz123.container table { border: 1px solid silver }
	div.xyz123.container th { text-align: left; color: grey; font-weight:100 }
	div.xyz123.container td { text-align: center; color: grey }
</style>

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
<h1>Capital Structure</h1>
<h3>Share capital diluted as at <?php echo date('M d, Y') ?></h3>

<br>

<table>
<tr>
	<th>Pink OTC markets</th>
	<td width="100"></td>
</tr>
<tr>
	<th>Frankfurt Exchange</th>
	<td></td>
</tr>
<tr>
	<th>TSX Venture Exchange</th>
	<td></td>
</tr>
<tr>
	<th>Share Price</th>
	<td> <?php echo $nouv->price; ?> </td>
	<th>Common Shares</th>
	<td width="100"></td>
</tr>
<tr>
	<th>52 Week low/high</th>
	<td> <?php echo $nouv->yearrange ?> </td>
	<th>Market Cap (MM)</th>
	<td> <?php echo $nouv->marketcap ?> </td>
</tr>
<tr>
	<th>Warrants</th>
	<td></td>
	<th>Broken Warrants</th>
	<td></td>
</tr>
<tr>
	<th>Daily Volume</th>
	<td> <?php echo $nouv->dailyvol ?> </td>
	<th>Options</th>
	<td></td>
</tr>
<tr>
	<th><strong>Balance</strong></th>
	<td></td>
</tr>
</table>

<br>
<h3>Stock Information</h3>
<img src="http://chart.finance.yahoo.com/z?s=NOU.V&t=6m&q=l&l=on&z=m" alt="" />

</div>

