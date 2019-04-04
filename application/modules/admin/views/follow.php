<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
<div class="col-lg-12">
  <div class="box box-primary">
  <div class="box-header">
    <h4 class="box-title">{title}</h4>
    <div class="box-tools">
      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">Add</button>
    </div>
  </div>
  <div class="box-body">
    <table id="bot" class="table table-bordered table-hover">
      <tbody>
      	<tr>
         <th style="width: 10px">ID</th>
         <th style="width: 80px">Series ID</th>
         <th style="width: 80px">Fansub ID</th>
         <th>URL</th>
         <th style="width: 60px">Status</th>
        </tr>
        <?php foreach($data as $bot) { ?>
        <tr>
          <td><?php echo $bot->id        ?></td>
          <td><a href="#"><?php echo $bot->series_id ?></a></td>
          <td><a href="#" id="fansub_id" data-pk="<?=$bot->id?>"><?php echo $bot->fansub_id ?></a></td>
          <td><?php echo $bot->url       ?></td>
          <td><?php echo anchor('#',($bot->status) ? 'Enabled' : 'Disabled',array(
            'id' => 'status',
            'data-type' => 'select',
            'data-pk' => $bot->id,
            'data-value' => $bot->status,
            )); ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  </div>
</div>

<div id="myModal" class="modal fade modal-primary">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST" accept-charset="utf-8">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Thêm Fansub</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <?php echo form_label('Series ID').form_dropdown(array('name' => 'series_id', 'class' => 'form-control'), $options['series']); ?>
        </div>
        <div class="form-group">
          <?php echo form_label('Fansub ID').form_dropdown(array('name' => 'fansub_id', 'class' => 'form-control'), $options['fansub']); ?>
        </div>
        <div class="form-group">
          <?php echo form_label('URL').form_input(array('name' => 'url', 'class' => 'form-control')); ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline">Add</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</div>