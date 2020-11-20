<?php

// retourne vrai si l'item fait partie de la sélection
function inSelection($selections, $id){
    return isset($selections[$id]);
}

// produire le html d'un controle <select...> avec une liste
// qui présente les items
function makeSelectedList($items){
    $html = "<select id='SelectedItems' name='SelectedItems[]' size='12' multiple class='form-control'>";
    foreach($items as $id => $item) {
        $html .= "<option value='$id'>$item</option>";
    }
    $html .= "</select>";
    return $html; 
}

// produire le html d'un controle <select...> avec une liste
// qui présente les items qui ne font pas partie de 
// d'items sélectionnés se trouvant dans $selectedItems
function makeUnselectedList($items, $selectedItems){
    $html = "<select id='UnselectedItems' size='12' multiple class='form-control'>";
    foreach($items as $id => $item) {
        if (!inSelection($selectedItems, $id)){
            $html .= "<option value='$id'>$item</option>";
        }
    }
    $html .= "</select>";
    return $html; 
}
?>