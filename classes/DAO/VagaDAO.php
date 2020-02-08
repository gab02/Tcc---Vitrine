<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VagaDAO
 *
 * @author Igor
 */
include 'C:\xampp\htdocs\vitrine\classes\Conexao.php';

class VagaDAO {

    function inserir_vaga(vaga $v) {
        try {
            #Instancia PDO
            $PDO = Conexao::getConnection();

            #QUERY
            $PDO->exec("EXEC dbo.insertVaga {$v->getId_contratante_vaga()}, {$v->getQtd_vaga()}, {$v->getRemuneracao_vaga()},'{$v->getTipo_vaga()}', '{$v->getRequisito_vaga()}', '{$v->getDescricao_vaga()}', 1 ,'{$v->getCargo_vaga()}','{$v->getNm_vaga()}','{$v->getRamo()}','{$v->getLocal()}','{$v->getTipo_local()}'");
        } catch (PDOException $e) {
            echo 'Falha ao cadastrar vaga: ' . $e->getMessage();
        }
    }

    function busca_vaga_por_contratante($id) {
        try {
            #Instancia PDO
            $PDO = Conexao::getConnection();
            #QUERY
            $query = $PDO->query("execute dbo.buscaVagaPorContratante $id");
            $vagas = $query->fetchALL(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Falha ao buscar vaga: ' . $e->getMessage();
        }

        RETURN $vagas;
    }

     function busca_vaga_por_filtro($tipo, $local, $ramo) {
        #try {
            #Instancia PDO
            $PDO = Conexao::getConnection();
            #QUERY
            $query = $PDO->query("exec dbo.filtrarVagas $tipo, $local, $ramo");
            $vagas = $query->fetchALL(PDO::FETCH_ASSOC);
            RETURN $vagas;
        #} catch (PDOException $e) {
        #    echo 'Falha ao buscar vaga: ' . $e->getMessage();
        #}

        RETURN $vagas;
    }
    
    function excluir_vaga($id) {
        try {
            #Instancia PDO
            $PDO = Conexao::getConnection();
            #QUERY
            $PDO->exec("DELETE FROM tbl_vaga WHERE id_vaga = $id");
        } catch (PDOException $e) {
            echo 'Falha ao deletar vaga: ' . $e->getMessage();
        }
    }

    function inserir_cadidatura($artista, $vaga) {
        try {
            #Instancia PDO
            $PDO = Conexao::getConnection();
 
            #QUERY
            $PDO->exec("INSERT INTO tbl_candidatura ([id_artista_candidatura]
           ,[id_vaga_candidatura]
           ,[status_candidatura]) 
           VALUES ($artista, $vaga, 1) ");
            
        } catch (PDOException $e) {
            echo 'Falha ao cadastrar vaga: ' . $e->getMessage();
        }
    }
}
