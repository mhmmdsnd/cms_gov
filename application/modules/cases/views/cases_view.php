<script src="<?php echo base_url();?>assets/js/holder.min.js"></script>
<script type="text/javascript">
jQuery(function($){
//this is for demo only
	$('.thumbnail').on('mouseenter', function() {
		$(this).find('.info-label').addClass('label-primary');
	}).on('mouseleave', function() {
		$(this).find('.info-label').removeClass('label-primary');
	});
});
</script>
<div>
<div class="row search-page" id="search-page-1">
    <div class="col-xs-12">
        <div class="row">
        	<div class="col-xs-12 col-sm-3">
                <div class="search-area well well-sm">
                    <div class="search-filter-header bg-primary">
                        <h5 class="smaller no-margin-bottom">
                            <i class="ace-icon fa fa-sliders light-green bigger-130"></i>&nbsp; Refine your Search
                        </h5>
                    </div>
                    <div class="space-10"></div>
                    <form>
                    <div class="row">
                        <div class="col-xs-12 col-sm-11 col-md-10">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keywords" placeholder="Look within results" />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default no-border btn-sm">
                                        <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr hr-dotted"></div>
                    <h4 class="blue smaller">
                        <i class="fa fa-map-marker light-orange bigger-110"></i>
                        Location
                    </h4>
                    <div>
                    	<?php $extra = array('class' => 'select2 tag-input-style'); echo form_multiselect("caselocation",$getlocation,'',$extra) ?>
                    </div>
                    <div class="hr hr-dotted hr-24"></div>
					<div class="text-center">
                        <button type="button" class="btn btn-default btn-round btn-sm btn-white">
                            <i class="ace-icon fa fa-remove red2"></i>
                            Reset
                        </button>

                        <button type="button" class="btn btn-default btn-round btn-white">
                            <i class="ace-icon fa fa-refresh green"></i>
                            Update
                        </button>
                    </div>
					</form>
                    <div class="space-4"></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="row">
                    <div class="search-area well col-xs-12">
                        <div class="pull-right">
                            <b class="text-primary">Order</b>&nbsp;
                            <select>
                                <option>Relevance</option>
                                <option>Newest First</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<?php for($i=0;$i<count($result);$i++) {$j = $i+1; ?>
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="thumbnail search-thumbnail">
                            <img class="media-object" data-src="holder.js/100px200?theme=gray" />
                            <div class="caption">
                                <div class="clearfix">
                                    <span class="pull-right label label-grey info-label"><?php echo $result[$i]['caseType'] ?></span>
                                </div>
                                <div class="space-2"></div>
                                <div class="clearfix">
                                    <span class="pull-right label label-grey info-label"><?php echo $result[$i]['caseLocation'] ?></span>
                                </div>
                                <h3 class="search-title">
                                    <a href="<?php echo base_url();?>cases/detail/<?php echo $result[$i]['caseId'] ?>" class="blue"><?php echo $result[$i]['caseTitle'] ?></a>
                                </h3>
                                <!-- <p><?php echo $result[$i]['caseHeader'] ?></p> -->
                            </div>
                        </div>
                    </div>
					<? } ?>
                </div>
                <div class="space-12"></div>
            </div>
        </div>
    </div>
</div>
</div>
