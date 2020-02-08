<?php
include 'C:\xampp\htdocs\vitrine\classes\Conexao.php';
class ProjetoDAO {
    
    function inserir_projeto(Projeto $p){ 
        try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
        
        #QUERY
        $query = $PDO->exec("INSERT INTO tbl_projeto(id_artista_projeto
           ,nm_projeto ,dtInclu_projeto ,categ_projeto,descr_projeto)
            VALUES
           ({$p->getId_artista_projeto()}
           ,'{$p->getNm_projeto()}'
           ,'{$p->getDtInclu_projeto()}'
           ,'{$p->getCateg_projeto()}'
           ,'{$p->getDescr_projeto()}')");
           
           $p->setId_projeto($PDO->lastInsertId());
        }catch(PDOException $e){
            echo 'Falha ao cadastrar projeto: '. $e->getMessage();
        }
    }
    
    function remover_projeto($id){
        try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
        
        #QUERY
        $PDO->exec("DELETE FROM tbl_arquivo WHERE id_projeto_arquivo = $id");
        $PDO->exec("DELETE FROM tbl_projeto WHERE id_projeto = $id");
        
        
        }catch(PDOException $e){
            echo 'Falha ao cadastrar projeto: '. $e->getMessage();
        }
    }
    
    function remover_arquivo($id){
        try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
        
        #QUERY
        $PDO->exec("DELETE FROM tbl_arquivo WHERE id_arquivo = $id");
        
        }catch(PDOException $e){
            echo 'Falha ao cadastrar projeto: '. $e->getMessage();
        }
    }
            
    function inserir_arquivos($p_id,$nome,$caminho){
        Try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
        
        #INSERÇÃO DE ARQUIVOS COM FK id`projeto
        $PDO->exec("INSERT INTO tbl_arquivo (id_projeto_arquivo ,nome_arquivo
        ,caminho_arquivo) VALUES('$p_id','$nome','$caminho')");
        
        }catch(PDOException $e){
            echo 'Falha ao cadastrar projeto: '. $e->getMessage();
        }
    }
    
    function selecionar_projetoID($id){
        try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
        
        $query = $PDO->query("SELECT * FROM tbl_projeto P WHERE P.id_projeto = $id;");
        $projeto = $query->fetch(PDO::FETCH_ASSOC);
        return $projeto;
        } catch (Exception $ex) {
            echo 'Erro: ' . $ex->getMessage();
        }
    }
    
    function Selecionar_ProjetoArtista($id_usuario){
        try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
    
        #QUERY
        $query = $PDO->query("SELECT P.* FROM tbl_projeto P INNER JOIN tbl_artista A ON P.id_artista_projeto = A.id_usuario WHERE A.id_usuario = $id_usuario;");
        
        #SALVA O RESULTADO DA QUERY EM ARRAY ASSOCIATIVO
        $projetos = $query->fetchALL(PDO::FETCH_ASSOC);
        
        return $projetos;
        
        } catch (Exception $ex) {
            echo 'Erro: ' . $ex->getMessage();
        }
    }
    function popular_projeto(Projeto $projeto){
        try{
            #Instancia PDO
            $PDO = Conexao::getConnection();

            $query = $PDO->query("select * from tbl_arquivo where id_projeto_arquivo = {$projeto->getId_projeto()};");

            $projeto->setArquivos($query->fetchALL(PDO::FETCH_ASSOC)); 

        } catch (Exception $ex) {
            echo 'Erro: ' . $ex->getMessage();
        }
    }
    
    function editar_projeto(Projeto $projeto){
         try{
            #Instancia PDO
            $PDO = Conexao::getConnection();

            $query = $PDO->exec("UPDATE tbl_projeto 
                SET nm_projeto = '{$projeto->getNm_projeto()}',
                categ_projeto = '{$projeto->getCateg_projeto()}',
                descr_projeto = '{$projeto->getDescr_projeto()}'
                WHERE id_projeto = '{$projeto->getId_projeto()}'");

            $atualizacao = $this->Selecionar_Projetoid($projeto->getId_projeto());
            
            $projeto->setNm_projeto($atualizacao['nm_projeto']);
            $projeto->setCateg_projeto($atualizacao['categ_projeto']);
            $projeto->setDescr_projeto($atualizacao['descr_projeto']);
            
            return true;

        } catch (Exception $ex) {
                return false;
                echo 'Erro: ' . $ex->getMessage();
        }      
    }
}
    

