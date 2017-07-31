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

    function createBookFromArray(array $arrayBook)
    {
        array_push(self::$library, $arrayBook);
    }

    function getLibrary()
    {
        return self::$library;
    }

    function getBookType(array $book)
    {
        return $book[0];
    }

    function getBookTitle(array $book)
    {
        return $book[1];
    }

    function getBookISBN(array $book)
    {
        return $book[2];
    }

    function getBookPrice(array $book)
    {
        return $p = $this->getDiscountedPrice($book[3], $this->getBookType($book));
    }

    function getBookAuthors(array $book)
    {
        if (strpos($book[4], '|') !== false) {
            return str_replace('|', ', ', $book[4]);
        }
        return $book[4];
    }


    function getTotalPrice()
    {
        self::$totalPrice = 0;
        foreach (self::$library as $key => $value) {
              $price = $this->getDiscountedPrice($value[3], $value[0]);
                self::$totalPrice+= $price;
        }

        return number_format((float)self::$totalPrice, 2, '.', '');
    }

    function getTotalBooks()
    {
          return count(self::$library);
    }

    function getFormatedLibrary()
    {
        $formLib = array();
        foreach (self::$library as $key => $value) {
              array_push($formLib, '€ '.$this->getBookPrice($value). ' ['.$this->getBookType($value). '] '.$this->getBookISBN($value). ': '.$this->getBookTitle($value). ' - ' . $this->getBookAuthors($value) .'<br>');
        }
        return $formLib;
    }

    function getDiscountedPrice($price, $bookType)
    {
        if ($bookType == 'NewBook') {
                return number_format((float)$price - $price * 10 / 100, 2, '.', '');
        } elseif ($bookType == 'UsedBook') {
            return number_format((float)$price - $price * 25 / 100, 2, '.', '');
        }
         return number_format((float)$price, 2, '.', '');
    }
}
