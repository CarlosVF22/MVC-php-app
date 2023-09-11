<?php

class ElementModel {

    public function getAllElements() {
        global $conn;

        $sql = "SELECT * FROM Element";
        $result = $conn->query($sql);

        $elements = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $elements[] = $row;
            }
        }

        return $elements;
    }
}