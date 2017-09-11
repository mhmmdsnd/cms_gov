<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script>
    jQuery(function($) {
        var myTable = $('#dt-polling').DataTable({bAutoWidth: false});
    });
</script>
<a href="<?php echo base_url();?>dialog/create" class="btn btn-app btn-primary no-radius">
    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i>Create</a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">Results for "Latest Registered Topik Dialog"</div>
<div>
<table id="dt-polling" class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th>No</th>
    <th>Topik Dialog Title</th>
    <th>Date Period</th>
    <th>Author</th>
    <th>Status Topik Dialog</th>
    <th>Action</th>			
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
            <? if($result[$i]['reftypeName']=='Draft') { ?><a class="green" href="<?php echo base_url();?>dialog/update/<?php echo $result[$i]['caseId'] ?>">
                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                </a><? } else { ?>
                <a class="green" href="<?php echo base_url();?>dialog/update/<?php echo $result[$i]['caseId'] ?>">
                    <i class="ace-icon fa fa-info-circle bigger-120"></i>
                </a>
            <? } ?>
            <a class="red" OnClick="return confirm('Are you delete this data?');" href="<?php echo base_url();?>dialog/delete/<?php echo $result[$i]['caseId'] ?>">
                <i class="ace-icon fa fa-trash-o bigger-120"></i>
            </a>
            <? if($result[$i]['reftypeName']=='Draft') { ?>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle">
                        Action <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-inverse">
                        <li>
                            <a onclick="return confirm('Do you want to proceed?');" href="<?php echo base_url();?>dialog/approve/<?php echo $result[$i]['caseId'] ?>">Approve</a>
                        </li>
                        <li>
                            <a onclick="return confirm('Do you want to proceed?');" href="<?php echo base_url();?>dialog/reject/<?php echo $result[$i]['caseId'] ?>">Reject</a>
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