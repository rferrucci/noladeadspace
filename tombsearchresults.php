<h2>2001/2002 Tomb & Marker Survey</h2>

<p>The project database can be searched by tomb number or name. Research continues to add the names of all "residents" interred for more 
extensive search capabilities. To see full definitions, download the <a alt="download the survey manual" href='pdfs/SURVEY MANUAL.pdf'>
survey manual.</a><p>
<?php
/*There are two ways to search for tombs on noladeadspace.com. First, you can choose a tomb from an interactive map. Second, A table is
output that has the map tomb number, family name of the tomb, arch diocese number, and grid location on the map. Family name is hypertext
leading to a search results page that outputs a complex table containing all data collected on the project. While the table containing
all tombs was constructed using the Views module, the more detailed table for each tomb is a bit complex and required custom php code.
this is the php code.*/

$username='********' ;
$password='********';
$id = $_GET['cemetery'];
$pnthnoc = $_GET['PNTHNOC'];
try {
  $conn = new PDO('mysql:host=mysql.noladeadspace.com;dbname=noladeadspacebkup', $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $data = $conn->prepare('SELECT * FROM cemeteries WHERE cemid = :id');
  $data->execute(array('id' => $id));

  $result = $data->fetchAll();
  $cemetery =$result[0]['cemetery'];
  $tombtab =$result[0]['full'];
  $nottab =$result[0]['notable'];

	$sql = $conn->prepare('SELECT COUNT(*) FROM ' . $tombtab. ' WHERE pnthnoc = :pnthnoc');
	$sql->execute(array('pnthnoc' => $pnthnoc));
	$count = $sql->fetchColumn();

  $tomb = $conn->prepare('SELECT * FROM ' . $tombtab. ' WHERE pnthnoc = :pnthnoc');
  $tomb->execute(array('pnthnoc' => $pnthnoc));
  $tombdata = $tomb->fetchAll();

  $notable = $conn->prepare('SELECT * FROM ' . $nottab. ' WHERE pnthnoc = :pnthnoc');
  $notable->execute(array('pnthnoc' => $pnthnoc));
  $notdata = $notable->fetchAll();

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
if ($count != 0){
	$img = "images/". $tombdata[0]['img'];
	$map = "maps/". $tombdata[0]['map'];
	$table = "<h3>Results for $cemetery</h3>";
	$table .= "<div class=\"table\"><p class=\"row\"><a href=$img><img class=\"cell\" align=\"left\" style=\"margin: 10px; border:solid black 2px\" height=\"250\" src=$img /></a><a href=$map><img width=\"250\" style=\"margin: 10px; border: solid black 2px;\" align=\"left\" class=\"cell\" src=$map /></a></p></div>";
	$table .= "<table><caption>Tomb Details - PNTHNOC # $pnthnoc</caption>";
	$table .= "<tr><th>Number</th><th>GIN</th><th colspan=\"4\">Name</th><th>First Date</th><th>Last Date</th></tr>\n";
	$table .= "<tr><td>".$tombdata[0]['pnthnoc']."</td><td>".$tombdata[0]['gin']."</td><td colspan=\"4\">".$tombdata[0]['idname']."</td><td>".$tombdata[0]['firstdate']."</td><td>".$tombdata[0]['lastdate']."</td></tr>";
	$table .= "<tr><th colspan=\"2\">Archdiocese #</th><th colspan=\"2\">Street</th><th colspan=\"2\">Tomb Type</th><th>Context</th><th >Orientation</th></tr>";
	$table .= "<tr><td colspan=\"2\">".$tombdata[0]['archdioc']."</td><td colspan=\"2\">".$tombdata[0]['street']."</td><td colspan=\"2\">".$tombdata[0]['tombtype']."</td><td>".$tombdata[0]['context']."</td><td>".$tombdata[0]['orient']."</td></tr>";
	$table .= "<tr><th scope=\"row\" colspan=\"2\">Current Status</th><td colspan=\"6\">".$tombdata[0]['currentstatus']."</td></tr>";
	/*$table .= "<tr><th scope=\"row\" colspan=\"2\">Military</th><td colspan=\"6\">".$notdata[0]['militarymkr']."</td></tr>";*/
	$table .= "<tr><th scope=\"row\" colspan=\"2\">Biographical</th><td colspan=\"6\">".$tombdata[0]['biographical']."</td></tr>";
	$table .= "<tr><th scope=\"row\" colspan=\"2\">Additional Information</th><td colspan=\"6\">".$tombdata[0]['comments']."</td></tr>";
	$table .= "<tr><th colspan=\"2\">Alignment</th><th colspan=\"2\">Path Proximity</th><th colspan=\"2\">Path Material</th><th colspan=\"2\">Drain Proximity</th></tr>";
	$table .= "<tr><td colspan=\"2\">".$tombdata[0]['alignment']."</td><td colspan=\"2\">".$tombdata[0]['pathproximity']."</td><td colspan=\"2\">".$tombdata[0]['pathmaterial']."</td><td colspan=\"2\">".$tombdata[0]['drainproximity']."</td></tr>";
	$table .= "<tr><th colspan=\"2\">Representation</th><th colspan=\"2\">Interments</th><th colspan=\"2\">Perpetual Care</th><th colspan=\"2\">Height (ft, in)</th></tr>";
	$table .= "<tr><td colspan=\"2\">".$tombdata[0]['representation']."</td><td colspan=\"2\">".$tombdata[0]['interments']."</td><td colspan=\"2\">".$tombdata[0]['perpcare']."</td><td colspan=\"2\">".$tombdata[0]['heightftin']."</td></tr>";
	$table .= "<tr><th colspan=\"2\">&nbsp;</th><th >Addition</th><th>Alteration</th><th>Material</th><th>Condition</th><th>Mat. Int.<th>Form Int.</th></tr>";
	$table .= "<tr><th scope=\"row\" colspan=\"2\">Primary Structure</th><td>".$tombdata[0]['primarystructureaddition']."</td><td>".$tombdata[0]['primarystructurealteration']."</td><td>".$tombdata[0]['primarystructurematerial']."</td><td>".$tombdata[0]['primarystructurecondition']."</td><td>".$tombdata[0]['primarystructurematrint']."</td><td>".$tombdata[0]['primarystructureformint']."</td></tr>";
	$table .= "<tr><th scope=\"row\" colspan=\"2\">Roof</th><td>".$tombdata[0]['roofaddition']."</td><td>".$tombdata[0]['roofalteration']."</td><td>".$tombdata[0]['roofmaterial']."</td><td>".$tombdata[0]['roofcondition']."</td><td>".$tombdata[0]['roofmatrint']."</td><td>".$tombdata[0]['roofformint']."</td></tr>";
	$table .= "<tr><th scope=\"row\" colspan=\"2\">Stucco</th><td >&nbsp;</td><td>".$tombdata[0]['stuccoalteration']."</td><td>".$tombdata[0]['stuccomaterial']."</td><td>".$tombdata[0]['stuccocondition']."</td><td>".$tombdata[0]['stuccomatrint']."</td><td >&nbsp;</td><td >&nbsp;</td></tr>";
	$table .= "<tr><th scope=\"row\" colspan=\"2\">Surface Finish</th><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td>".$tombdata[0]['surfacefinishcondition']."</td><td>".$tombdata[0]['surfacefinishmatrint']."</td><td >&nbsp;</td></tr>";
	$table .= "<tr><th colspan=\"2\" scope=\"row\">Tablet System</th><td >&nbsp;</td><td >&nbsp;</td><td>".$tombdata[0]['tabletsystemmaterial']."</td><td>".$tombdata[0]['tabletsystemcondition']."</td><td>".$tombdata[0]['tabletsystemmatrint']."</td><td >&nbsp;</td></tr>";
	$table .= "<tr><th scope=\"row\" colspan=\"2\">Ornament</th><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td>".$tombdata[0]['ornamentcondition']."</td><td>".$tombdata[0]['ornamentmatrint']."</td><td >&nbsp;</td></tr>";

	$table .= "</table>";
	echo $table;
	}
else{
    echo "Full results not available for tomb # " .$pnthnoc; 
}
?>
