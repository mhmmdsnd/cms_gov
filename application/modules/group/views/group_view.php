<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script>
    jQuery(function($) {
        var myTable = $('#dt-group').DataTable({bAutoWidth: false});
    });
</script>
<a href="<?php echo base_url();?>group/create" class="btn btn-app btn-primary no-radius">
    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i>Create</a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">Results for "Latest Registered Group"</div>
<div>
<table id="dt-group" class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th>No</th>
    <th>Group Name</th>
    <th>Action</th>			
</tr>
</thead>
<tbody>
	<?php $urut=1; foreach ($result->result_array() as $list) { ?>
    <tr>
        <td><?php echo $urut++ ?></td>
        <td><?php echo $list['groupName'] ?></td>
        <td>
        <div class="hidden-sm hidden-xs action-buttons">
        <a class="green" href="<?php echo base_url();?>group/update/<?php echo $list['groupId'] ?>">
            <i class="ace-icon fa fa-pencil bigger-120"></i>
        </a>
        <a class="red" OnClick="return confirm('Are you delete this data?');" href="<?php echo base_url();?>group/delete/<?php echo $list['groupId'] ?>">
            <i class="ace-icon fa fa-trash-o bigger-120"></i>
        </a>
    </div>
    </td>
    </tr>
    <?php } ?>
</tbody>
</table>