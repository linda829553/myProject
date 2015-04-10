<!--数据库类文件：DataBase.php-->
<?php
	require("sys_conf.inc");			//包含系统配置文件
	class DataBase
	{
		//属性
		public $mConnId;		//连接标识		
		public $mSqlString;		//待执行的SQL语句
		public $mResultArray;	//执行Select语句返回的结果数组		
		
		//构造函数
		function __construct($pHost,$pUser,$pPwd,$pDbName)
		{			
			$this->mConnId=mysql_connect ($pHost,$pUser,$pPwd);//建立连接
			mysql_select_db($pDbName, $this->mConnId);	//选择数据库
		}
		
		//__destruct：析构函数，断开连接
		function __destruct()
		{
				//mysql_close($this->mConnId);
		}
		
		//增删改数据
		function ExecuteSql()
		{
			//echo $this->SqlString."<br>";
			mysql_query($this->SqlString);
		}
		
		//查询数据，返回值为对象数组，数组中的每一元素为一行记录构成的对象
		function Query(){
			//echo $this->SqlString."<br>";
			$i=0;
			$query_result=mysql_query($this->SqlString,$this->mConnId);
			while($row=mysql_fetch_object($query_result))
			{
				$this->mResultArray[$i++]=$row;
			}
		}
	
	}//class DataBase
	
/*
	$db=new DataBase($DBHOST,$DBUSER,$DBPWD,$DBNAME);
	
	$db->SqlString="insert into test(t1,t2) values('1','2')";
	$db->ExecuteSql();
	
	$db->SqlString="select * from test";
	$db->Query();	
	print_r($db->mResultArray);
	
	$db->__destruct();
	$db=NULL;
//*/
?>