<form method="post" action="upload.php" enctype="multipart/form-data" id="uploadForm">
    <input type="file" name="file" id="file" />
    <input type="submit" name="submit" value="Upload"/>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
function filePreview(input) {
	if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function (e) {
	        // $('#uploadForm + img').remove();
	        // $('#uploadForm').after('<img src="'+e.target.result+'" width="450" height="300"/>');
	        /*If you want to preview all type of file, use <embed> tag instead of <img> tag*/
	        $('#uploadForm + embed').remove();
			$('#uploadForm').after('<embed src="'+e.target.result+'" width="450" height="300">');
	    }
	    reader.readAsDataURL(input.files[0]);
	}
}
$("#file").change(function () {
    filePreview(this);
});
</script>