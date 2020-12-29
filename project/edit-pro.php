<?php include("../sql.php");?>
<?php
	if(isset($_SESSION['type'])){
		if($_SESSION['type'] != "admin"){
			$_SESSION['message'] = "無權限";
			go("discuss/discuss.php");
		}
	}else{
		$_SESSION['message'] = "請登入";
		go("../index.php");
	}
?>
<html>
	
	<head>
		<?php include("../head.php");?>
		<title>專案討論-專案管理</title>
	</head>
	
	<body>
	<?php include("../navbar.php");?>
		<div class="warp fccc">
			<label><h3>修改專案</h3></label>
			<div class="btn-group">
				<a href="project.php" class="btn">返回</a>
			</div>
			<hr>
			<div class="hero-unit fccc">
				<?php
					 $p = once("SELECT * FROM `project` WHERE id = '{$_GET['edit_id']}'");
				?>
				<form action="../api.php?id=edit_pro&edit_id=<?=$_GET['edit_id']?>" method="POST" class="fccc">
					<p class="fccr">
					專案名稱：<input type="text" name="project" id="project" value="<?=$p['projectname']?>" required>
					&emsp;
					專案說明：<input type="text" name="description" id="description" value="<?=$p['description']?>" required>
					&emsp;
					</p>
					<button class="btn btn-primary pull-right" onclick="add()" >新增</button>
					<hr>
					<div class="facehome">
					<?php
						$face = all("SELECT * FROM `face` WHERE proid = '{$_GET['edit_id']}'");
						$i =0;
						foreach($face as $f){
							$i++;
					?>
						<p class="fccr">
						面向名稱：<input type="text" name="oldface[<?=$f['id']?>]" value="<?=$f['face']?>" class="face"  required>
						&emsp;
						面向說明：<input type="text" name="oldfacedescription[<?=$f['id']?>]" value="<?=$f['facedescription']?>"  class="face" required>
						&emsp;
						<button class="close" onclick="deltold(this,<?=$f['id']?>)">&times;</button>
						</p>
					<?php
						}
					?>
					</div>
					<div class="btn-group">
						<input type="button" class="btn btn-success" value="修改" id="s" onclick="sub()">
					</div>
				</form>
			</div>
		</div>
		<script>
		let num = <?=$i?>;
		function add(){
			if(num <10){
				$(".facehome").append(`<?php include("face.php");?>`);
				num++;
			}else{
				alert("面向數量已達上限");
			}
			
		}
		function delt(th){
			$(th).parent().remove();
			num--;
		}
		function deltold(th,id){
			$(th).parent().remove();
			$(".facehome").append("<input type='hidden' value="+id+" name='oldid[]'>");
			num--;
		}
		function sub(){
			let j = 0;
			if($("#project").val().replace(/\s/g,'') == '' || $("#description").val().replace(/\s/g,'') == '' ){
				j++;
			}
			$(".face").each(function(){
				if($(this).val().replace(/\s/g) == ''){
					j++;
				}
			});
			if(j != 0){
				alert("有資料未填寫");
			}else{
				$("#s").attr("type","submit");
				$("#s").removeAttr("onclick");
				$("#s").click();
			}
		}
		</script>
	</body>
	
</html>