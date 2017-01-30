<style>

/* The MIT License */
.dropzone,
.dropzone *,
.dropzone-previews,
.dropzone-previews * {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.dropzone {
  position: relative;
  border: 1px solid rgba(0,0,0,0.08);
  background: rgba(0,0,0,0.02);
  padding: 1em;
}
.dropzone.dz-clickable {
  cursor: pointer;
}
.dropzone.dz-clickable .dz-message,
.dropzone.dz-clickable .dz-message span {
  cursor: pointer;
}
.dropzone.dz-clickable * {
  cursor: default;
}
.dropzone .dz-message {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.dropzone.dz-drag-hover {
  border-color: rgba(0,0,0,0.15);
  background: rgba(0,0,0,0.04);
}
.dropzone.dz-started .dz-message {
  display: none;
}
.dropzone .dz-preview,
.dropzone-previews .dz-preview {
  background: rgba(255,255,255,0.8);
  position: relative;
  display: inline-block;
  margin: 17px;
  vertical-align: top;
  border: 1px solid #acacac;
  padding: 6px 6px 6px 6px;
}
.dropzone .dz-preview.dz-file-preview [data-dz-thumbnail],
.dropzone-previews .dz-preview.dz-file-preview [data-dz-thumbnail] {
  display: none;
}
.dropzone .dz-preview .dz-details,
.dropzone-previews .dz-preview .dz-details {
  width: 100px;
  height: 100px;
  position: relative;
  background: #ebebeb;
  padding: 5px;
  margin-bottom: 22px;
}
.dropzone .dz-preview .dz-details .dz-filename,
.dropzone-previews .dz-preview .dz-details .dz-filename {
  overflow: hidden;
  height: 100%;
}
.dropzone .dz-preview .dz-details img,
.dropzone-previews .dz-preview .dz-details img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100px;
  height: 100px;
}
.dropzone .dz-preview .dz-details .dz-size,
.dropzone-previews .dz-preview .dz-details .dz-size {
  position: absolute;
  bottom: -28px;
  left: 3px;
  height: 28px;
  line-height: 28px;
}
.dropzone .dz-preview.dz-error .dz-error-mark,
.dropzone-previews .dz-preview.dz-error .dz-error-mark {
  display: block;
}
.dropzone .dz-preview.dz-success .dz-success-mark,
.dropzone-previews .dz-preview.dz-success .dz-success-mark {
  display: block;
}
.dropzone .dz-preview:hover .dz-details img,
.dropzone-previews .dz-preview:hover .dz-details img {
  display: none;
}
.dropzone .dz-preview .dz-success-mark,
.dropzone-previews .dz-preview .dz-success-mark,
.dropzone .dz-preview .dz-error-mark,
.dropzone-previews .dz-preview .dz-error-mark {
  display: none;
  position: absolute;
  width: 40px;
  height: 40px;
  font-size: 30px;
  text-align: center;
  right: -10px;
  top: -10px;
}
.dropzone .dz-preview .dz-success-mark,
.dropzone-previews .dz-preview .dz-success-mark {
  color: #8cc657;
}
.dropzone .dz-preview .dz-error-mark,
.dropzone-previews .dz-preview .dz-error-mark {
  color: #ee162d;
}
.dropzone .dz-preview .dz-progress,
.dropzone-previews .dz-preview .dz-progress {
  position: absolute;
  top: 100px;
  left: 6px;
  right: 6px;
  height: 6px;
  background: #d7d7d7;
  display: none;
}
.dropzone .dz-preview .dz-progress .dz-upload,
.dropzone-previews .dz-preview .dz-progress .dz-upload {
  display: block;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 0%;
  background-color: #8cc657;
}
.dropzone .dz-preview.dz-processing .dz-progress,
.dropzone-previews .dz-preview.dz-processing .dz-progress {
  display: block;
}
.dropzone .dz-preview .dz-error-message,
.dropzone-previews .dz-preview .dz-error-message {
  display: none;
  position: absolute;
  top: -5px;
  left: -20px;
  background: rgba(245,245,245,0.8);
  padding: 8px 10px;
  color: #800;
  min-width: 140px;
  max-width: 500px;
  z-index: 500;
}
.dropzone .dz-preview:hover.dz-error .dz-error-message,
.dropzone-previews .dz-preview:hover.dz-error .dz-error-message {
  display: block;
}
.dropzone {
  border: 1px solid rgba(0,0,0,0.03);
  min-height: 360px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  background: rgba(0,0,0,0.03);
  padding: 23px;
}
.dropzone .dz-default.dz-message {
  opacity: 1;
  -ms-filter: none;
  filter: none;
  -webkit-transition: opacity 0.3s ease-in-out;
  -moz-transition: opacity 0.3s ease-in-out;
  -o-transition: opacity 0.3s ease-in-out;
  -ms-transition: opacity 0.3s ease-in-out;
  transition: opacity 0.3s ease-in-out;
  background-image: url("../images/spritemap.png");
  background-repeat: no-repeat;
  background-position: 0 0;
  position: absolute;
  width: 428px;
  height: 123px;
  margin-left: -214px;
  margin-top: -61.5px;
  top: 50%;
  left: 50%;
}
@media all and (-webkit-min-device-pixel-ratio:1.5),(min--moz-device-pixel-ratio:1.5),(-o-min-device-pixel-ratio:1.5/1),(min-device-pixel-ratio:1.5),(min-resolution:138dpi),(min-resolution:1.5dppx) {
  .dropzone .dz-default.dz-message {
    background-image: url("../images/spritemap@2x.png");
    -webkit-background-size: 428px 406px;
    -moz-background-size: 428px 406px;
    background-size: 428px 406px;
  }
}
.dropzone .dz-default.dz-message span {
  display: none;
}
.dropzone.dz-square .dz-default.dz-message {
  background-position: 0 -123px;
  width: 268px;
  margin-left: -134px;
  height: 174px;
  margin-top: -87px;
}
.dropzone.dz-drag-hover .dz-message {
  opacity: 0.15;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=15)";
  filter: alpha(opacity=15);
}
.dropzone.dz-started .dz-message {
  display: block;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.dropzone .dz-preview,
.dropzone-previews .dz-preview {
  -webkit-box-shadow: 1px 1px 4px rgba(0,0,0,0.16);
  box-shadow: 1px 1px 4px rgba(0,0,0,0.16);
  font-size: 14px;
}
.dropzone .dz-preview.dz-image-preview:hover .dz-details img,
.dropzone-previews .dz-preview.dz-image-preview:hover .dz-details img {
  display: block;
  opacity: 0.1;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=10)";
  filter: alpha(opacity=10);
}
.dropzone .dz-preview.dz-success .dz-success-mark,
.dropzone-previews .dz-preview.dz-success .dz-success-mark {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.dropzone .dz-preview.dz-error .dz-error-mark,
.dropzone-previews .dz-preview.dz-error .dz-error-mark {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.dropzone .dz-preview.dz-error .dz-progress .dz-upload,
.dropzone-previews .dz-preview.dz-error .dz-progress .dz-upload {
  background: #ee1e2d;
}
.dropzone .dz-preview .dz-error-mark,
.dropzone-previews .dz-preview .dz-error-mark,
.dropzone .dz-preview .dz-success-mark,
.dropzone-previews .dz-preview .dz-success-mark {
  display: block;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: opacity 0.4s ease-in-out;
  -moz-transition: opacity 0.4s ease-in-out;
  -o-transition: opacity 0.4s ease-in-out;
  -ms-transition: opacity 0.4s ease-in-out;
  transition: opacity 0.4s ease-in-out;
  background-image: url("../images/spritemap.png");
  background-repeat: no-repeat;
}
@media all and (-webkit-min-device-pixel-ratio:1.5),(min--moz-device-pixel-ratio:1.5),(-o-min-device-pixel-ratio:1.5/1),(min-device-pixel-ratio:1.5),(min-resolution:138dpi),(min-resolution:1.5dppx) {
  .dropzone .dz-preview .dz-error-mark,
  .dropzone-previews .dz-preview .dz-error-mark,
  .dropzone .dz-preview .dz-success-mark,
  .dropzone-previews .dz-preview .dz-success-mark {
    background-image: url("../images/spritemap@2x.png");
    -webkit-background-size: 428px 406px;
    -moz-background-size: 428px 406px;
    background-size: 428px 406px;
  }
}
.dropzone .dz-preview .dz-error-mark span,
.dropzone-previews .dz-preview .dz-error-mark span,
.dropzone .dz-preview .dz-success-mark span,
.dropzone-previews .dz-preview .dz-success-mark span {
  display: none;
}
.dropzone .dz-preview .dz-error-mark,
.dropzone-previews .dz-preview .dz-error-mark {
  background-position: -268px -123px;
}
.dropzone .dz-preview .dz-success-mark,
.dropzone-previews .dz-preview .dz-success-mark {
  background-position: -268px -163px;
}
.dropzone .dz-preview .dz-progress .dz-upload,
.dropzone-previews .dz-preview .dz-progress .dz-upload {
  -webkit-animation: loading 0.4s linear infinite;
  -moz-animation: loading 0.4s linear infinite;
  -o-animation: loading 0.4s linear infinite;
  -ms-animation: loading 0.4s linear infinite;
  animation: loading 0.4s linear infinite;
  -webkit-transition: width 0.3s ease-in-out;
  -moz-transition: width 0.3s ease-in-out;
  -o-transition: width 0.3s ease-in-out;
  -ms-transition: width 0.3s ease-in-out;
  transition: width 0.3s ease-in-out;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  position: absolute;
  top: 0;
  left: 0;
  width: 0%;
  height: 100%;
  background-image: url("../images/spritemap.png");
  background-repeat: repeat-x;
  background-position: 0px -400px;
}
@media all and (-webkit-min-device-pixel-ratio:1.5),(min--moz-device-pixel-ratio:1.5),(-o-min-device-pixel-ratio:1.5/1),(min-device-pixel-ratio:1.5),(min-resolution:138dpi),(min-resolution:1.5dppx) {
  .dropzone .dz-preview .dz-progress .dz-upload,
  .dropzone-previews .dz-preview .dz-progress .dz-upload {
    background-image: url("../images/spritemap@2x.png");
    -webkit-background-size: 428px 406px;
    -moz-background-size: 428px 406px;
    background-size: 428px 406px;
  }
}
.dropzone .dz-preview.dz-success .dz-progress,
.dropzone-previews .dz-preview.dz-success .dz-progress {
  display: block;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: opacity 0.4s ease-in-out;
  -moz-transition: opacity 0.4s ease-in-out;
  -o-transition: opacity 0.4s ease-in-out;
  -ms-transition: opacity 0.4s ease-in-out;
  transition: opacity 0.4s ease-in-out;
}
.dropzone .dz-preview .dz-error-message,
.dropzone-previews .dz-preview .dz-error-message {
  display: block;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-transition: opacity 0.3s ease-in-out;
  -moz-transition: opacity 0.3s ease-in-out;
  -o-transition: opacity 0.3s ease-in-out;
  -ms-transition: opacity 0.3s ease-in-out;
  transition: opacity 0.3s ease-in-out;
}
.dropzone .dz-preview:hover.dz-error .dz-error-message,
.dropzone-previews .dz-preview:hover.dz-error .dz-error-message {
  opacity: 1;
  -ms-filter: none;
  filter: none;
}
.dropzone a.dz-remove,
.dropzone-previews a.dz-remove {
  background-image: -webkit-linear-gradient(top, #fafafa, #eee);
  background-image: -moz-linear-gradient(top, #fafafa, #eee);
  background-image: -o-linear-gradient(top, #fafafa, #eee);
  background-image: -ms-linear-gradient(top, #fafafa, #eee);
  background-image: linear-gradient(to bottom, #fafafa, #eee);
  -webkit-border-radius: 2px;
  border-radius: 2px;
  border: 1px solid #eee;
  text-decoration: none;
  display: block;
  padding: 4px 5px;
  text-align: center;
  color: #aaa;
  margin-top: 26px;
}
.dropzone a.dz-remove:hover,
.dropzone-previews a.dz-remove:hover {
  color: #666;
}
@-moz-keyframes loading {
  from {
    background-position: 0 -400px;
  }
  to {
    background-position: -7px -400px;
  }
}
@-webkit-keyframes loading {
  from {
    background-position: 0 -400px;
  }
  to {
    background-position: -7px -400px;
  }
}
@-o-keyframes loading {
  from {
    background-position: 0 -400px;
  }
  to {
    background-position: -7px -400px;
  }
}
@keyframes loading {
  from {
    background-position: 0 -400px;
  }
  to {
    background-position: -7px -400px;
  }
}















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

.item img{width: 60%; height: 184px;}

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
        <div class="col-sm-12">
            <div class="col-sm-12">
            	
            </div>
            
            <div class="col-sm-6">
            	<div class="form-group">
            		<label class="control-label">Project</label>
            		<?php
            			$projects = $this->db->get('projects')->result_object();
            		?>
                    <select id="project" class="form-control" name="project"/>
                    	<option><?php echo get_phrase('select');?></option>
                    <?php foreach($projects as $opts){?>
                    	<option value="<?php echo $opts->name;?>"><?php echo $opts->name;?></option>
                    <?php }?>
                    </select>
            	</div>
            </div>
            <div class="col-sm-6">
                <!--<div class="form-group">-->
                    <!--<label class="control-label">Choose Files</label>
                    <input type="file" class="form-control" name="userFiles[]" multiple/>-->
                <form class="dropzone" id="myDropZone" enctype="multipart/form-data" action="<?php echo base_url();?>index.php?sdsa/upload_photo" method="post">   
                    <!--<input name="userFiles[]" type="file" multiple />-->
                </form>
                <!--</div>-->
                <!--<div class="form-group">
                    <input class="form-control btn btn-warning" type="submit" name="fileSubmit" value="UPLOAD"/>
                </div>-->
            </div>
            <!--</form>-->
        </div>
       </div>
        
        <hr>
        
        <div class="row">
        	  <div class="col-sm-6">
        	  	<form action="<?php echo base_url();?>index.php?sdsa/search_photo" method="post">
	        		<div class="form-group">
	        		<label class="control-label col-sm-12">Search By ICP</label>
	        		
	        		 	<?php
	            			$projects = $this->db->get('projects')->result_object();
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
			                        	<a href="#" id="download_all"  class="mass_action">
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
                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_full_photo/<?php echo $file->id;?>');"><img src="<?php echo base_url();?>uploads/photos/KE0200/<?php echo $file->file_name;?>" alt="" ></a>
                        	<div class="details">
                        		<caption><u>Details</u></caption><br>
                        		
                        			Width:<?php echo $image['0'];?><br>
                        			Height:<?php echo $image['1'];?><br>
                        			Type:<?php echo $type['1'];?><br>
                        			File:<?php echo $file_name;;?>
                        		
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
	 
	 //var myDropzone = new Dropzone("div#dropzone", { url: "/file/post"});
	$(document).ready(function(){
			 	Dropzone.options.myDropZone = {
			    maxFilesize: 5,
			    addRemoveLinks: true,
			    dictResponseError: 'Server not Configured',
			    acceptedFiles: ".jpg,.jpeg",
			    init:function(){
			      var self = this;
			      // config
			      self.options.addRemoveLinks = true;
			      self.options.dictRemoveFile = "Delete Photo";
			      //New file added
			      //self.on("addedfile", function (file) {
			        //console.log('new file added ', file);
			      //});
			      // Send file starts
			      self.on("sending", function (file) {
			        //console.log('upload started', file);
			        alert('upload started');
			        $('.meter').show();
			      });
			      
			      // File upload Progress
			      self.on("totaluploadprogress", function (progress) {
			        console.log("progress ", progress);
			        $('.roller').width(progress + '%');
			      });
			
			      self.on("queuecomplete", function (progress) {
			        $('.meter').delay(999).slideUp(999);
			      });
			      
			      // On removing file
			      self.on("removedfile", function (file) {
			        console.log(file);
			      });
			    }
			  };
	});
	 
</script>