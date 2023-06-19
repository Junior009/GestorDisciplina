<?php

include 'service/discService.php';
class disciplinaController{

    private $discServ = null;

    public function __construct(){
        $this->discServ = new discService();
    }


    public function requestsHandler(){

        $operation = filter_input(INPUT_GET, 'op');
        $op = isset($operation) ? $operation : NULL;

        if(!$op || $op == 'list'){
            $this->listDisciplina();
        } else if($op == 'new'){
            
            $this->newDisciplina();
        }else if($op == 'delete'){
            
            $this->deleteDisc();
        } else if($op == 'update'){
            
            $this->updateDisciplina();
        }

    } 

        
    

    public function listDisciplina(){

        $disciplinas = $this->discServ->getAllDisciplinas();
        include 'view/discView.php';
    }

    public function redirect($location) {
        header('Location: ' . $location);
    }

    public function newDisciplina(){
        $title = '';

        $nome = '';

        $errors = array();
       
        if (isset($_POST['btn_Enviar'])) {
            
            $nome = isset($_POST['nome']) ? filter_input(INPUT_POST, 'nome') : NULL;
           
            $filterId = filter_input(INPUT_GET, 'id');
            $id = isset($filterId) ? $filterId : NULL;
            //var_dump($id); exit();
            if (isset($id)) {
                try {
                    $this->discServ->updateDisciplina($id, $nome);
                    $this->redirect('index.php');
                    return;
                } catch (ValidationException $e) {
                    $errors = $e->getErrors();
                }
            }else{
                try {
                    $this->discServ->insert($nome);
                    $this->redirect('index.php');
                    return;
                } catch (ValidationException $e) {
                    $errors = $e->getErrors();
                }
            }

            include 'view/discView.php';
        }else{
            include 'view/discRegistroView.php';
        }
    }

    public function deleteDisc() {

        $filterId = filter_input(INPUT_GET, 'id');
        $id = isset($filterId) ? $filterId : NULL;
        //var_dump($id); exit();
        if (!$id) {
            throw new Exception('Ocorreu um erro.');
        }

        $this->discServ->deleteDisciplina($id);
        $this->redirect('index.php');
    }

    public function updateDisciplina(){
        $filterId = filter_input(INPUT_GET, 'id');
        $id = isset($filterId) ? $filterId : NULL;
        $disciplina = null;
        if(!$id){
            throw new Exception('Ocorreu um erro.');
        } else {
           $disciplina = $this->discServ->getDisciplinaId($id);
           include 'view/discUpdateView.php';
        }

        $nome = '';

        $errors = array();
       
  /*      if (isset($_POST['btn_Enviar'])) {
            
            $nome = isset($_POST['nome']) ? filter_input(INPUT_POST, 'nome') : NULL;
           

            try {
                $this->discServ->updateDisciplina($id);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
    }*/
        

    }

}