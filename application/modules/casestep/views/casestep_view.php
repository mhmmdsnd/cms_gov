<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script>
    jQuery(function($) {
        var myTable = $('#dt-casestep').DataTable({bAutoWidth: false});
    });
</script>
<a href="<?php echo base_url();?>casestep/create" class="btn btn-app btn-primary no-radius">
    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i>Create</a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">Results for "Latest Registered Case Step"</div>
<div>
<table id="dt-casestep" class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th>No</th>
    <th>Case Step Name</th>
    <th>Action</th>			
</tr>
</thead>
<tbody>
	<?php $urut=1; foreach ($result->result_array() as $list) { ?>
    <tr>
        <td><?php echo $urut++ ?></td>
        <td><?php echo $list['casestepName'] ?></td>
        <td>
        <div class="hidden-sm hidden-xs action-buttons">
        <a class="green" href="<?php echo base_url();?>casestep/update/<?php echo $list['casestepId'] ?>">
            <i class="ace-icon fa fa-pencil bigger-120"></i>
        </a>
        <a class="red" OnClick="return confirm('Are you delete this data?');" href="<?php echo base_url();?>casestep/delete/<?php echo $list['casestepId'] ?>">
            <i class="ace-icon fa fa-trash-o bigger-120"></i>
        </a>
    </div>
    </td>
    </tr>
    <?php } ?>
</tbody>
</table>