<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="box box-primary">
  <div class="box-header">
    <h4 class="box-title">Danh sách series</h4>
    <div class="box-tools">
      <!--<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">Thêm series</button>-->
	  <a href="<?php echo base_url('admin/anime/add'); ?>"><i class="fa fa-circle-o"></i> Thêm Series</a>
    </div>
  </div>
  <div class="box-body">
  <table id="AnimeTable" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th class="sorting_desc" style="width: 10px;">ID</th>
      <th style="width: 50px;">MyAnimeListID</th>
      <th>Tên Anime</th>
      <th>Quản lí</th>
    </tr>
    </thead>
    <tbody>
    <?php
    //print_r($series);
    foreach ($series as $key => $seri) {
    	echo "<tr>
      <td>$seri[id]</td>
      <td>$seri[myl_id]</td>
      <td><a href='".base_url("admin/$ctrler/edit/$seri[id]")."'>$seri[name]</a></td>
      <td><a href='".base_url("admin/$ctrler/eps/$seri[id]")."' class='btn btn-primary btn-xs'>Tập phim</a>
          <button data-id='$seri[id]' data-title='$seri[name]' class='btn btn-danger btn-xs confirm-delete'>Xóa</button>
      </td>
      </tr>";
    }
    ?>
    </tbody>
  </table>
  </div>
</div>

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
      <button data-dismiss="modal" class="btn red" id="deleteSeriesBtn">Confirm</button>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $("#AnimeTable").DataTable({
    "order": [[0, "desc"]],
  });

$('#confirmModal').on('shown.bs.modal', function() {
    var id = $(this).data('id');
    var title = $('.confirm-delete').data('title');
    console.log(title);
    $('#myConfirm').html("Bạn muốn xóa Anime " + '<b>' + title +' (ID: '+id+')</b>' + '?');
    removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#confirmModal').data('id', id).modal('show');
});

  $('#deleteSeriesBtn').click(function() {
    var id = $('#confirmModal').data('id');
    $.ajax({
      url: 'anime/delete/anime',
      type: 'POST',
      data: 'id='+id,
      cache: false,
      success: function(string){
        var result = $.parseJSON(string);
        if(result.success){
          $('[data-id='+id+']').parents('tr').remove();
        }
        $('#loading').html('&nbsp;');
      },
      error: function (){
        alert('Có lỗi xảy ra');
      }
    });
    $('#confirmModal').modal('hide');
});
  
});</script>