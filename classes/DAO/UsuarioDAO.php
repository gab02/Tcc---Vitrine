<?php
/**
 * Description of UsuarioDAO
 * Representa usuário do sistema na conexão com o banco
 * @author Igor
 */ 
class UsuarioDAO {

    /*
     * Função para buscar usuário pela combinação de login e senha; 
     * Caso encontrado, popula o objeto que a executa.
     * @param Usuario
     * @return BOOL
     * @author Igor
     */
    function logar(Usuario $usuario){   
        try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
        
        #QUERY QU CHAMA PROCEDURE DE BUSCA DE USUARIO
        $query = $PDO->query("EXECUTE BuscaUsuario '{$usuario->getLogin_usuario()}', '{$usuario->getSenha_usuario()})'");
        }catch(PDOException $e){
            echo 'Falha ao Logar: '. $e->getMessage();
        }
        #se houver resultado
        if($query->rowCount() != 0){

            #Traz resultados da query em array associativo
            $arrayusuario = $query->fetch(PDO::FETCH_ASSOC);
            
            #As chaves do ARRAY são correspondentes aos ATRIBUTOS
            #Cada elemento do array é atribuído ao atributo de usuário
            $usuario->popularUsuario($arrayusuario);

            #Retorna confirmação de login
            return TRUE;
            
        }else{
            
            #Retorna negação de login
            return FALSE;
        }
    }
    
    /*
     * Função para encerrar a sessão do usuário logado
     * @param Usuario
     * @return BOOL
     * @author Igor
     */
    
    function existe(Usuario $usuario){
        try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
        
        #Select usuario pelo login e senha
        $query = $PDO->query("SELECT * FROM tbl_usuario WHERE login_usuario = '{$usuario->getLogin_usuario()}' AND 'senha_usuario' = '{$usuario->getSenha_usuario()})'");
        }catch(PDOException $e){
            echo 'Falha na consulta de existência: '. $e->getMessage();
        }
        #se houver resultado
        if($query->rowCount() == 0):
            return FALSE;
        else:
            return TRUE;
        endif;
    }
    
    /*
     * Função para encerrar a sessão do usuário logado
     * @param Usuario
     * @return BOOL
     * @author Igor
     */
    function cadastrar(Usuario $usuario, $TIPO){
        try {
            $PDO = Conexao::getConnection();
            
            $PDO->exec("EXECUTE insertUsuario '{$usuario->getlogin_usuario()}',
            '{$usuario->getSenha_usuario()}','{$usuario->getNm_usuario()}','{$usuario->getEmail_usuario()}',
            '{$usuario->getLocal_usuario()}', '{$usuario->getTelefone_usuario()}', '{$usuario->getDescricao_usuario()}',
            '{$usuario->getAtivo_usuario()}', '{$usuario->getRemoto_artista()}', '{$usuario->getnascimento_artista()}',
            '{$usuario->getPremium_contratante()}','{$usuario->getRamo_contratante()}',
            '{$usuario->getRazaosocial_contratante()}','{$usuario->getSite_contratante()}','{$usuario->getCnpj_contratante()}',
            '{$usuario->getPorte_contratante()}','$TIPO'");
            
            RETURN TRUE;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            RETURN FALSE;
        }
    }
    
    function inserir_perfil(Usuario $artista, $caminho){
        try {
            $PDO = Conexao::getConnection();
            
            $PDO->exec("DELETE FROM tbl_arquivo_perfil WHERE id_artista_arquivo = '{$artista->getId_usuario()}'");
            
            $PDO->exec("INSERT INTO tbl_arquivo_perfil (id_artista_arquivo, caminho_arquivo)
                VALUES ('{$artista->getid_usuario()}','{$caminho}')");
            
            RETURN TRUE;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            RETURN FALSE;
        }
    }
    
    function buscar_foto(Usuario $usuario){
        try{
        #Instancia PDO
        $PDO = Conexao::getConnection();
        
        #Select usuario pelo login e senha
        $result = $PDO->query("SELECT caminho_arquivo FROM tbl_arquivo_perfil WHERE id_artista_arquivo = '{$usuario->getId_usuario()}'")->fetchColumn();
        if($result != NULL){
        $usuario->setFoto($result);
        }else{
            $usuario->setFoto('assets/img/foto_perfil/default.jpg');
        }
        }catch(PDOException $e){
            echo 'Falha na consulta de existência: '. $e->getMessage();
        }
    }        
}
