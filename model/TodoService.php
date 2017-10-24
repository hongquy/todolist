<?php

require_once 'model/TodoGateway.php';
require_once 'model/ValidationException.php';


class TodoService {
    
    private $todoGateway    = NULL;
    
    private function openDb() {
        if (!mysql_connect("localhost", "root", "")) {
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysql_select_db("todolist")) {
            throw new Exception("No todolist database found on database server.");
        }
    }
    
    private function closeDb() {
        mysql_close();
    }
  
    public function __construct() {
        $this->todoGateway = new TodoGateway();
    }
    
    public function getAllTodo($order) {
        try {
            $this->openDb();
            $res = $this->todoGateway->selectAll($order);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function getTodo($id) {
        try {
            $this->openDb();
            $res = $this->todoGateway->selectById($id);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
        return $this->todoGateway->find($id);
    }
    
    private function validateTodoParams( $title, $start, $end, $status ) {
        $errors = array();
        if ( !isset($title) || empty($title) ) {
            $errors[] = 'Name is required';
        }
        if ( !isset($start) || empty($start) ) {
            $errors[] = 'Start date is required';
        }
        if ( !isset($end) || empty($end) ) {
            $errors[] = 'End date is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    public function createNewTodo( $title, $start, $end, $status ) {
        try {
            $this->openDb();
            $this->validateTodoParams($title, $title, $end, $status);
            $res = $this->todoGateway->insert($title, $start, $end, $status);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function deleteTodo( $id ) {
        try {
            $this->openDb();
            $res = $this->todoGateway->delete($id);
            $this->closeDb();
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }


}
?>
