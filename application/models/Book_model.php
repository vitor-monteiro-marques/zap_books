<?php 

class Book_model extends CI_Model {

        private $title;
        private $authors;
        private $ISBN;
        private $price;


        public function getBookFromCSV($tile, $authors, $ISBN, $price) {
        $this->title = $title;
        $this->authors = $authors;
        $this->ISBN = $ISBN;
        $this->price = $price;
    }

        public function get_last_ten_entries()
        {
                $query = $this->db->get('entries', 10);
                return $query->result();
        }

        public function insert_entry()
        {
                $this->title    = $_POST['title']; // please read the below note
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->insert('entries', $this);
        }

        public function update_entry()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('entries', $this, array('id' => $_POST['id']));
        }

}
