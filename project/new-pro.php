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
			<label><h3>新增專案</h3></label>
			<div class="btn-group">
				<a href="project.php" class="btn">返回</a>
			</div>
			<hr>
			<div class="hero-unit fccc">
			
				<form action="../api.php?id=new_pro" method="POST" class="fccc">
					<p class="fccr">
					專案名稱：<input type="text" name="project" id="project" required>
					&emsp;
					專案說明：<input type="text" name="description" id="description" required>
					&emsp;
					</p>
					<button class="btn btn-primary pull-right" onclick="add()" >新增</button>
					<hr>
					<div class="facehome">
						<?php include("face.php");?>
					</div>
					<div class="btn-group">
						<input type="button" class="btn btn-success" value="新增" id="s" onclick="sub()">
					</div>
				</form>
			</div>
		</div>
		<script>
		let num = 1;
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