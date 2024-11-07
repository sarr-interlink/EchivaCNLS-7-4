<?php

namespace Laboratoire\View;

use GtnDataTables\View\AbstractDecorator;

class Effectue extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Examen Effectué</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        $a = array("default" => "default", "primary" => "primary", "danger" => "danger", "success" => "success", "info" => "infos");
        $exam = array("Sero" => "Sero", "Bioc" => "Bioc", "Nfs_" => "Nfs_", "Cd4_" => "Cd4_", "Pcr_" => "Pcr_", "Urin" => "Urin", "Gout" => "Gout", "Vagi" => "Vagi", "Ceph" => "Ceph", "Autr" => "Autr");
        $label = array("Sero" => "Serologie", "Bioc" => "Biochimie",
            "Nfs_" => "NFS", "Cd4_" => "CD4", "Pcr_" => "PCR", 
            "Urin" => "Urine", "Gout" => "Goutte ép", 
            "Vagi" => "Prél. Vagi.", "Ceph" => "Liq. cépha", "Autr" => "Autres");
        $str = "";
        foreach ($exam as $value) {
            if ($object[$value] == 1) {
                if (count($a) > 0) {
                    $col = array_rand($a, 1);
                    unset($a[$col]);
                }
                $str .= '<span class="label label-' . $col . '">' . $label[$value] . '</span><br />';
            }
        }
        return $str;
    }

}
