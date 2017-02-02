<?php
$user = $this->db->get_where('users',array('users_id'=>$this->session->userdata('login_user_id')))->row();
?>
<div class="row">
	<div class="col-xs-12">
		
		
		    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#update_profile" data-toggle="tab"><i class="fa fa-user"></i> 
					<?php echo get_phrase('update_profile');?>
                    	</a>
            </li>
			
			<li class="">
            	<a href="#manage_users" data-toggle="tab"><i class="fa fa-users"></i> 
					<?php echo get_phrase('manage_users');?>
                    	</a>
            </li>
            
            <li class="">
            	<a href="#projects" data-toggle="tab"><i class="fa fa-bullseye"></i> 
					<?php echo get_phrase('projects');?>
                    	</a>
            </li>
            
        </ul>    
        
        
       	<div class="tab-content">
        <!----EDITING FORM STARTS---->
		<div class="tab-pane box active" id="update_profile" style="padding: 5px">
				
				
		
		<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('update_profile');?></div>						
				</div>
										
				<div class="panel-body">
					<?php echo form_open(base_url() . 'index.php?sdsa/manage_profile/update/'.$this->session->userdata('login_user_id') , array('id'=>'frm_profile','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>	
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('full_name');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="fname" id="fname" value="<?php echo $user->name;?>"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('email');?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" readonly="readonly" name="email" id="email" value="<?php echo $user->email;?>" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('level');?></label>
							<div class="col-sm-8">
								<!--<input type="text" class="form-control" name="level" id="level"  value="<?php echo $user->level;?>"/>-->
								<select class="form-control" name="level" id="level">
									<option value=""><?php echo get_phrase('select');?></option>
									<option value="1" <?php if($user->level==='1') echo 'selected';?>><?php echo get_phrase('administrator');?></option>
									<option value="2" <?php if($user->level==='2') echo 'selected';?>><?php echo get_phrase('sdsa');?></option>
									<option value="3" <?php if($user->level==='3') echo 'selected';?>><?php echo get_phrase('facilitator');?></option>
									<option value="4" <?php if($user->level==='4') echo 'selected';?>><?php echo get_phrase('project');?></option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('password');?></label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="" id="" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4"><?php echo get_phrase('confirm_password');?></label>
							<div class="col-sm-8">
								<input type="password" class="form-control" name="password" id="password" />
							</div>
						</div>
						
						<div class="form-group">
							<button class="btn btn-success btn-icon col-sm-offset-6"><i class="fa fa-save"></i><?php echo get_phrase('save');?></button>
						</div>
						
					</form>
				</div>

		</div>
		
		</div>
		
		
		<div class="tab-pane box" id="manage_users" style="padding: 5px">


		<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('manage_users');?></div>						
				</div>
										
				<div class="panel-body">
					<div class="btn btn-success btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_user')"><i class="fa fa-plus-circle"></i><?php echo get_phrase('add_user');?></div>
					<hr>
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th><?php echo get_phrase('action');?></th>
								<th><?php echo get_phrase('full_name');?></th>
								<th><?php echo get_phrase('email');?></th>
								<th><?php echo get_phrase('level');?></th>
								<th><?php echo get_phrase('linked_projects');?></th>
							</tr>
						</thead>
						<?php
							$users = $this->db->get('users')->result_object();
						?>
						<tbody>
						<?php
							foreach($users as $rows):
						?>
							<tr>
								<td>
									
								<div class="btn-group">
			                    <button id="" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
			                        Action <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
			                        
			                        <!-- Edit -->
			                        <li>
			                        	<a href="#" id="" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_user/<?php echo $rows->users_id;?>');">
			                            	<i class="entypo-pencil"></i>
												<?php echo get_phrase('edit');?>
			                               	</a>
			                        </li>
			                        <li class="divider"></li>
			                        
			                        <!-- Link -->
			                        
			                        <li>
			                        	<a href="#" id="" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_link_project/<?php echo $rows->users_id;?>');">
			                            	<i class="fa fa-link"></i>
												<?php echo get_phrase('link');?>
			                               	</a>
			                        </li>
			                        
			                        <li class="divider"></li> 
			                        <!--Delete -->
			                        <li>
			                        	<a href="#" id="" onclick="confirm_modal('<?php echo base_url();?>index.php?sdsa/manage_profile/delete/<?php echo $rows->level;?>/<?php echo $rows->users_id;?>');">
			                            	<i class="glyphicon glyphicon-edit"></i>
												<?php echo get_phrase('delete');?>
			                               	</a>
			                       	</li>
			                     	
			                     				                       	
			                     	
			                     </ul>
			                     </div>
									
								</td>
								<td><?php echo $rows->name;?></td>
								<td><?php echo $rows->email;?></td>
								<?php
									$levels = array('None','administrator','sdsa','facilitator','user');
								?>
								<td><?php echo ucfirst($levels[$rows->level]);?></td>
								<?php
									$linkages = 0;
									if($rows->level == '2'){
										$linkages = $this->db->get_where('projects',array($levels[2]=>$rows->users_id))->num_rows();
									}
									if($rows->level == '3'){
										$linkages = $this->db->get_where('projects',array($levels[3]=>$rows->users_id))->num_rows();
									}
									if($rows->level == '4'){
										$linkages = $this->db->get_where('projects',array($levels[4]=>$rows->users_id))->num_rows();
									}
									
									
									
								?>
								<td><a href="#" class="btn" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_list_projects/<?php echo $levels[$rows->level];?>/<?php echo $rows->users_id;?>')"><?php echo $linkages;?></a></td>
							</tr>
						<?php
							endforeach;
						?>
							
						</tbody>
					</table>
				</div>
		</div>
	</div>

<div class="tab-pane box" id="projects" style="padding: 5px">

		<div class="panel panel-info">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('projects');?></div>						
				</div>
										
				<div class="panel-body">
					
				<div class="btn btn-success btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_project')"><i class="fa fa-plus-square-o"></i><?php echo get_phrase('add_project');?></div>
					
				<hr>
					
						<table class="table table-striped">
							<thead>
								<tr>
									<th><?php echo get_phrase('action');?></th>
									<th><?php echo get_phrase('project_name');?></th>
									<th><?php echo get_phrase('project_number');?></th>
									<th><?php echo get_phrase('linked_sdsa');?></th>
									<th><?php echo get_phrase('linked_facilitator');?></th>
								</tr>
							</thead>
							<?php
								$projects = $this->db->get_where('projects')->result_object();
							?>
							<tbody>
								<?php
									foreach($projects as $rows):
								?>
									<tr>
										<td>
											<div class="btn-group">
						                    <button id="" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						                        Action <span class="caret"></span>
						                    </button>
						                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                        
						                        <!-- Edit -->
						                        <li>
						                        	<a href="#" id="" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_project/<?php echo $rows->projects_id;?>');">
						                            	<i class="entypo-pencil"></i>
															<?php echo get_phrase('edit');?>
						                               	</a>
						                        </li>
						                        
						                        <li class="divider"></li>
						                        
						                        <!--Delete -->
						                        <li>
						                        	<a href="#" id="" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_links/<?php echo $rows->projects_id;?>');">
						                            	<i class="fa fa-archive"></i>
															<?php echo get_phrase('remove_links');?>
						                               	</a>
						                       	</li>
						                       	
						                        <li class="divider"></li>
						                        
						                        
						                        <!--Delete -->
						                        <li>
						                        	<a href="#" id="" onclick="confirm_modal('<?php echo base_url();?>index.php?sdsa/projects/delete/<?php echo $rows->projects_id;?>');">
						                            	<i class="glyphicon glyphicon-edit"></i>
															<?php echo get_phrase('delete');?>
						                               	</a>
						                       	</li>
						                     	
						                     				                       	
						                     	
						                     </ul>
						                     </div>
										</td>
										<td><?php echo $rows->name;?></td>
										<td><?php echo $rows->num;?></td>
										<td><?php echo $this->db->get_where('users',array('users_id'=>$rows->sdsa))->row()->name;?></td>
										<td><?php echo $this->db->get_where('users',array('users_id'=>$rows->facilitator))->row()->name;?></td>
									</tr>
								<?php
									endforeach;
								?>
								
							</tbody>
						</table>
				
				</div>
		</div>
	</div>
</div>

</div>

</div>


					