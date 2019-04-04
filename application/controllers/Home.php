<?php
//    defined('BASEPATH') OR exit('No direct script access allowed');
//
//    class Home extends Anime_Controller {
//
//        function __construct()
//        {
//            parent::__construct();
//            $this->load->library('pagination');
//            $this->load->model('home_model');
//        }
//
//        public function index()
//        {
//            $this->load->helper('text');
//            $this->load->model('genres_model');
//            $genres = array();
//            foreach ($a = $this->genres_model->getGenres() as $genre)
//                $genres[$genre->id] = $genre->name;
//
//            $this->meta->dscription = "Anime Vietsub Online, Xem phim anime, Anime hay, Anime Download, Anime HD,Xem VietSub Online sớm nhất tại localhost với nhiều nội dung phong phú và hấp dẫn. Các Anime HOT luôn được cập nhật sớm nhất. Đón xem One Piece, Dragon Ball Super sớm nhất và nhiều Anime hấp dẫn khác tại đây.Xem anime Vietsub online miễn phí chất lượng cao với đường truyền nhanh, các anime HOT luôn được cập nhật sớm nhất Việt Nam";
//            $this->meta->keywords = "anime hay, anime vietsub, hoat hinh anime, phim anime, phim anime hay nhat, anime hay nên xem, anime vietsub hay,anime vietsub, xem anime, vui ghe, naruto, vua hai tac, one piece, hoi phap su, fairy tail, bleach, dragon ball, dao hai tac";
//
//            $year = 2019;
//            $month = 4;
//            $previousYear = $year;
//            if ($month <= 3)
//            {
//                $season = 'Winter';
//                $previousSeason = 'Fall';
//                $previousYear = $year-1;
//            }
//            elseif ($month <= 6)
//            {
//                $season = 'Spring';
//                $previousSeason = 'Winter';
//            }
//            elseif ($month <= 9)
//            {
//                $season = 'Summer';
//                $previousSeason = 'Spring';
//            }
//            else
//            {
//                $season = 'Fall';
//                $previousSeason = 'Summer';
//            }
//            $this->mViewData['seasonal'] = $seasonal = "$season $year";
//            $this->mViewData['previousYear'] = $previousSeasonal = "$previousSeason $previousYear";
//
//            $animePreviousSeasonal = $this->home_model->getRecentUpdateSeason($previousSeason, 12);
//            foreach ($animePreviousSeasonal as $key => $anime)
//            {
//                $arrGenres = array();
//                if($anime->genres)
//                    foreach (explode(',', $anime->genres) as $genresID)
//                        $arrGenres[] = $genres[$genresID];
//                $animePreviousSeasonal[$key]->genres = $arrGenres;
//                $animePreviousSeasonal[$key]->slug = $this->toAscii("$anime->name $anime->id");
//            }
//
//            $animeSeasonal = $this->home_model->getAnimeSeasonal($season);
//            foreach ($animeSeasonal as $key => $seri)
//                $animeSeasonal[$key]->slug = $this->toAscii("$seri->name $seri->id");
//
//            $this->mViewData['animeSeasonal'] = $animeSeasonal;
//            $this->mViewData['animePreviousSeasonal'] = $animePreviousSeasonal;
//
//            $blockSeason = $this->home_model->getRecentUpdateSeason("$season $year", 12);
//            foreach ($blockSeason as $key => $anime) {
//                $arrGenres = array();
//                if ($anime->genres)
//                    foreach (explode(',', $anime->genres) as $genresID)
//                        $arrGenres[] = $genres[$genresID];
//                $blockSeason[$key]->genres = $arrGenres;
//                $blockSeason[$key]->slug = $this->toAscii("$anime->name $anime->id");
//                if(!$anime->total_episodes) $anime->total_episodes = "?";
//            }
//            $this->mViewData['blockSeason'] = $blockSeason;
//
//            $total = $this->home_model->countSeries('series');
//            $perpage = 10;
//            $page = $this->input->get('p');
//            $page = empty($page) ? 1 : $page;
//
//            $a = $this->mViewData['data'] = $this->home_model->getRecentUpdateSeason(18);
//
//            foreach ($this->mViewData['data'] as $key => $anime) {
//                $arrGenres = array();
//                if($anime->genres)
//                    foreach (explode(',', $anime->genres) as $genrenID)
//                        $arrGenres[] = $genres[$genresID];
//                    $this->mViewData['data'][$key]->genres = $arrGenres;
//                    $this->mViewData['data'][$key]->slug = $this->toAscii("$anime->anime-$anime->id");
//                    if(!$anime->total_episodes) $anime->total_episodes = "?";
//            }
//
//            $lastest = $this->home_model->getLastest();
//            foreach ($lastest as $key => $seri)
//                $lastest[$key]->slug = $this->toAscii("$seri->name-$seri->series_id");
//            $this->mViewData['lastest'] = $lastest;
//
//            $this->mViewData['TopSeriesViewedToday'] = $this->home_model->getTopSeriesViewedToday();
//            foreach ($this->mViewData['TopSeriesViewedToday'] as $key => $anime)
//            {
//                $this->mViewData['TopSeriesViewedToday'][$key]->slug = $this->toAscii("$anime->name-$anime->id");
//
//                $animeGenres = array();
//                foreach (explode(',', $anime->genres) as $genresID)
//                    $animeGenres[] = $genres[$genresID];
//                $this->mViewData['TopSeriesViewedToday'][$key]->genres = $animeGenres;
//            }
//
//            $this->mViewData['notify'] = $this->home_model->getNotify();
//
//            $this->mViewData['pagination'] = $this->pagination->render($total, $perpage);
//
//            $poster = $this->home_model->get_poster(5);
//            foreach ($poster as $k => $v) {
//                $poster[$k]->descriptions = word_limiter(strip_tags($v->descriptions));
//                $posterGenres = array();
//                foreach (explode(',', $v->genres) as $genresID)
//                    $posterGenres[] = $genres[$genresID];
//                $poster[$k]->genres = $posterGenres;
//            }
//
//            $this->mViewData['poster'] = $poster;
//            $this->render('home', 'default');
//        }
//    }
//?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends Anime_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('home_model');

    }

    public function index()
    {
        $this->load->helper('text');
        $this->load->model('genres_model');
        $genres = array();
        foreach($a = $this->genres_model->getGenres() as $genre)
            $genres[$genre->id] = $genre->name;

        //$meta = (object) [];
        $this->meta->description = "Anime Vietsub Online, Xem phim anime, Anime hay, Anime Download, Anime HD,Xem VietSub Online sớm nhất tại localhost với nhiều nội dung phong phú và hấp dẫn. Các Anime HOT luôn được cập nhật sớm nhất. Đón xem One Piece, Dragon Ball Super sớm nhất và nhiều Anime hấp dẫn khác tại đây.Xem anime Vietsub online miễn phí chất lượng cao với đường truyền nhanh, các anime HOT luôn được cập nhật sớm nhất Việt Nam";
        $this->meta->keywords = "anime hay, anime vietsub, hoat hinh anime, phim anime, phim anime hay nhat, anime hay nên xem, anime vietsub hay,anime vietsub, xem anime, vui ghe, naruto, vua hai tac, one piece, hoi phap su, fairy tail, bleach, dragon ball, dao hai tac";

        //$year = date('Y');
        //$month = date('m');
        $year = 2018;
        $month = 10;
        $previousYear = $year;
        if($month <= 3) {$season = 'Winter'; $previousSeason = 'Fall'; $previousYear = $year-1;}
        elseif($month <= 6) {$season = 'Spring'; $previousSeason = 'Winter';}
        elseif($month <= 9) {$season = 'Summer'; $previousSeason = 'Spring';}
        else {$season = 'Fall'; $previousSeason = 'Summer';}
        $this->mViewData['seasonal'] = $seasonal = "$season $year";
        $this->mViewData['previousSeasonal'] = $previousSeasonal = "$previousSeason $previousYear";

        //$animePreviousSeasonal = $this->home_model->getAnimeSeasonal($previousSeasonal, 18);
        $animePreviousSeasonal = $this->home_model->getRecentUpdateSeason($previousSeasonal, 12);
        foreach($animePreviousSeasonal as $key => $anime){
            $arrGenres = array();
            if($anime->genres)
                foreach(explode(',', $anime->genres) as $genreID)
                    $arrGenres[] = $genres[$genreID];
            $animePreviousSeasonal[$key]->genres = $arrGenres;
            $animePreviousSeasonal[$key]->slug = $this->toAscii("$anime->name $anime->id");
        }

        $animeSeasonal = $this->home_model->getAnimeSeasonal($seasonal);
        foreach ($animeSeasonal as $key => $seri)
            $animeSeasonal[$key]->slug = $this->toAscii("$seri->name $seri->id");


        $this->mViewData['animeSeasonal'] = $animeSeasonal;
        $this->mViewData['animePreviousSeasonal'] = $animePreviousSeasonal;


        $blockSeason = $this->home_model->getRecentUpdateSeason("$season $year", 12);
        foreach ($blockSeason as $key => $anime) {
            $arrGenres = array();
            if($anime->genres)
                foreach(explode(',', $anime->genres) as $genreID)
                    $arrGenres[] = $genres[$genreID];
            $blockSeason[$key]->genres = $arrGenres;
            $blockSeason[$key]->slug = $this->toAscii("$anime->name $anime->id");
            if(!$anime->total_episodes) $anime->total_episodes = "?";
        }
        $this->mViewData['blockSeason'] = $blockSeason;

        $total = $this->home_model->countSeries('series');
        $perpage = 10;
        $page = $this->input->get('p');
        $page = empty($page) ? 1 : $page;
        //$this->add_stylesheet('assets/foundation/css/foundation-grid.css');

        $a = $this->mViewData['data'] = $this->home_model->getRecentUpdate(18);

        foreach($this->mViewData['data'] as $key => $anime){
            $arrGenres = array();
            if($anime->genres)
                foreach(explode(',', $anime->genres) as $genreID)
                    $arrGenres[] = $genres[$genreID];
            $this->mViewData['data'][$key]->genres = $arrGenres;
            $this->mViewData['data'][$key]->slug = $this->toAscii("$anime->name-$anime->id");
            if(!$anime->total_episodes) $anime->total_episodes = "?";
        }

        $lastest = $this->home_model->getLastest();
        foreach($lastest as $key => $seri)
            $lastest[$key]->slug = $this->toAscii("$seri->name-$seri->series_id");
        $this->mViewData['lastest'] = $lastest;


        $this->mViewData['TopSeriesViewedToday'] = $this->home_model->getTopSeriesViewedToday();
        foreach($this->mViewData['TopSeriesViewedToday'] as $key => $anime) {
            $this->mViewData['TopSeriesViewedToday'][$key]->slug = $this->toAscii("$anime->name-$anime->id");

            $animeGenres = array();
            foreach (explode(',', $anime->genres) as $genreID)
                $animeGenres[] = $genres[$genreID];
            $this->mViewData['TopSeriesViewedToday'][$key]->genres = $animeGenres;
        }

        $this->mViewData['notify'] = $this->home_model->getNotify();

        $this->mViewData['pagination'] = $this->pagination->render($total, $perpage);

        $poster = $this->home_model->get_poster(5);
        foreach ($poster as $k => $v) {
            $poster[$k]->descriptions = word_limiter(strip_tags($v->descriptions));
            $posterGenres = array();
            foreach (explode(',', $v->genres) as $genreID)
                $posterGenres[] = $genres[$genreID];
            $poster[$k]->genres = $posterGenres;
        }
        //print_r($poster); exit();

        $this->mViewData['poster'] = $poster;
        $this->render('home', 'default');
        //$this->render('home', 'full_width');
    }
}

