<?php

require_once 'model/TodoService.php';

class TodoController {
    
    private $todoService = NULL;
    
    public function __construct() {
        $this->todoService = new TodoService();
    }
    
    public function redirect($location) {
        header('Location: '.$location);
    }

    /**
     * router
     */
    public function handleRequest() {
        $op = isset($_GET['op'])?$_GET['op']:NULL;
        try {
            if ( !$op || $op == 'list' ) {
                $this->listTodo();
            } elseif ( $op == 'new' ) {
                $this->saveTodo();
            } elseif ( $op == 'delete' ) {
                $this->deleteTodo();
            } elseif ( $op == 'show' ) {
                $this->showTodo();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            // some unknown Exception got through here, use application error page to display it
            $this->showError("Application error", $e->getMessage());
        }
    }

    /**
     * get all list of todo
     */
    public function listTodo() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $listTodo = $this->todoService->getAllTodo($orderby);
        include 'view/todo.php';
    }

    /**
     * save data
     */
    public function saveTodo() {
        $errors = array();

        if ( isset($_POST['form-submitted']) ) {
            $title       = isset($_POST['title']) ?   $_POST['title']  :NULL;
            $start      = isset($_POST['start'])?   $_POST['start'] :NULL;
            $end      = isset($_POST['end'])?   $_POST['end'] :NULL;
            $status    = isset($_POST['status'])? $_POST['status']:NULL;
            //var_dump($_POST); die();
            try {
                $this->todoService->createNewTodo($title, $start, $end, $status);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        
        include 'view/todo-form.php';
    }

    /**
     * delete data
     * @return string
     * @throws Exception
     */
    public function deleteTodo() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        
        $this->todoService->deleteTodo($id);
        return json_encode('success');
        //$this->redirect('index.php');
    }

    /**
     * get todobyId
     * @throws Exception
     */
    public function showTodo() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $todo = $this->todoService->getTodo($id);
        
        include 'view/todo.php';
    }

    /**
     * @param $title
     * @param $message
     */
    public function showError($title, $message) {
        include 'view/error.php';
    }
    
}
?>
