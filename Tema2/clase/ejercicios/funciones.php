<?php
function selectDinamico($opciones, $opc, $nombre, $seleccionado = null) {
  $select = '<select name="' . $nombre . '">';
  foreach ($opciones as $opcion) {
    $selected = ($opcion[$opc] == $seleccionado) ? ' selected' : '';
    $select .= '<option value="' . $opcion[$opc] . '"' . $selected . '>' . $opcion['opcion'] . '</option>';
  }
  $select .= '</select>';
  return $select;
}