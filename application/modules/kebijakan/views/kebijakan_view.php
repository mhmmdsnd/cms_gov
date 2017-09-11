<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script>
    jQuery(function($) {
        var myTable = $('#dt-polling').DataTable({bAutoWidth: false});
    });
</script>
<a href="<?php echo base_url();?>kebijakan/create" class="btn btn-app btn-primary no-radius">
    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i><? echo $this->lang->line('btn_create') ?></a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header"><? echo $this->lang->line('title_kebijakan') ?></div>
<div>
<table id="dt-polling" class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th>No</th>
    <th><? echo $this->lang->line('list_kebijakan1') ?></th>
    <th><? echo $this->lang->line('list_kebijakan2') ?></th>
    <th><? echo $this->lang->line('list_kebijakan3') ?></th>
    <th><? echo $this->lang->line('list_kebijakan4') ?></th>
    <th><? echo $this->lang->line('list_kebijakan5') ?></th>			
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($result);$i++) {$j = $i+1; ?>
    <tr>
        <td><?php echo $j; ?></td>
        <td><?php echo $result[$i]['caseTitle'] ?></td>
        <td><?php echo $result[$i]['caseDateStart'] ?> / <?php echo $result[$i]['caseDateEnd'] ?></td>
        <td><?php echo $result[$i]['caseAuthor'] ?></td>
        <td><?php echo $result[$i]['reftypeName'] ?></td>
        <td>
        <div class="hidden-sm hidden-xs action-buttons">
        <? if($result[$i]['reftypeName']=='Draft') { ?><a class="green" href="<?php echo base_url();?>kebijakan/update/<?php echo $result[$i]['caseId'] ?>">
            <i class="ace-icon fa fa-pencil bigger-120"></i>
        </a><? } else { ?>
        <a class="green" href="<?php echo base_url();?>kebijakan/update/<?php echo $result[$i]['caseId'] ?>">
            <i class="ace-icon fa fa-info-circle bigger-120"></i>
        </a>
        <? } ?>
        <a class="red" OnClick="return confirm('Are you delete this data?');" href="<?php echo base_url();?>kebijakan/delete/<?php echo $result[$i]['caseId'] ?>">
            <i class="ace-icon fa fa-trash-o bigger-120"></i>
        </a>
        <? if($result[$i]['reftypeName']=='Draft') { ?>
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle">
                Action <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>  
            <ul class="dropdown-menu dropdown-inverse">
                <li>
                    <a onclick="return confirm('<? echo $this->lang->line('update_process'); ?>');" href="<?php echo base_url();?>kebijakan/approve/<?php echo $result[$i]['caseId'] ?>"><? echo $this->lang->line('btn_approve'); ?></a>
                </li>
                <li>
                    <a onclick="return confirm('<? echo $this->lang->line('update_process'); ?>');" href="<?php echo base_url();?>kebijakan/reject/<?php echo $result[$i]['caseId'] ?>"><? echo $this->lang->line('btn_cancel'); ?></a>
                </li>
            </ul>
        </div>
        <? } ?>
    	</div>
    </td>
    </tr>
    <?php } ?>
</tbody>
</table>