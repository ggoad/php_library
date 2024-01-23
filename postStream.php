<?php 
function postStream($url, $postVarObject){
  $postVarObject=obTOhttp1level($postVarObject);
   $options=[
     'http'=>[
       'method'=>"POST",
       'header'=>"Content-Type: application/x-www-form-urlencoded\r\n".
				"Content-Length: ".strlen($postVarObject)."\r\n".
				"User-Agent:WAApStream/1.1\r\n",
       'content'=>$postVarObject
     ]
   ];
   $context=stream_context_create($options);
    return file_get_contents($url, false, $context);
}
function obTOhttp1level($ob){
   $ret="";
   foreach($ob as $k=>$v)
   {
      if($ret){$ret.="&";}
      $ret.=$k."=";
      switch(getType($v)){
         case "boolean":
         case "integer":
         case "double":
         case "string":
            $ret.=urlencode($v);
            break;
         case "array":
         case "object":
            $ret.=urlencode(json_encode($v));
            break;
         default:
            $cat[$k]="";
            break;
      }
   }
   return $ret;
}
?>
