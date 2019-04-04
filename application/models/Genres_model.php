<?php

    class Genres_model extends MY_Model
    {
        function __construct()
        {
            parent::__construct();
        }

        public function getGenres()
        {
            return $this->db->where("status", 1)->order_by("name")->get("genres")->result();
        }

        public function getGenreName($genre_id)
        {
            $query = $this->db->get_where('genres', "id=$genre_id");
            return $query->row();
        }

        public function getSeriesWhereGenre($genre_id)
        {
            $query = $this->db->select('series.*')
                ->join('series', 'series_genres.series_id = series.id', 'inner')
                ->where("genres_id='$genre_id'")
                ->get('series_genres');
            return $query->result();
        }
    }
?>