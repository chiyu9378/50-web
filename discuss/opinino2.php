<?php include("../sql.php");?>
<?php
	if(isset($_SESSION['type'])){
	}else{
		$_SESSION['message'] = "請登入";
		go("../index.php");
	}
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
				<a href="javascript:history.back();" class="btn ">返回</a>
			</div>
			<hr>
			<?php
				$op = once("SELECT * FROM `opinino` WHERE id = '{$_GET['opid']}'");
				$os = all("SELECT * FROM `opinino` WHERE faceid = '{$_SESSION['faceid']}'");
				$num = 0;
				$a=0;
				foreach($os as $o){
					if($o['id'] != $op['id']){
						$a++;
					}else{
						$a++;
						$num = $a;
					}
				}
				$start = once("SELECT AVG(start),COUNT(start) FROM `opstart` WHERE opininoid = '{$_GET['opid']}'");
				$ext = all("SELECT * FROM `ext` WHERE opininoid = '{$_GET['opid']}'");
			?>
			<div class="fccc well">
				<?php
					if(!empty($ext)){
				?>
				<div class="alert alert-success ">
					延伸意見：
					<?php
						foreach($ext as $e){
					?>
						<a href="opinino2.php?opid=<?=$e['extid']?>"><?=$e['exttitle']?></a>
						&emsp;
					<?php
						}
					?>
				</div >
				<?php
					}
				?>
				<p>編號：<?=sprintf('%03d',$num)?></p>
				<p>標題：<?=$op['title']?></p>
				<p>說明：<?=$op['description']?></p>
				<p>發表的時間：<?=$op['creattime']?></p>
				<p>發表者的使用者名稱：<?=$op['name']?></p>
				<p>被評價平均分數：<?=ceil($start['AVG(start)'])?></p>
				<p>評價人數：<?=$start['COUNT(start)']?></p>
				<?php
					if(!empty($op['fill'])){
						if($op['filltype'] == "image"){
				?>
					<hr>
						<img src="../<?=$op['fill']?>" width="500px;">
				<?php
						}elseif($op['filltype'] == "audio"){
				?>
					<hr>
						<audio controls>
							<source src="../<?=$op['fill']?>">
						</audio>
				<?php
						}elseif($op['filltype'] == "video"){
				?>
					<hr>
						<video controls>
							<source src="../<?=$op['fill']?>">
						</video>
				<?php				
						}
						
					}
				?>
				<hr>
				<div class="fccr">
					<?php
						$s = once("SELECT * FROM `opstart` WHERE opininoid = '{$_GET['opid']}' AND userid = '{$_SESSION['id']}'");
						if(!empty($s)){
					?>
					<input type="button" class="btn btn-success" value="評分：<?=$s['start']?>分，已評分" disabled>
					<?php
						}else{
					?>
					<form action="../api.php?id=op_start&opid=<?=$_GET['opid']?>" method="POST">
						評分：
						<select name="start">
							<option value="1">1分</option>
							<option value="2">2分</option>
							<option value="3" selected>3分</option>
							<option value="4">4分</option>
							<option value="5">5分</option>
						</select>
						<input type="submit" class="btn btn-warning" value="評分">
					</form>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		</body>
	
</html>