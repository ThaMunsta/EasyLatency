<head>
<META HTTP-EQUIV="refresh" CONTENT="180">
</head>
<?php
echo '<style type="text/css">table {border-style: solid; border-collapse: collapse;} table td { border-width: 3px; border-style: solid; border-color: black;} table th { border-width: 3px; border-style: solid; border-color: black;} </style>';
echo '<html><table border="1"';

#################################
$file = fopen("hosts.txt", "r");
while (!feof($file)) {
    $hosts[] = fgets($file);
}
fclose($file);
foreach ($hosts as $v) {
    $val  = explode("|", $v);
    //DEFINE
    $URL    = $val[0];
    $port   = $val[1];
	if ($port == ""){
	$port =80;
	}
    $pre = $val[2];
	$post = $val[3];
	if ($val[0][0] !== "#") {
		print '<iframe src="http://hq.nervesocket.com/ports/frameless.php?addr='.$URL.'&port='.$port.'&pretext='.$pre.'&posttext='.$post.'" frameborder=0 width=350 height=70 /> </iframe>';
    }
}
#######################################
?>
<br>
<form name=time>
<input type=text name=tfield size=25 style="border: 3px blue; background-color: skyblue; color: white; font-size: 15px; font-weight: bold;">
</form>
<script type="text/javascript">
pageOpen = new Date();
function leavingPage()
{

pageClose =new Date();
hours=pageClose.getHours()-pageOpen.getHours();
minutes=pageClose.getMinutes()-pageOpen.getMinutes();
seconds=pageClose.getSeconds()-pageOpen.getSeconds();
time = (seconds + (minutes * 60) + (hours * 60 * 60));
if(time<60){
document.time.tfield.value="Updated " + time + " sec ago";
}
else
{
min=(parseInt(time/60));
sec=(time%60);
document.time.tfield.value="Updated " + min + " min " + sec + " sec ago";
}
}
function timer()
{
leavingPage();
setTimeout('timer()',1000)
}
document.onload=timer();
</script>
</td></tr>
</table>
<?php
echo "Server time: " . date("h:i:sa");
?>