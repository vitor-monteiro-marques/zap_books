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

        $this->load->library('book');
        $this->load->helper('url');

        $fileChoosen = false;

        if (isset($_POST["submit"])) {
           
            if (isset($_FILES["file"])) {
                     //if there was an error uploading the file
                if ($_FILES["file"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                } else {
                        //Print file details
                    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                    echo "Type: " . $_FILES["file"]["type"] . "<br />";
                    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                        $storagename = "uploaded_file.txt";
                        move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $storagename);
                        echo "Stored in: " . "uploads/" . $_FILES["file"]["name"] . "<br>";
                        $this->parseCSV("uploads/" .  $storagename);
                        $fileChoosen = true;
                }
            } else {
                    echo "No file selected <br>";
            }
        }
//TODO: count dos livros
//TODO: Check if CSV
    if(!$fileChoosen) {
         $this->parseCSV("basket.csv");
    }
       
        echo '<pre>';
        print_r($this->book->getLibrary());
        echo '</pre>';
        print_r($this->book->getTotalPrice());

        //Send data to view
        $data['library'] = $this->book->getLibrary();
        $data['formLibrary'] = $this->book->getFormatedLibrary();
        $data['total'] = $this->book->getTotalPrice();

        //fclose($file);
        $this->load->view('includes/header', $data);
        $this->load->view('welcome_message');
        $this->load->view('includes/footer');
    }


    public function parseCSV($file) {

         $csv = array();
        $lines = file($file, FILE_IGNORE_NEW_LINES);

        foreach ($lines as $key => $value) {
            if ($key != 0) {
                $csv[$key] = str_getcsv($value);
                $book = new Book();
                $book->createBookFromArray(str_getcsv($value));

            }
        }

        return $book;

    }
}
