<pre>
	<?php
	function getData($url, $param = array(), $method = "GET")
	{
		$headers = array(
			"User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36",
			"Content-Type: application/x-www-form-urlencoded",
			"Accept:*/*",
			"Connection: keep-alive",
			"Accept-Encoding:gzip, deflate",
			"Accept-Language:en-US,en;q=0.8,vi;q=0.6",
			"Connection:keep-alive",
			"X-Requested-With:ShockwaveFlash/18.0.0.232"
		);

		$ch = curl_init();
		if ($method == "POST"){
			ksort($param);
			$strParam = http_build_query($param);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch,CURLOPT_POSTFIELDS, $strParam);
		} else if (count($param) > 0){
			ksort($param);
			$strParam = http_build_query($param);
			$url = $url . "?" . $strParam;

		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_COOKIE, "location.href=1" );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_URL, $url);

		$data =  curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	$url = "https://www.facebook.com/TAIHENTV/videos/273316510179505/";
	$exp = explode(".com/",$url);
	$exp = explode("/",$exp[1]);
    print_r($exp);
    $html = getData("https://www.facebook.com/$exp[0]/$exp[1]/$exp[2]");	
    $exLink = explode("sd_src:\"" , $html);
    $exLink = explode('"' , $exLink[1]);
    //$exLink = str_replace('video','instagram',$exLink);

    ?>

    ​<script src="../assets/jwplayer-7.3.6/jwplayer.js" ></script>

    <script>jwplayer.key="75f9jpL7HIyq4fJ9yIVmkOhlySvn72qzvBYduA==";</script>

    <div id="myElement">Loading the player...</div>

    <script type="text/javascript">

        var playerInstance = jwplayer("myElement");

        playerInstance.setup({

            file: "<?php echo $exLink[0]?>",

            width: 640,

            height: 360

        });

    </script>
    <?php
    print_r($exLink[0]);
    /*$url = "https://drive.google.com/file/d/0B8idkdjOyOCBWTFQNWFZTWRQbGM/view";
    $get = ("https%3A%2F%2Fr1---sn-npoe7nez.c.drive.google.com%2Fvideoplayback%3Fid%3Dd81a9bfd3e4bc7bc%26itag%3D22%26source%3Dwebdrive%26requiressl%3Dyes%26mm%3D30%26mn%3Dsn-npoe7nez%26ms%3Dnxu%26mv%3Dm%26pl%3D21%26sc%3Dyes%26ttl%3Dtransient%26ei%3Dhf3CW_eZKsqaqwXMtorQAw%26susc%3Ddr%26driveid%3D0B8idkdjOyOCBWTFQNWFZTWRQbGM%26app%3Dtexmex%26mime%3Dvideo%2Fmp4%26dur%3D1500.194%26lmt%3D1475995260034025%26mt%3D1539505485%26ip%3D27.78.63.68%26ipbits%3D0%26expire%3D1539519941%26cp%3DQVNIQUZfWFlSQlhOOm1KV3VmcXpFTWto%26sparams%3Dip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Csc%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Cdur%2Clmt%2Ccp%26signature%3DD26B3ABC89F401DE23D5E80ED79C4A47746BC1FC9AEDFCE0E13DBEDD8D113C4B.A6197EB8C8C2E701271E65F6FE68B1B8EC90934B9A75EF2CDAEF02951525F5E5%26key%3Dus0\u0026type\u003dvideo%2Fmp4%3B+codecs%3D%22avc1.42001E%2C+mp4a.40.2%22\u0026quality\u003dhd720,itag\u003d59\u0026url\u003d");
    $link = str_replace(
        array('\\u003d', '\\u0026', '%22', '%26', '%2C' , '%2F', '%3A', '%3B' , '%3D', '%3F'),
        array('=', '&' , '"' ,'&', ',' ,'/', ':', ';' , '=', '?'), $get);
    echo $link;*/