$(function () {
	$('#fileupload').fileupload({
		dataType: 'json',

		// start uploading
		send: function (e, data) {

			// first disable upload button
			$("#fileupload").prop('disabled', true);
			
			// display loading icon and text
			$('#hex_text').css("color", "");
			$('#hex_text').text("loading...");				
			$('#hex_icon').attr("src", "../img/working.gif");
		},

		// upload completed
		done: function (e, data) {

			// display done icon and text
			$('#hex_text').text("loaded :)");
			$('#hex_text').css("color", "green");			
			$('#hex_icon').attr("src", "../img/ok.png");

			// call next step
			merge_with_bootloader(data.result.files[0].name);
		},
		
		// error during upload
		fail: function (e, data) {

			// display ko icon and text
			$('#hex_text').text("error :(");
			$('#hex_text').css("color", "red");
			$('#hex_icon').attr("src", "../img/ko.png");
			
			// enable upload button
			$("#fileupload").prop('disabled', false);
		}		
	});
});

function merge_with_bootloader(filename) {
	
	// display working icon and text
	$('#merge_text').text("working");
	$('#merge_text').css("color", "");
	$('#merge_icon').attr("src", "../img/working.gif");

	// call php page
	$.getJSON("ws.php?action=MERGE&filename=" + filename, function(data) {
		
		//operation successful
		if(data.returncode == 0) {
			
			// display done icon and text
			$('#merge_text').text("merged :)");
			$('#merge_text').css("color", "green");
			$('#merge_icon').attr("src", "../img/ok.png");
			
			// call next step
			upload(filename);
		}
		
		// error
		else {
		
			// display ko icon and text
			$('#merge_text').text("error :(");
			$('#merge_text').css("color", "red");
			$('#merge_icon').attr("src", "../img/ko.png");
			
			// enable upload button
			$("#fileupload").prop('disabled', false);
		}
	})
	
	// JSON request failed
	.fail(function(jqXHR, textStatus, errorThrown) {

		// display ko icon and text
		$('#merge_text').text("error :(");
		$('#merge_text').css("color", "red");
		$('#merge_icon').attr("src", "../img/ko.png");
		
		// enable upload button
		$("#fileupload").prop('disabled', false);	
	});
}

function upload(filename) {
	
	// display working icon and text
	$('#upload_text').text("working");
	$('#upload_text').css("color", "");
	$('#upload_icon').attr("src", "../img/working.gif");

	// call php page
	$.getJSON("ws.php?action=UPLOAD&filename=" + filename, function(data) {
		
		//operation successful
		if(data.returncode == 0) {
			
			// display done icon and text
			$('#upload_text').text("uploaded :)");
			$('#upload_text').css("color", "green");
			$('#upload_icon').attr("src", "../img/ok.png");
		}
		
		// error
		else {
		
			// display ko icon and text
			$('#upload_text').text("error :(");
			$('#upload_text').css("color", "red");
			$('#upload_icon').attr("src", "../img/ko.png");
			
			// enable upload button
			$("#fileupload").prop('disabled', false);
		}
	})
	
	// JSON request failed
	.fail(function(jqXHR, textStatus, errorThrown) {

		// display ko icon and text
		$('#upload_text').text("error :(");
		$('#upload_text').css("color", "red");
		$('#upload_icon').attr("src", "../img/ko.png");
	});

	// enable upload button
	$("#fileupload").prop('disabled', false);
	
	// make a call to delete the uploaded file, not blocking (the upload function is able to rename the file if a previous one exists)
	deletefile(filename);
}

function deletefile(filename) {

	$.getJSON("ws.php?action=DELETE&filename=" + filename);
}
