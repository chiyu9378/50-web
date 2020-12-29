<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<div class="container">
			<button class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand">
			-><?=$_SESSION['name']?>
			<?php
				if(isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
					echo "/管理員";
				}elseif(isset($_SESSION['member']) && $_SESSION['member'] == "top"){
					echo "/組長";
				}elseif(isset($_SESSION['member']) && $_SESSION['member'] == "bot"){
					echo "/組員";
				}
			?>
			</a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li><a href="../discuss/discuss.php">專案討論</a></li>
					<li><a href="../top/top.php">組長功能管理</a></li>
					<li><a href="../admin/admin.php">使用者管理</a></li>
					<li><a href="../project/project.php">專案管理</a></li>
					<li><a href="../selectpic/selectpic.php">統計管理</a></li>
					<li><a href="../api.php?id=logout">登出</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>