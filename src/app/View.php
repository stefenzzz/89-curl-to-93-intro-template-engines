<?php


namespace App;

use App\Exceptions\ViewNotFoundException;
use App\Enums\InvoiceStatus;

class View
{
    public function __construct(
        private string $view,
        private array $params = []
    )
    {

    }
    public static function make(string $view, array $params = []):static
    {
        return new static($view, $params);
    }

    public function render():string
    {
        $viewPath = VIEWS_PATH.'/'.$this->view.'.php';

        if(!file_exists($viewPath))
        {
            throw new ViewNotFoundException($this->view.'.php didnt exists');
        }

        extract($this->params);

        ob_start();

        include $viewPath;

        return (string) ob_get_clean();

    }

    public function __toString()
    {
        return $this->render();
    }
}