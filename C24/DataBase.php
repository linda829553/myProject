<!--���ݿ����ļ���DataBase.php-->
<?php
	require("sys_conf.inc");			//����ϵͳ�����ļ�
	class DataBase
	{
		//����
		public $mConnId;		//���ӱ�ʶ		
		public $mSqlString;		//��ִ�е�SQL���
		public $mResultArray;	//ִ��Select��䷵�صĽ������		
		
		//���캯��
		function __construct($pHost,$pUser,$pPwd,$pDbName)
		{			
			$this->mConnId=mysql_connect ($pHost,$pUser,$pPwd);//��������
			mysql_select_db($pDbName, $this->mConnId);	//ѡ�����ݿ�
		}
		
		//__destruct�������������Ͽ�����
		function __destruct()
		{
				//mysql_close($this->mConnId);
		}
		
		//��ɾ������
		function ExecuteSql()
		{
			//echo $this->SqlString."<br>";
			mysql_query($this->SqlString);
		}
		
		//��ѯ���ݣ�����ֵΪ�������飬�����е�ÿһԪ��Ϊһ�м�¼���ɵĶ���
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