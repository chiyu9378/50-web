<?php include("../sql.php");?>
<?php
	if(isset($_SESSION['type'])){
	}else{
		$_SESSION['message'] = "請登入";
		go("../index.php");
	}
	(isset($_GET['proid']))? ($_SESSION['proid'] = $_GET['proid']):'';
	(isset($_GET['type']))? ($_SESSION['member'] = $_GET['type']):'';
?>
<html>
	
	<head>
		<?php include("../head.php");?>
		<title>專案討論-專案討論</title>
	</head>
	
	<body>
		<?php include("../navbar.php");?>
		<div class="warp fccc">
			<label><h3>專案討論-專案討論</h3></label>
			<div class="btn-group">
			<?php
				$ps = once("SELECT * FROM `project` WHERE id = '{$_SESSION['proid']}'");
				if($_SESSION['member'] == "top" && $ps['prook'] == "false"){
			?>
				<button class="btn btn-primary" onclick="prostart()">開始意見</button>
			<?php
				}elseif($_SESSION['member'] == "top" && $ps['prook'] == "true"){
			?>
				<button class="btn btn-danger" onclick="prostop()">停止意見</button>
			<?php
				}
			?>
				<a href="discuss.php" class="btn ">返回</a>
			</div>
			<hr>
			<div class="fccc">
				
					<?php
						$pro = all("SELECT * FROM `face` WHERE proid = '{$_SESSION['proid']}'");
						foreach($pro as $p){
					?>
					<div class="well f fc span8">
						<p>面向名稱：<?=$p['face']?></p>
						<p>面向說明：<?=$p['facedescription']?></p>
						<p>
						<span class="btn-group pull-right">
							<a href="opinino.php?faceid=<?=$p['id']?>" class="btn">面向意見</a>
						</span>
						</p>
					</div>
					<?php
						}
					?>
			</div>
		</div>
		<script>
		function prostart(){
			$.get("../api.php",{id:'pro_start'},function(){
				location.reload();
			});
		}
		function prostop(){
			$.get("../api.php",{id:'pro_stop'},function(){
				location.reload();
			});
		}
		</script>
	</body>
	
</html>