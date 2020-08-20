<section id="dashboard" class="bg-gradient-purple">
	<div class="container text-left">
		<div class="col-lg-12 mx-auto">
			<h2 class="mt-5 text-light">Website</h2>
			<p class="lead mb-3">Charts with data about <?=$QUICKBROWSE->DOMAIN;?>.</p>
			
			<h5 class="text-left text-light"><small>Users</small></h5>
			<canvas class="mb-3 chartjs-render-monitor" id="usersChart" style="display: block; width: 100%; height: 30vh;"></canvas>
			
			<h5 class="text-left text-light"><small>Unique Visits</small></h5>
			<canvas class="mb-3 chartjs-render-monitor" id="visitsChart" style="display: block; width: 100%; height: 30vh;"></canvas>
			
			<h2 class="mt-5 text-light">Youtube</h2>
			<p class="lead mb-3">Charts with data about your Youtube channel.</p>
			
			<h5 class="text-left text-light"><small>Views</small></h5>
			<canvas class="mb-3 chartjs-render-monitor" id="viewsChart" style="display: block; width: 100%; height: 30vh;"></canvas>
			
			<h5 class="text-left text-light"><small>Subscribers</small></h5>
			<canvas class="mb-3 chartjs-render-monitor" id="subscribersChart" style="display: block; width: 100%; height: 30vh;"></canvas>
		</div>
	</div>
</section>
<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
  var fillColor = '#fefefe';
  Chart.defaults.global.defaultFontColor = fillColor;
  
  var canvas = document.getElementById("usersChart");
  var viewsChart = new Chart(canvas, {
	type: 'line',
	data: {
	  labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
	  datasets: [{
		data: [10, 15, 30, 45, 55, 60, 75],
		lineTension: 0,
		backgroundColor: 'transparent',
		borderColor: fillColor,
		borderWidth: 2,
		pointBackgroundColor: fillColor
	  }]
	},
	options: {
	  scales: {
		yAxes: [{
		  ticks: {
			beginAtZero: false
		  }
		}]
	  },
	  legend: {
		display: false,
	  }
	}
  });
  
  var canvas = document.getElementById("visitsChart");
  var viewsChart = new Chart(canvas, {
	type: 'line',
	data: {
	  labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
	  datasets: [{
		data: [10, 15, 30, 45, 55, 60, 75],
		lineTension: 0,
		backgroundColor: 'transparent',
		borderColor: fillColor,
		borderWidth: 2,
		pointBackgroundColor: fillColor
	  }]
	},
	options: {
	  scales: {
		yAxes: [{
		  ticks: {
			beginAtZero: false
		  }
		}]
	  },
	  legend: {
		display: false,
	  }
	}
  });
  
  var canvas = document.getElementById("viewsChart");
  var viewsChart = new Chart(canvas, {
	type: 'line',
	data: {
	  labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
	  datasets: [{
		data: [10339, 12339, 12896, 14339, 17339, 18339, 19339],
		lineTension: 0,
		backgroundColor: 'transparent',
		borderColor: fillColor,
		borderWidth: 2,
		pointBackgroundColor: fillColor
	  }]
	},
	options: {
	  scales: {
		yAxes: [{
		  ticks: {
			beginAtZero: false
		  }
		}]
	  },
	  legend: {
		display: false,
	  }
	}
  });
  
  var canvas = document.getElementById("subscribersChart");
  var subscribersChart = new Chart(canvas, {
	type: 'line',
	data: {
	  labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
	  datasets: [{
		data: [0, 1, 1, 2, 3, 4, 6],
		lineTension: 0,
		backgroundColor: 'transparent',
		borderColor: fillColor,
		borderWidth: 2,
		pointBackgroundColor: fillColor
	  }]
	},
	options: {
	  scales: {
		yAxes: [{
		  ticks: {
			beginAtZero: false
		  }
		}]
	  },
	  legend: {
		display: false,
	  }
	}
  });
</script>