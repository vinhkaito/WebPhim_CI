<?php header("Content-type: application/javascript"); ?>
$(function () {
  $(".select2").select2();
});
$(document).ready(function(){
  $('#mylgetbtn').click(function() {
    var mylID = $('#mylID').val();
    $.ajax({
      url: '<?php echo base_url("$controller/myl") ?>/'+mylID,
      type: 'GET',
      cache: false,
      success: function(string){
        var getData = $.parseJSON(string);
        $('#name').val(getData.name);
        $('#thumbnail').val(getData.thumbnail);
        $('#type').val(getData.type);
        $('#episodes').val(getData.episodes);
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
$('#episodes #fansub').editable({
  type: 'select2',
  url: 'post',
  source: <?php echo json_encode($fansub)?>,
  select2: {
    width: 200,
    allowClear: true
  } 
});
$('#episodes #link').editable({
  type: 'text',
  url: '/post',
});