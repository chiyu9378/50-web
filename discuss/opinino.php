<?php include("../sql.php");?>
<?php
	if(isset($_SESSION['type'])){
	}else{
		$_SESSION['message'] = "請登入";
		go("../index.php");
	}
	(isset($_GET['faceid']))? ($_SESSION['faceid'] = $_GET['faceid']):'';
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
				if($_SESSION['member'] == "top" && $ps['prook'] == "true"){
			?>
				<a class="btn btn-primary" href="new-opinino.php">發表意見</a>
			<?php
				}elseif($_SESSION['member'] == "top" && $ps['prook'] == "false"){
			?>
				<button class="btn btn-danger" disabled>意見已停止</button>
			<?php
				}
			?>
				<a href="discuss.php" class="btn ">返回</a>
			</div>
			<hr>
			<div class="fccc">
				
					<?php
						$pro = all("SELECT * FROM `opinino` WHERE faceid = '{$_SESSION['faceid']}'");
						foreach($pro as $p){
					?>
					<div class="well f fc span8">
						<p>意見名稱：<?=$p['title']?></p>
						<p>意見說明：<?=$p['description']?></p>
						<p>
						<span class="btn-group pull-right">
							<a href="opinino2.php?opid=<?=$p['id']?>" class="btn">檢視意見</a>
						</span>
						</p>
					</div>
					<?php
						}
					?>
			</div>
		</div>
	</body>
	
</html>