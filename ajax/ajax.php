<?php	
	require_once("../../../includes/functions.inc.php");
	require_once("../../../includes/form_functions.inc.php");
	require_once("../../../includes/connection_open.inc.php");
	require_once("../../../includes/select_database.inc.php");
	select_database(MMS_DB, $connection);

	$fan = $_GET['fan'];
	$textout = "";
	if(strlen($fan)>0){
		$result = mysql_query("SELECT * FROM w2_defect_reporting WHERE defect_id = {$fan}");
		if(mysql_num_rows($result)==1) {
			$myrow = mysql_fetch_array($result);
			$getFAN = mysql_fetch_array(mysql_query("SELECT * FROM w1_equip_location WHERE equip_loc_id = '{$myrow['equip_loc_id']}'"));
			$getFAC = mysql_fetch_array(mysql_query("SELECT * FROM m3_fixed_asset_reg WHERE fixed_asset_no = '{$getFAN['fixed_asset_no']}'"));
			$fac = $getFAC["fixed_asset_code"];
			$getPN = mysql_fetch_array(mysql_query("SELECT * FROM m1_equip_codding WHERE fixed_asset_code = '{$fac}'"));
			$partName = $getPN["part_name"];
			$model = $getFAC["model"];
			$defect = $myrow["defect_details"];
			$location = $getFAN["location"];
			$textout .= $fac."|".$partName."|".$model."|".$defect."|".$location."|";
		}
	}
	echo $textout;

?>