<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-film"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Series</span>
                <span class="info-box-number"><?=$dashboard['series']?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-file"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Episodes</span>
                <span class="info-box-number"><?=$dashboard['episodes']?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div>
        </div><!-- /.row -->