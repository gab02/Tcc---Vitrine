<?php
/**
 * Description of Projeto
 *
 * @author Igor
 */
class Projeto {
    private $id_projeto;
    private $id_artista_projeto;
    private $nm_projeto;
    private $dtInclu_projeto;
    private $categ_projeto;
    private $descr_projeto;
    private $arquivos;

        function __construct($id_artista_projeto, $nm_projeto,$categ_projeto, $descr_projeto, $id = NULL) {
        $this->id_projeto = $id;
        $this->id_artista_projeto = $id_artista_projeto;    
        $this->nm_projeto = $nm_projeto;    
        $this->dtInclu_projeto = date('Y-m-d');
        $this->categ_projeto = $categ_projeto;
        $this->descr_projeto = $descr_projeto;
    }

    //GETTERS & SETTERS
    function getId_projeto() {
        return $this->id_projeto;
    }

    function setId_projeto($id_projeto) {
        $this->id_projeto = $id_projeto;
    }

            
    
    function getId_artista_projeto() {
        return $this->id_artista_projeto;
    }

        function getNm_projeto() {
        return $this->nm_projeto;
    }

    function getDtInclu_projeto() {
        return $this->dtInclu_projeto;
    }

    function getCateg_projeto() {
        return $this->categ_projeto;
    }

    function getDescr_projeto() {
        return $this->descr_projeto;
    }

    function setNm_projeto($nm_projeto) {
        $this->nm_projeto = $nm_projeto;
    }

    function setDtInclu_projeto($dtInclu_projeto) {
        $this->dtInclu_projeto = $dtInclu_projeto;
    }

    function setCateg_projeto($categ_projeto) {
        $this->categ_projeto = $categ_projeto;
    }

    function setDescr_projeto($descr_projeto) {
        $this->descr_projeto = $descr_projeto;
    }

    function getArquivos() {
        return $this->arquivos;
    }

    function setArquivos($arquivos) {
        $this->arquivos = $arquivos;
    }

}
