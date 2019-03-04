<section class="page info">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div>
                    //code o day
                </div>                        
            </div>
            <div class="col-lg-3 t-w">
                <div class="row">
                    <div class="col-lg-12">
<!--                        Bật thông báo-->
                        <a href="#" class="btn btn-block btn-sm btn-outline-danger mb-2 push-btn" data-tootik="Nhận thông báo khi có tập mới" data-tootik-conf="danger"><i class="fa fa-bell-o"></i> Bật thông báo</a>
<!--                        Anime vừa xem-->
                        <div class="mb-2">
                            <a class="btn btn-outline-success btn-block btn-sm" id="watched-list-btn" data-toggle="collapse" href="#watched-list" aria-expanded="false">
                                <i class="fa fa-clock-o"></i> Anime vừa xem
                            </a>
                            <div class="collapse" id="watched-list">
                                <div class="p-2"><a href="#">Vanquished Queens</a><a href="#">Shuudengo, Capsule Hotel de, Joushi ni Binetsu Tsutawaru Yoru.</a><a href="#">Joshiochi!: 2-kai kara Onnanoko ga... Futtekita!?</a></div>
                            </div>
                        </div>
<!--                        Xem sau-->
                        <div class="bookmark">
                            <a class="btn btn-outline-primary btn-sm btn-block" data-toggle="collapse" href="#" aria-expanded="false">
                                <i class="fa fa-bookmark"></i> Xem sau <span class="badge badge-default bookmark-count">0</span>
                            </a>
                            <div class="collapse" id="anime-bookmark">
                                <p class="pt-2">Ấn <button class="btn btn-outline-primary btn-sm"><i class="fa fa-bookmark"></i> Xem sau</button> ở mỗi anime để thêm vào danh sách</p>
                            </div>
                        </div>
                        <hr>
<!--                        Xem Nhiều Trong Ngày-->
                        <div class="most-view">
                            <h6 class="title"><i class="fa fa-star-o"></i> Xem Nhiều Trong Ngày</h6>
                            <div class="row">
                                <div class="col-sm-6 col-lg-12 anime-list-item">
                                    <a class="pull-left" href="#">
                                        <img class="anime-thumbnail" src="<?= base_url() ?>./webroot/images/Meiji-Tokyo-Renka.jpg" alt="Meiji Tokyo Renka">
                                    </a>
                                    <div class="anime-list-item-body">
                                        <a class="pull-left" href="#">Meiji Tokyo Renka</a>
                                        <p class="text-muted"><i class="fa fa-eye"></i> Lượt xem: 59</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-12 anime-list-item">
                                    <a class="pull-left" href="#">
                                        <img class="anime-thumbnail" src="<?= base_url() ?>./webroot/images/Tate-no-Yuusha-no-Nariagari.jpg" alt="Tate no Yuusha no Nariagari">
                                    </a>
                                    <div class="anime-list-item-body">
                                        <a class="pull-left" href="#">Tate no Yuusha no Nariagari</a>
                                        <p class="text-muted"><i class="fa fa-eye"></i> Lượt xem: 49</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-12 anime-list-item">
                                    <a class="pull-left" href="#">
                                        <img class="anime-thumbnail" src="<?= base_url() ?>./webroot/images/Black-Clover.jpg" alt="Black Clover">
                                    </a>
                                    <div class="anime-list-item-body">
                                        <a class="pull-left" href="#">Black Clover</a>
                                        <p class="text-muted"><i class="fa fa-eye"></i> Lượt xem: 39</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-12 anime-list-item">
                                    <a class="pull-left" href="#">
                                        <img class="anime-thumbnail" src="<?= base_url() ?>./webroot/images/B-Project-Zecchou-Emotion.jpg" alt="B-Project: Zecchou*Emotion">
                                    </a>
                                    <div class="anime-list-item-body">
                                        <a class="pull-left" href="#">B-Project: Zecchou*Emotion</a>
                                        <p class="text-muted"><i class="fa fa-eye"></i> Lượt xem: 29</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-12 anime-list-item">
                                    <a class="pull-left" href="#">
                                        <img class="anime-thumbnail" src="<?= base_url() ?>./webroot/images/Watashi-ni-Tenshi-ga-Maiorita!.jpg" alt="Watashi ni Tenshi ga Maiorita!">
                                    </a>
                                    <div class="anime-list-item-body">
                                        <a class="pull-left" href="#">Watashi ni Tenshi ga Maiorita!</a>
                                        <p class="text-muted"><i class="fa fa-eye"></i> Lượt xem: 19</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-12 anime-list-item">
                                    <a class="pull-left" href="#">
                                        <img class="anime-thumbnail" src="<?= base_url() ?>./webroot/images/High-Speed-Free-Starting-Days.jpg" alt="High☆Speed!: Free! Starting Days">
                                    </a>
                                    <div class="anime-list-item-body">
                                        <a class="pull-left" href="#">High☆Speed!: Free! Starting Days</a>
                                        <p class="text-muted"><i class="fa fa-eye"></i> Lượt xem: 09</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>