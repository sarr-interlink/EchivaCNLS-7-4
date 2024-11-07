<?php

namespace Accueil\View;

use GtnDataTables\View\AbstractDecorator;

class Moti extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Motifs</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        $a = array("default" => "default", "primary" => "primary", "danger" => "danger", "success" => "success", "info" => "infos");
        $moti = explode("-", $object['Moti']);
        $str = "";
        foreach ($moti as $value) {
            if (count($a) > 0) {
                $col = array_rand($a, 1);
                unset($a[$col]);
            }
            $str .= '<span class="label label-' . $col . '">' . $value . '</span><br />';
        }
        return $str;
    }

}
