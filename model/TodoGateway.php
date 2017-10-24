<?php

/**
 * Table data gateway.
 * PDO.
 */
class TodoGateway {
    
    public function selectAll($order) {
        if ( !isset($order) ) {
            $order = "start";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM todolist ORDER BY $dbOrder ASC");
        
        $todo = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $todo[] = $obj;
        }
        
        return $todo;
    }
    
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        
        $dbres = mysql_query("SELECT * FROM todolist WHERE id=$dbId");
        
        return mysql_fetch_object($dbres);
		
    }

    public function insert( $title, $start, $end, $status ) {
        
        $dbTitle = ($title != NULL)?"'".mysql_real_escape_string($title)."'":'NULL';
        $dbStart = ($start != NULL)?"'".mysql_real_escape_string($start)."'":'NULL';
        $dbEnd = ($end != NULL)?"'".mysql_real_escape_string($end)."'":'NULL';
        $dbStatus = ($status != NULL)?"'".mysql_real_escape_string($status)."'":'NULL';
        
        mysql_query("INSERT INTO todolist (title, start, end, status) VALUES ($dbTitle, $dbStart, $dbEnd, $dbStatus)");
        return mysql_insert_id();
    }
    
    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM todolist WHERE id=$dbId");
    }
    
}

?>
