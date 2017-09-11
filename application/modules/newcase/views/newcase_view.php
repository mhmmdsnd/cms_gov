<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script>
    jQuery(function($) {
        var myTable = $('#dt-newcase').DataTable({bAutoWidth: false});
    });
</script>
<a href="<?php echo base_url();?>newcase/create" class="btn btn-app btn-primary no-radius">
    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i><? echo $this->lang->line('btn_create'); ?></a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header"><? echo $this->lang->line('result_kom'); ?></div>
<div>
<table id="dt-newcase" class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th>No</th>
    <th><? echo $this->lang->line('list_kom1'); ?></th>
    <th><? echo $this->lang->line('list_kom2'); ?></th>
    <th><? echo $this->lang->line('list_kom3'); ?></th>
    <th><? echo $this->lang->line('list_kom4'); ?></th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($result);$i++) {$j = $i+1; ?>
    <tr>
        <td><?php echo $j; ?></td>
        <td><?php echo $result[$i]['komunitasName'] ?></td>
        <td><?php echo $result[$i]['komunitasDesc'] ?></td>
        <td><?php echo $result[$i]['reftypeName'] ?></td>
        <td>
        <div class="hidden-sm hidden-xs action-buttons">
        <a class="green" href="<?php echo base_url();?>newcase/update/<?php echo $result[$i]['komunitasId'] ?>">
            <i class="ace-icon fa fa-pencil bigger-120"></i>
        </a>
        <a class="red" OnClick="return confirm('<? echo $this->lang->line('ask_process'); ?>');" href="<?php echo base_url();?>newcase/delete/<?php echo $result[$i]['komunitasId'] ?>">
            <i class="ace-icon fa fa-trash-o bigger-120"></i>
        </a> | 
         <a class="green" href="<?php echo base_url();?>berita/index/<?php echo $result[$i]['komunitasId'] ?>">
            <i class="ace-icon fa fa-inbox bigger-120"></i>
        </a>
        <a class="green" href="<?php echo base_url();?>berita/create/<?php echo $result[$i]['komunitasId'] ?>" title="<? echo $this->lang->line('btn_create'); ?>">
            <i class="ace-icon fa fa-folder-o bigger-120"></i>
        </a>
    </div>
    </td>
    </tr>
    <?php } ?>
</tbody>
</table>