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
            <div class="col-xs-12 col-sm-12">
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
                                    <a href="cases/detail/<?php echo $result[$i]['caseId'] ?>" class="blue"><?php echo $result[$i]['caseTitle'] ?></a>
                                </h3>
                                <!--<p><?php echo $result[$i]['caseHeader'] ?></p> -->
                            </div>
                        </div>
                    </div>
                    <? } ?>
                    
                </div> <!-- end row -->
                <div class="space-12"></div>
            </div>
        </div>
    </div>
</div>
</div>
