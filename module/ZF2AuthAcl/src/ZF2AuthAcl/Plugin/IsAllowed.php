<?php

namespace ZF2AuthAcl\Plugin;

use Zend\View\Helper\AbstractHelper;
use Zend\Permissions\Acl\AclInterface;
use Zend\Permissions\Acl\Role\RoleInterface;

/**
 * Class IsAllowed
 * @package View\Helper
 */
class IsAllowed extends AbstractHelper {

    protected $acl;
    protected $role;

    public function __invoke($resource = null, $privilege = null) {
        if (is_null($resource)) {
            return $this;
        }
        return $this->isAllowed($resource, $privilege);
    }

    public function isAllowed($resource, $privilege) {
        return $this->acl->isAccessAllowed($this->getRole(),$resource, $privilege);
    }

    public function setAcl($acl = null) {
        $this->acl = $acl;
        return $this;
    }

    protected function getAcl() {
        return $this->acl;
    }

    public function setRole($role = null) {
        $this->role = $role;
        return $this;
    }

    protected function getRole() {
        return $this->role;
    }

}
