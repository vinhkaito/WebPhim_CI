<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">Danh sách thể loại</h4>
                <div class="box-tools">    
                </div>
            </div>
            <div class="box-body">
                <table id="genres" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="sorting_desc" style="width: 10px;">ID</th>
                            <th style="width: 50px;">Tên</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($genres as $genre): ?>
                        <tr>
                            <td><?= $genre->id ?></td>
                            <td><?= $genre->name ?></td>
                            <td><a href="#" id="status" data-pk="<?php echo $genre->status?>"> <?php echo $genre->status ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
