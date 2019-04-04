<?php header("Content-type: application/javascript"); ?>
$(function () {
  $(".select2").select2();
  $(".textarea").wysihtml5();
});
$(document).ready(function(){
  $('#mylgetbtn').click(function() {
    var mylID = $('#mylID').val();
    $.ajax({
      url: '<?php echo base_url("$controller/js/myl") ?>/'+mylID,
      type: 'GET',
      cache: false,
      success: function(string){
        var getData = $.parseJSON(string);
        $('#myl_id').val(mylID);
        $('#name').val(getData.name);
        $('#thumbnail').val(getData.thumbnail);
        $('#type').val(getData.type);
        $('#episodes').val(getData.episodes);
        $('#airedTime').val(getData.airedTime);
        $('#season').val(getData.season);
        $('#studios').val(getData.studios);
        $('#duration').val(getData.duration);
        $('#genres').val(getData.genres).trigger('change');
        //Trả loading về trạng thái ban đầu
        $('#loading').html('&nbsp;');
      },
      error: function (){
        alert('Có lỗi xảy ra');
      }
    });
  });
});
$('#cbName').change(function() {
    $('#name').attr('disabled',!this.checked)
});
$('#cbHomepage').change(function() {
    $('#homepage').attr('disabled',!this.checked)
});
$('#episodes #fansub_id').editable({
  type: 'select2',
  url: 'anime/save/episode',
  source: <?php echo json_encode($fansub)?>,
  select2: {
    width: 200,
    allowClear: true
  } 
});
$('#episodes a').editable({
  type: 'text',
  url: 'anime/save/episode',
});
$('.follow-link').editable({
  url: 'test/save',
  class: 'report-content',
});
$('#bot #status').editable({
  source: [
    {value: 0, text: 'Disable'},
    {value: 1, text: 'Enable'}
  ],
  url: 'bot/save',  
});
$('#bot a').editable({
  url: 'bot/save',  
});

$('#fansub a').editable({
  type: 'text',
  url: 'fansub/save',
});


$('#genres a').editable({
  type: 'text',
  url: 'theloai/saveTL',
}); 




$('#confirmModal').on('shown.bs.modal', function() {
    var ep = $('.confirm-delete').data('ep');
    var id = $(this).data('id');
    $('#myConfirm').html("Bạn muốn xóa EP " + '<b>' + ep +' (ID: '+id+')</b>' + '?');
    removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#confirmModal').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
    var id = $('#confirmModal').data('id');
    $.ajax({
      url: 'anime/delete/episode',
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
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue'
});
$("input.anime-checkbox").click(function(){
  var val = 0;
  if($(this).is(':checked')) val = 1;
  $.ajax({
    url: 'anime/save/episode',
    type: 'POST',
    data: 'name=bd&value='+val+'&pk='+$(this).data('pk')
  })
});