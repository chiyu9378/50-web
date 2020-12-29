<?php include("../sql.php");?>
<html>
	
	<head>
		<?php include("../head.php");?>
		<title>專案討論-首頁</title>
	</head>
	
	<body>
	<?php include("../navbar.php");?>
		<div class="warp fccc">
			<label><h3>專案討論-登入</h3></label>
			<div class="btn-group">
				<a href="project.php" class="btn">返回</a>
			</div>
			<hr>
			<div class="fccc">
			
				<div class="alert alert-success span8">
					<label><h3>可選擇使用者</h3></label>
					<hr>
					<span class="span8" ondrop="all(event)" ondragover="delt(event)" style="min-height:50px;">
						<?php
							$user = all("SELECT * FROM `users` WHERE id != 1");
							foreach($user as $u){
						?>
						<div class="alert alert-info span1" id="<?=$u['id']?>" draggable="true" ondragstart="drop(event)">
						<?=$u['name']?>
						</div>
						<?php
							}
						?>
					</span>
				</div>
				<div class="alert alert-danger span8" >
					<label><h3>組長</h3></label>
					<hr>
					<span class="span8" ondrop="all(event)" ondragover="add(event,'a')" style="min-height:50px;">
					</span>
				</div>
				<div class="alert alert-primary  span8">
					<label><h3>組員</h3></label>
					<hr>
					<span class="span8" ondrop="all(event)" ondragover="add(event,'b')" style="min-height:50px;">
					</span>
				</div>
				<div class="btn-group ">
					<input type="button" value="指定" class="btn btn-success" onclick="sub()">
				</div>
			</div>
		</div>
		<script>
		var a = [];
		var b = [];
		var data = "";
		function all(event){
			event.preventDefault();
		}
		function drop(event){
			data = event.currentTarget.id;
		}
		function add(event,array){
			event.currentTarget.appendChild(document.getElementById(data));
			if(array == 'a' && a.indexOf(data) == -1){
				a.push(data);
				if(b.indexOf(data) != -1){
					b.splice(b.indexOf(data),1);
				}
			}else if(array == 'b' && b.indexOf(data) == -1){
				b.push(data);
				if(a.indexOf(data) != -1){
					a.splice(a.indexOf(data),1);
				}
			}
		}
		function delt(event){
			event.currentTarget.appendChild(document.getElementById(data));
			if(b.indexOf(data) != -1){
				b.splice(b.indexOf(data),1);
			}else if(a.indexOf(data) != -1){
				a.splice(a.indexOf(data),1);
			}
		}
		function sub(){
			if(a.length != 1){
				alert("組長只能有一個");
			}else{
				$.get("../api.php",{id:'new_member',top:a,bot:b,edit_id:<?=$_GET['edit_id']?>},function(){
					location.href="project.php";
				});
			}
		}
		</script>
	</body>
	
</html>