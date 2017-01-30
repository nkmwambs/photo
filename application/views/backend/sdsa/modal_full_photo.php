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
		<div class="panel panel-primary">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('photo');?></div>						
				</div>
										
				<div class="panel-body">
				
					<img src="<?php echo base_url();?>uploads/photos/KE0200/<?php echo $photo['file_name'];?>" alt="" >
					
				</div>
				
				<div class="panel-footer">
					        <div class="btn btn-success btn-icon"><i class="fa fa-thumbs-o-up"></i>Accept</div>
                        	<div class="btn btn-danger btn-icon"><i class="fa fa-close"></i>Reject</div>
				</div>
			
		</div>
	</div>
	
</div>