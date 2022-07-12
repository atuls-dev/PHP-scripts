<pre>
<form id="form1" method="POST" action="testimage2.php" enctype="multipart/form-data">
    
    <input onchange="readURL(this);" type="file" name="File"/>
    <img alt="Image Display Here" id="test" width="300px" src="#" />
    <input type="submit" name="submit" value="send"/>
</form>
</pre>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

   function readURL(input) {

        var file = input.files[0];
        console.log(file);
        var fileType = file["type"];
        var validImageTypes = ["image/gif", "image/jpeg", "image/png", "image/jpg",];
        if ($.inArray(fileType, validImageTypes) < 0) {
            alert('Invalid file type only image accepted');
        }else{

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#test').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

      }

    }
</script>
<script>
 
</script>

