<?php
class Google{
    //var $urlIpV6 = "http://sub1.phim3s.net/v3/plugins_player.php?url=";
    //var $urlIpV6 = "http://xemphimso.com/grab/vplugin2/curl.php?url=";
    var $urlIpV6 = "http://tranvu.info/curl.php?url=";
    
    public function getData($url, $param = array(), $method = "GET"){
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
    
    private function getLocation($url = "" , $force = false){
        if ($force == false){
            return $url;
        }
        if ($url != ""){
            $url_ = $url;
            $url_  = $this->getUrrlV6() . urlencode($url);
            $ch = curl_init($url_);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $response = curl_exec($ch);
            curl_close($ch);
            
            preg_match_all('/^Location:(.*)$/mi', $response, $matches);
            if (!empty($matches[1])){
                $url =  trim($matches[1][0]);
                $arrDomain = parse_url($url);
                $url = str_replace($arrDomain['host'], "redirector.googlevideo.com", $url);
                $url = str_replace("&begin=0", "", $url);
                return $url;
            }
            
            preg_match_all('/HREF="(.*)"/s', $response, $matches);
            if (!empty($matches[1])){
                $url =  trim($matches[1][0]);
                $url = str_replace("&begin=0", "", $url);
                $arrDomain = parse_url($url);
                $url = str_replace($arrDomain['host'], "redirector.googlevideo.com", $url);
                return html_entity_decode ($url);
            }
        }
       return $url;
    }
    
    private function getLabel($str)
    {
        parse_str($str,$arr);
        if (isset($arr['itag']) == false || $arr['itag'] == ''){
            $str = str_replace('=m', '&itag=', $str);
            parse_str($str,$arr);
        }
        switch ($arr['itag']){
            case 17: $result =  '144';break;
            case 6:
            case 5: $result = '240'; break;
            case 36: $result =  '240';break;
            case 18: $result =  '360';break;
            case 34: $result =  '360';break;
            case 43: $result =  '360';break;
            case 35: $result =  '480';break;
            case 59: $result =  '480';break;
            case 44: $result =  '480';break;
            case 45: $result =  '720';break;
            case 22: $result =  '720';break;
            case 37: $result =  '1080';break;
            case 38: $result =  '1080';break;
            case 46: $result =  '1080';break;
            default:  $result =  "Default";break;
        }
        if ($result != "Default"){
            $result .= "p"; 
        }
        return $result;
    }
    
    private function getUrrlV6(){
        $arrUrl = array(
            'http://anime102.net/proxy.php?url='
            //'http://giaiphapxanh.vn/lib/assetmanager/pr0xyz.php?url=',
            ///'http://www.asv-vn.com/jscripts/pr0xyz.php?url=',
            //'http://dev.cytus.xyz/pr0xyxz.php?url=',
            //'http://thitruongphanbon.com.vn/css/pr0xyz.php?url=',
            //'http://amthuc02.vn/cache/pr0xyz.php?url=',
            //'http://lethanhshop.com/cache/pr0xyz.php?url=',
            //'http://sub1.phim3s.net/v3/plugins_player.php?url=',
            //'http://sub2.phim3s.net/v3/plugins_player.php?url=',
            //'http://sub3.phim3s.net/v3/plugins_player.php?url=',
            //'http://sub4.phim3s.net/v3/plugins_player.php?url=',
            //'http://sub5.phim3s.net/v3/plugins_player.php?url=',
            //'http://xemphimso.com/grab/vplugin2/curl.php?url=',
            //'http://tranvu.info/curl.php?url='
        );
        $rand_keys = array_rand($arrUrl);
        return $arrUrl[$rand_keys];
    }
    
    private function Picasa($url, $random = false)
    {
        $html = $this->getData($url);
        if (substr_count($url,"#")>0)
        {
            $id = explode("#",$url);
            preg_match("/([0-9]+)/",$id[1],$arr);
            $da = explode('"gphoto$id":"'.$arr[1].'"',$html);
            $html = $da[1];
        }
        
        $data = explode('"media":',$html);
        $strKey = 1;
        if ($random == true && count($data) > 1){
            $strKey = rand(1, count($data) -1);
        }
        $data = explode(',"description"',$data[$strKey]);
        
        $json = json_decode($data[0]."}");
        $n = count($json->content);
        $arrData = array();
        for ($i = 0; $i < $n ; $i++){
            if ($json->content[$i]->type =="video/mpeg4") {
                $vlink = $json->content[$i]->url;
                //$vlink = str_replace("https://redirector.googlevideo.com/", "https://r1---sn-8qj-nbok.googlevideo.com/", $vlink);
                if($json->content[$i]->height <= 360 && $json->content[$i]->height > 180){
                    $arrData[] = array (
                        'file' => $vlink,
                        'label' => $this->getLabel($vlink)
                    );
                }
                if($json->content[$i]->height > 360  && $json->content[$i]->height < 720){
                    $arrData[] = array (
                        'file' => $vlink,
                        'label' => $this->getLabel($vlink)
                    );
                }
                if($json->content[$i]->height >= 720  && $json->content[$i]->height < 1080){
                    $arrData[] = array (
                        'file' => $vlink,
                        'label' => $this->getLabel($vlink)
                    );
                }
                if($json->content[$i]->height >= 1080){
                    $arrData[] = array (
                        'file' => $vlink,
                        'label' => $this->getLabel($vlink)
                    );
                
                }
            }
        }
    
       return $arrData;
    }
    
    private function PicasaNew($link){
        if(strpos($link, 'lh/photo/')){
            $text = $this->getData($link);
            $url = explode("if (!'",$text);
            $url = explode("'",$url[1]);
            $url = urldecode($url[0]);
            $data['file'] = $url;
            $streamlink = $data['file'];
        }else{
            $text = $this->getData($link);
            $CT = $text;
            $isL3 = strpos($link,"#");
            if(is_int($isL3) && $isL3>0){
                $idItemAlbum = explode("#",$link);
                $idItemAlbum = $idItemAlbum[1];
                $m1 = '"gphoto$id":"'.$idItemAlbum;
                $RS = explode($m1,$text);
                $CT = $RS[1];
            }
            $RS = explode('content":[{',$CT);
            $RS = explode('}],"title"',$RS[1]);
            $RS = 'content":[{'.$RS[0];
            $text = $RS;
            preg_match_all('#{"url":"(.*?)","height":(.*?),"width":(.*?),"type":"(.*?)"}#',$text,$match);
            foreach ($match[4] as $key => $value){
                $vlink = $match[1][$key];
                if($match[2][$key] <= 360 && $match[2][$key] > 180){
                    $arrData[] = array (
                        'file' => $vlink,
                        'label' => $this->getLabel($vlink)
                    );
                }
                if($match[2][$key] > 360  && $match[2][$key] < 720){
                    $arrData[] = array (
                        'file' => $vlink,
                        'label' => $this->getLabel($vlink)
                    );
                }
                if($match[2][$key] >= 720  && $match[2][$key] < 1080){
                    $arrData[] = array (
                        'file' => $vlink,
                        'label' => $this->getLabel($vlink)
                    );
                }
                if($match[2][$key] >= 1080){
                    $arrData[] = array (
                        'file' => $vlink,
                        'label' => $this->getLabel($vlink)
                    );
        
                }
            }
        }
        return $arrData;
    }
    private function checkExitLinkDocs($html){
        if (substr_count($html, "&fmt_stream_map=") > 0){
            $data = explode('&fmt_stream_map=',$html);
            $data = explode('&',$data[1]);
            $data[0] = urldecode($data[0]);
            return $data[0];
        } else if (substr_count($html, '"fmt_stream_map","') > 0){
            $data = explode('"fmt_stream_map","',$html);
            $data = explode('"',$data[1]);
            return $data[0];
        }
        if (substr_count($html , 'have+permission+to+access') > 0 || ( 
            substr_count($html , 'Moved Temporarily') > 0 && substr_count($html , 'accounts/ServiceLogin') > 0 )){
            return "NotAccess";
        }
        return "";
    }
    
    private function Docs($url){
        $arrData = array();
        $data = file_get_contents("http://www.vixumilk.com.vn/cache/get.php?url=$url");
        if(json_decode($data, true)) $arrData = json_decode($data, true);
        if (substr_count($url, "|") > 0){
            $arrUrl = explode("|" , $url);
        } else {
            $arrUrl = array($url);
        }
        
        foreach ($arrUrl as $url){
            $url = trim($url);
            $idx = explode("file/d/", $url);
            $idx = explode("/" , $idx[1]);
            $id = $idx[0];
            if ($id != ""){
                $url = "https://drive.google.com/get_video_info?docid=" . $id . "&authuser=";
                $url = "https://docs.google.com/get_video_info?docid=" . $id . "&authuser=";
                //use proxy: 
                $url = $this->getUrrlV6() . urlencode($url);
            }
            $html = $this->getData($url);
            $data = $this->checkExitLinkDocs($html);
            if ($data == ""){
                //$url = "https://drive.google.com/file/d/" . $id . "/view?pli=1";
                //$url = $this->getUrrlV6() . urlencode($url);
                //$html = $this->getData($url);
                //$data = $this->checkExitLinkDocs($html);
              
            }
            if ($data != ""){
                break;
            }
        }
        if ($data != "NotAccess" && $data != ""){
            $v = explode(",",$data);
            $n = count($v);
            $link ="";
            $arrDataFLV = array();
            $arrDataMp4 = array();
            $arrDataWebm = array();
            $arrData = array();
            for ($i=0;$i<$n;$i++){
                $itag = explode("|",$v[$i]);
                if (count($itag) > 0 ){
                    $link = $itag[1];
                    $link = str_replace(array('\\u003d', '\\u0026'), array('=', '&'), $link);
                    $link = str_replace("docs.google.com", "googlevideo.com", $link);
                    $arrDomain = parse_url($link);
                    $link = str_replace($arrDomain['host'], "redirector.googlevideo.com", $link);
                    parse_str($arrDomain['query'], $linkQuery);
                    $link = str_replace("ipbits=".$linkQuery['ipbits'], 'ipbits=32', $link);

                    if (in_array($itag[0],array(17, 34 , 35 ))){
                        $arrDataFLV[$this->getLabel($link)] = $link;
                    } else if (in_array($itag[0],array(18,  22 , 37 , 38 , 59 ))) {
                        $arrDataMP4[$this->getLabel($link)] = $link;
                    } else if (in_array($itag[0],array(43,  44 , 45 , 46 ))) {
                        $arrDataWebm[$this->getLabel($link)] = $link;
                    }
                }
            }
            foreach ($arrDataMP4 as $label => $link){
                $arrData[] = array (
                    'file' => str_replace("&app=explorer", '&app=anivndrive', $link),
                    'label' => $label
                );
            }
            foreach ($arrDataWebm as $label => $link){
                if (isset($arrDataMP4[$label]) == false){
                    $arrData[] = array (
                        'file' => str_replace("&app=explorer", '&app=anivndrive', $link),
                        'label' => $label
                    );
                }
            }
            if (count($arrData) == 0 && count($arrDataFLV) > 0){
                foreach ($arrDataFLV as $label => $link){
                    $arrData[] = array (
                        'file' => str_replace("&app=explorer", '&app=anivndrive', $link),
                        'type'  => 'google',
                        'label' => $label
                    );
                }
            }
        }
        //echo "2";
        if(!$arrData) file_put_contents('faild.txt', "$html\n------\n", FILE_APPEND);
        return $arrData;
    }
    
    private function Photos($url , $array = false){
        $arrData = array();
        $arrDataFLV = array();
        $arrDataMP4 = array();
        $url = str_replace(array('/u/0/' , '/u/1/' , '/u/2/', '/u/3/', '/u/4/', '/u/5/') , "/" , $url);
        $html = $this->getData($url);
        $data = explode(',"url\u003d',$html);
        $data = @explode('"',$data[1]);
        if (substr_count($data[0],',url\u003d')>0){
            $v = explode(',url\u003d',$data[0]);
            $n = count($v);
            $link ="";
            for ($i=0;$i<$n;$i++)
            {
                $default = false;
                $link = urldecode($v[$i]);
                $link = str_replace(array('\u003d', '\u0026'), array('=', '&'), $link);
                $quality = explode('quality=', $link);
                if (substr_count($link,"video/mp4") > 0 ){
                    $link = explode(";", $link);
                    $link = $link[0];
                    $link = str_replace("&itag", "?itag", $link);
                    $label = str_replace(array('hd720', 'large' , 'medium', 'small'), array('720', '480' , '360' , '240'), $quality[1]);
                    $arrDataMP4[$label] = $this->getLocation($link);
                } else if (substr_count($link,"video/x-flv") > 0 ){
                    $link = explode(";", $link);
                    $link = $link[0];
                    $link = str_replace("&itag", "?itag", $link);
                    $label = str_replace(array('hd720', 'large' , 'medium', 'small'), array('720', '480' , '360' , '240'), $quality[1]);
                    $arrDataFLV[$label] =  $this->getLocation($link);
                }
            }
            foreach ($arrDataMP4 as $label => $link){
                $arrData[] = array (
                    'file' => $link,
                    'label' => $label
                );
            }
            /* foreach ($arrDataMP4 as $label => $link){
                if (isset($arrDataFLV[$label]) == false){
                    $arrData[] = array (
                        'file' => $link,
                        'label' => $label
                    );
                }
            } */
         } else {
            $link = urldecode($data[0]);
            $link = str_replace(array('\\u003d', '\\u0026'), array('=', '&'), $link);
            //if (substr_count($link,"video/mp4") > 0 || (substr_count($link,"video/x-flv") > 0 )){
            if (substr_count($link,"video/mp4") > 0){
                $link = explode(";", $link);
                $link = $link[0];
                $link = str_replace("&itag", "?itag", $link);
                $quality = explode('quality=', $link);
                $arrData[] = array (
                    'file' => $link,
                    'label' => str_replace(array('hd720', 'large' , 'medium', 'small'), array('720', '480' , '360' , '240'), $quality[1])
                );
            }
        }
        $arrData = array_reverse($arrData);
        return $arrData;
    }
    
    private function Plus($link){
        if(strpos($link, '?')){
            $p = explode('?',$link);
            $p = $p[1];
            parse_str($p,$a);
            preg_match('#photos/(.*?)/albums/(.*?)/(.*?)$#', $link,$match);
            if (isset( $match[1]) == true){
                $link = 'https://plus.google.com/_/photos/lightbox/photo/' . $match[1]  .'/' . $match[3];
            } else if (isset($a['oid']) == true) {
                $link = 'https://plus.google.com/_/photos/lightbox/photo/' . $a['oid']  .'/' . $a['pid'] . "?local=1";
                if (isset($a['authkey'])) {
                    $link  .= "&authkey=" . $a['authkey'];
                }
            } else {
                $pz = explode('?',$link);
                $ex = explode("photos/photo/" , $pz[0]);
                $link = 'https://plus.google.com/_/photos/lightbox/photo/' . $ex[1] . "?local=1";
                if (isset($a['authkey'])) {
                    $link  .= "&authkey=" . $a['authkey'];
                }
            }
            $link .= '&soc-app=2&cid=0&soc-platform=1&ozv=es_oz_20140723.12_p1&avw=phst%3A31&f.sid=-6129781934038072053&_reqid=273570&rt=j';
        
        }else{
            preg_match('#photos/(.*?)/albums/(.*?)/(.*?)$#', $link ,$match);
            if (isset( $match[1]) == true){
                $link = 'https://plus.google.com/_/photos/lightbox/photo/' . $match[1]  .'/' . $match[3];
            } else {
                $ex = explode("photos/photo/" , $link);
                $link = 'https://plus.google.com/_/photos/lightbox/photo/' . $ex[1] . "?local=1";
                if (isset($a['authkey'])) {
                    $link  .= "&authkey=" . $a['authkey'];
                }
            }
            $link .= '?soc-app=2&cid=0&soc-platform=1&ozv=es_oz_20140723.12_p1&avw=phst%3A31&f.sid=-6129781934038072053&_reqid=273570&rt=j';
        }
        $text = $this->getData($link);
        if(strpos($text, 'The document has moved')){
            $link = explode('<A HREF="',$text);
            $link = explode('">here</A>',$link[1]);
            $link = $link[0];
            if(strpos($link, '?')){
                $link .= '&soc-app=2&cid=0&soc-platform=1&ozv=es_oz_20140715.10_p2&avw=phst%3A31&f.sid=--1275557768769984423&_reqid=790123&rt=j';
            }else{
                $link .= '?soc-app=2&cid=0&soc-platform=1&ozv=es_oz_20140715.10_p2&avw=phst%3A31&f.sid=--1275557768769984423&_reqid=790123&rt=j';
            }
            $text = $this->getData($link);
        }
        if(strpos($text,'redirector.googlevideo.com')){
            if(strpos($text,'https://redirector.googlevideo.com')){
                $ptc = 'https';
            }else{
                $ptc = 'http';
            }
            $arrDataFLV = array();
            $arrDataMp4 = array();
            preg_match_all('#\[([0-9]+),([0-9]+),([0-9]+),"' . $ptc . '://redirector.googlevideo.com/(.*?)"#',$text,$match);
            foreach ($match[4] as $k => $v){
                $json = '{"link":"' . $ptc . '://redirector.googlevideo.com/' . $v . '"}';
                $m = json_decode($json);
                $vlink = $m->link;
                if (in_array($match[1][$k],array(17, 34 , 35 )))
                {
                    $arrDataFLV[$this->getLabel($vlink)] = $vlink;
                } else if (in_array($match[1][$k],array(18,  22 , 37 , 38 , 59 ))) {
                    $arrDataMP4[$this->getLabel($vlink)] = $vlink;
                }
            }
        } else if(strpos($text,'lh3.googleusercontent.com')){
            $arrDataFLV = array();
            $arrDataMp4 = array();
            preg_match_all('#\[([0-9]+),([0-9]+),([0-9]+),"https://lh3.googleusercontent.com/(.*?)"#',$text,$match);
            foreach ($match[4] as $k => $v){
                $json = '{"link":"https://lh3.googleusercontent.com/' . $v . '"}';
                $m = json_decode($json);
                $vlink = $m->link;
                if (in_array($match[1][$k],array(17, 34 , 35 )))
                {
                    $arrDataFLV[$this->getLabel($vlink)] = $vlink;
                } else if (in_array($match[1][$k],array(18,  22 , 37 , 38 , 59))) {
                    $arrDataMP4[$this->getLabel($vlink)] = $vlink;
                }
            }
        }
        foreach ($arrDataMP4 as $label => $link){
            $arrData[] = array (
                'file' => $link,
                'label' => $label
            );
        }
        /* foreach ($arrDataMP4 as $label => $link){
            if (isset($arrDataFLV[$label]) == false){
                $arrData[] = array (
                    'file' => $link,
                    'label' => $label
                );
            }
        } */
        return $arrData;
    }
    
    private function Phim14($url, $random = false)
    {
        $arrData = array();
        $html = $this->getData($url);
        if (substr_count($html, 'phim14*')){
            $data = explode('phim14*', $html);
            $data = explode('&', $data[1]);
            $uri = $data[0];
            $gkdecode = new GKDecode();
            $uri = $gkdecode->decrypt($uri, 'zyUDEentRuAffYeGnkyv');
            $stream_php = "http://player3.phim14.net/2047";
            if (substr_count($html, '<param name="movie" value="') > 0){
                $exStream = explode('<param name="movie" value="', $html);
                $exStream = explode('/player.swf', $exStream[1]);
                $stream_php = $exStream[0];
            }
            $html = $this->getData($stream_php . "/plugins/plugins_player.php", array(
                'ihttpheader' => true,
                'isslverify' => true,
                'iheader' => true,
                'url' => trim($uri),
                'iagent' => 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0'
            ), 'POST');
            
            $data = explode('content":',$html);
            
            $data = explode(',"description"',$data[1]);
            $json = json_decode($data[0]);
            $n = count($json);
            
            for ($i = 0; $i < $n ; $i++){
                if ($json[$i]->type =="video/mpeg4") {
                    $vlink = $json[$i]->url;
                    if($json[$i]->height <= 360 && $json[$i]->height > 180){
                        $arrData[] = array (
                            'file' => $vlink,
                            'label' => $this->getLabel($vlink)
                        );
                    }
            
                    if($json[$i]->height > 360  && $json[$i]->height < 720){
                        $arrData[] = array (
                            'file' => $vlink,
                            'label' => $this->getLabel($vlink)
                        );
                    }
            
                    if($json[$i]->height >= 720  && $json[$i]->height < 1080){
                        $arrData[] = array (
                            'file' => $vlink,
                            'label' => $this->getLabel($vlink)
                        );
                    }
                    if($json[$i]->height >= 1080){
                        $arrData[] = array (
                            'file' => $vlink,
                            'label' => $this->getLabel($vlink)
                        );
            
                    }
                }
            }
        }
        
    
        return $arrData;
    }
    
    private function Facebook($url){
        $arrData = array();
        $exp = explode(".com/",$url);
        $exp = explode("/",$exp[1]);
        if (intval($exp[0]) > 0){
            $html = $this->getData("https://www.facebook.com/$exp[0]/$exp[1]/$exp[2]");
            if (substr_count($html , "sd_src:\"") > 0){
                $exLink = explode("sd_src:\"" , $html);
                $exLink = explode('"' , $exLink[1]);
                $exLink = str_replace('video','instagram',$exLink);
                if ($exLink[0] != ""){
                    $json = '{"link":"' . $exLink[0] . '"}';
                    $m = json_decode($json);
                    $arrData[] = array (
                            'file' => $m->link,
                            'label' => 360
                        );
                }
            }
            if (substr_count($html , "hd_src:\"") > 0){
                $exLink = explode("hd_src:\"" , $html);
                $exLink = explode('"' , $exLink[1]);
                if ($exLink[0] != ""){
                    $json = '{"link":"' . $exLink[0] . '"}';
                    $m = json_decode($json);
                    $arrData[] = array (
                        'file' => $m->link,
                        'label' => 720
                    );
                }
            }
            if (substr_count($html , "subtitles_src:\"") > 0){
                $exLink = explode("subtitles_src:\"" , $html);
                $exLink = explode('"' , $exLink[1]);
                if ($exLink[0] != ""){
                    $json = '{"link":"' . $exLink[0] . '"}';
                    $m = json_decode($json);
                    $arrData[] = array (
                        'file' => $m->link,
                        'type' => 'subtitle',
                        'label' => 0
                    );
                }
            }
            
        }
        return $arrData;
    }
    
    public function detectGet($url){
        $arrayLink = array();
        $orgLink = $url;
        if (substr_count($url, "|") > 0){
            $arrUrl = explode("|" , $url);
        } else {
            $arrUrl = array($url);
        }
        
        foreach ($arrUrl as $url){
            if (substr_count($url,"picasaweb.google.com")>0) {
                $arrayLink = $this->Picasa($url);
            } elseif (substr_count($url,"docs.google.com")>0 || substr_count($url,"drive.google.com")>0){
                $arrayLink = $this->Docs($url);
            } elseif (substr_count($url,"photos.google.com")>0) {
                $arrayLink = $this->Photos($url);
            } elseif (substr_count($url,"plus.google.com")>0) {
                $arrayLink = $this->Plus($url);
            } elseif (substr_count($url,"phim14.net")>0) {
                $arrayLink = $this->Phim14($url);
            } elseif (substr_count($url,"facebook.com")>0) {
                $arrayLink = $this->Facebook($url);
            }
            if (count($arrayLink) > 0){
                break;
            }
        }
        if (count($arrayLink) == 0){
            if ((substr_count($orgLink,"youtube.com") > 0 || substr_count($orgLink,"youtu.be") > 0 )){
                $arrayLink[] = array(
                    'file' => $orgLink,
                    'label' => 'auto'
                );
            } else if (substr_count($url,"googledrive.com") > 0){
                $arrayLink[] = array(
                    'file' => $orgLink,
                    'type' => 'mp4',
                    'label' => '720'
                );
            } else if (substr_count($orgLink,"bp.blogspot.com") > 0 || substr_count($orgLink,"googleusercontent.com") > 0){
                foreach ($arrUrl as $url){
                    $url = str_replace("3.bp.blogspot.com" , "lh3.googleusercontent.com" , $url);
                    $arrayLink[] = array(
                        'file' => $this->getLocation($url , true),
                        'type' => 'mp4',
                        'label' => $this->getLabel($url)
                    );
                }
            }
        }
        
        usort($arrayLink, function($a, $b)
        {
            if ($a['label'] == $b['label'])
                return 0;
            if (intval($a['label']) > intval($b['label']))
                return 1;
            return -1;
        });
        
        
        return $arrayLink;
    }
    
}