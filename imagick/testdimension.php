<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style>
	body {
		padding:  0;
		margin:  0;
	}
	.divMain {
		margin-top: 50px;
	    width: 200px;
	    height: 200px;
	    position: relative;
	    background: grey;
	}
	.span-price {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
	<div class="divMain">
	<!-- 	<img src="background1.jpg" width="300px" height="300px" > -->
		<span class="span-price">45</span>
	</div>

	<button onclick="positionTest();"> Click </button>
	<script>
		$( ".span-price" ).draggable({
		  	//containment: "parent"
		    //axis: "x",
    	 	containment: ".divMain"
		});

		function positionTest() {
			let tbg = $('.span-price').position();
			console.log(tbg);
		}
	</script>
</body>
</html>
