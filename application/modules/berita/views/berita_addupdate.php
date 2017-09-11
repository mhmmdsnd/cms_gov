<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/markdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-markdown.min.js"></script>
<div class="page-header">
  <h1><? echo $this->lang->line('header_news') ?></h1>
</div>
<script type="text/javascript">
$(document).ready(function(){
	image_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
	doc_ext = ["doc","pdf","docx"];
	image_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
	$('textarea[data-provide="markdown"]').each(function(){
        var $this = $(this);

		if ($this.data('markdown')) {
		  $this.data('markdown').showEditor();
		}
		else $this.markdown()
		
		$this.parent().find('.btn').addClass('btn-white');
    });
});
</script>
<? if ($_SERVER['REQUEST_URI'] == "/berita/create" || $_SERVER['REQUEST_URI'] == "/berita/create/".$komId) { ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#berita_form").validate({
		errorElement: 'div',
		errorClass: 'help-block',
		rules: {
            beritaTitle: { required:true }
		},
		messages : {
            beritaTitle : { required : "<? echo $this->lang->line('fld_req')."".$this->lang->line('field_news1') ?>" }
		},
		success: function (e) {
			$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
			$(e).remove();
		},
		highlight: function (e) {
			$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
		}
	});
});
</script>
<form method="post" id="berita_form" name="berita_form" class="form-horizontal" role="form" enctype="multipart/form-data" >
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_news1') ?></label>
    <div class="col-sm-9">
      <input id="beritaTitle" name="beritaTitle" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kom1') ?></label>
    <div class="col-sm-9">
           <?php $extra = array('class' => 'input-medium'); echo form_dropdown("komunitasId",$listkomunitas,$komId,$extra) ?>
    </div>
  </div>
  <div class="hr hr-16 hr-dotted"></div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_news2') ?></label>
    <div class="col-sm-9">
      <textarea name="content" data-provide="markdown" data-iconlibrary="fa" rows="10"></textarea>
    </div>
  </div>
  <div class="hr hr-16 hr-dotted"></div>
  <div class="form-group">
    <div class="col-md-offset-3 col-md-9">
      <input type="submit" name="action" value="<? echo $this->lang->line('btn_submit') ?>" class="btn btn-primary" />
      &nbsp; &nbsp; &nbsp;
      <input type="button" value="<? echo $this->lang->line('btn_cancel') ?>" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>berita');" />
    </div>
  </div>
</form>
<? } else { ?>
<form method="post" id="berita_form" name="berita_form" class="form-horizontal" role="form" enctype="multipart/form-data" >
 <input id="beritaId" name="beritaId" type="hidden" value="<? echo $detail->beritaId ?>" />
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_news1') ?></label>
    <div class="col-sm-9">
      <input id="beritaTitle" name="beritaTitle" type="text" maxlength="20" class="col-xs-10 col-sm-5" value="<? echo $detail->beritaTitle ?>" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_kom1') ?></label>
    <div class="col-sm-9">
           <?php $extra = array('class' => 'input-medium'); echo form_dropdown("komunitasId",$listkomunitas,$detail->komunitasId,$extra) ?>
    </div>
  </div>
  <div class="hr hr-16 hr-dotted"></div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"><? echo $this->lang->line('field_news2') ?></label>
    <div class="col-sm-9">
      <textarea name="content" data-provide="markdown" data-iconlibrary="fa" rows="10"><? echo $detail->content ?></textarea>
    </div>
  </div>
  <div class="hr hr-16 hr-dotted"></div>
  <div class="form-group">
    <div class="col-md-offset-3 col-md-9">
      <input type="submit" name="action" value="<? echo $this->lang->line('btn_update') ?>" class="btn btn-primary" />
      &nbsp; &nbsp; &nbsp;
      <input type="button" value="<? echo $this->lang->line('btn_cancel') ?>" class="btn btn-primary" onclick="document.location.replace('<?php echo base_url();?>berita');" />
    </div>
  </div>
</form>
<? } ?>