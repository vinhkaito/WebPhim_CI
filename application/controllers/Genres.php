<?php

    class Genres extends Anime_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('genres_model');
        }

        public function index()
        {
            $this->mPageTitle = 'Thể Loại';
            $this->mViewData['data'] = $this->genres_model->getGenres();
            $this->render('genres_index');
        }
    }
?>


