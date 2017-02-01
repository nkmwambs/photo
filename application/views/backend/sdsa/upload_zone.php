<div class="row">

	<form id="myDropZone" action="<?php echo base_url();?>index.php?sdsa/upload_photo" class="dropzone"  >
	</form>
	
</div>

<script>
	$(document).ready(function(){
		Dropzone.options.myDropZone = {
		  paramName: "file",
		  //maxFilesize: 1,
		  addRemoveLinks:true,
		  dictRemoveFile:'Delete Photo',
		  dictDefaultMessage: '<?php echo get_phrase('drag_an_image_here_to_upload,_or_click_to_select_one');?>',
		  acceptedFiles: 'image/jpeg,image/jpg',
		  init: function() {
		    this.on('success', function( file, resp ){
				this.removeFile(file);
		    });
		    this.on('thumbnail', function(file) {
		      if ( file.width < 800 || file.height < 1200 ) {
		        file.rejectDimensions();
		      }
		      else {
		        file.acceptDimensions();
		      }
		    });
		  },
		  accept: function(file, done) {
		    file.acceptDimensions = done;
		    file.rejectDimensions = function() {
		      done('The image must be at least 800 x 1200px')
		    };
		  }
		};
		  
	});
</script>