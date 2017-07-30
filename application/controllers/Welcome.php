<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {

    // 	$this->load->model('book_model');
    // $this->book_model->getBookFromCSV();

        $this->load->library('book');

//$book->createBook();

        // $file = fopen("basket.csv", "r");
        //var_dump(fgetcsv($file));
// $csv = array_map('str_getcsv', file('basket.csv'));
// print_r($csv);
        // while (($row = fgetcsv($file, 0, ",")) !== false) {
    //Dump out the row for the sake of clarity.
        //     echo('/n');
        //     var_dump($row[0]);
        // }


        $csv = array();
        $lines = file('basket.csv', FILE_IGNORE_NEW_LINES);

        foreach ($lines as $key => $value) {
            if ($key != 0) {
                $csv[$key] = str_getcsv($value);
				$book = new Book();
				$book->createBookFromArray(str_getcsv($value));

                //$this->book->createBookFromArray(str_getcsv($value));
            }
        }

        echo '<pre>';
        print_r($this->book->getLibrary());
        echo '</pre>';
        print_r($this->book->getTotalPrice());

        $data['library'] = $this->book->getLibrary();
        $data['formLibrary'] = $this->book->getFormatedLibrary();
        $data['total'] = $this->book->getTotalPrice();

        //fclose($file);
        $this->load->view('includes/header', $data);
        $this->load->view('welcome_message');
        $this->load->view('includes/footer');
    }
}
