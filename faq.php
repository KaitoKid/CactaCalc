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
  <title>CactaCalc - Cactpot Solver and Optimizer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
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
  
	<script type="text/javascript" src="/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap-select.js"></script>
	<script type="text/javascript" src="/js/scripts.js"></script>
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
						<li>
							<a href="http://cactacalc.com">Home</a>
						</li>
						<li class="active">
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
					<strong>Got another question?</strong> Drop us a message in the <a href="/contact">contact form</a>. 
			</div>
			<div class="page-header">
					<div class="col-md-12">
						<h1>FAQ <small>CactaCalc Frequently Asked Questions</small></h1>
					</div>
			</div>
	<div class="panel-group" id="accordion">
        <div class="faqHeader">General questions</div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">What is CactaCalc?</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    CactaCalc helps you choose the best option for your Cactopot lottery. 
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">What is Cactopot?</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
					<strong>Cactpot</strong> is a game that puts numbers 1 to 9 placed on a 3x3 grid, similar to TicTacToe. The goal of the game is to pick one line (horizontal, vertical or diagonal), and the total of the numbers placed on it will result in a prize referring to the list on the right.<br/><br/>
					So if you pick a line that has 4 8 9, the total is 21.<br/><br/>
					To help you pick a line without relying 100% on luck, one of the number is revealed for you, and then you get to <strong>scratch</strong> 3 more, meaning that 4 numbers will be visible, and 5 will be hidden. The numbers showing will not affect the line you choose in the end. <br/><br/>
					The biggest prize is if you manage to get a line with 1-2-3 on it, which of course the chances are relatively low most of the time, as if they are on different lines the chances are 0%. But you can still attempt to get decent prizes in the thousand. <br/><br/>
					So to use this solver, you start a Cactpot game as usual, choose the 3 numbers to reveal, and then input all 4 visible numbers in the Solver you downloaded here. Then you press <strong>calculate</strong>. The numbers that show next to the arrows for each line give you your chances of winning. That is, the higher the number, the better your chances. <br/><br/>
					But as in any RNG game, this is only probabilities. Even if you pick the highest chances line, it doesn't mean you will get the best prizes everytime. RNG is RNG after all, but you can at least <strong>pinpoint which line has the highest chances for you.</strong> <br/><br/>
					Source: <a href="http://www.reddit.com/user/FranckKnight">FranckKnight</a>
                </div>
            </div>
        </div>
		<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Should I use the mean or the median?</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
					Without going into the specifics, use the <strong>mean</strong> which is the default. I'm going to have to write a more detailed explanation in the future regarding this.
                </div>
            </div>
        </div>
		
		<div class="panel panel-default">
		<div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">How does this work?</a>
                </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse">
                <div class="panel-body">
					The main work for this game is generating the possible <strong>permutations</strong> that the game board can end up as. <br/><br/>
					With only 9 possible numbers, there are 362,880 possible game boards (a far cry from sudoku). Even on an old computer, you could go through all 362,880 combinations in less than a second.<br/><br/>
					So what you do is get the remaining numbers which are not being used, lets say [1, 2, 3]. This means there should be 3 empty slots on the board. You generate all the possible permutations of [1, 2, 3] such as [1, 3, 2], [2, 1, 3], [2, 3, 1], [3, 1, 2] and [3, 2, 1]. Then you place them in these "empty slots" to generate a possible game board. You then add up the lines and and work out how much each line will win.
                </div>
            </div>
		</div>
		
		<div class="faqHeader">How to Play</div>
		<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Which numbers should I scratch?</a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
					Choose a diagonal and 1 corner for the best results. It does not matter which diagonal or corner. Here's an example:
					<div class="view">
					<img alt="719x361" src="http://i.imgur.com/uFIXmCO.png">
					</div>
                </div>
            </div>
		</div>
		<div class="panel panel-default">		
			<div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">What do the numbers mean?</a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
                <div class="panel-body">
					The large numbers are the estimated MGP reward that you will receive while the <strong>"x%"</strong> is your percent chance of receiving the reward.
                </div>
            </div>
			
        </div>
    </div>
			
		</div>
	</div>
</div>
</body>
</html>
