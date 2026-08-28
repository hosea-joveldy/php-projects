<?php
require_once BASE_PATH . '/models/HomeModel.php';

class homeController
{
    private HomeModel $model;

    public function __construct()
    {
        $this->model = new HomeModel();
    }

    public function index (): void
    {
        $data = $this->model->getData();

        require_once __DIR__ . '/../views/homeView.php';    
    }

    public function addItem (): void
    {
        $nama_bahan = $_POST["nama_bahan"];
        $kategori = $_POST["kategori"];
        $this->model->addData($nama_bahan, $kategori);
    }
}