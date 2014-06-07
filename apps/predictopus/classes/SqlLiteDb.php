<?php

class SqlLiteDb extends \SQLite3 {

    public function cascadeQuery($idQuery, $nextQuery) {
        $results1st = $this->query($idQuery);
        $idArr = array();
        while ($row = $results1st->fetchArray(SQLITE3_NUM)) {
            array_push($idArr, $row[0]);
        }
        $ids = implode(",", $idArr);
        $results = $this->query($nextQuery . "($ids)");
        return $results;
    }

}
