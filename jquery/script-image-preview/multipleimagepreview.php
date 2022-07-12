</!DOCTYPE html>
<html>
<head>
	<title>Image Preview Thumbnails before upload using jQuery & PHP</title>
	<style>
		.thumb{
			margin: 10px 5px 0 0;
			width: 100px;
		}
	</style>
</head>
<body>
	<h2>Image Preview Thumbnails before upload using jQuery & PHP</h2>
<form>
	<input type="file" id="file-input" multiple />
	<div id="thumb-output"></div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
	$('#file-input').on('change', function(){ //on file input change
		if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
    	{
			$('#thumb-output').html(''); //clear html of output element
			var data = $(this)[0].files; //this file data
			
			$.each(data, function(index, file){ //loop though each file
				if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
					var fRead = new FileReader(); //new filereader
					fRead.onload = (function(file){ //trigger function on successful read
					return function(e) {
						var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
						$('#thumb-output').append(img); //append image to output element
					};
				  	})(file);
					fRead.readAsDataURL(file); //URL representing the file's data.
				}
			});
			
		}else{
			alert("Your browser doesn't support File API!"); //if File API is absent
		}
	});
});
</script>
</body>
</html>