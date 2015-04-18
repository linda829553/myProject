<head>    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
<title>----分页演示-----</title>    
<link href="pager.css" type="text/css" rel="stylesheet" />    
</head>    
<body>    
    <?php    
     include "pager.class.php";    
     $CurrentPage=isset($_GET['page'])?$_GET['page']:1;    
     //die($CurrentPage);    
     $myPage=new pager(1300,intval($CurrentPage));    
      $pageStr= $myPage->GetPagerContent();    
     //echo $pageStr;    
     $myPage=new pager(90,intval($CurrentPage));     
     $pageStr= $myPage->GetPagerContent();    
     echo $pageStr;    
    ?>    
</body>    
</html>  