<?php

 header('Content-type: text/ecmascript');

/*
  Allow and deny lists are stored as flat files of MACs, one per line.
  The files are specified in HostAPD's configuration file, and the policy (allow or deny) is also set in that file.
*/

$exampleDenyFileContents = <<<DENYFILECONTENTS
08:00:07:26:C0:A5
08:00:07:26:C0:A6
08:00:07:26:C0:A7
DENYFILECONTENTS;

echo $exampleDenyFileContents;

?>
