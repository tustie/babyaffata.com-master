<?php $this->view('header.php'); ?>
<?php $this->view('navbar.php'); ?>

<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Converter.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Sanitizer.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Editor.js'); ?>"></script>

<?php $this->view('posts/markdown-help.php'); ?>

<div class="container-fluid">
    
    <form id="write-form" name="auth" method="post" action="<?php echo $this->location('posts/post'); ?>" class="form-inline">
    <input type="hidden" name="id" id="id" value="<?php echo $post->id; ?>" />
    <input type="hidden" name="post_author_id" id="post-author-id" value="<?php echo $user->username; ?>" />
    <fieldset style="width:99%">
    	<legend>
        <a href="<?php echo $this->location('posts'); ?>" class="btn btn-info pull-right"><i class="icon-list icon-white"></i> Post List</a>
        <a href="<?php echo $this->location('posts/write'); ?>" class="btn pull-right" style="margin:0px 5px"><i class="icon-pencil"></i> Write New Post</a>
        
        Edit Post
        </legend>    
        
    <div class="row-fluid">
    
        <div class="span8">
        
            <div class="control-group">
                <div class="hide" id="notification-container"></div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="post_title" >Title</label>
                <div class="controls">
                <input type="text" name="post_title" id="post_title" class="input-xlarge" value="<?php echo $post->post_title; ?>" placeholder="Post Title" style="width:98%" /> 
                </div>
            </div><!-- /control-group -->
            

            
            <div class="control-group">
                <label class="control-label" for="post_subtitle" >Subtitle (Optional)</label>
                <div class="controls">
                <input type="text" name="post_subtitle" id="post_subtitle" class="input-xlarge" value="<?php echo $post->post_subtitle; ?>" placeholder="Subtitle" style="width:98%" />     
                </div>
            </div><!-- /control-group -->            


            <div class="control-group">
				<div class="accordion-group">
                	<div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" href="#collapsePageURL">
                            <i class="icon-bookmark"></i> <strong>Page URL</strong>
                        </a>
                    </div>
                    <div id="collapsePageURL" class="accordion-body collapse">
                    	<div class="accordion-inner">
                        	<label for="password">Current page URL: </label>
                            <div class="controls">
	                        <input type="text" name="post_page" id="post_page" class="input-xlarge" value="<?php echo $post->post_page; ?>" placeholder="Page URL" style="width:80%" />
                            </div>
                            <div class="controls" style="margin-top:3px;">
                            <p><a href="#" id="btn-generate-pageurl" class="btn btn-primary">Generate Page URL</a><small> A post page URL will be this post pretty URL. Defaulting generated from post's title.</small></p>
                            </div>
                        </div>
                    </div>                    
                </div>                 
            </div><!-- /control-group -->
            
            <div class="control-group">
                               
                <ul class="nav nav-tabs" id="writeTab">
                  <li class="active"><a href="#tab-write" data-toggle="tab">Write Contents</a></li>
                  <li><a href="#tab-preview" data-toggle="tab" data-tabname="preview">Preview</a></li>
                  <li><a href="#tab-help" data-toggle="tab">Help</a></li>
                </ul>
                 
                <div class="tab-content">
                  <div class="tab-pane active" id="tab-write">
                    <div class="controls">
                    
                        <div id="wmd-editor" class="wmd-panel">
                            <div id="wmd-button-bar"></div>
                            <textarea name="post_content" class="input-xxlarge" id="wmd-input" style="height:300px;" ><?php echo $post->post_content; ?></textarea>    
                        </div>
        
                    </div>                  
                  </div><!--/tab-write-->
                  <div class="tab-pane" id="tab-preview">
	                  <div id="wmd-preview" style="height:300px; overflow-y:auto;"></div>
                  </div>
                  <div class="tab-pane" id="tab-help">
                  
                  </div>
                </div>
                
            </div><!-- /control-group -->
            
            <div class="control-group">
            	<div class="accordion-group">
                	<div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseExcerpt">
                            <i class="icon-chevron-down"></i> <strong>Post Excerpt</strong>
                        </a>
                    </div>
                    <div id="collapseExcerpt" class="accordion-body collapse">
                    	<div class="accordion-inner">
                        	<textarea name="post_excerpt" class="input-xxlarge" style="height:100px;"><?php echo $post->post_excerpt; ?></textarea>
                            <p><small>An excerpt is more like a post's summary as a preview of the longer post content before it is shown to the viewer. A clip, snippet, passage or extract from a larger work such as a news article, a film, a literary composition or other media (http://en.wiktionary.org/wiki/excerpt). An extract; a passage selected or copied from a book or record.</small></p>
                        </div>
                    </div>
                </div>
            </div><!-- /control-group -->
        
        </div><!-- /span8 -->    
    
        <div class="span4">
			<fieldset>
            	<legend><small>Categories</small></legend>
                <div class="controls" id="categories-list">
                <?php if( $categories ) : 
                
                    foreach($categories as $cat) :
                    
                    $checked = '';
                    if(isset($post_categories_tag) && is_array($post_categories_tag) && in_array($cat->tag, $post_categories_tag)) $checked = 'checked="checked"';
                    
                ?>
                <label class="checkbox span3">
                    <input type="checkbox" name="post_categories[]" <?php echo $checked; ?> value="<?php echo $cat->tag; ?>" />
                    <?php echo $cat->name; ?>
                </label>
                <?php 
                    endforeach;
                endif; ?>
                </div>

                <div class="control-group">
                    <div class="controls span4" style="clear:both; margin-top:7px;">
                        <div class="input-append" style="vertical-align:top !important">
                            <input id="post-categories" type="text" data-provide="typeahead" placeholder="Category Name"><button class="btn" type="button" id="btn-add-category" style="margin-top:0px !important;"><i class="icon-plus"></i> Add</button>
                        </div>                        
                    </div>
                </div>
            </fieldset>
            
            <fieldset style="margin-top:27px;">
            	<legend><small>Tags</small></legend>
                <div class="controls span4">
                    <div class="input-append" style="vertical-align:top !important">
                        <input class="" id="post-tags" type="text" data-provide="typeahead" placeholder="Tag Name"><button class="btn" type="button" id="btn-add-tag" style="margin-top:0px !important;"><i class="icon-plus"></i> Add</button>
                    </div>
                </div>
                <div class="controls span4" style="margin-top:5px; margin-bottom:27px;">
                    <div id="selected-tags"><?php if(isset($post_tags)): foreach($post_tags as $tag): ?><div class="label label-big pull-left label-tag" title="Click to remove"><?php echo $tag->name; ?></div><?php endforeach; endif; ?></div>
                </div>
            </fieldset>
            
            <div class="control-group">
            
            
              	<div class="accordion-group">
                	<div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" href="#collapseDateTime">
                            <i class="icon-time"></i> <strong>Date and Time</strong>
                        </a>
                    </div>
                    <div id="collapseDateTime" class="accordion-body collapse">
                    	<div class="accordion-inner">
                            <div class="control-group">
                                <div class="controls">
                                <div style="margin-right:10px;">
                                <label>Date
                                    <input type="text" name="post_date" size="12" value="<?php echo $post->post_date; ?>" id="date-time" />
                                </label>
                                </div>
                                <div>
                                <label>Time
                                    <input type="text" name="post_time" size="12" value="<?php echo $post->post_time; ?>" />
                                </label>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div><!-- /accordion-group -->        
            
            	<div class="accordion-group">
                	<div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapsePassword">
                            <i class="icon-lock"></i> <strong>Password Protect</strong>
                        </a>
                    </div>
                    <div id="collapsePassword" class="accordion-body collapse">
                    	<div class="accordion-inner">
                        	<label for="password">Password protect post with: </label>
                            <div class="controls">
                            <input type="text" name="post_password" value="<?php echo $post->post_password; ?>" />
                            </div>
                            <small>Setting the password field to blank will remove post's password protection.</small>
                        </div>
                    </div>                    
                </div><!-- /accordion-group -->
                
                <div class="accordion-group">
                                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseComments">
                            <i class="icon-comment"></i> <strong>Post Comments</strong>
                        </a>
                    </div>
                    <div id="collapseComments" class="accordion-body collapse">
                    	<div class="accordion-inner">
                            <div class="controls">                        
                        	<label>Comments status for this post:
                            <?php if($post->comment_status == "open") {
								$class = "btn-info";
								$label = "Allowed";
							} else {
								$class = "btn-danger active";
								$label = "Disallowed";
							}
							?>
                            <button class="btn<?php echo " ".$class; ?>" id="comment-status" data-toggle="button"><?php echo $label; ?></button>
                            </label>
                            </div>
                        </div>
                    </div>
                </div><!-- /accordion-group -->
                        
            </div><!-- /control-group -->
    
        </div><!-- /span4 -->
               
    </div><!-- /row-fluid -->

    	<div class="row-fluid">
            <div class="span12">
                <div class="form-actions">
                    <a class="btn btn-danger pull-right" id="btn-discard">
                    <i class="icon-minus icon-white"></i> Discard</a>            
					<a href="<?php echo $this->location('posts'); ?>" class="btn btn-info pull-right" style="margin-right:5px">
                    <i class="icon-list icon-white"></i> Post List</a>                            
                    <a href="<?php echo $this->location('posts/write'); ?>" class="btn pull-right" style="margin-right:5px;"><i class="icon-pencil"></i> Write New Post</a>
                    <button class="btn btn-primary" data-loading-text="Publishing..." id="btn-publish">Save and Publish</button>
                    <button class="btn" data-loading-text="Saving..." id="btn-draft">Save as Draft</button>
                </div>    
            </div>
    	</div>
        <div class="row-fluid">
        	<div class="span12" id="save-status">
            Post status: 
			<?php 
				if($post->post_status == 'published')
					echo '<span class="label label-success">Published</span>';
				else echo '<span class="label label-warning">Draft</span>';
			?>
            </div>
        </div>
        </fieldset>            
    </form>
    
    </div><!-- /container -->

<script type="text/javascript" src="<?php echo $this->asset('pagedown/pagedown.js'); ?>"></script>

<?php $this->view('footer.php'); ?>