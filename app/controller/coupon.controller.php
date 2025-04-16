<?php 
require_once(dirname(__DIR__) . "../models/coupon.model.php");
class CouponController
{
    private $couponModel;
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        $this->couponModel = new CouponModel($this->db);
    }

    public function getAllCoupons()
    {
        return $this->couponModel->getAllCoupons();
    }

    public function getCouponById($id)
    {
        return $this->couponModel->getCouponById($id);
    }

    public function addCoupon($data)
    {
        return $this->couponModel->createCoupon($data);
    }

    public function updateCoupon($id, $data)
    {
        return $this->couponModel->updateCoupon($id, $data);
    }

    public function deleteCoupon($id)
    {
        return $this->couponModel->deleteCoupon($id);
    }
}



?>