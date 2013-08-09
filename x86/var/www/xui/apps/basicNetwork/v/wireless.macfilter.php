<div class='pageTitle'>Wireless: Mac Filter</div>
<!-- TODO:
-->

<div class='controlBox'><span class='controlBoxTitle'>WL0</span><div class='controlBoxContent'><table class='controlTable'><tbody>
 <tr><td>Policy</td><td>
  <select id='wl0_macfilter_policy' name='wl0_macfilter_policy' class='radioSwitchElement'>
   <option value='off'>Off</option>
   <option value='allow'>Allow</option>
   <option value='deny'>Deny</option>
  </select>
 </td></tr>
</tbody></table></div></div>

<div class='controlBox'><span class='controlBoxTitle'>Demo</span><div class='controlBoxContent'>
 <pre id='demov'></pre>
 <pre id='demo'></pre>
</div></div>

<script type='text/ecmascript' src='php/bin.etc.php?q=wl&n=0'></script>
<script type='text/ecmascript'>

$('#wl0_macfilter_policy').radioswitch({
 value: wl[0].macfilter.policy
//, change: function(event,ui){ $('.wl0_type').hide(); $('.wl0_type-'+ ui.value ).show(); }
});


//$(function(){});

</script>
