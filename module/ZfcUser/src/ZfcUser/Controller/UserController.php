<?php

namespace ZfcUser\Controller;

use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use Zend\View\Model\ViewModel;
use ZfcUser\Service\User as UserService;
use ZfcUser\Options\UserControllerOptionsInterface;

class UserController extends AbstractActionController {

    const ROUTE_CHANGEPASSWD = 'zfcuser/changepassword';
    const ROUTE_CHANGECENTRE = 'zfcuser/changecentre';
    const ROUTE_LOGIN = 'zfcuser/login';
    const ROUTE_REGISTER = 'zfcuser/register';
    const ROUTE_CHANGEEMAIL = 'zfcuser/changeemail';
    const CONTROLLER_NAME = 'zfcuser';

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var FormInterface
     */
    protected $loginForm;

    /**
     * @var FormInterface
     */
    protected $registerForm;

    /**
     * @var FormInterface
     */
    protected $changePasswordForm;
    protected $changeCentreForm;

    /**
     * @var FormInterface
     */
    protected $changeEmailForm;

    /**
     * @todo Make this dynamic / translation-friendly
     * @var string
     */
    protected $failedLoginMessage = 'Authentification échouée. Veuillez réessayer.';

    /**
     * @var UserControllerOptionsInterface
     */
    protected $options;

    /**
     * @var callable $redirectCallback
     */
    protected $redirectCallback;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;
    protected $role;
    protected $entrTable;
    protected $depiTable;
    protected $centreTable;
    protected $userTable;
    protected $logqueryTable;

    /**
     * @param callable $redirectCallback
     */
    public function __construct($redirectCallback) {
        if (!is_callable($redirectCallback)) {
            throw new \InvalidArgumentException('You must supply a callable redirectCallback');
        }
        $this->redirectCallback = $redirectCallback;
    }

    /**
     * User page
     */
    public function indexAction() {
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }
    }

    /**
     * Login form
     */
    public function loginAction() {

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);

        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }

        $request = $this->getRequest();
        $form = $this->getLoginForm();

        if ($this->getOptions()->getUseRedirectParameterIfPresent() && $request->getQuery()->get('redirect')) {
            $redirect = $request->getQuery()->get('redirect');
        } else {
            $redirect = false;
        }
        $centretable = $this->getOptionsForSelect($this->getCentreTable()->select(null, 'Structure'), 'Prefixe', 'Structure');
        $form->get('center')->setOptions(array('value_options' => $centretable));
		$form->get('center')->setValue('alg_');
        if (!$request->isPost()) {
            $viewModel->loginForm = $form;
            $viewModel->redirect = $redirect;
            $viewModel->enableRegistration = $this->getOptions()->getEnableRegistration();
            return $viewModel;
        }

        $form->setData($request->getPost());

        if (!$form->isValid()) {
            $this->flashMessenger()->setNamespace('zfcuser-login-form')->addMessage($this->failedLoginMessage);
            return $this->redirect()->toUrl($this->url()->fromRoute(static::ROUTE_LOGIN) . ($redirect ? '?redirect=' . rawurlencode($redirect) : ''));
        }

        $prefixe = new \Zend\Session\Container('prefixe');
        $prefixe->offsetSet('prefixe', $form->get('center')->getValue());
        $prefixe->offsetSet('currentcentre', $centretable[$form->get('center')->getValue()]);

        // clear adapters
        $this->zfcUserAuthentication()->getAuthAdapter()->resetAdapters();
        $this->zfcUserAuthentication()->getAuthService()->clearIdentity();




        return $this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'authenticate'));
    }

    /**
     * Logout and clear the identity
     */
    public function logoutAction() {
        $this->zfcUserAuthentication()->getAuthAdapter()->resetAdapters();
        $this->zfcUserAuthentication()->getAuthAdapter()->logoutAdapters();
        $this->zfcUserAuthentication()->getAuthService()->clearIdentity();

        $redirect = $this->redirectCallback;

        return $redirect();
    }

    /**
     * General-purpose authentication action
     */
    public function authenticateAction() {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }

        $adapter = $this->zfcUserAuthentication()->getAuthAdapter();
        $redirect = $this->params()->fromPost('redirect', $this->params()->fromQuery('redirect', false));

        $result = $adapter->prepareForAuthentication($this->getRequest());

        // Return early if an adapter returned a response
        if ($result instanceof Response) {
            return $result;
        }

        $auth = $this->zfcUserAuthentication()->getAuthService()->authenticate($adapter);

        if (!$auth->isValid()) {
            $this->flashMessenger()->setNamespace('zfcuser-login-form')->addMessage($this->failedLoginMessage);
            $adapter->resetAdapters();
            return $this->redirect()->toUrl(
                            $this->url()->fromRoute(static::ROUTE_LOGIN) .
                            ($redirect ? '?redirect=' . rawurlencode($redirect) : '')
            );
        }

        $redirect = $this->redirectCallback;



        $user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
        $user = $this->getUserTable()->getUser($user_id);
        //$centre = $this->getCentreTable()->getCentre($user->centre);
        $prefixe = new \Zend\Session\Container('prefixe');
        $prefixe->offsetSet('prefixeagent', 'alg_'/*$centre->Prefixe*/);


        $prefixes = $prefixe->offsetGet('prefixe');
        $centre1 = $this->getCentreTable()->select("Prefixe='" . $prefixes . "'");
        $codereg = "";
        $codestruct = "";
        foreach ($centre1 as $cent) {
            $codereg = $cent->Code_region;
            $codestruct = $cent->Code_struct;
        }

        $prefixe->offsetSet('codereg', $codereg);
        $prefixe->offsetSet('codestruct', $codestruct);
        //select max(date) as date from log_query WHERE etat = 1 and prov="$codestruct"
        $where = "etat = 1 and prov='" . $codestruct . "'";
        $col = array('date' => new \Zend\Db\Sql\Expression('Max(date)'));
        $logquery = $this->getLogqueryTable()->select($where, $col);
        $derndate="";
         foreach ($logquery as $log) {
            $derndate = $log->date;
        }
        $prefixe->offsetSet('derndate', $derndate);
        return $redirect();
    }

    /**
     * Register new user
     */
    public function registerAction() {
        $viewModel = new ViewModel();
        // if registration is disabled
        if (!$this->getOptions()->getEnableRegistration()) {
            $viewModel->enableRegistration = false;
            return $viewModel;
        }

        $request = $this->getRequest();
        $service = $this->getUserService();
        $form = $this->getRegisterForm();
        $array = $this->getRoleTable()->getUserRoles();
        foreach ($array as $value) {
            $new[$value['rid']] = $value['role_name'];
        }
        $form->get('profil')->setValueOptions($new);
        $arraycentre = $this->getCentreTable()->select();
        foreach ($arraycentre as $valuecentre) {
            $centre[$valuecentre->Id] = $valuecentre->Region;
        }
        $form->get('centre')->setValueOptions($centre);
        if ($this->getOptions()->getUseRedirectParameterIfPresent() && $request->getQuery()->get('redirect')) {
            $redirect = $request->getQuery()->get('redirect');
        } else {
            $redirect = false;
        }

        $redirectUrl = $this->url()->fromRoute(static::ROUTE_REGISTER)
                . ($redirect ? '?redirect=' . rawurlencode($redirect) : '');
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            $viewModel->registerForm = $form;
            $viewModel->enableRegistration = $this->getOptions()->getEnableRegistration();
            $viewModel->redirect = $redirect;
            return $viewModel;
        }

        $post = $prg;
        $user = $service->register($post);

        $redirect = isset($prg['redirect']) ? $prg['redirect'] : null;
        if (!$user) {
            $viewModel->registerForm = $form;
            $viewModel->enableRegistration = $this->getOptions()->getEnableRegistration();
            $viewModel->redirect = $redirect;
            return $viewModel;
        }

        if ($service->getOptions()->getLoginAfterRegistration()) {
            $identityFields = $service->getOptions()->getAuthIdentityFields();
            if (in_array('email', $identityFields)) {
                $post['identity'] = $user->getEmail();
            } elseif (in_array('username', $identityFields)) {
                $post['identity'] = $user->getUsername();
            }
            $post['credential'] = $post['password'];
            $request->setPost(new Parameters($post));
            return $this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'authenticate'));
        }

        // TODO: Add the redirect parameter here...
        $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
        return $this->redirect()->toRoute('parametres');
    }

    /**
     * Change the users password
     */
    public function changepasswordAction() {
        // if the user isn't logged in, we can't change password
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            // redirect to the login redirect route
            return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }
        $form = $this->getChangePasswordForm();
        $prg = $this->prg(static::ROUTE_CHANGEPASSWD);

        $fm = $this->flashMessenger()->setNamespace('change-password')->getMessages();
        if (isset($fm[0])) {
            $status = $fm[0];
        } else {
            $status = null;
        }

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return array(
                'status' => $status,
                'changePasswordForm' => $form,
            );
        }

        $form->setData($prg);

        if (!$form->isValid()) {
            return array(
                'status' => false,
                'changePasswordForm' => $form,
            );
        }

        if (!$this->getUserService()->changePassword($form->getData())) {
            return array(
                'status' => false,
                'changePasswordForm' => $form,
            );
        }

        $this->flashMessenger()->setNamespace('change-password')->addMessage(true);
        return $this->redirect()->toRoute(static::ROUTE_CHANGEPASSWD);
    }

    public function changeEmailAction() {
        // if the user isn't logged in, we can't change email
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            // redirect to the login redirect route
            return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }

        $form = $this->getChangeEmailForm();
        $request = $this->getRequest();
        $request->getPost()->set('identity', $this->getUserService()->getAuthService()->getIdentity()->getEmail());

        $fm = $this->flashMessenger()->setNamespace('change-email')->getMessages();
        if (isset($fm[0])) {
            $status = $fm[0];
        } else {
            $status = null;
        }

        $prg = $this->prg(static::ROUTE_CHANGEEMAIL);
        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return array(
                'status' => $status,
                'changeEmailForm' => $form,
            );
        }

        $form->setData($prg);

        if (!$form->isValid()) {
            return array(
                'status' => false,
                'changeEmailForm' => $form,
            );
        }

        $change = $this->getUserService()->changeEmail($prg);

        if (!$change) {
            $this->flashMessenger()->setNamespace('change-email')->addMessage(false);
            return array(
                'status' => false,
                'changeEmailForm' => $form,
            );
        }

        $this->flashMessenger()->setNamespace('change-email')->addMessage(true);
        return $this->redirect()->toRoute(static::ROUTE_CHANGEEMAIL);
    }

    /**
     * Getters/setters for DI stuff
     */
    public function getUserService() {
        if (!$this->userService) {
            $this->userService = $this->serviceLocator->get('zfcuser_user_service');
        }
        return $this->userService;
    }

    public function setUserService(UserService $userService) {
        $this->userService = $userService;
        return $this;
    }

    public function getRegisterForm() {
        if (!$this->registerForm) {
            $this->setRegisterForm($this->serviceLocator->get('zfcuser_register_form'));
        }
        return $this->registerForm;
    }

    public function setRegisterForm(FormInterface$registerForm) {
        $this->registerForm = $registerForm;
    }

    public function getLoginForm() {
        if (!$this->loginForm) {
            $this->setLoginForm($this->serviceLocator->get('zfcuser_login_form'));
        }
        return $this->loginForm;
    }

    public function setLoginForm(FormInterface $loginForm) {
        $this->loginForm = $loginForm;
        $fm = $this->flashMessenger()->setNamespace('zfcuser-login-form')->getMessages();
        if (isset($fm[0])) {
            $this->loginForm->setMessages(
                    array('identity' => array($fm[0]))
            );
        }
        return $this;
    }

    public function getChangePasswordForm() {
        if (!$this->changePasswordForm) {
            $this->setChangePasswordForm($this->serviceLocator->get('zfcuser_change_password_form'));
        }
        return $this->changePasswordForm;
    }

    public function setChangePasswordForm(FormInterface $changePasswordForm) {
        $this->changePasswordForm = $changePasswordForm;
        return $this;
    }

    /**
     * set options
     *
     * @param UserControllerOptionsInterface $options
     * @return UserController
     */
    public function setOptions(UserControllerOptionsInterface $options) {
        $this->options = $options;
        return $this;
    }

    /**
     * get options
     *
     * @return UserControllerOptionsInterface
     */
    public function getOptions() {
        if (!$this->options instanceof UserControllerOptionsInterface) {
            $this->setOptions($this->serviceLocator->get('zfcuser_module_options'));
        }
        return $this->options;
    }

    /**
     * Get changeEmailForm.
     * @return ChangeEmailForm
     */
    public function getChangeEmailForm() {
        if (!$this->changeEmailForm) {
            $this->setChangeEmailForm($this->serviceLocator->get('zfcuser_change_email_form'));
        }
        return $this->changeEmailForm;
    }

    /**
     * Set changeEmailForm.
     *
     * @param $changeEmailForm - the value to set.
     * @return $this
     */
    public function setChangeEmailForm($changeEmailForm) {
        $this->changeEmailForm = $changeEmailForm;
        return $this;
    }

    public function getRoleTable() {
        if (!$this->role) {
            $this->role = $this->serviceLocator->get('RoleTable');
        }
        return $this->role;
    }

    public function getDepiTable() {
        if (!$this->depiTable) {
            $sm = $this->getServiceLocator();
            $this->depiTable = $sm->get('Analyse\Model\DepiTable');
        }
        return $this->depiTable;
    }

    public function getCentreTable() {
        if (!$this->centreTable) {
            $sm = $this->getServiceLocator();
            $this->centreTable = $sm->get('Parametres\Model\CentreTable');
        }
        return $this->centreTable;
    }

    public function getOptionsForSelect($array, $key, $value) {

        $select = array();
        foreach ($array as $res) {

            $select[$res->$key] = $res->$value;
        }
        return $select;
    }

    public function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Parametres\Model\UserTable');
        }
        return $this->userTable;
    }

    public function getLogqueryTable() {
        if (!$this->logqueryTable) {
            $sm = $this->getServiceLocator();
            $this->logqueryTable = $sm->get('Parametres\Model\logqueryTable');
        }
        return $this->logqueryTable;
    }

}
