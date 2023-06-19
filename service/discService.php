<?php


include 'repository/disciplinaRepository.php';
class discService{

    private $discRep = null;

    public function __construct(){
        $this->discRep = new disciplinaRepository();
    }

    public function getAllDisciplinas(){
      $res =  $this->discRep->selectAll();
      return $res;
    }

    public function insert($nome){
       $res = $this->discRep->addDisciplina($nome);
       return $res;
    }

    public function deleteDisciplina($id) {
        
        try {
            $res = $this->discRep->delete($id);
            return $res;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDisciplinaId($id){
        
            try {
                $res = $this->discRep->selectId($id);
                return $res;
            } catch (Exception $e) {
                throw $e;
            }
        
    }

    public function updateDisciplina($id,$nome){
        try {
            $res = $this->discRep->update($id,$nome);
            return $res;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function atualizar(){

    }


}