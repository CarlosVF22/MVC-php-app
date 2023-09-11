<?php

require_once 'models/BranchModel.php';
require_once 'models/ElementModel.php';


class ApiController {
    public function branchList() {
        $branchModel = new BranchModel();
        $branches = $branchModel->getAllBranches();

        header('Content-Type: application/json');
        echo json_encode(array('sucursales' => $branches));
        exit;
    }

    public function elementList() {
        $elementModel = new ElementModel();
        $elements = $elementModel->getAllElements();

        header('Content-Type: application/json');
        echo json_encode(array('elementos' => $elements));
        exit;
    }


}