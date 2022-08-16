<?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

    class Post {

        private $id;
        private $title;
        private $content;
        private $image;
        private $created_at;
        private $user_id;

        private $connection;

        public function __construct($connection) {
            $this->connection = $connection;
        }

        public function create($title, $content, $image, $created_at, $user_id) {

            $query = "INSERT INTO `posts` (`id`, `title`, `content`, `image`, `created_at`, `user_id`) 
            VALUES (NULL, '$title', '$content', '$image', '$created_at', '$user_id')";
            
            $this->connection->query($query);

        }

        public function read($id) {
            $query = "SELECT * FROM posts";
            $this->connection->query($query);
        }

        public function update($id) {

        }

        public function delete($id) {

        }

        public function getId() {
            return $this->id;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getContent() {
            return $this->content;
        }
        public function getImage() {
            return $this->image;
        }

        public function getDate() {
            return $this->created_at;
        }

        public function getUserId() {
            return $this->user_id;
        }

    }