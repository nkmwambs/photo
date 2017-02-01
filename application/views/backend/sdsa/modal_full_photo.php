<?php
$photo = $this->file->getRows($param2);
?>
<style>
	img {

    width:100%;
    height:100%;
}
</style>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('photo');?></div>						
				</div>
										
				<div class="panel-body">
				
					<img src="<?php echo base_url();?>uploads/photos/<?php echo $photo['group'];?>/<?php echo $photo['file_name'];?>" alt="" >
					
				</div>
				
				<div class="panel-footer">
						<?php
							if($photo['status']==='1' || $photo['status']==='4'){
						?>
					        <div class="btn btn-success btn-icon" onclick="return accept_photo('<?php echo $param2;?>');"><i class="fa fa-thumbs-o-up"></i>Accept</div>
                        	<div class="btn btn-danger btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_reject_reason/<?php echo $param2;?>')"><i class="fa fa-close"></i>Reject</div>
                        	
						<?php
							}elseif($photo['status']==='2'){
								
						?>
							<div class="btn btn-danger btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_reject_reason/<?php echo $param2;?>')"><i class="fa fa-close"></i>Reject</div>
								
						<?php		
							}elseif($photo['status']==='3'){
						?>		
							<div class="btn btn-success btn-icon" onclick="return accept_photo('<?php echo $param2;?>');"><i class="fa fa-thumbs-o-up"></i>Accept</div>
						<?php		
							}
						?>
				</div>
			
		</div>
	</div>
	
</div>

<script>
	function accept_photo(id){
	 	var url = '<?php echo base_url();?>index.php?sdsa/accept_photo/'+id;
	 	$.ajax({
	 		url:url,
	 		success:function(){
	 			
	 			window.location.reload();
	 			alert('Photo Accepted');
	 		},
	 		error:function(errorCode,error,msg){
	 			alert(msg);
	 		}
	 	});
	 }
</script>