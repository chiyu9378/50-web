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
		<title>專案討論-統計管理</title>
	</head>
	
	<body>
		<?php include("../navbar.php");?>
		<div class="warp fccc">
			<label><h3>專案討論-統計管理</h3></label>
			<div class="btn-group">
				<a href="selectpic.php" class="btn ">返回</a>
			</div>
			<hr>
			<select onchange="change()">
			<?php
				$p = all("SELECT * FROM `project`");
				foreach($p as $s){
			?>
				<option value="<?=$s['id']?>">專案名稱：<?=$s['projectname']?></option>
			<?php
				}
			?>
			</select>
			<div class="container">
				<div id="topthree"></div>
			</div>
		</div>
		<script>
			function change(){
				$.get("../api.php",{id:'selectface',proid:$("select").val()},function(d){
					console.log(d);
					Highcharts.chart('topthree', {
						chart: {
							type: 'pie'
						},
						title: {
							text: d[1][0].name+'專案意見之面向統計'
						},
						plotOptions: {
							pie: {
								shadow: false,
								center: ['50%', '50%']
							}
						},
						tooltip: {
							valueSuffix: '個'
						},
						series: [{
							name: 'Browsers',
							data: d[1],
							size: '60%',
							dataLabels: {
								formatter: function () {
									return  '專案'+this.point.name + '<br>總意見數量:' +
										this.y + '個';
								},
								color: '#ffffff',
								distance: -100
							}
						}, {
							name: 'Versions',
							data: d[0],
							size: '80%',
							innerSize: '60%',
							dataLabels: {
								formatter: function () {
									// display only if larger than 1
									return  '面向'+this.point.name + '<br>意見數量:' +
										this.y + '個';
								},
								distance: -30
							},
							id: 'versions'
						}],
						responsive: {
							rules: [{
								condition: {
									maxWidth: 400
								},
								chartOptions: {
									series: [{
									}, {
										id: 'versions',
										dataLabels: {
											enabled: false
										}
									}]
								}
							}]
						}
					});
				},"JSON");
			};
			change();
		</script>
	</body>
	
</html>