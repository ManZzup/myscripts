<?php include "include/config.php";
	  include "include/header.php";
	  
	  $id = htmlspecialchars($_GET['id']);
	  $error = false;
	  if(db_connect()){	  	
		try{
			$qry = "SELECT Name,Link FROM downloads WHERE ID=$id";
			$result = mysql_query($qry);
			if(mysql_num_rows($result)==1){
				while($rows = mysql_fetch_array($result)){
					$nam = $rows['Name'];
					$link = $rows['Link'];
				}
				$qry = "UPDATE downloads SET Counter = Counter+1";
				mysql_query($qry);
			}else{ $error = true; }
		}catch(Exception $e){
			$error = true;
		}
		
	  }
	  if($error){
	  	if($error) header("Location: index.php");
	  }
?>
<title>ZONTEK - Download File</title>
<script type="text/javascript">
	var c = 6;
	$(document).ready(function(){
		count();
	});	
	function count(){
		c -= 1;
		if(c>=0) $('#time').text(" in " + c + " Seconds");
		else{
			$('#time').text("Now");
			download();
			return;
		}
		var counter2 = setTimeout("count()",1000);
		return;
	}
	function download(){
		var ele = document.createElement('iframe');
		ele.src = "downloader.php?id=<?php echo $id; ?>";
		ele.style.display = "none";
		document.body.appendChild(ele);
	}
</script>
<div id="content">
	<style>
    	#content{color:#000000}
		body {color:#000000}
    </style>
    <h1 align="center">Thank You For Downloading <?php echo $nam;?></h1><br />
   <p align="center" style="font-size:24px">Your download will start <span id="time"></span>
   <br />If not please use this <a href="<?php echo $link ?>">Direct Link</a>
   </p>
    
</div>
<?php include "include/footer.php"; ?>
<script>
changeMNav("home");
</script>
