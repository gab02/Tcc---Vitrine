<?php
/**
 * Description of Usuario
 * Representa usuário do sistema
 * @author Igor
 */
class Usuario {
    private $id_usuario;
    private $nm_usuario;
    private $login_usuario;
    private $senha_usuario;
    private $local_usuario;
    private $email_usuario;
    private $telefone_usuario;
    private $descricao_usuario;
    private $ativo_usuario;
    private $remoto_artista; //ARTISTA
    private $nascimento_artista; //ARTISTA
    private $premium_contratante; //contratante
    private $ramo_contratante;//contratante
    private $razaosocial_contratante;//contratante
    private $site_contratante;//contratante
    private $cnpj_contratante;//contratante
    private $porte_contratante;//contratante
    private $foto;
    
    
    #GETTERS
    function getFoto() {
        return $this->foto;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

        
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getNm_usuario() {
        return $this->nm_usuario;
    }

    function getLogin_usuario() {
        return $this->login_usuario;
    }

    function getSenha_usuario() {
        return $this->senha_usuario;
    }

    function getLocal_usuario() {
        return $this->local_usuario;
    }

    function getEmail_usuario() {
        return $this->email_usuario;
    }

    function getTelefone_usuario() {
        return $this->telefone_usuario;
    }

    function getDescricao_usuario() {
        return $this->descricao_usuario;
    }

    function getAtivo_usuario() {
        return $this->ativo_usuario;
    }
    
    function getRemoto_artista() {
        return $this->remoto_artista;
    }

    function getNascimento_artista() {
        return $this->nascimento_artista;
    }

    function getPremium_contratante() {
        return $this->premium_contratante;
    }

    function getRamo_contratante() {
        return $this->ramo_contratante;
    }

    function getRazaosocial_contratante() {
        return $this->razaosocial_contratante;
    }

    function getSite_contratante() {
        return $this->site_contratante;
    }

    function getCnpj_contratante() {
        return $this->cnpj_contratante;
    }

    function getPorte_contratante() {
        return $this->porte_contratante;
    }

    
    #SETTERS
    function setNm_usuario($nm_usuario) {
        $this->nm_usuario = $nm_usuario;
    }

    function setLogin_usuario($login_usuario) {
        $this->login_usuario = $login_usuario;
    }

    function setSenha_usuario($senha_usuario) {
        $this->senha_usuario = md5($senha_usuario);
    }

    function setLocal_usuario($local_usuario) {
        $this->local_usuario = $local_usuario;
    }

    function setEmail_usuario($email_usuario) {
        $this->email_usuario = $email_usuario;
    }

    function setTelefone_usuario($telefone_usuario) {
        $this->telefone_usuario = $telefone_usuario;
    }

    function setDescricao_usuario($descricao_usuario) {
        $this->descricao_usuario = $descricao_usuario;
    }

    function setAtivo_usuario($ativo_usuario) {
        $this->ativo_usuario = $ativo_usuario;
    }

    function setRemoto_artista($remoto_artista) {
        $this->remoto_artista = $remoto_artista;
    }

    function setNascimento_artista($nascimento_artista) {
        $this->nascimento_artista = $nascimento_artista;
    }

    function setPremium_contratante($premium_contratante) {
        $this->premium_contratante = $premium_contratante;
    }

    function setRamo_contratante($ramo_contratante) {
        $this->ramo_contratante = $ramo_contratante;
    }

    function setRazaosocial_contratante($razaosocial_contratante) {
        $this->razaosocial_contratante = $razaosocial_contratante;
    }

    function setSite_contratante($site_contratante) {
        $this->site_contratante = $site_contratante;
    }

    function setCnpj_contratante($cnpj_contratante) {
        $this->cnpj_contratante = $cnpj_contratante;
    }

    function setPorte_contratante($porte_contratante) {
        $this->porte_contratante = $porte_contratante;
    }

    /*
     * Função para encerrar a sessão do usuário logado
     * @author Igor
     */
    function deslogar(){
        unset($_SESSION['logado']);
    }
    
    /*
     * Função para encerrar a sessão do usuário logado
     * @param Array
     * @author Igor
     */
    public function popularUsuario($usuario){
        foreach ($usuario as $chave => $valor){
            $this->$chave = $valor;
        }
    }
}