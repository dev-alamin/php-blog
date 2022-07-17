<?php
/*
* Format Class
* @return mixed 
*/

class Format
{
    // Format date
    public function formatDate($date){
        return date('F j, Y, g:i a', strtotime($date));
    }

    // Shorten text for blog post in index page
    public function shortenText($text, $limit = 400){
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . "...";
        return $text;
    }

    /*
    * Pagination for the pages
    * return page number
    */

    public function blogPagination($page){
        for ($i = 1; $i < $page; $i++) {
            echo '<a href="index.php?page=' . $i . '">' . $i . '</a>';
        }
        
        return $page;
    }

    /**
     * Validate user login information
     *
     * @param string $data
     * @return void
     */
    public function validation($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    public function title()
    {   
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');

        if($title == 'contact'){
            $title = 'contact';
        }elseif($title == 'index'){
            $title = 'home';
        }

        return $title = ucfirst($title);
    }
}
