<?php

/*
 * To change this license header choose License Headers in Project Properties.
 * To change this template file choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vaga
 *
 * @author Igor
 */
class Vaga {
    private $id_contratante_vaga;
    private $qtd_vaga;
    private $remuneracao_vaga;
    private $tipo_vaga;
    private $requisito_vaga;
    private $descricao_vaga;
    private $nm_vaga;
    private $status_vaga;
    private $cargo_vaga;
    private $max_cand_vaga;
    private $ramo;
    private $local;
    private $tipo_local;
    
    function __construct($id_contratante_vaga, $qtd_vaga, $remuneracao_vaga, $tipo_vaga, $requisito_vaga, $descricao_vaga, $nm_vaga, $status_vaga, $cargo_vaga, $max_cand_vaga,$ramo,$local,$tipo_local) {
        $this->id_contratante_vaga = $id_contratante_vaga;
        $this->qtd_vaga = $qtd_vaga;
        $this->remuneracao_vaga = $remuneracao_vaga;
        $this->tipo_vaga = $tipo_vaga;
        $this->requisito_vaga = $requisito_vaga;
        $this->descricao_vaga = $descricao_vaga;
        $this->nm_vaga = $nm_vaga;
        $this->status_vaga = $status_vaga;
        $this->cargo_vaga = $cargo_vaga;
        $this->max_cand_vaga = $max_cand_vaga;
        $this->ramo = $ramo;
        $this->local = $local;
        $this->tipo_local = $tipo_local;
    }
    
    function getTipo_local() {
        return $this->tipo_local;
    }

    function setTipo_local($tipo_local) {
        $this->tipo_local = $tipo_local;
    }

        function getLocal() {
        return $this->local;
    }

    function setLocal($local) {
        $this->local = $local;
    }

        
    function getId_contratante_vaga() {
        return $this->id_contratante_vaga;
    }

    function getQtd_vaga() {
        return $this->qtd_vaga;
    }

    function getRemuneracao_vaga() {
        return $this->remuneracao_vaga;
    }

    function getTipo_vaga() {
        return $this->tipo_vaga;
    }

    function getRequisito_vaga() {
        return $this->requisito_vaga;
    }

    function getDescricao_vaga() {
        return $this->descricao_vaga;
    }

    function getNm_vaga() {
        return $this->nm_vaga;
    }

    function getStatus_vaga() {
        return $this->status_vaga;
    }

    function getCargo_vaga() {
        return $this->cargo_vaga;
    }

    function getMax_cand_vaga() {
        return $this->max_cand_vaga;
    }

    function setId_contratante_vaga($id_contratante_vaga) {
        $this->id_contratante_vaga = $id_contratante_vaga;
    }

    function setQtd_vaga($qtd_vaga) {
        $this->qtd_vaga = $qtd_vaga;
    }

    function setRemuneracao_vaga($remuneracao_vaga) {
        $this->remuneracao_vaga = $remuneracao_vaga;
    }

    function setTipo_vaga($tipo_vaga) {
        $this->tipo_vaga = $tipo_vaga;
    }

    function setRequisito_vaga($requisito_vaga) {
        $this->requisito_vaga = $requisito_vaga;
    }

    function setDescricao_vaga($descricao_vaga) {
        $this->descricao_vaga = $descricao_vaga;
    }

    function setNm_vaga($nm_vaga) {
        $this->nm_vaga = $nm_vaga;
    }

    function setStatus_vaga($status_vaga) {
        $this->status_vaga = $status_vaga;
    }

    function setCargo_vaga($cargo_vaga) {
        $this->cargo_vaga = $cargo_vaga;
    }

    function setMax_cand_vaga($max_cand_vaga) {
        $this->max_cand_vaga = $max_cand_vaga;
    }
    function getRamo() {
        return $this->ramo;
    }

    function setRamo($ramo) {
        $this->ramo = $ramo;
    }

        
    //FUNCTIONS
}

