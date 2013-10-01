<div class='pageTitle'>Diagnostics: Ping</div>

<!-- TODO:
 -->

<div class='controlBox'>
    <span class='controlBoxTitle'>Test</span>
    <div class='controlBoxContent'>
      <table class='controlTable'>
        <tbody>
          <tr>
              <td>Address</td>
              <td><input id='ping_address' name='ping_address'></td>           
              <td><input type='button' id='ping' value='Ping' onClick='pingy()'></td>
          </tr>
          <tr>
              <td>Ping Count</td>
              <td><input id='ping_count' name='ping_count' class='shortinput' /></td>
          </tr>
          <tr>
              <td>Packet Size</td>
              <td><input id='ping_size' name='ping_size' class='shortinput' /><span class='smallText'> (bytes)</span></td>
          </tr>
        </tbody>
      </table>

    </div> <!--end control box content -->
</div> <!--end control box  -->


<div class='controlBox'><span class='controlBoxTitle'>Results</span>
  <div class='controlBoxContent'>
    <?php 
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
    echo "<div id='stats' class='noshow'>";
    for ($y= $place; $y < $outputLength; $y++){
      echo "<p>$output[$y]</p>";
    }
    echo "</div>";

    echo "<table id='list' class='listTable noshow'><thead></thead><tbody>";
    
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

    }else

    echo "Ping unsuccessful!";
    ?>     
    </tbody></table>
  </div>
</div>


<script type='text/ecmascript' src='php/bin.etc.php?q=ping'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

function pingy() {
  $('#list').removeClass('noshow');
  $('#stats').removeClass('noshow');

  $('#list').dataTable({
  'bAutoWidth': false,
  'bPaginate': false,
  'bInfo': false,
  'bFilter': false,
  'bSort': false,
  'aoColumns': [
   { 'sTitle': 'ICMP Req' },
   { 'sTitle': 'TTL' },
   { 'sTitle': 'Time (ms)' }
    ]
  });
} ;



$('#ping_address').ipspinner().ipspinner('value',ping.address);
$('#ping_size').spinner({ min: 0, max: 3600 }).spinner('value',ping.size);
$('#ping_count').spinner({ min: 0, max: 3600 }).spinner('value',ping.count);



</script>

