<?php
require_once('connect.php');

$last = $_POST['last'];
$amount = $_POST['amount'];

$user = array('demo1','demo2','demo3','demo3','demo4');
$sql = "select * from say order by id desc";
// echo $sql;
// exit;
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)) {
	$sayList[] = array(
		'content'=>$row['content'],
		'author'=>$user[$row['userid']],
		'date'=>date('m-d H:i',$row['addtime'])
      );
}
echo json_encode($sayList);
?>