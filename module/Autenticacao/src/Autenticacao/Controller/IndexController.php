<?php

namespace Autenticacao\Controller;

use Application\Controller\AbstractController,
    Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

use Autenticacao\Form\Autenticacao as FormAutenticacao;

class IndexController extends AbstractController
{

    public function __construct()
    {
        $this->service    = "Autenticacao\Service\Autenticacao";
        $this->route      = "autenticacao";
        $this->controller = "index";
    }

    public function indexAction()
    {
//        $form    = new FormAutenticacao(null, null, './autenticacao/index/captcha');
        $form    = new FormAutenticacao(true);
        $request = $this->getRequest();

        //ValidaForm via post
        if ($request->isPost()) {
            $form->setData($request->getPost());

            //ValidationGroup
            if ($this->params()->fromPost('Cadastrar')) {
                $form->setValidationGroup('milpassword', 'confirmation');

            } else {
                $form->setValidationGroup('milmatricula', 'milpassword');
            }

            //ValidarForm de acordo com o filter
            if ($form->isValid()) {

                try {
                    
                    $service = $this->getServiceLocator()->get($this->service);

                    if ($this->params()->fromPost('Cadastrar')) {

                        //Realiza o insert
                        if ($service->insert($request->getPost()->toArray())) {
                             $this->flashMessenger()->addSuccessMessage($this->MSG7);
                             return $this->redirect()->toRoute('autenticacao');
                        }

                    } else {

                        // Criando Storage para gravar session da autenticcao
                        $sessionStorage = new SessionStorage("Usuario");

                        $auth = new AuthenticationService;
                        $auth->setStorage($sessionStorage); // Definindo o SessionStorage para a auth

                        //Realiza a consulta
                        $authAdapter = $this->getServiceLocator()->get("Autenticacao\Auth\Adapter");
                        $authAdapter->setUsername($this->params()->fromPost('milmatricula'));
                        $authAdapter->setPassword($this->params()->fromPost('milpassword'));

                        $result  = $auth->authenticate($authAdapter);

                        if ($result->getIdentity()) {
                            $usuario = array_merge(array('perfil' => $result->getIdentity()['user']->getRoleid()->getNome()),
                                                         $result->getIdentity());
                            $sessionStorage->write(array($usuario),null);
                            return $this->redirect()->toRoute('home');

                        } else {
                            $this->flashMessenger()->addErrorMessage("Usuario não encontrado");
                            return $this->redirect()->toRoute('autenticacao');
                        }
                    }
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function usuariosAction()
    {
        $list = $this->getServiceLocator()->get($this->service);

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list->findAll()));
        $paginator->setCurrentPageNumber($page)
                  ->setDefaultItemCountPerPage(40);

        return new ViewModel(array('data'=> $paginator, 'page'=>$page));
    }

    public function cadastrarAction()
    {
        $servRole = $this->getServiceLocator()->get('Acl\Service\Role');
        $options['roles'] = $servRole->listarRoles();

        $form = new FormAutenticacao(null, $options, './autenticacao/index/captcha');
        $request = $this->getRequest();

        //ValidaForm via post
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $form-> setValidationGroup('milidt', 'password');

            //ValidarForm de acordo com o filter
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);

                //Realiza o insert
                if ($service->insert($request->getPost()->toArray())) {
                     $this->flashMessenger()->addErrorMessage($this->MSG3);
                     return $this->redirect()->toRoute('autenticacao');
                }
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function atualizarAction()
    {
        $servRole = $this->getServiceLocator()->get('Acl\Service\Role');
        $options['milcodigo'] = $this->params()->fromRoute('id',0);
        $options['roles']     = $servRole->listarRoles();

        //Formulario
        $form    = new FormAutenticacao(null, $options, './autenticacao/index/captcha');
        $request = $this->getRequest();

        //Dados do usuario
        $service = $this->getServiceLocator()->get($this->service);
        $usuario = $service->find($this->params()->fromRoute('id',0));
        if ($usuario) {
            $setData = array_merge($usuario->toArray(), array('role' => $usuario->getRole()->getId()));
            //Preenchendo o formualrio com os dados do usuario
            $form->setData($setData);
        }

        //ValidaForm via post
        if ($request->isPost()) {
            $form->setData($request->getPost());
            //ValidarForm de acordo com o filter
            $form->setValidationGroup('role');
            if ($form->isValid()) {
                //Realiza o insert
                $arrData = $request->getPost()->toArray();
                if ($service->update($arrData)) {
                    $this->flashMessenger()->addSuccessMessage($this->MSG2);

                } else {
                    $this->flashMessenger()->addErrorMessage($this->MSG3);
                }
                return $this->redirect()->toRoute("autenticacao/default", array('controller' => $this->controller,'action' => 'atualizar', 'id' => $arrData['milcodigo']));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function lembreteAction()
    {
        // Service usuario
        $serUsuario = $this->getServiceLocator()->get($this->service);

        // Formulario
        $form       = new FormAutenticacao(null, null, './autenticacao/index/captcha');
        $request    = $this->getRequest();

        // ValidaForm via post
        if ($request->isPost()) {
            $form->setData($request->getPost());
            // ValidarForm de acordo com o filter
            $form->setValidationGroup('email');
            if ($form->isValid()) {
                $arrData = $request->getPost()->toArray();
                $usuario = $serUsuario->findBy(array('milcodigo' => 194));
//                var_dump($usuario);exit;
                // Realiza o update
                if ($serUsuario->update($request->getPost()->toArray())) {
                    $this->flashMessenger()->addSuccessMessage($this->MSG2);
                } else {
                    $this->flashMessenger()->addErrorMessage($this->MSG3);
                }
            } else {
                 $this->flashMessenger()->addErrorMessage($this->MSG3);
            }
            return $this->redirect()->toRoute("autenticacao/default", array('controller' => $this->controller, 'action' => 'lembrete'));
        }
        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $service = $this->getServiceLocator()->get($this->service);
        if ($service->delete($this->params()->fromRoute('id',0))) {
            $this->flashMessenger()->addSuccessMessage($this->MSG2);
        } else {
            $this->flashMessenger()->addErrorMessage($this->MSG3);
        }
        return $this->redirect()->toRoute("autenticacao/default", array('controller' => $this->controller, 'action' => 'usuarios'));
    }

    public function logoutAction()
    {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage("Usuario"));
        $auth->clearIdentity();

        return $this->redirect()->toRoute($this->route);
    }

    public function generateAction()
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', "image/png");

        $id = $this->params('id', false);
        if ($id) {

            $image = './data/captcha/' . $id;
            if (file_exists($image) !== false) {
                $imagegetcontent = @file_get_contents($image);

                $response->setStatusCode(200);
                $response->setContent($imagegetcontent);

                if (file_exists($image) == true) {
                    unlink($image);
                }

            }

        }
        return $response;
    }

}
