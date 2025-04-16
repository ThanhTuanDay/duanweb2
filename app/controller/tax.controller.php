<?php
require_once(dirname(__DIR__) . '../models/tax-rule.model.php');
require_once(dirname(__DIR__) . '../models/tax-class.model.php');
class TaxController
{
    private $taxClassModel;
    private $taxRuleModel;
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        $this->taxClassModel = new TaxClassModel($this->db);
        $this->taxRuleModel = new TaxRuleModel($this->db);
    }

    public function getAllTaxRules()
    {
        return $this->taxRuleModel->getAllRules();
    }

    public function addTaxRule($data)
    {
        return $this->taxRuleModel->createTaxRule($data);
    }

    public function updateTaxRule($id, $data)
    {
        return $this->taxRuleModel->updateTaxRule($id, $data);
    }

    public function deleteTaxRule($id)
    {
        return $this->taxRuleModel->deleteTaxRule($id);
    }

    public function getTaxClasses()
    {
        return $this->taxClassModel->getAllTaxClasses();
    }

    public function addTaxClass($name,$description)
    {
        return $this->taxClassModel->createTaxClass($name,$description);
    }

    public function updateTaxClass($id, $name,$description)
    {
        return $this->taxClassModel->updateTaxClass($id, $name,$description);
    }

    public function updateTaxRuleStatus($id, $data)
    {
        return $this->taxRuleModel->updateTaxRuleStatus($id, $data);
    }

    public function deleteTaxClass($id)
    {
        return $this->taxClassModel->deleteTaxClass($id);
    }
}


?>