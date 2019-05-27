<?php
file_list("D:\\git笔记\\note","D:\\git笔记\\html");
echo "success";
//遍历目录
function file_list($basePath,$toBasePath){
	//读取文件夹
	$temp=scandir($basePath);
	//遍历文件夹
	foreach($temp as $v){
		$filename=$basePath.'\\'.$v;
		$toPath = $toBasePath.'\\'.$v;
		
		if(is_dir($filename)){
		   if($v=='.' || $v=='..' || $v=='.git'){
			   continue;
		   }
		   file_list($filename,$toPath);
		}else{
			$fname = explode('.',$v);
			$r = toHtml($basePath,$fname[0],$toBasePath);
		}
	}	
}

/**
	$fpath 源文件路径
	$fname 源文件名称
	$topath 目标文件路径
**/
function toHtml($fpath='',$fname='',$topath=''){
	$tofile = $topath.'\\'.$fname.'.html';
	if(!file_exists($topath)){
		mkdir($topath, 0777,true);
	}
	$content = file_get_contents($fpath.'\\'.$fname.'.txt');
	$str = txt2html($fname,$content);
	$m = file_put_contents($tofile,$str);
	return $m;
}


//内容替换
function txt2html($title='',$content=''){
	$cont  = str_replace(PHP_EOL, PHP_EOL.'<br>', $content);
$str = '<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>'.$title.'</title>
	</head>
	<body>
	<div>'.$cont.'</div>
	</body>
</html>';
	return $str;
}