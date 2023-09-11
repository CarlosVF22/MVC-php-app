<?php

require_once 'models/TechnicianModel.php';
require_once 'models/BranchModel.php';
require_once 'models/ElementModel.php';

class HomeController {
    public function index() {
        // Technicians
        $technicianModel = new TechnicianModel();
        $technicians = $technicianModel->getAllTechnicians();

        // Branches
        $branchModel = new BranchModel();
        $branches = $branchModel->getAllBranches();

        // Elements
        $elementModel = new ElementModel();
        $elements = $elementModel->getAllElements();


        require_once 'views/home.php';
    }
}