<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Experiencia
 *
 * @author Igor
 */
class Experiencia {
    private $id_exp;
    private $id_artista_exp;
    private $empresa_exp;
    private $cargo_exp;
    private $inicio_exp;
    private $fim_exp;
    private $descricao_exp;
    
    function getId_exp() {
        return $this->id_exp;
    }

    function getId_artista_exp() {
        return $this->id_artista_exp;
    }

    function getEmpresa_exp() {
        return $this->empresa_exp;
    }

    function getCargo_exp() {
        return $this->cargo_exp;
    }

    function getInicio_exp() {
        return $this->inicio_exp;
    }

    function getFim_exp() {
        return $this->fim_exp;
    }

    function getDescricao_exp() {
        return $this->descricao_exp;
    }

    function setId_exp($id_exp) {
        $this->id_exp = $id_exp;
    }

    function setId_artista_exp($id_artista_exp) {
        $this->id_artista_exp = $id_artista_exp;
    }

    function setEmpresa_exp($empresa_exp) {
        $this->empresa_exp = $empresa_exp;
    }

    function setCargo_exp($cargo_exp) {
        $this->cargo_exp = $cargo_exp;
    }

    function setInicio_exp($inicio_exp) {
        $this->inicio_exp = $inicio_exp;
    }

    function setFim_exp($fim_exp) {
        $this->fim_exp = $fim_exp;
    }

    function setDescricao_exp($descricao_exp) {
        $this->descricao_exp = $descricao_exp;
    }


    
}
