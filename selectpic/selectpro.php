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
			<div class="container">
				<div id="topthree"></div>
			</div>
		</div>
		<script>
			$.get("../api.php",{id:'selectpro'},function(d){
				console.log(d);
				Highcharts.chart('topthree', {
					chart: {
						type: 'column'
					},
					title: {
						text: '各專案意見總數量統計'
					},
					xAxis: {
						type: 'category',
						labels: {
							rotation: -45,
							style: {
								fontSize: '13px',
								fontFamily: 'Verdana, sans-serif'
							}
						}
					},
					yAxis: {
						min: 0,
						title: {
							text: '意見數量'
						}
					},
					legend: {
						enabled: false
					},
					tooltip: {
						pointFormat: '意見數量: <b>{point.y:.0f} 個</b>'
					},
					series: [{
						name: 'Population',
						data: d,
						dataLabels: {
							enabled: true,
							rotation: 360,
							color: '#FFFFFF',
							align: 'right',
							format: '{point.y:.0f}', // one decimal
							y: 10, // 10 pixels down from the top
							style: {
								fontSize: '13px',
								fontFamily: 'Verdana, sans-serif'
							}
						}
					}]
				});
			},"JSON");
		</script>
	</body>
	
</html>