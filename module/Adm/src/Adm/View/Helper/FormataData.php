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
class FormataData extends \Zend\View\Helper\AbstractHelper
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
        return (string) implode('/', array_reverse(explode('-', $this->campo)));
    }
}
