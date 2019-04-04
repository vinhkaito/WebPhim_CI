<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
$form = array(
  'myl_id' => array(
    'class' => 'form-control',
    'name'  => 'myl_id',
    'id'    => 'myl_id',
   ),
  'bd' => array(
    'name'  => 'bluray',
    'id'    => 'bluray',
    'value' => 1,
  ),
  'name' => array(
    'class' => 'form-control',
    'name' => 'name',
    'id' => 'name',
  ),
  'airedTime' => array(
    'class' => 'form-control',
    'name'  => 'airedTime',
    'id'    => 'airedTime',
  ),
  'thumbnail' => array(
    'class' => 'form-control',
    'name'  => 'thumbnail',
    'id'    => 'thumbnail',
  ),
  'type' => array(
    'class' => 'form-control',
    'name'  => 'type',
    'id'    => 'type',
  ),
  'total_ep' => array(
    'class' => 'form-control',
    'name'  => 'total_ep',
    'id'    => 'episodes',
  ),
  'poster' => array(
    'class' => 'form-control',
    'name'  => 'poster',
    'id'    => 'poster',
  )
);
$form['season'] = array(
  'class' => 'form-control',
  'name' => 'season',
  'id' => 'season',
);
$form['studios'] = array(
  'class' => 'form-control',
  'name' => 'studios',
  'id' => 'studios',
);
$form['duration'] = array(
  'class' => 'form-control',
  'name' => 'duration',
  'id' => 'duration',
);
$form['genres'] = array(
  'class' => 'form-control select2',
  'name' => 'genres[]',
  'id' => 'genres',
  'options' => $genres,  
);
?>
<div class="box box-primary">
  <div class="box-header">Edit Series
  <div class="box-tools">
    <div class="input-group" style="width: 250px">
      <input class="form-control input-sm pull-right" id="mylID" placeholder="Get info from MyAnimeList">
      <div class="input-group-btn">
      <button class="btn btn-sm btn-default" id="mylgetbtn"><i class="fa fa-search"></i></button>
      </div>
    </div>
  </div>
  <?php echo form_open("admin/$ctrler/add"); ?>
    <div class="box-body">
      <div class="col-lg-6">
      <div class="form-group">
        <?php echo form_label('MyAnimeList ID').form_input($form['myl_id']);?>
      </div>
      <div class="form-group">
        <?php 
          echo form_label('Name');
          echo form_input($form['name']);
        ?>
      </div>
      <div class="form-group">
        <?php echo form_label('Thumbnail').form_input($form['thumbnail']); ?>
      </div>
      <div class="form-group">
        <?php echo form_label('Type').form_input($form['type']);?>
      </div>
      <div class="form-group">
        <?php echo form_label('Total EP').form_input($form['total_ep']); ?>
      </div>
      <div class="form-group">
        <?php echo form_label('Poster').form_input($form['poster']); ?>
      </div>
      </div>
      <div class="col-lg-6">
      <div class="form-group">
        <div class="checkbox"><label><?php echo form_checkbox($form['bd']); ?> Bluray</label></div>
      </div>
      <div class="form-group">
        <?php echo form_label('airedTime').form_input($form['airedTime']); ?>
      </div>
      <div class="form-group">
        <?php echo form_label('Season').form_input($form['season']); ?>
      </div>
      <div class="form-group">
        <?php echo form_label('Studios').form_input($form['studios']); ?>
      </div>
      <div class="form-group">
        <?php echo form_label('Duration').form_input($form['duration']); ?>
      </div>
      <div class="form-group">
        <?php
          echo form_label('Genres');
          echo form_multiselect($form['genres']);
        ?>
      </div>
      </div>
    </div>
    <textarea name="descriptions" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
    <div class="box-footer">
      <button class="btn btn-primary">Add</button>
    </div>
</div>

<?php echo form_close(); ?>