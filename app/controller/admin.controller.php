<?php
require_once(dirname(__DIR__) . "../config/config.php");
require_once(dirname(__DIR__) . "../models/user.model.php");
require_once(dirname(__DIR__) . "../models/product.model.php");
require_once(dirname(__DIR__) . "../models/category.model.php");
require_once(dirname(__DIR__) . "../models/order.model.php");
require_once(dirname(__DIR__) . "../lib/database.php");
require_once(dirname(__DIR__) . '../dto/user.dto.php');
?>
<?php
class AdminController{
    private $db;

    private $userModel;
    private $productModel;
    private $orderModel;
    private $categoryModel;


    public function __construct()
    {
        $this->db = new Database();
        $this->userModel = new UserModel($this->db);
        $this->productModel = new ProductModel($this->db);
        $this->orderModel = new OrderModel($this->db);
        $this->categoryModel = new CategoryModel($this->db);
    }

    public function getDashboardData() {
        return [
            'totalOrders' => $this->orderModel->countOrders(),
            'totalRevenue' => $this->orderModel->sumCompletedOrders(),
            'totalCustomers' => $this->userModel->countCustomers(),
            'totalProducts' => $this->productModel->countProducts(),
            'topProducts' => $this->orderModel->getTopSellingProducts(),
            'recentOrders' => $this->orderModel->getRecentOrders(),
            'topCategories' => $this->orderModel->getTopSellingCategories()
        ];
    }


}