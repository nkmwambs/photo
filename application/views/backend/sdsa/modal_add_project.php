<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('add_project');?></div>						
				</div>
										
				<div class="panel-body">
					<?php echo form_open(base_url() . 'index.php?sdsa/projects/add_project/' , array('id'=>'frm_profile','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('project_name');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pname" id="pname"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('project_number');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="num" id="num" />
							</div>
						</div>
						
											
						<div class="form-group">
							<button class="btn btn-success btn-icon col-sm-offset-6"><i class="fa fa-plus-square"></i><?php echo get_phrase('add_project');?></button>
						</div>
						
					</form>
				</div>
			</div>
		</div>
</div>