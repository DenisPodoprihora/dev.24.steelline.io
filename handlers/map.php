<? 
$count_close_deal = 0;
$count_new_deal = 0;
$temp = null;

foreach($_POST['array_Users'] as $user_id){

	$result = $DB->Query("SELECT COUNT(ID) FROM b_crm_deal WHERE ASSIGNED_BY_ID ='" . $user_id . "' AND CLOSED = 'Y' AND BEGINDATE >= '" . $_POST['Begin_date'] . "' AND CLOSEDATE <='". $_POST['Close_date'] ."'");
	$temp = $result->fetch();
	$count_close_deal += $temp['COUNT(ID)'];
}


foreach($_POST['array_Users'] as $user_id){
	$result = $DB->query("SELECT COUNT(ID) FROM b_crm_deal WHERE ASSIGNED_BY_ID ='" . $user_id . "' AND CLOSED = 'N' AND BEGINDATE >= '" . $_POST['Begin_date'] . "'");
	$temp = $result->fetch();
	$count_new_deal += $temp['COUNT(ID)'];
}
//echo ($_POST['Begin_date']);
echo ("<div class='Close_deal'> Завершенныe сделки за отчётный период: ". $count_close_deal ." </div> <div class='new_deal'> Новые сделки за отчётный период: ". $count_new_deal ."</div>");
?>