<!DOCTYPE html>
<html lang="en">
<head>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60144229-1', 'auto');
  ga('send', 'pageview');

	</script>
  <meta charset="utf-8">
  <title>CactaCalc - FFXIV Cactpot Solver and Optimizer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A light-weight tool to calculate the best rewards for Final Fantasy XIV's Cactpot minigame">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-select.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">
  
	<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-select.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript">
		//----------------------------------------------
		// Vars
		//----------------------------------------------
		var rewardAmount = [0, 0, 0, 0, 0, 0, // impossible.
			10000, 36,   720, 360,            // 6, 7, 8, 9
			80,    252,	 108, 72,             // 10, 11, 12, 13
			54,    180,	 72,  180,            // 14, 15, 16, 17
			119,   36,   306, 1080,           // 18, 19, 20, 21
			144,   1800, 3600                 // 22, 23, 24
			];
		var rowCombinations = [
			[1, 2, 3],
			[4, 5, 6],
			[7, 8, 9],
			[1, 4, 7],
			[2, 5, 8],
			[3, 6, 9],
			[1, 5, 9],
			[7, 5, 3]
			];	
		var cells = [0];
		var prevResults = [];
		var bestMed = -1;
		var bestMean = -1;
		
		//----------------------------------------------
		// Functions
		//----------------------------------------------
		function setConsoleState(state) {
			$("#console").removeClass().addClass(state);
		}
		
		function setConsoleMessage(msg) {
			$("#console").html(msg);
		}
		
		function swap(arr, a, b) {
			var t = arr[b];
			arr[b] = arr[a];
			arr[a] = t;
		}
		
		function nextPerm(arr) {
			var k = arr.length;
			var i = k - 1;
			while (arr[i-1] >= arr[i]) 
				i--;

			if (i < 1) return false;

			var j = k;
			while (arr[j-1] <= arr[i-1]) 
				j--;

			swap(arr, i - 1, j - 1);

			i++; 
			j = k;

			while (i < j)
			{
				swap(arr, i - 1, j - 1);
				i++;
				j--;
			}

			return true;
		}
		
		function rowToString(arr) {
			var str = "[";
			for (var i = 0; i < arr.length; i++) {
				str += arr[i];
				if (i + 1 < arr.length)
					str += ", ";
			}
			
			return str + "]";
		}
		
		function displayResults(n) {
			doCalculate();
		
			if (bestMed < 0 || bestMean < 0)
				return;
			
			var res = prevResults[n];
			$("#results").html("");
			
			for (i = 1; i <= 9; i++) $(cells[i]).removeClass("ready");
			for (i = 0; i < rowCombinations[n].length; i++) {
				$(cells[rowCombinations[n][i]]).addClass("ready");
			}
				
			$("#results").html("Mean: " + res["mean"] + "\tMedian: " + res["median"] + "\tMode: " + res["mode"] + "\n\n");
			for (i = 0; i < res["chances"].length; i++) {
				$("#results").html($("#results").html() + "\t" + res["chances"][i][0] + ": " + res["chances"][i][2] + "%\n");
			}
		}
		
		function doCalculate() {
			var i, input;
			var numCount = [0, 
				0, 0, 0,
				0, 0, 0, 
				0, 0, 0];
			var freeCells = [];
			var freeNums = [];
			var board = [];
			var results = [];
			for (i = 0; i < rowCombinations.length; i++) results[i] = [];
			
			// Message
			setConsoleMessage("Working...");
			setConsoleMessage("loading");
			
			// Grab all Numbers that are leftover.
			for (i = 1; i <= 9; i++) {
				$(cells[i]).removeClass("ready");
				input = $(cells[i]).children("input[type=text]").first().val();
				if (input.length == 0 || input.trim() == "0") {
					freeCells.push(i);
					continue;
				}
				
				if (isNaN(input) || input != input * 1 || input * 1 < 0 || input * 1 > 9) {
					setConsoleState("error");
					setConsoleMessage("Please enter only numbers between 0 to 9 in each box.");
					return;
				}
				n = input * 1;
				
				board[i] = n;
				numCount[n]++;
				if (numCount[n] > 1) {
					setConsoleState("error");
					setConsoleMessage("Please don't use the same number twice!");
					return;
				}
			}
			
			// Get free numbers.
			for (i = 1; i <= 9; i++) {
				if (numCount[i] == 0)
					freeNums.push(i);
			}
			
			// Check that there aren't too many numbers...
			if (freeNums.length > 6) {
				setConsoleState("error");
				setConsoleMessage("Please fill in a few more numbers!");
				return;
			}
			if (freeNums.length != freeCells.length) {
				setConsoleState("error");
				setConsoleMessage("Missing numbers does not match missing cells!");
				return;
			}
			
			// Do Simulation.
			do {
				// add to board.
				for (i = 0; i < freeCells.length; i++)
					board[freeCells[i]] = freeNums[i];
				
				// run through each row and add the reward they would have got
				for (i = 0; i < rowCombinations.length; i++) {
					var total = 0;
					for (j = 0; j < rowCombinations[i].length; j++) {
						total += board[rowCombinations[i][j]];
					}
					
					results[i].push(rewardAmount[total]);
				}
			} while (nextPerm(freeNums));
			
			// Sort results
			bestMed = -1;
			bestMean = -1;
			var highestMed = 0;
			var highestMean = 0;
			
			for (i = 0; i < results.length; i++) {
				var med = 0;
				var meanTotal = 0.0;
				var mean = 0;
				chances = {};
				
				// median
				results[i].sort(function(a, b) { return a * 1 - b * 1; });
				med = results[i][results[i].length / 2];
				if (med > highestMed) {
					highestMed = med;
					bestMed = i;
				}
				
				// mean calculations
				for (j = 0; j < results[i].length; j++)
					meanTotal += results[i][j];
				mean = meanTotal / results[i].length;
				if (mean > highestMean) {
					highestMean = mean;
					bestMean = i;
				}
				
				// calculate percentages for each number.
				for (j = 0; j < results[i].length; j++) {
					if (chances[results[i][j]] == undefined)
						chances[results[i][j]] = 1;
					else
						chances[results[i][j]]++;
				}
				var nums = [], j = 0;
				for (var k in chances)
					nums[j++] = [k, chances[k]];
				nums.sort(function(a, b) { return b[1] - a[1]; });
				
				// debugging info.
				console.log("Line " + rowToString(rowCombinations[i]) + ": (Median: " + med + ")");
				for (var n in nums) {
					nums[n][2] = nums[n][1] / results[i].length * 100;
					console.log("\t" + nums[n][0] + ": " + nums[n][2] + "%");
				}
				
				// save results
				prevResults[i] = {
					"mode": nums[0][0],
					"median" : med,
					"mean": meanTotal / results[i].length,
					"chances": nums,
					"totalNums": results[i].length
					};
			}
			
			setConsoleMessage("Calculations complete. The highlighted option is your best choice.");
			setConsoleState("ready");
		}
		
		//----------------------------------------------
		// OnLoad Event Handler
		//----------------------------------------------
		$(document).ready(function() {
			var i;
			for (i = 1; i <= 9; i++) {
				cells[i] = document.getElementById(i);
				prevResults[i-1] = {};
			}
			
			// Display Results
			$(".btn-default").click(function() {
				displayResults($(this).data("combination"));
			});
			
			// Calculate Button - OnClick
			$("#calc").click(function() {
				doCalculate();
				displayResults($("#sortType").val() == "mean" ? bestMean : bestMed);
			});
			
			// End DOMReady
			setConsoleMessage("Please enter your Cactpot numbers");
			setConsoleState("ready");
		});
	</script>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="http://cactacalc.com">CactaCalc</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="active">
							<a href="http://cactacalc.com">Home</a>
						</li>
						<li>
							<a href="/faq">FAQ</a>
						</li>
						<li>
							<a href="/credits">Credits</a>
						</li>
						<li>
							<a href="/contact">Contact</a>
						</li>
					</ul>
				</div>
				
			</nav>
			<div class="alert alert-success alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<strong>Heads up!</strong> The <a href="/faq">FAQ</a> should answer most questions including the <strong>best setup</strong>. 
			</div>
			<div class="alert alert-info alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<strong>Hint!</strong> Bookmark me by pressing <strong>Ctrl + D</strong> to find me easily everyday. 
			</div>
			<div class="jumbotron ">
				<h1>Cactpot Solver and Optimizer</h1>
	<div id="console" class="ready">Enter in your numbers!</div>
	<table class="table">
		<tbody>
		<tr>
			<td><input type="button" class="btn btn-default" data-combination="6" value="↘ "></td>
			<td><input type="button" class="btn btn-default" data-combination="3" value="↓ "></td>
			<td><input type="button" class="btn btn-default" data-combination="4" value="↓ "></td>
			<td><input type="button" class="btn btn-default" data-combination="5" value="↓ "></td>
			<td><input type="button" class="btn btn-default" data-combination="7" value="↙"></td>
		</tr>
		<tr>
			<td><input type="button" class="btn btn-default" data-combination="0" value="→ "></td>
			<td id="1" class="slot"><input type="text" class="form-control"></td>
			<td id="2" class="slot"><input type="text" class="form-control"></td>
			<td id="3" class="slot"><input type="text" class="form-control"></td>
			
		</tr>
		<tr>
			<td><input type="button" class="btn btn-default" data-combination="1" value="→ "></td>
			<td id="4" class="slot"><input type="text" class="form-control"></td>
			<td id="5" class="slot"><input type="text" class="form-control"></td>
			<td id="6" class="slot"><input type="text" class="form-control"></td>
			
		</tr>
		<tr>
			<td><input type="button" class="btn btn-default" data-combination="2" value="→ "></td>
			<td id="7" class="slot"><input type="text" class="form-control"></td>
			<td id="8" class="slot"><input type="text" class="form-control"></td>
			<td id="9" class="slot"><input type="text" class="form-control"></td>
			
		</tr>
	</tbody></table>
	<p>
		<select id="sortType" class="form-control selectpicker">
			<option value="mean">Mean</option>
			<option value="median">Median</option>
		</select>
		
		<br/>
		<br/>
		<input type="button" class="btn btn-primary btn-lg center-block" id="calc" value="Calculate">
	</p>
	<br/>
	<pre id="results"></pre>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Responsive Bottom -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9081065499935557"
     data-ad-slot="5937938626"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
			</div>
		</div>
	</div>
</div>
</body>
</html>
