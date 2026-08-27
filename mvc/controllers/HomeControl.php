<?php
require_once BASE_PATH . '/models/HomeModel.php';

class homeController
{
    public function index (): void
    {
        $model = new HomeModel();
        $data = $model->getData();

        require_once __DIR__ . '/../views/homeView.php';    
    }
}