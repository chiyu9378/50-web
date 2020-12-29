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
				<div id="user0"></div>
				<div id="user1"></div>
				<div id="user2"></div>
			</div>
		</div>
		<script>
			$.get("../api.php",{id:'three'},function(d){
				console.log(d);
				Highcharts.chart('topthree', {
					chart: {
						type: 'column'
					},
					title: {
						text: '使用者發表意見統計'
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
						data: [
							[d[0][0],parseInt(d[0][1])],
							[d[1][0],parseInt(d[1][1])],
							[d[2][0],parseInt(d[2][1])]
						],
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
			$.get("../api.php",{id:'topthree'},function(d){
				console.log(d);
				var pieColors = (function () {
					var colors = [],
						base = Highcharts.getOptions().colors[0],
						i;

					for (i = 0; i < 10; i += 1) {
						// Start out with a darkened base color (negative brighten), and end
						// up with a much brighter color
						colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
					}
					return colors;
				}());

			// Build the chart
			for(let i =0;i<3;i++){
				Highcharts.chart('user'+i, {
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie'
					},
					title: {
						text: '使用者'+d[3][i]+'分數使用統計'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.y:.0f}次</b>'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							colors: pieColors,
							dataLabels: {
								enabled: true,
								format: '<b>{point.name}分</b><br>{point.y:.0f} 次',
								distance: -50,
								filter: {
									property: 'percentage',
									operator: '>',
									value: 4
								}
							}
						}
					},
					series: [{
						name: d[3][i],
						data: d[i]
					}]
				});
			}
			},"JSON");
		</script>
	</body>
	
</html>