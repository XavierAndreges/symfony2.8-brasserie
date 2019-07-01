var urlRelative = "/symfony2Brasserie/web/";
var allowedTypes = ['png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF'];
var files;


$('input[type="file"]').on('change', function() {

	$(".fileUpload_remove").remove();

    files = this.files;
    var filesLen = files.length;
    var imgType;

    console.log("this.files : ");
	console.log(this.files);

    for (var i = 0; i < filesLen; i++) {

        imgType = files[i].name.split('.');
        imgType = imgType[imgType.length - 1];

        if (allowedTypes.indexOf(imgType) != -1) {
            createThumbnail(files[i], i);
        }

	}


    function createThumbnail(file, i) {

    	var newLink = '<a class="delete_file fileUpload_remove" id="fileUpload_' + i + '" href="javascript: fileUpload_remove_from_form(' + i + ')" onclick="return confirm(\'are u sure?\')">' + 
                		'<img src="' + urlRelative + 'assets/close.png" class="close_cross" />' +
                		'<img src="" class="image absoluteIndex" id="image_' + i + '" />' +
                	'</a>';


        $('#block_image').append(newLink);

        var reader = new FileReader();

        reader.addEventListener('load', function() {

            var imgElement = document.querySelector('#image_' + i);
            imgElement.src = this.result;

        });

        reader.readAsDataURL(file);
    }
});


function fileUpload_remove_from_form (i) {

	//$("#fileUpload_" + i).remove();

	$(".fileUpload_remove").remove();

	$('input[type="file"]').val("");

}


function file_delete(_id) {

/*
	var url = "{{ path('file_delete', {'id': '_id' }) }}";
	url = url.replace("_id", _id);
*/

    var target = document.getElementById("file_" + _id);
    var spinner = new Spinner().spin(target);

    url = urlRelative + "app_dev.php/file/" + _id + "/delete";

	$.ajax({
        url: url,
        success: function (data) {
            $("#file_" + _id).remove();
            spinner.stop();
        }
    });    
}