<?php
include_once('connect.php'); //连接数据库，略过，具体请下载源码查看 
 
$page = intval($_POST['pageNum']); //当前页 
 
$result = mysql_query("select id from message"); 
$total = mysql_num_rows($result);//总记录数 
$pageSize = 7; //每页显示数 
$totalPage = ceil($total/$pageSize); //总页数 
 
$startPage = $page*$pageSize; //开始记录 
//构造数组 
$arr['total'] = $total; 
$arr['pageSize'] = $pageSize; 
$arr['totalPage'] = $totalPage; 
$query = mysql_query("select * from message order by post_time DESC limit  
$startPage,$pageSize"); //查询分页数据 
while($row=mysql_fetch_array($query)){ 
     $arr['list'][] = array( 
         'id' => $row['id'], 
        'title' => $row['content'], 
        'pic' => $row['post_time'], 
     ); 
} 
echo json_encode($arr); //输出JSON数据 
?>