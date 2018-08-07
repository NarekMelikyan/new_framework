<?php

namespace application\controllers;

use application\core\View;

class BookController{

    public function get_book($param1,$param2,$param3){
        View::render('book_item', $variables = [ 'p1' => $param1, 'p2' => $param2, 'p3' => $param3 ]);
    }

    public function show_all_books(){
        echo 'This is all books list';
    }
}