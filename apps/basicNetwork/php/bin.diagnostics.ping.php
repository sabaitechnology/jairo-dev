<?php 
 header('Content-type: text/ecmascript');
    $host="192.168.22.11";

    exec("ping -c 3 " . $host, $output, $result);
    $outputLength = count($output);

    //generate statistics div
    //find start of statistics data
    for ($i = 0; $i < $outputLength; $i++){
      $string = $output[$i];
      //check each array element for string: "---"
      if (strpos($string,'---') !==false){
        //find position of the element containing ---
        $place = $i;
      }else{}
    }
    //print out each string from that element until the end
    echo "<div id='stats'>";
    for ($y= $place; $y < $outputLength; $y++){
      echo "<p>$output[$y]</p>";
    }
    echo "</div>";

    echo "<table id='list' class='listTable'><thead></thead><tbody>";
    
    if ($result == 0)

    {



    //find out how many elements are in the output
    $outputLength = count($output);
    //loop through output - this 4 needs to be a variable based on user input
    for ($i = 1; $i < 4; $i++){
      //start a new row
      echo "<tr>";
      
      //store current line as string
      $string = $output[$i];
      //make an array by split each string by spaces
      $arr = preg_split('/[\s]+/', $string);

      //find out how many elements are in this array
      $county = count($arr);
      //for each element
      for ($x = 0; $x < $county; $x++){
        
        if (strpos($arr[$x],'=')){
          //split by = to make another array
          $val = explode("=", $arr[$x]);
          //print the 2nd element of this array
          echo "<td>$val[1]</td>";
        }else{

        }
      }

    //close table row
    echo "</tr>";

    }
    echo "</tbody></table>";
    

    }else

    echo "Ping unsuccessful!";
    ?>  