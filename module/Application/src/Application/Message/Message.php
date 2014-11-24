<?php

namespace Application\Message;

/**
 * Mensagens do sistema de aviso, alerta, erro...
 *
 * @author Paulo Henrique Oliveira
 */
trait Message
{
    protected $MSG1    = 'Usuário não encontrado';
    protected $MSG2    = 'Operação realizada com sucesso';
    protected $MSG3    = 'Falha ao realizar a operação';
    protected $MSG4    = 'É necessario está autenticado';
    protected $MSG5    = 'Não tem permissão para acessar essa pagina, entre em contato com o adminstrador';
    protected $MSG6    = 'E-mail ja cadastrado, entre com outro email';
    protected $MSG7    = 'Cadastro relizado com sucesso. Entre com o email e senha cadastrada.';
}
