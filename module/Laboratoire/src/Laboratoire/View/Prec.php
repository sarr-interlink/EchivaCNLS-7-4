<?php

namespace Laboratoire\View;

use GtnDataTables\View\AbstractDecorator;

class Prec extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Examen prévu</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        $a = array("default" => "default", "primary" => "primary", "danger" => "danger", "success" => "success", "info" => "infos");
        $moti = explode("-", $object['Prec']);
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
