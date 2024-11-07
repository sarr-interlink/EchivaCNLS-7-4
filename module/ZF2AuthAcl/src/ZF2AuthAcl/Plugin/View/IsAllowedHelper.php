<?php

namespace ZF2AuthAcl\Plugin\View;

use Zend\View\Helper\AbstractHelper;
use ZF2AuthAcl\Plugin\IsAllowed;

class IsAllowedHelper extends AbstractHelper {

    public function __invoke() {
        $IsAllowed = new IsAllowed();
        return $IsAllowed;
    }

}
