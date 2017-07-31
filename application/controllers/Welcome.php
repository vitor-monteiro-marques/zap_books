<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function index()
    {

        $this->load->library('book');
        $this->load->helper('url');

        $csvMimetypes = array(
            'text/csv',
            'text/plain',
            'application/csv',
            'text/comma-separated-values',
            'application/excel',
            'application/vnd.ms-excel',
            'application/vnd.msexcel',
            'text/anytext',
            'application/octet-stream',
            'application/txt',
        );
        $fileChoosen = false;

        if (isset($_POST['submit'])) {
            if (isset($_FILES['file'])) {
                     //if there was an error uploading the file
                if ($_FILES['file']['error'] > 0) {
                    echo 'Return Code: ' . $_FILES['file']['error'] . '<br>';
                } else {
                        // check if csv
                    if (!in_array($_FILES['file']['type'], $csvMimetypes)) {
                        echo 'Not a valid CSV!';
                    } else {
                        $storagename = 'uploaded_file.csv';
                        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $storagename);
                        $this->parseCSV('uploads/' .  $storagename);
                        $fileChoosen = true;
                    }
                }
            } else {
                    echo 'No file selected <br>';
            }
        }

        if (!$fileChoosen) {
             $this->parseCSV('basket.csv');
        }
       

        //Send data to view
        $data['library'] = $this->book->getLibrary();
        $data['formLibrary'] = $this->book->getFormatedLibrary();
        $data['totalPrice'] = $this->book->getTotalPrice();
        $data['totalBooks'] = $this->book->getTotalBooks();

        $this->load->view('includes/header', $data);
        $this->load->view('index.php');
        $this->load->view('includes/footer');
    }


    public function parseCSV($file)
    {

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
