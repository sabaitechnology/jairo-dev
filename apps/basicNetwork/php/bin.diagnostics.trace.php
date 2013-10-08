<?php 
// TODO: validate numbers and IP address

  header('Content-type: text/ecmascript');

  $traceAddress=$_REQUEST['traceAddress'];
  $maxHops=$_REQUEST['maxHops'];
  $maxWait=$_REQUEST['maxWait'];

  // //execute a quick traceroute - save result as output
  exec("traceroute -n $traceAddress -m $maxWait", $output); 

  //get length of output array
  $outputLength = count($output);
  if ($outputLength > $maxHops){
    $outputLength = $maxHops +1;
  }else{}

  $datalines = array();
  $dataResult = array();

  //for each element in array
  for ($i = 1; $i < $outputLength; $i++){

    
    //store current element(row) as string (ignore space at beggining/end)
    $string = trim($output[$i]);

    //regex;s for each case
    $ipttt ='/(\d+)\s+([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\s+(\d+.[0-9]{1,3})\s+ms\s+(\d+.[0-9]{1,3})\s+ms\s+(\d+.[0-9]{1,3})\s+ms/';
    $ipttipt ='/(\d+)\s+([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\s+(\d+.[0-9]{1,3})\s+ms\s+(\d+.[0-9]{1,3})\s+ms\s+([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\s+(\d+.[0-9]{1,3})\s+ms/';
    $iptiptt ='/(\d+)\s+([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\s+(\d+.[0-9]{1,3})\s+ms\s+([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\s+(\d+.[0-9]{1,3})\s+ms\s+(\d+.[0-9]{1,3})\s+ms/';
    $iptiptipt ='/(\d+)\s+([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\s+(\d+.[0-9]{1,3})\s+ms\s+([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\s+(\d+.[0-9]{1,3})\s+ms\s+([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\s+(\d+.[0-9]{1,3})\s+ms/';
    $other ='/(\d+)\s+/';

    if(preg_match($ipttt,$string)){
      preg_match($ipttt,$string, $match);
      $line = [$match[1],$match[2],$match[3],($match[2]), $match[4],($match[2]),$match[5] ];
      array_push($datalines, $line);     
    }    
    elseif(preg_match($ipttipt,$string)){
      preg_match($ipttipt,$string, $match1);
      $line = [$match1[1],$match1[2],$match1[3],($match1[2]),$match1[4],$match1[5],$match1[6]];
      array_push($datalines, $line);    
    }
    elseif(preg_match($iptiptt,$string)){
      preg_match($iptiptt,$string, $match2);
      $line = [$match2[1],$match2[2],$match2[3],$match2[4],$match2[5],($match2[4]),$match2[6]];
      array_push($datalines, $line);
    }
    elseif(preg_match($iptiptipt,$string)){
      preg_match($iptiptipt,$string, $match3);
      $line = [$match3[1],$match3[2],$match3[3],$match3[4],$match3[5],$match3[6],$match3[7]];
      array_push($datalines, $line);    
    }
    else{
      preg_match($other,$string, $match4);
      $line = [$match4[1],'*', '*','*','*','*','*'];
      array_push($datalines, $line);          
    }

  }

  foreach($datalines as &$dl){
  $dataResult[] = array(
    'Hop' => $dl[0],
    'Address' => $dl[1],
    'Time (ms)' => $dl[2],
    'Address2' => $dl[3],
    'Time2 (ms)' => $dl[4],
    'Address3' => $dl[5],
    'Time3 (ms)' => $dl[6]
    );
  }

  $out = array(
    'traceResults' => $dataResult
  );
  
echo json_encode($out,JSON_PRETTY_PRINT);


?>


