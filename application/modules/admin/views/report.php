<div class="row">
    <div class="col-lg-7">
        <div class="box box-primary">
            <div class="box-header with-border">
              <div class="box-title">Report</div>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover report-table">
                <thead>
                    <tr>
                        <th style="width: 30px;">#</th>
                        <th style="width: 50px;">EP ID</th>
                        <th style="">Content</th>
                        <th style="width: 135px;">Time</th>
                        <th style="width: 20px;">Fix</th>
                        <th style="width: 20px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $item) { ?>
                        <tr>
                            <td><?php echo $item->id?></td>
                            <td><?php echo $item->episode_id ?></td>
                            <td class="report-content"><?php echo $item->content ?></td>
                            <td><?php echo $item->time ?></td>
                            <td><input type="checkbox" class="minimal" data-reportid="<?php echo $item->id ?>" <?php echo ($item->fixed) ? 'checked' : '' ?>></td>
                            <td><button class="btn btn-primary btn-xs fix-btn" onclick="reportFix(<?php echo "$item->id , $item->episode_id"?>);" data-reportid="<?php echo $item->id ?>" data-id="<?php echo $item->episode_id ?>">Fix</button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="box box-primary" id="reportEdit" style="display: none;">
            <div class="box-header with-border">
                <div class="box-title">Report ID: <span id="reportID"></span></div>
            </div>
            <div class="box-body">
                <ul class="list-unstyled" id="reportInfo">
                    <li><strong>Episode ID:</strong> <span id="episodeID"></span></li>
                    <li><strong>Episode:</strong> <span id="episode"></span></li>
                    <li><strong>Anime:</strong> <span id="seriesName"></span></li>
                    <li><strong>Fansub:</strong> <span id="fansubName"></span></li>
                    <li id="episodeLink"><a href="#" id="link">{link}</a></li>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary" id="fixed-btn">Set Fixed</button>
                <button class="btn btn-default pull-right" id="close-btn">Close</button>
            </div>
        </div>
    </div>
</div>
<style type="text/css" media="screen">
.report-content{
    max-width: 135px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<script>
var test;
function reportFix(reportID, episodeID){
        $("#reportEdit").hide('fast');
        $("#reportEdit").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $("#reportEdit").show('fast');
        $("#fixed-btn").data('reportid', reportID);
        //var episodeID = $(this).data('id');
        test = episodeID;
        $.ajax({
            type: "GET",
            url: "report/info/"+episodeID,
            success: function(result){
                $("#episodeID").html(episodeID);
                $("#episode").html(result.ep);
                $("#seriesName").html(result.series_name);
                $("#fansubName").html(result.fansub_name);
                $("#episodeLink a").remove();
                $("#episodeLink").html('<li id="episodeLink"><a href="#" id="link" data-pk="'+episodeID+'">'+result.link+'</a></li>');
                $('a#link').editable({
                    type: 'text',
                    url: 'anime/save/episode',
                    //pk: episodeID,
                });
            }
        });
        $("#reportEdit .overlay").remove();
    };

$(document).ready(function(){
    $(".report-table").dataTable({
        order: [0, 'desc']
    });
    
    $("#fixed-btn").click(function(){
        var reportID = $(this).data('reportid');
        $.ajax({
            type: "POST",
            url: "report/fixed",
            data: "id="+reportID,
            success: function(result){
                $('[data-reportid='+reportID+']').parent('div').attr('class', 'icheckbox_minimal-blue checked');
                $("#reportEdit").hide('fast');
            }
        });
    });
    $("#close-btn").click(function(){
        $("#reportEdit").hide('fast');
    });
  $("body").click(function(){$('#searchResults').hide();});
  $('[data-toggle="tooltip"]').tooltip();
});
</script>