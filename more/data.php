<?php
require_once('connect.php');

// $last = $_POST['last'];
// $amount = $_POST['amount'];


$user = array('demo1','demo2','demo3','demo3','demo4');
$query=mysql_query("select * from say order by id desc");
while ($row=mysql_fetch_array($query)) {
	$sayList[] = array(
		'content'=>$row['content'],
		'author'=>$user[$row['userid']],
		'id'=> '1',
		'link'=> 'index.php?action=show_one_msg&id='.$row['userid'],
		'date'=>date('m-d H:i',$row['addtime'])
      );
}
echo json_encode($sayList);
?>