<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
foreach($fansub as $k => $v){
  $options[$v['id']] = $v['name'];
}
foreach($fansub as $v)
  $fansub_for_json[] = array('id' => $v['id'], 'text' => $v['name']);
?>
<?php echo validation_errors('<div class="alert alert-warning alert-dismissable">', '</div>'); ?>
<div class="box box-solid">
  <div class="box-header">
    <h4 class="box-title">Nhóm dịch | <?php echo $series['name']?></h4>
    <div class="box-tools">
      <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Thêm episode</button>
    </div>
  </div>
  <div class="box-body">
    <div class="box-group">
     <?php $collapseID = 0; foreach ($data as $fansub_name => $episodes){ $collapseID++;?>
      <div class="panel box box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $collapseID; ?>" aria-expanded="false" class="collapsed"><?php echo $fansub_name ?></a>
          </h4>
        </div>
        <div class="panel-collapse collapse" aria-expanded="false" style="height: 0px;" id="collapse<?php echo $collapseID; ?>">
          <div class="box-body table-responsive no-padding">
            <table id="episodes" class="table table-hover">
              <tbody>
                <tr>
                  <th style="width: 10px;">ID</th>
                  <th style="width: 20px;">EP</th>
                  <th>Link</th>
                  <th>BD</th>
                  <th style="width: 150px;">Fansub<th>
                <tr>
                <?php foreach($episodes as $episode) { ?>
                <tr>
                  <td><?php echo $episode['id']?></td>
                  <td><a href="#" id="ep"   data-pk="<?php echo $episode['id']?>"><?php echo $episode['ep']?></td>
                  <td><a href="#" id="link" data-pk="<?php echo $episode['id']?>"><?php echo $episode['link']?></a></td>
                  <td><input type="checkbox" class="anime-checkbox" data-pk="<?php echo $episode['id']?>" value="<?php echo $episode['bd']?>" <?php echo ($episode['bd']) ? 'checked' : ''?>></td>
                  <td><a href="#" id="fansub_id" data-type="select2" data-pk="<?php echo $episode['id']?>" data-value="<?php echo $episode['fansub_id']?>">
                    <?php echo $fansub_name; ?>
                  </a></td>
                  <td><button data-id="<?=$episode['id']?>" data-ep="<?=$episode['ep']?>" class="btn btn-danger btn-xs confirm-delete">Xóa</button></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

<div id="myModal" class="modal fade modal-primary">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Thêm episode</h4>
      </div>
      <div class="modal-body">
        <?php echo $form->bs3_text('Episode', 'ep', '', array('placeholder' => 'Nếu có')); ?>
        <div class="form-group">
          <?php echo form_label('Fansub').form_dropdown(array('name' => 'fansub', 'class' => 'form-control', 'options' => $options)); ?>
        </div>
        <?php echo $form->bs3_textarea('Link', 'link'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline">Add</button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="confirmModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      </div>
    <div class="modal-body">
      <p id="myConfirm"></p>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      <button data-dismiss="modal" class="btn red" id="btnYes">Confirm</button>
    </div>
  </div>
</div>