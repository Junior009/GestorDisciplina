<?php


class Disciplina{
    private int $cod;
    private String $nome;
   
    public function __construct($cod,$nome){
     $this->cod = $cod;
    $this->nome = $nome;
    //$this->alunos[] = $aluno;

   }


   public function getNome(){
    return $this->nome;
   }

   public function getCod(){
    return $this->cod;
   }

  /* public function addAluno(Aluno $aluno){
        $this->alunos[] = $aluno;
   } */
}