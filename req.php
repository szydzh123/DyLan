<?php
	$method1=$_POST['method1'];
	if ($method1=='getBank'){
		$mypostq = curl_init();
		$header['User-Agent']="Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36";
		$header['Content-Type']="application/json; charset=UTF-8";
		curl_setopt($mypostq, CURLOPT_URL, 'https://ccclub.cmbchina.com/mca/MQuery.aspx?WT.mc_id=Z1O00WXA055B412100CC&WT.refp=/card/queryweixin/undefined$');
		curl_setopt($mypostq, CURLOPT_HEADER, 1);
		curl_setopt($mypostq, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($mypostq, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
		curl_setopt($mypostq, CURLOPT_HTTPHEADER,$header);
		curl_setopt($mypostq, CURLOPT_SSLVERSION,1); 
		curl_setopt($mypostq, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($mypostq, CURLOPT_SSL_VERIFYHOST, FALSE);
		$data = curl_exec($mypostq);
		/*炸开Set-Cookie*/
		$arr=explode("Set-Cookie:", $data);
		array_shift($arr);
		$i=0;
		foreach ($arr as $key => $value) {
		  $tmp=explode(";", $value);
		  $cookieone[$i]=trim($tmp[0]);
		  $i++;
		}
		$cookie=join($cookieone,";");
		$cookie=$cookie.";";
		echo $cookie;
		curl_close($mypostq);
	}else if($method1=='getSmscode'){
		$idType=$_POST['idType'];
		$idNum=$_POST['idNum'];
		$telNo=$_POST['telNo'];
		$cookie=$_POST['cookie'];
		$mypost = curl_init();
		$url="https://ccclub.cmbchina.com/mca/Service/CWAService.asmx/PQS_SendSMSCode";
		$list=array(
			"IDType"=>$idType,
			"IDNum"=>$idNum,
			"TelNo"=>$telNo
		);
		$list=json_encode($list);
		curl_setopt($mypost, CURLOPT_URL, $url);
		curl_setopt($mypost, CURLOPT_HEADER, 1);
		curl_setopt($mypost, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($mypost, CURLOPT_POST, 1);
		curl_setopt($mypost, CURLOPT_POSTFIELDS,$list);
		curl_setopt($mypost, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
		curl_setopt($mypost, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
		curl_setopt($mypost, CURLOPT_COOKIE, $cookie);
		curl_setopt($mypost, CURLOPT_SSLVERSION,1); 
		curl_setopt($mypost, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($mypost, CURLOPT_SSL_VERIFYHOST, FALSE);
		$dataz = curl_exec($mypost);
		echo $cookie;
		curl_close($mypost);
	}else if($method1=='addSmscode'){
		$cardtype=$_POST['cardtype'];
		$cardid=$_POST['cardid'];
		$smscode=$_POST['smscode'];
		$cookie=$_POST['cookie'];
		$mypost = curl_init();
		$url="https://ccclub.cmbchina.com/mca/Service/CWAService.asmx/PQS_QuerySchedule";
		$list=array(
			"cardtype"=>$cardtype,
			"cardid"=>$cardid,
			"smscode"=>$smscode
		);
		$list=json_encode($list);
		curl_setopt($mypost, CURLOPT_URL, $url);
		curl_setopt($mypost, CURLOPT_HEADER, 1);
		curl_setopt($mypost, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($mypost, CURLOPT_POST, 1);
		curl_setopt($mypost, CURLOPT_POSTFIELDS,$list);
		curl_setopt($mypost, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
		curl_setopt($mypost, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
		curl_setopt($mypost, CURLOPT_COOKIE, $cookie);
		curl_setopt($mypost, CURLOPT_SSLVERSION,1); 
		curl_setopt($mypost, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($mypost, CURLOPT_SSL_VERIFYHOST, FALSE);
		$dataz = curl_exec($mypost);
		echo $dataz;
		curl_close($mypost);
	}else if($method1=='getResult'){
		$a = range(0,9); 
		for($i=0;$i<17;$i++){ 
			$b[] = array_rand($a); 
		} 
		$arr=join("",$b);
		$arr="0.".$arr;
		$cookie=$_POST['cookie'];
		$mypostq = curl_init();
		$header['User-Agent']="Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36";
		$header['Content-Type']="application/json; charset=UTF-8";
		curl_setopt($mypostq, CURLOPT_URL, 'https://ccclub.cmbchina.com/mca/MQueryRlt.aspx?serino=' + $arr);
		curl_setopt($mypostq, CURLOPT_HEADER, 1);
		curl_setopt($mypostq, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($mypostq, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
		curl_setopt($mypostq, CURLOPT_HTTPHEADER,$header);
		curl_setopt($mypostq, CURLOPT_COOKIE, $cookie);
		curl_setopt($mypostq, CURLOPT_SSLVERSION,1); 
		curl_setopt($mypostq, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($mypostq, CURLOPT_SSL_VERIFYHOST, FALSE);
		$data = curl_exec($mypostq);
		$myfile = fopen("curl.txt", "w") or die("Unable to open file!");   
		fwrite($myfile, "=================================================================\n");  //写入文件 
		fwrite($myfile, $data);  //写入文件
		//fwrite($myfile, $url);  //写入文件
		echo $myfile;
		fclose($myfile);       //关闭文件
		curl_close($mypostq);
	}








// $a = range(0,9); 
// for($i=0;$i<17;$i++){ 
// 	$b[] = array_rand($a); 
// } 
// var_dump(join("",$b));
/*书写文件*/
// $myfile = fopen("curl.txt", "w") or die("Unable to open file!");   
// fwrite($myfile, $data);  //写入文件
// fwrite($myfile, "=================================================================\n");  //写入文件 
// fwrite($myfile, $dataz);  //写入文件
// //fwrite($myfile, $url);  //写入文件
// fclose($myfile);       //关闭文件

// //接下来发送无相关参数的响应给正在使用APP查询进度的代理
// //wait
// //接收代理的下一条请求,收到手机二维码的识别结果,假设是'1392'
// $myputreq['method1'] = 'put';
// $myputreq['token'] = $token;
// $myputreq['code'] = '1392';
// $myput = curl_init();
// $myputreq['method1'] = 'get';
// curl_setopt($myput, CURLOPT_URL, 'http://192.168.0.105:8080/ask.php');
// curl_setopt($myput, CURLOPT_HEADER, 1);
// curl_setopt($myput, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($myput, CURLOPT_POST, 1);
// curl_setopt($myput, CURLOPT_POSTFIELDS, $myputreq);
// curl_setopt($myput, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;    
// curl_setopt($myput, CURLOPT_SSLVERSION,3); 
// curl_setopt($myput, CURLOPT_SSL_VERIFYPEER, FALSE); 
// curl_setopt($myput, CURLOPT_SSL_VERIFYHOST, 2);
// $data = curl_exec($myput);
// curl_close($myput);
// if ($data===FALSE) die();
// if ($data['status']!=1) die();
// var_dump($data[data]);
?>