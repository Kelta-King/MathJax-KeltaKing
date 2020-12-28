<head>
<title>Data visualization</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://www.chartjs.org/dist/2.9.4/Chart.min.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<style>
.kel-hover{
	
	transition-duration:0.3s;
	cursor:pointer;
	
}
</style>
</head>
<body>
<div class="w3-content">
<div class="w3-xlarge w3-padding-16 w3-center">
Data visualization
</div>
<div class="w3-center w3-margin-bottom">
<button class="w3-button w3-blue w3-hover-green w3-round kel-hover w3-bar-item" 
onclick="visualizeData()" style="margin-top:20px">Visulize</button>

<button class="w3-button w3-green w3-hover-blue w3-round kel-hover w3-bar-item" 
onclick="getMean()" style="margin-top:20px">Get mean</button>

<button class="w3-button w3-orange w3-text-white w3-round w3-hover-green kel-hover w3-bar-item" 
onclick="getMedium()" style="margin-top:20px">Get medium</button>

<button class="w3-button w3-indigo w3-hover-green w3-round kel-hover w3-bar-item" 
onclick="getyo()" style="margin-top:20px">Get mode</button>
</div>
</div>

<div class="w3-content" style="max-width:1100px">
<div class="w3-row w3-light-gray" id="hey" style="margin-top:30px">
<div class="w3-half">
<canvas id="canvas1"></canvas>
</div>
<div class="w3-half">
<canvas id="canvas2"></canvas>
</div>
</div>
<div class="w3-row w3-light-gray">
<div class="w3-half">
<canvas id="canvas3"></canvas>
</div>
<div class="w3-half">
<canvas id="canvas4"></canvas>
</div>
</div>
</div>
<div class="w3-content w3-padding-32 w3-light-gray" style="max-width:800px;padding:30px">

<table class="w3-table-all">
<thead>
<tr class="w3-green">
	<td>-</td>
	<td>Heights</td>
	<td>Marks</td>
</tr>
</thead>
<tbody>
<tr>
	<td>Mean</td>
	<td id="avgHeights"></td>
	<td id="avgMarks"></td>
</tr>
<tr>
	<td>Mode</td>
	<td id="modeHeights"></td>
	<td id="modeMarks"></td>
</tr>
<tr>
	<td>Medium</td>
	<td id="mediumHeights"></td>
	<td id="mediumMarks"></td>
</tr>
</tbody>
</table>

</div>
<script>
let heights = [];
let marks = [];

let getFreq = (arr, low, high) => {
	
	let count = 0;
	
	if(high == Math.max(...arr)){
		
		count++;
		
	}
	
	for(let i=0 ; i<arr.length ; i++){
		
		if(arr[i] >= low && arr[i] < high){
			
			count++;
			
		}
		
	}
	
	return count;
	
}

let visualizeData = () => {
	
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		
		if(this.readyState == 4 && this.status == 200){
			
			let val = this.responseText;
			let vals = val.split("&");
			let numbers = vals[0].split("#");
			let names = vals[1].split("#");
			heights = vals[2].split("#");
			marks = vals[3].split("#");
			
			var config = {
			type: 'line',
			data: {
				labels:  names,
				datasets: [{
					label: 'Height',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: heights,
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Overview'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Names'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			}
		};
			var ctx = document.getElementById('canvas1').getContext('2d');
			window.myLine = new Chart(ctx, config);
			
			var config = {
			type: 'line',
			data: {
				labels:  names,
				datasets: [{
					label: 'Mark',
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: marks
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Overview'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Names'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			}
		};
			var ctx3 = document.getElementById('canvas3').getContext('2d');
			window.myLine = new Chart(ctx3, config);
		
			for(let i=0; i<heights.length; i++){
				
				heights[i] = Number.parseInt(heights[i]);
				
			}
			
			for(let i=0; i<marks.length; i++){
				
				marks[i] = Number.parseInt(marks[i]);
				
			}
			
		var color = Chart.helpers.color;
		
		let maxH = Math.max(...heights);
		let lowH = Math.min(...heights);
		
		let n = 5;
		let m = ((maxH-lowH)/n);
		let a = [];
		let freqH = [];
		
		let temp = lowH;
		for(let i=0; i<n; i++){
			
			a[i] = temp.toFixed(2) + " - " + (temp + m).toFixed(2);
			freqH[i] = getFreq(heights, temp.toFixed(2), (temp + m).toFixed(2));
			temp = temp + m;
			
		}
		
		var barChartData = {
			labels: a,
			datasets: [{
				label: 'Height',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: freqH
			}]

		};
		let ctx2 = document.getElementById('canvas2').getContext('2d');
		window.myBar = new Chart(ctx2, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: false
				}
			}
		});
		
		let maxM = Math.max(...marks);
		let lowM = Math.min(...marks);
		
		n = 5;
		m = ((maxM-lowM)/n);
		a = [];
		let freqM = [];
		
		temp = lowM;
		for(let i=0; i<n; i++){
			
			a[i] = temp.toFixed(2) + " - " + (temp + m).toFixed(2);
			freqM[i] = getFreq(marks, temp.toFixed(2), (temp + m).toFixed(2));
			temp = temp + m;
			
		}
		
		var barChartData = {
			labels: a,
			datasets: [{
				label: 'Marks',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: freqM
			}]

		};
		let ctx4 = document.getElementById('canvas4').getContext('2d');
		window.myBar = new Chart(ctx4, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: false
				}
			}
		});
		
		}
		
	}
	
	xhttp.open("POST", "data.php", true);
	xhttp.send(); 
	
}
//visualizeData();

let getMean = () => {
	
	//marks mean
	if(marks.length == 0){
		
		alert("First visualize the data");
		return false;
		
	}
	
	let sumMarks = 0;
	for(let i=0; i<marks.length;i++){
		
		sumMarks += Number.parseInt(marks[i]);
	
	}
	
	let avgMarks = (sumMarks/marks.length);
	document.getElementById('avgMarks').innerHTML = avgMarks;
	
	if(heights.length == 0){
		
		alert("First visualize the data");
		return false;
		
	}

	let sumHeights = 0;
	for(let i=0; i<heights.length;i++){
		
		sumHeights += Number.parseInt(heights[i]);
		
	}
	
	let avgHeight = (sumHeights/heights.length);
	document.getElementById('avgHeights').innerHTML = avgHeight;

}

let getMedium = () => {
	
	//marks mean
	if(marks.length == 0){
		
		alert("First visualize the data");
		return false;
		
	}
	
	if(heights.length == 0){
		
		alert("First visualize the data");
		return false;
		
	}
	
	let mediumHeight = 0;
	
	let mid = Math.floor(heights.length / 2);
	temp = heights.sort();
	mediumHeight = (heights.length % 2 !== 0) ? temp[mid] : (temp[mid - 1] + temp[mid]) / 2;
	document.getElementById('mediumHeights').innerHTML = mediumHeight;

	mid = Math.floor(marks.length / 2);
	temp = marks.sort();
	let mediumMarks = (marks.length % 2 !== 0) ? temp[mid] : (temp[mid - 1] + temp[mid]) / 2;
	document.getElementById('mediumMarks').innerHTML = mediumMarks;

}

let getMode = () => {
	
	//marks mean
	if(marks.length == 0){
		
		alert("First visualize the data");
		return false;
		
	}
	
	let sumMarks = 0;
	for(let i=0; i<marks.length;i++){
		
		sumMarks += Number.parseInt(marks[i]);
	
	}
	
	let avgMarks = (sumMarks/marks.length);
	document.getElementById('avgMarks').innerHTML = avgMarks;
	
	if(heights.length == 0){
		
		alert("First visualize the data");
		return false;
		
	}

	let sumHeights = 0;
	for(let i=0; i<heights.length;i++){
		
		sumHeights += Number.parseInt(heights[i]);
		
	}
	
	let avgHeight = (sumHeights/heights.length);
	document.getElementById('avgHeights').innerHTML = avgHeight;

}

</script>
</body>