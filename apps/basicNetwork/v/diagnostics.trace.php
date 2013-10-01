<div class='pageTitle'>Diagnostics: Trace</div>

<!-- TODO: 

-->
<div class='controlBox'>
    <span class='controlBoxTitle'>Traceroute</span>
    <div class='controlBoxContent'>
      <table class='controlTable'>
        <tbody>
          <tr>
              <td>Address</td>
              <td><input id='trace_address' name='trace_address'></td>           
              <td><input type='button' id='trace' value='Trace' onClick='tracer()'></td>
          </tr>
          <tr>
              <td>Max Hops</td>
              <td><input id='max_hops' name='max_hops' class='shortinput' /></td>
          </tr>
          <tr>
              <td>Max Wait Time</td>
              <td><input id='max_wait' name='max_wait' class='shortinput' /><span class='smallText'> (bytes)</span></td>
          </tr>
        </tbody>
    </table>

    </div> <!--end control box content -->
</div> <!--end control box  -->


<div class='controlBox'><span class='controlBoxTitle'>Results</span>
  <div class='controlBoxContent'>
    <table id='list' class='listTable noshow'>
      <thead>
      </thead>
      <tbody>
        <?php 
          //execute a quick traceroute - save result as output
          exec('traceroute -n letsrun.com', $output); 

          //get length of output array
          $outputLength = count($output);

          //for each element in array
          for ($i = 1; $i < $outputLength; $i++){
            //start a new row
            echo "<tr>";
            
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
              echo "<td>$match[1]</td><td>$match[2]</td><td>$match[3]</td><td>($match[2])</td><td>$match[4]</td><td>($match[2])</td><td>$match[5]</td>";
            }
            elseif(preg_match($ipttipt,$string)){
              preg_match($ipttipt,$string, $match1);
              echo "<td>$match1[1]</td><td>$match1[2]</td><td>$match1[3]</td><td>($match1[2])</td><td>$match1[4]</td><td>$match1[5]</td><td>$match1[6]</td>";
            }
            elseif(preg_match($iptiptt,$string)){
              preg_match($iptiptt,$string, $match2);
              echo "<td>$match2[1]</td><td>$match2[2]</td><td>$match2[3]</td><td>$match2[4]</td><td>$match2[5]</td><td>($match2[4])</td><td>$match2[6]</td>";

            }
            elseif(preg_match($iptiptipt,$string)){
              preg_match($iptiptipt,$string, $match3);
              echo "<td>$match3[1]</td><td>$match3[2]</td><td>$match3[3]</td><td>$match3[4]</td><td>$match3[5]</td><td>$match3[6]</td><td>$match3[7]</td>";
            }
            else{
              preg_match($other,$string, $match4);
              echo "<td>$match4[1]</td><td>*</td><td>*</td><td>*</td><td>*</td><td>*</td>";
            }

            //close table row
            echo "</tr>";

          }

          // $outputLength = count($output);

          // //for each element in array
          // for ($i = 1; $i < $outputLength; $i++){
          //   echo "$output[$i]<br>";
          // }
        ?>
    </tbody></table>
  </div>
</div>





<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript' src='php/bin.etc.php?q=trace'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>

<script type='text/ecmascript'>

function tracer(){
  $('#list').removeClass('noshow');


$('#list').dataTable({
  'bAutoWidth': false,
  'bPaginate': false,
  'bInfo': false,
  'bFilter': false,
  'bSort': false,
  'aoColumns': [
   { 'sTitle': 'Hop'},
   { 'sTitle': 'Address' },
   { 'sTitle': 'Time (ms)' },
   { 'sTitle': 'Address' },
   { 'sTitle': 'Time (ms)' },
   { 'sTitle': 'Address' },
   { 'sTitle': 'Time (ms)' }
   ]
 });

};

 $('#trace_address').ipspinner().ipspinner('value',trace.address);
$('#max_hops').spinner({ min: 0, max: 3600 }).spinner('value',trace.hops);
$('#max_wait').spinner({ min: 0, max: 3600 }).spinner('value',trace.wait);


</script>
