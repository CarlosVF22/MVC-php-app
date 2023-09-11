<?php

class BranchModel {
    
    public function getAllBranches() {
        global $conn;

        $sql = "SELECT * FROM Branch";
        $result = $conn->query($sql);

        $branches = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $branches[] = $row;
            }
        }

        return $branches;
    }
}