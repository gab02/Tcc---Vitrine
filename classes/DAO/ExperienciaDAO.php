<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExperienciaDAO
 *
 * @author Igor
 */
include 'C:\xampp\htdocs\vitrine\classes\Conexao.php';

class ExperienciaDAO {
    function busar_expArtista($id_artista){
        try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
        
        $query = $PDO->query("SELECT * FROM tbl_experiencia WHERE id_artista_exp = $id_artista;");
        $exps = $query->fetchALL(PDO::FETCH_ASSOC);
        return $exps;
        } catch (Exception $ex) {
            echo 'Erro: ' . $ex->getMessage();
        }
    }
    function inserir_exp(Experiencia $experiencia){
        Try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
       
        #INSERÇÃO DE exp
        $PDO->exec("INSERT INTO tbl_experiencia (id_artista_exp ,empresa_exp ,cargo_exp ,inicio_exp ,fim_exp ,descricao_exp)
                VALUES('{$experiencia->getId_artista_exp()}','{$experiencia->getEmpresa_exp()}',
                '{$experiencia->getCargo_exp()}','{$experiencia->getInicio_exp()}',
                '{$experiencia->getId_artista_exp()}','{$experiencia->getEmpresa_exp()}',
                '{$experiencia->getCargo_exp()}','{$experiencia->getInicio_exp()}',
                '{$experiencia->getId_artista_exp()}',
                '{$experiencia->getEmpresa_exp()}','{$experiencia->getCargo_exp()}','{$experiencia->getInicio_exp()}',
                '{$experiencia->getFim_exp()}','{$experiencia->getDescricao_exp()}')");
        
        }catch(PDOException $e){
            echo 'Falha ao cadastrar experiencia: '. $e->getMessage();
        }
    }
    function alterar_exp(){
        
    }
    function remover_exp(){
        
    }
}
