<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script>
    jQuery(function($) {
        var myTable = $('#dt-berita').DataTable({bAutoWidth: false});
    });
</script>
<a href="<?php echo base_url();?>berita/create" class="btn btn-app btn-primary no-radius">
    <i class="ace-icon fa fa-pencil-square-o bigger-230"></i><? echo $this->lang->line('btn_create'); ?></a>
<div class="clearfix">
    <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header"><? echo $this->lang->line('result_news'); ?></div>
<div>
<table id="dt-berita" class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th>No</th>
    <th><? echo $this->lang->line('list_news1'); ?></th>
    <th><? echo $this->lang->line('list_news2'); ?></th>
    <th><? echo $this->lang->line('list_kom1'); ?></th>
    <th><? echo $this->lang->line('list_news3'); ?></th>
    <th><? echo $this->lang->line('list_news4'); ?></th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($result);$i++) {$j = $i+1; ?>
<tr>
	<td><?php echo $j; ?></td>
    <td><?php echo $result[$i]['beritaTitle'] ?></td>
    <td><?php echo $result[$i]['tglberita'] ?></td>
    <td><?php echo $result[$i]['komunitasName'] ?></td>
    <td><?php echo $result[$i]['reftypeName'] ?></td>
    <td><div class="hidden-sm hidden-xs action-buttons">
        <? if($result[$i]['reftypeName']!='Banned') { ?>
        <a class="green" onclick="document.location.replace('<?php echo base_url();?>berita/update/<?php echo $result[$i]['beritaId'] ?>');" href="#">
            <i class="ace-icon fa fa-pencil bigger-120"></i>
        </a>
        <? } else { ?>
        <a class="green" onclick="document.location.replace('<?php echo base_url();?>berita/detail/<?php echo $result[$i]['beritaId'] ?>');" href="#">
            <i class="ace-icon fa fa-info-circle bigger-120"></i>
        </a>
        <? } ?>
        <a class="red" OnClick="return confirm('<? echo $this->lang->line('ask_process'); ?>');" href="<?php echo base_url();?>berita/delete/<?php echo $result[$i]['beritaId'] ?>">
            <i class="ace-icon fa fa-trash-o bigger-120"></i>
        </a>
     	<? if($result[$i]['reftypeName']=='Draft') { ?>
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle">
                Action <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>  
            <ul class="dropdown-menu dropdown-inverse">
            <li>
                <a onclick="return confirm('<? echo $this->lang->line('update_process'); ?>');" href="<?php echo base_url();?>berita/process/<?php echo $result[$i]['beritaId'] ?>/2">Publish</a>
            </li>
            <li>
                <a onclick="return confirm('<? echo $this->lang->line('update_process'); ?>');" href="<?php echo base_url();?>berita/process/<?php echo $result[$i]['beritaId'] ?>/3">Banned</a>
            </li>
            </ul>
        </div>
        <? } ?>
     </div>
     </td>
</tr>
<? } ?>
</tbody>
</table>