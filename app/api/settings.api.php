<?php
require_once(dirname(__DIR__) . '/controller/setting.controller.php');
require_once(dirname(__DIR__) . '/controller/tax.controller.php');
require_once(dirname(__DIR__) . '/controller/coupon.controller.php');

$settingsController = new SettingsController();
$taxController = new TaxController();
$couponController = new CouponController();

header('Content-Type: application/json');

$action = $_GET['action'] ?? $_POST['action'] ?? null;

if (!$action) {
    echo json_encode(["success" => false, "message" => "Missing action"]);
    exit();
}

switch ($action) {
    case 'getSettings':
        $general = $settingsController->getStoreInfo();
        $taxRules = $taxController->getAllTaxRules();
        $taxClass = $taxController->getTaxClasses();
        $coupons = $couponController->getAllCoupons();
        echo json_encode([
            "success" => true,
            "general" => $general,
            "tax" => [
                "rules" => $taxRules,
                "classes" => $taxClass
            ],
            "coupons" => $coupons
        ]);
        break;

    case 'saveGeneralSettings':
        $data = $_POST;
        $success = $settingsController->updateStoreInfo($data);
        echo json_encode([
            "success" => $success,
            "message" => $success ? "General settings saved" : "Failed to update general settings"
        ]);
        break;

    case 'addTaxRule':
        $rule = $_POST;
        $success = $taxController->addTaxRule($rule);
        echo json_encode([
            "success" => $success,
            "message" => $success ? "Tax rule added" : "Failed to add tax rule"
        ]);
        break;

    case 'updateTaxRule':
        $rule = $_POST;
        $success = $taxController->updateTaxRule($rule['id'], $rule);
        echo json_encode([
            "success" => $success,
            "message" => $success ? "Tax rule updated" : "Failed to update tax rule"
        ]);
        break;
        case 'updateTaxRuleStatus':
            $rule = $_POST;
            $success = $taxController->updateTaxRuleStatus($rule['id'], $rule);
            echo json_encode([
                "success" => $success,
                "message" => $success ? "Tax rule status updated" : "Failed to update tax rule"
            ]);
            break;   
    case 'deleteTaxRule':
        $id = $_POST['id'];
        $success = $taxController->deleteTaxRule($id);
        echo json_encode([
            "success" => $success,
            "message" => $success ? "Deleted tax rule" : "Failed to delete tax rule"
        ]);
        break;

    case 'addTaxClass':
        $class = $_POST;
        $success = $taxController->addTaxClass($class['name'],$class['description']);
        echo json_encode([
            "success" => $success,
            "message" => $success ? "Tax class added" : "Failed to add tax class"
        ]);
        break;

    case 'updateTaxClass':
        $class = $_POST;
        $success = $taxController->updateTaxClass($class['id'], $class['name'],$class['description']);
        echo json_encode([
            "success" => $success,
            "message" => $success ? "Tax class updated" : "Failed to update tax class"
        ]);
        break;

    case 'deleteTaxClass':
        $id = $_POST['id'];
        $success = $taxController->deleteTaxClass($id);
        echo json_encode([
            "success" => $success,
            "message" => $success ? "Deleted tax class" : "Failed to delete tax class"
        ]);
        break;

    case 'addCoupon':
        $coupon = $_POST;
        $success = $couponController->addCoupon($coupon);
        echo json_encode([
            "success" => $success,
            "message" => $success ? "Coupon added" : "Failed to add coupon"
        ]);
        break;

    case 'updateCoupon':
        $coupon = $_POST;
        $success = $couponController->updateCoupon($coupon['id'], $coupon);
        echo json_encode([
            "success" => $success,
            "message" => $success ? "Coupon updated" : "Failed to update coupon"
        ]);
        break;

    case 'deleteCoupon':
        $id = $_POST['id'];
        $success = $couponController->deleteCoupon($id);
        echo json_encode([
            "success" => $success,
            "message" => $success ? "Coupon deleted" : "Failed to delete coupon"
        ]);
        break;

    default:
        echo json_encode(["success" => false, "message" => "Unknown action"]);
        break;
}
?>