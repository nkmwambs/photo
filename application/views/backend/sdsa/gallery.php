<style>

	ul.gallery {
    clear: both;
    float: left;
    width: 100%;
    margin-bottom: -10px;
    padding-left: 3px;
}
ul.gallery li.item {
    width: 30%;
    height: 215px;
    display: block;
    float: left;
    margin: 0px 15px 55px 0px;
    font-size: 12px;
    font-weight: normal;
    background-color: d3d3d3;
    padding: 10px;
    box-shadow: 10px 10px 5px #888888;
}

.buttons{
	margin-top: 10px;
}

.item img,.details{width: 50%; height: 184px;}

.item .details{padding-left:10px;}

.item p {
    color: #6c6c6c;
    letter-spacing: 1px;
    text-align: center;
    position: relative;
    margin: 5px 0px 0px 0px;
}
.details{
	position: relative;
	float:right;
}



#pagination{
	position: relative;
	padding-top: 40px;
}

ul.tsc_pagination li a
{
	border:solid 1px;
	border-radius:3px;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	padding:6px 9px 6px 9px;
}
ul.tsc_pagination li
{
	padding-bottom:1px;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
	color:#FFFFFF;
	box-shadow:0px 1px #EDEDED;
	-moz-box-shadow:0px 1px #EDEDED;
	-webkit-box-shadow:0px 1px #EDEDED;
}
ul.tsc_pagination
{
	margin:4px 0;
	padding:0px;
	height:100%;
	overflow:hidden;
	font:12px 'Tahoma';
	list-style-type:none;
}
ul.tsc_pagination li
{
	float:left;
	margin:0px;
	padding:0px;
	margin-left:5px;
	
}
ul.tsc_pagination li a
{
	color:black;
	display:block;
	text-decoration:none;
	padding:7px 10px 7px 10px;
}
ul.tsc_pagination li a img
{
	border:none;
}
ul.tsc_pagination li a
{
	color:#0A7EC5;
	border-color:#8DC5E6;
	background:#F8FCFF;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
	text-shadow:0px 1px #388DBE;
	border-color:#3390CA;
	background:#58B0E7;
	background:-moz-linear-gradient(top, #B4F6FF 1px, #63D0FE 1px, #58B0E7);
	background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #B4F6FF), color-stop(0.02, #63D0FE), color-stop(1, #58B0E7));
}

.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
.toggle.ios .toggle-handle { border-radius: 20px; }
  
</style>

<?php


?>

<button data-toggle="collapse" class="btn btn-success" data-target="#panel">Show/ Hide Panel</button>

<hr>

<div id="panel" class="collapse">

        <div class="row">
        	  <div class="col-sm-6">
        	  	<form action="<?php echo base_url();?>index.php?sdsa/search_photo" method="post">
	        		<div class="form-group">
	        		<label class="control-label col-sm-12">Search By ICP</label>
	        		
	        		 	<?php
	            			$projects = $this->db->get_where('projects',array('sdsa'=>$this->session->userdata('login_user_id')))->result_object();
	            		?>
	            	<div class="col-sm-12">
	                    <select class="form-control" name="project"/>
	                    	<option><?php echo get_phrase('select');?></option>
	                    <?php foreach($projects as $opts){?>
	                    	<option value="<?php echo $opts->name;?>" <?php if($opts->name===$this->session->userdata('locate')) echo 'selected';?>><?php echo $opts->name;?></option>
	                    <?php }?>
	                    </select>
	                 </div>   
	        		</div>
	        		
	        		
	        		<div class="form-group">
				        <label class="control-label col-sm-12">Show Status</label>
				        <!--<input type="checkbox" id="rejected_img" data-toggle="toggle" data-size="normal" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" value="0">-->
				         <?php 
				         	$selected = "selected";
							
							if(!isset($select_status)){
								$select_status = $this->session->userdata('status');
							}
				         ?>
				        <div class="col-sm-12">
				        	<select name="status" class="form-control">
				        	  	<option value=""><?php echo get_phrase('select');?></option>
				        	  	<option value="1" <?php if($select_status==='1') echo $selected;?>><?php echo get_phrase('new');?></option>
				        	  	<option value="2" <?php if($select_status==='2') echo $selected;?>><?php echo get_phrase('accepted');?></option>
				        	  	<option value="3" <?php if($select_status==='3') echo $selected;?>><?php echo get_phrase('rejected');?></option>
				        	  	<option value="4" <?php if($select_status==='4') echo $selected;?>><?php echo get_phrase('reinstated');?></option>
				      		</select>
				      </div>
	        		
	        		<div class="form-group">
	                   <div class="col-sm-12">
	                   	 <input class="form-control btn btn-primary" type="submit" name="search" value="Search"/>
	                   </div>
	                </div>
	        	</form>
	        </div>		
        	</div>
        	  
        	  <div class="col-sm-6">
        	  	
        	  	<div class="row">
        	  		
        	  	<div class="col-sm-6">
        	  		<label class="control-label">Select Photos</label>
        	  		<input type="checkbox" id="select_img" data-toggle="toggle" data-size="normal" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" value="0">
        	  	</div>
        	  	
        	  	<div class="col-sm-6">
        	  		<!--<div id="download_all" class="btn btn-blue btn-icon"><i class="fa fa-download"></i>Action</div>-->
        	  		
        	  		<div class="btn-group">
			                    <button id="" style="width: 100px;" type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown">
			                        Action <span class="caret"></span>
			                    </button>
			                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
	
			                        <!-- Add Sub Account -->
			                        <li>
			                        	<a href="#" id="accept_all" class="mass_action">
			                            	<i class="fa fa-check"></i>
												<?php echo get_phrase('accept_all');?>
			                               	</a>
			                        </li>
			                        <li class="divider"></li>

									
			                        <!--Edit Category -->
			                        <li>
			                        	<a href="#" id="reject_all"  class="mass_action">
			                            	<i class="fa fa-close"></i>
												<?php echo get_phrase('reject_all');?>
			                               	</a>
			                       	</li>
			                       	
									<li class="divider"></li>
												                       	
			                       	<!--Edit Category -->
			                        <li>
			                        	<a href="<?php echo base_url();?>index.php?sdsa/download_all/KE0200/1" id="download_all"  class="mass_action">
			                            	<i class="fa fa-download"></i>
												<?php echo get_phrase('download_all');?>
			                               	</a>
			                       	</li>
			                       	
			                     	
			                     </ul>
			                     </div>
        	  		
        	  		
        	  		
        	  	</div>
        	  	
        	  	</div>
        	  	
        	  	<hr>
        	  	
		        <div class="row">
		        	<!--Empty Row-->
		        </div>
        	  	
        	  	
        	  </div>
        </div>
        
        

        
       </div> 
        <!-- Panel End-->
        
        <hr>
        
        <div class="row">
        <div class="col-sm-12">
        	 <?php 
        		if(!empty($results)): 
			?>
        	<div class="row" style="font-weight: bolder;">
        		<div class="well well-sm"><?php echo $project_num.' : '.ucfirst($this->db->get_where('status',array('status_id'=>$this->session->userdata('status')))->row()->name).' '.get_phrase('photos');?></div>
        	</div>
            <div class="row">
                <ul class="gallery">
                 	<?php 
                 		foreach($results as $file):
                 	?>
                 
                    <li class="item">
                    	<?php
							$file_path = base_url().'uploads/photos/'.$project_num.'/'.$file->file_name;
							$image = getimagesize($file_path);
							$type = explode("/",$image['mime']);
							$file_name = basename(base_url().'uploads/photos/'.$project_num.'/'.$file->file_name);
						?>
                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_full_photo/<?php echo $file->id;?>');"><img src="<?php echo base_url();?>uploads/photos/<?php echo $project_num;?>/<?php echo $file->file_name;?>" alt="" ></a>
                        	<div class="details">
                        		<caption><u>Details</u></caption><br>
                        		
                        			<?php echo get_phrase('Width');?>:<?php echo $image['0'];?><br>
                        			<?php echo get_phrase('Height');?>:<?php echo $image['1'];?><br>
                        			<?php echo get_phrase('Type');?>:<?php echo $type['1'];?><br>
                        			<?php echo get_phrase('File');?>:<?php $filename = explode('.', $file_name); echo $filename['0'];?>
                        		
                        	</div>
                        	<p>Uploaded On <?php echo date("j M Y",strtotime($file->created)); ?></p>                        
                        <div class="buttons">
                        	<input style="width: 20px;" class="form-control pull-left get_img" type="checkbox"/> 
                        	<div class="btn btn-success btn-icon"  onclick="return accept_photo('<?php echo $file->id;?>');"><i class="fa fa-thumbs-o-up"></i>Accept</div>
                        	<?php
                        		if($this->session->userdata('status')==='3'){
                        	?>
                        		<div class="btn btn-info btn-icon" onclick="return reinstate_photo('<?php echo $file->id;?>');"><i class="fa fa-refresh"></i><?php echo get_phrase('reinstate');?></div>
                        	<?php
                        		}else{
                        	?>
                        		<div class="btn btn-danger btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_reject_reason/<?php echo $file->id;?>')"><i class="fa fa-close"></i>Reject</div>
                        	<?php		
                        		}
                        	?>
                        	
                    		<a href="<?php echo base_url();?>index.php?sdsa/download/<?php echo $file->id;?>" class=" btn fa fa-download"></a>
                    	</div>
                    </li>
                    
                    <?php endforeach;?>

						<div class="row">
				           <div  id="pagination">
								<ul class="tsc_pagination">
									
								<?php //echo $link_raw;?>
											
								<!-- Show pagination links -->
								<?php foreach ($links as $link) {
								echo "<li>". $link."</li>";
								} ?>
								
								</ul>
							</div>
			            </div>


                    <?php else: ?>
                    <div class="well well-sm">File(s) not found.....</div>
                    
                </ul>
            </div>
            
			<?php endif; ?>

        </div>
    </div>


<script>
	$(function() {
	    $('#select_img').change(function() {
	      
	      if($(this).prop('checked')){
		      	$('.get_img').prop('checked',true);	
	      }else{
	      	$('.get_img').prop('checked',false);	
	      }
	      
	    })
	  })
	  
	  $('#rejected_img').change(function() {
	      if($(this).prop('checked')){
		      	//$('.get_img').prop('checked',true);	
		      	alert('Function not available');
	      }else{
	      		//$('.get_img').prop('checked',false);
	      		alert('Function not available');	
	      }	  	
	  	
	  });
	  
	 $('.mass_action').click(function(){
	 	
	 	var msg = "";
	 	
	 	if($('input.get_img:checked').length>0){
	 		msg = 'Are you sure you want to perform this action on the selected images?';
	 	}else{
	 		msg = 'Please select a photo first';
	 	}
	 	
	 		BootstrapDialog.show({
		           title:'<?php echo get_phrase('confirm');?>',
				   message: msg,
				   draggable: true
			});
	 });
	 
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
	 
	function reinstate_photo(id){
	 	var url = '<?php echo base_url();?>index.php?sdsa/reinstate_photo/'+id;
	 	$.ajax({
	 		url:url,
	 		success:function(){
	 			
	 			window.location.reload();
	 			alert('Photo Reinstated');
	 		},
	 		error:function(errorCode,error,msg){
	 			alert(msg);
	 		}
	 	});
	 }
	 

	 
</script>