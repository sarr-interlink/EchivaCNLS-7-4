<?php

namespace ZF2AuthAcl\Plugin\View;

use Zend\View\Helper\AbstractHelper;
use Zend\Permissions\Acl\AclInterface;
use Zend\Permissions\Acl\Role\RoleInterface;

/**
 * Class IsAllowed
 * @package View\Helper
 */
class IsAllowed extends \Zend\Form\View\Helper\AbstractHelper {

    /**
     * @var AclInterface
     */
    protected $acl;

    /**
     * @var RoleInterface
     */
    protected $role;

    /**
     * @var AclInterface
     */
    protected static $defaultAcl;

    /**
     * @var RoleInterface
     */
    protected static $defaultRole;

    /**
     * @param null $resource
     * @param null $privilege
     * @return $this
     */
    public function __invoke($resource = null, $privilege = null) {
        if (is_null($resource)) {
            return $this;
        }

        return $this->isAllowed($resource, $privilege);
    }

    /**
     * @param string|ResourceInterface $resource
     * @param string $privilege
     * @return bool
     * @throws \RuntimeException
     */
    public function isAllowed($resource, $privilege = null) {
        $acl = $this->getAcl();
        if (!$acl instanceof AclInterface) {
            throw new \RuntimeException('No ACL provided');
        } elseif (!$resource instanceof \Zend\Permissions\Acl\Resource\ResourceInterface) {
            $resource = new \Zend\Permissions\Acl\Resource\GenericResource($resource);
        }

        return $acl->isAllowed($this->getRole(), $resource, $privilege);
    }

    public static function setDefaultAcl(AclInterface $acl = null) {
        self::$defaultAcl = $acl;
    }

    /**
     * @param AclInterface $acl
     * @return $this
     */
    public function setAcl(AclInterface $acl = null) {
        $this->acl = $acl;
        return $this;
    }

    /**
     * @return AclInterface
     */
    protected function getAcl() {
        if ($this->acl instanceof AclInterface) {
            return $this->acl;
        }

        return self::$defaultAcl;
    }

    /**
     * @param RoleInterface $role
     */
    public static function setDefaultRole(RoleInterface $role = null) {
        self::$defaultRole = $role;
    }

    /**
     * @param RoleInterface $role
     * @return $this
     */
    public function setRole(RoleInterface $role = null) {
        $this->role = $role;
        return $this;
    }

    /**
     * @return RoleInterface
     */
    protected function getRole() {
        if ($this->role instanceof RoleInterface) {
            return $this->role;
        }

        return self::$defaultRole;
    }

}
