<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Adm\View\Helper;

use Zend\View\Exception;

/**
 */
class FormataCpfCnpj extends \Zend\View\Helper\AbstractHelper
{
    /**
     * Título
     *
     * @var string
     */
    protected $campo;
    protected $formato;

    public function __invoke($campo, $formatado = true)
    {
        $this->campo      = $campo;
        $this->formatado  = $formatado;
        return $this;
    }
    public function __toString()
    {
        return $this->formatar();
    }

    /**
     *
     * @return string
     */
    function formatar(){
        //retira formato
        $codigoLimpo = preg_replace("[' '-./ t]",'',$this->campo);
        // pega o tamanho da string menos os digitos verificadores
        $tamanho = (strlen($codigoLimpo) -2);
        //verifica se o tamanho do código informado é válido
        if ($tamanho != 9 && $tamanho != 12){
            return $this->campo;
        }

        if ($this->formatado){
            // seleciona a máscara para cpf ou cnpj
            $mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';

            $indice = -1;
            for ($i=0; $i < strlen($mascara); $i++) {
                    if ($mascara[$i]=='#') {
                        $mascara[$i] = $codigoLimpo[++$indice];
                    }
            }
            //retorna o campo formatado
            $retorno = $mascara;

        }else{
            //se não quer formatado, retorna o campo limpo
            $retorno = $codigoLimpo;
        }
        return (string) $retorno;

    }
}
