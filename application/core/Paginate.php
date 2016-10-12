<?php

/**
 * Created by PhpStorm.
 * User: Rickardh
 * Date: 2016-10-12
 * Time: 19:47
 */
class Paginate
{

    private $rows;
    private $currentpage = 0;
    private $pages;

    /**
     * Paginate constructor.
     * @param $sql
     * @param null $data
     * @param int $items_per_page
     */
    public function __construct($sql, $data = null, $items_per_page = 10)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $pages = $database->prepare("SELECT COUNT(*) as amount FROM " . $sql);
        $pages->execute($data);
        $this->rows = $pages->fetchObject()->amount;
        $page = Request::get("page");
        if (isset($page)) {
            $this->currentpage = $page;
        }
        $this->pages = ($this->rows / $items_per_page);
    }

    public function render()
    {
        $url = rtrim(Config::get('URL'), '/') . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        echo '<ul class="pagination" > ';
        if ($this->currentpage != 0) {
            echo '<li ><a href = "' . $url . '?page=' . ($this->currentpage - 1) . '" > «</a ></li > ';
        }
        for ($i = round($this->currentpage - 5); $i < ($this->currentpage + 5); $i++) {
            if ($i >= 0 && $i < $this->pages) {
                if ($i == $this->currentpage) {
                    echo '<li class="active" ><a href = "' . $url . '?page=' . $i . '" > ' . ($i + 1) . '</a ></li > ';
                } else {
                    echo '<li ><a href = "' . $url . '?page=' . $i . '" > ' . ($i + 1) . '</a ></li > ';
                }
            }
        }
        if ($this->currentpage < $this->pages - 1) {
            echo '<li ><a href = "' . $url . '?page=' . ($this->currentpage + 1) . '" > »</a ></li > ';
        }
        echo '</ul>';
    }
}