<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
<div class="col-lg-6">
  <div class="box box-primary">
  <div class="box-header">
    <h4 class="box-title">Fansub Management</h4>
    <div class="box-tools">
      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addFansub">Thêm Fansub</button>
      <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#delFansub">Xóa Fansub</button>
    </div>
  </div>
  <div class="box-body">
    <table id="fansub" class="table table-bordered table-hover">
      <tbody>
      	<tr>
         <th style="width: 10px">ID</th>
         <th>Name</th>
         <th>Homepage</th>
        </tr>
        <?php foreach($data as $fansub) { ?>
        <tr>
          <td><?php echo $fansub['id'] ?></td>
          <td><a href="#" id="name" data-pk="<?php echo $fansub['id']?>"><?php echo $fansub['name'] ?></td>
          <td><a href="#" id="homepage" data-pk="<?php echo $fansub['id']?>"><?php echo $fansub['homepage'] ?></a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  </div>
</div>
<!--ADD FANSUB -->
<div id="addFansub" class="modal fade modal-primary">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST" accept-charset="utf-8">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Thêm Fansub</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        <?php echo form_error('name') ?>
        <?php echo form_label('Name').form_input(array('name' => 'name', 'class' => 'form-control',)); ?>
        </div>
        <div class="form-group">
          <?php echo form_label('Homepage').form_input(array('name' => 'homepage', 'class' => 'form-control')); ?>
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


<!--DELETE FANSUB -->
<div id="delFansub" class="modal fade modal-primary">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST" accept-charset="utf-8">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Delete Fansub</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        <?php echo form_error('id') ?>
        <?php echo form_label('ID').form_input(array('id' => 'id', 'name' => 'id', 'class' => 'form-control',)); ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline">Delete</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
