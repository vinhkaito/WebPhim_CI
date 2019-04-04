<?php
/**
 *
 */
class Home_model extends MY_Model
{

    function __construct()
    {
        # code...
    }
    public function countSeries()
    {
        $query = $this->db->query("SELECT series_id FROM `episode` GROUP BY series_id");
        return $query->num_rows();
    }
    public function get($table)
    {
        return $this->db->get($table)->result();
    }
    public function get_where($table, $data)
    {
        return $this->db->get_where($table, $data)->row();
    }
    public function getSeriesWhereFansubID($fansub_id)
    {
        $query = $this->db->query("SELECT series_id FROM episode WHERE id IN ( SELECT MAX(id) FROM episode GROUP BY series_id ) and fansub_id= '$fansub_id' ORDER BY `id` DESC");
        return $query->result();
    }
    public function getSeries($id = '', $page = 1, $limit = 15)
    {
        $this->db->select('series.*, MAX(ep) as lastEpisode')
            ->join('episode', 'series.id = episode.series_id', 'inner')
            ->group_by('series.id');
        if($id) $this->db->where('series.id', $id);
        $this->db->order_by('series.airedTime', 'DESC');

        $offset = ($page<=1) ? 0 : ($page-1)*$limit;
        $this->db->limit($limit, $offset);

        $query = $this->db->get('series');
        $series = $query->result();
        if(!$series) return array();
        $this->fansubData = $this->db->get('fansub')->result();
        foreach($this->getGenres() as $genre)
            $genres[$genre->id] = $genre->name;
        //print_r($genres); exit();
        foreach ($series as $key => $seri) {
            $series[$key]->total_episodes = (!$series[$key]->total_episodes) ? '?' : $series[$key]->total_episodes;
            $arrGenres = array();
            foreach(explode(',', $seri->genres) as $genreID)
                $arrGenres[] = (object) array('id' => $genreID, 'name' => $genres[$genreID]);
            $series[$key]->genres = $arrGenres;
            $series[$key]->list_episodes = $this->getSeriesEpisodes($seri->id);
        }
        if($id) return $series[0];
        return $series;
    }
    public function getSeriesName($id = '')
    {
        $this->db->select('id, name');
        if($id) $this->db->where('id', $id);
        $series = $this->db->get('series')->result_array();
        foreach ($series as $id => $name) {
            $result[$name['id']] = $name['name'];
        }
        return $series;
    }
    public function getGenres()
    {
        $a = $this->db->get('genres')->result();
        return $a;
    }
    public function getGenreName($id)
    {
        $a = $this->db->get_where('genres', array('id' => $id))->result_array();
        return $a[0];

    }
    public function getSeriesGenres($id){
        $data = $this->db->select('genres.id, genres.name')
            ->join('genres', 'series_genres.genres_id = genres.id', 'inner')
            ->where('series_id', $id)
            ->get('series_genres');
        return $data->result();
    }
    public function getSeriesWhereGenre($id){
        $series = array();
        $this->db->order_by('id', 'DESC');
        $a = $this->db->get_where('series_genres', array('genres_id' => $id))->result_array();
        foreach ($a as $b)
            $series[] = $this->getSeries($b['series_id']);
        //foreach ($c as $seri) $d[] = $seri;
        return $series;
    }
    public function getSeriesEpisodes($id){
        $episodes = array();
        $test = array();
        $query = $this->db->select(array('id', 'ep', 'fansub_id'))
            ->where('series_id', $id)
            ->get('episode');
        $seriesEpisodes = $query->result();
        $fansubData = $this->fansubData;
        foreach($fansubData as $fansub)
            $fansubs[$fansub->id] = $fansub;
        $fansubs[0] = (object)['id' => 0, 'name' => 'Unknown'];
        foreach($seriesEpisodes as $k => $v){
            $id = $v->fansub_id;
            $episodes[$fansubs[$v->fansub_id]->id] = $fansubs[$v->fansub_id];
            $episodes[$fansubs[$v->fansub_id]->id]->episodes[sprintf('%02d',$v->ep)] = $v->id;
        }
        return $episodes;
    }
    public function getEpisodes($sid){
        $this->db->where('series', $sid);
        return $this->db->get('episode')->row();
    }
    public function getEP($id)
    {
        $this->db->where('id', $id);
        $c = $this->db->get('episode')->row_array();
        $series = $this->getSeries($c['series_id']);
        foreach ($series['episodes'] as $fansub_name => $fansub) {
            foreach($fansub['episodes'] as $episode => $episode_id)
                if($c['fansub_id'] == $fansub['id'] && $c['ep']+1 == $episode) $series['next_ep'] = $episode_id;
        }
        $z = array(
            'error' => 0,
            'name' => $series['name'].' - Tập '.$c['ep'],
            'episode' => $c['ep'],
            'series' => $series,
        );
        return $z;

    }
    public function getEpisodeLink($id)
    {
        $this->db->select('link');
        $this->db->where('id', $id);
        return $this->db->get('episode')->row_array();

    }
    public function getLastest($limit = 12)
    {
        $query = $this->db->query("SELECT episode.id, episode.ep, episode.series_id, series.name, series.thumbnail 
                                    FROM episode INNER JOIN series ON episode.series_id = series.id 
                                    WHERE episode.id IN 
                                    ( SELECT MAX(id) FROM episode GROUP BY series_id ) ORDER BY `id` DESC LIMIT $limit");
        $lastest = $query->result();
        return $lastest;
    }
    public function getTopSeriesViewedToday($limit = 12)
    {

        $query = $this->db->select('series.id, series.name, today_views,series.type,series.descriptions,
		series.genres, series.total_episodes, series.total_views, series.duration, series.studios, series.season,
		series.bluray, thumbnail, MAX(ep) as lastEpisode')
            ->join('episode', 'series.id = episode.series_id', 'inner')
            ->where('today_views > 0')
            ->order_by('today_views', 'DESC')
            ->group_by('episode.series_id')
            ->limit($limit)
            ->get('series');
        return $query->result();
    }
    public function getAnimeSeasonal($season, $limit = 12)
    {
        $query = $this->db->where('season', $season)
            ->limit($limit)
            ->order_by('total_views', 'desc')
            ->get('series');
        return $query->result();
    }
    public function getRecentUpdateSeason($season, $limit = 18)
    {
        $query = $this->db->query("
			SELECT episode.id as lastEPID, episode.ep as lastEpisode, series.*
			FROM episode
			LEFT JOIN series ON episode.series_id = series.id
			WHERE episode.id IN (SELECT MAX(id) FROM episode GROUP BY series_id) AND series.season = '$season'
			ORDER BY episode.id DESC LIMIT $limit
		");
        return $query->result();
    }
    public function getNotify()
    {
        $query = $this->db->where("name", "notify")
            ->get("temp");
        return $query->row();
    }
    public function getRecentUpdate($limit = 10)
    {
        $query = $this->db->query("
		SELECT episode.ep as lastEpisode, episode.series_id as id, series.name, series.thumbnail,
		 series.season, series.genres, series.descriptions, series.total_episodes, series.type,
		  series.bluray,series.studios,series.today_views,series.total_views,series.duration
		FROM episode
		INNER JOIN series ON episode.series_id = series.id
		WHERE episode.id IN ( SELECT MAX(id) FROM episode GROUP BY series_id )
		ORDER BY episode.id DESC
		LIMIT $limit
		");
        return $query->result();
    }
    public function get_poster($limit = 10)
    {
        $query = $this->db->select('id, name, genres, poster,descriptions, total_episodes, total_views')
            ->where("poster != ''")
            ->order_by("RAND()")
            ->limit($limit)
            ->get("series");
        return $query->result();
    }
}