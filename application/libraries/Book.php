<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Book
{
    private $type;
    private $title;
    private $authors;
    private $ISBN;
    private $price;
    private static $library = array();
    private static $totalPrice = 0;
// function __construct($tile, $authors, $ISBN, $price) {
//         $this->title = $title;
//         $this->authors = $authors;
//         $this->ISBN = $ISBN;
//         $this->price = $price;

//     }

//    function createBook($tile, $authors, $ISBN, $price) {
//         $this->title = $title;
//         $this->authors = $authors;
//         $this->ISBN = $ISBN;
//         $this->price = $price;

//     }

    function createBookFromArray(array $arrayBook)
    {
        // $this->type = $arrayBook[0];
        // $this->title = $arrayBook[1];
        // $this->ISBN = $arrayBook[2];
        // $this->price = $arrayBook[3];
        // $this->authors = $arrayBook[4];
        
        array_push(self::$library, $arrayBook);
    }

    function getLibrary()
    {
        return self::$library;
    }

    function getBookType(array $book) {
        return $book[0];
    }

    function getBookTitle(array $book) {
        return $book[1];
    }

    function getBookISBN(array $book) {
        return $book[2];
    }

    function getBookPrice(array $book) {
      return  $this->getDiscountedPrice($book[3], $this->getBookType($book));
    }

    function getBookAuthors(array $book) {
        if (strpos($book[4], '|') !== false) {
          return str_replace(" | ",", ",$book[4]);
        }
        return $book[4];
    }


    function getTotalPrice()
    {
        foreach (self::$library as $key => $value) {

              $price = $this->getDiscountedPrice($value[3], $value[0]);
                self::$totalPrice+= $price;
            
        }

        return number_format((float)self::$totalPrice, 2, '.', '');
    }

    function getFormatedLibrary() {
//TODO
        foreach (self::$library as $key => $value) {
           
               
            
        }

    }

    function getDiscountedPrice($price, $bookType) {
        if ($bookType == 'NewBook') {
                return $price - $price * 10 / 100;
            } else if($bookType == 'UsedBook') {
               return $price - $price * 25 / 100;
            } 
            return $price;
    }

}
