<?php

include 'model/Disciplina.php';
include 'Dbconfig/Dbconnection.php';


class disciplinaRepository{

    private $db;
    
    public function __construct(){
        $this->db = Dbconnection::getInstance();
    }

    public function selectAll(){

                
        $disciplinas = Array();
        $stmt = $this->db->prepare("SELECT * FROM tb_disciplina");
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $disciplina) {
            $disciplinas[] = new Disciplina( $disciplina['cod'],$disciplina['nome']);
        }
        return $disciplinas;
    }


    public function addDisciplina($nome){
      
      try{
        $stmt = $this->db->prepare("INSERT INTO tb_disciplina (nome)VALUES (:nome)" );
        $stmt->bindparam(':nome',$nome);
        $stmt->execute();
        return true;
    } catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }

    }

    public function delete($id) {
      
        try {

            $stmt = $this->db->prepare("DELETE FROM tb_disciplina WHERE cod=:id");
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id, $nome) {
      
        try {

            $stmt = $this->db->prepare("UPDATE tb_disciplina SET nome = :nome WHERE cod=:id");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":nome", $nome);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function selectId($id) {
      
        try {
            $disciplina = NULL;
            $stmt = $this->db->prepare("SELECT *FROM tb_disciplina WHERE cod=:id");
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
    
            if (isset($result)) {
                $disciplina = new Disciplina( $result['cod'],$result['nome']);
            }
            return $disciplina;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}