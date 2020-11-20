<?php
//////////////////////////////////////////////////////////////////////////////////////////////
//
// Module de génération de code html
//
// Auteur : Nicolas Chourot dans le cadre du cours 420-KB9
//
//////////////////////////////////////////////////////////////////////////////////////////////
function html_BR() {
    return '<br>';
}
function html_HR() {
    return '<hr>';
}
function html_open($tag, $css=''){
    return "<$tag class='$css'>";
}
function html_close($tag){
    return "</$tag>";
}
function html_header($title, $size = 1){
    if ($size < 1 || $size > 6) $size = 1;  
    return "<h$size>$title</h$size>";
}
function html_label($title, $for){
    return "<label for='$for'>$title</label>";
}
function html_password($name, $placeholder, $css='form-control') {
    return 
    "<input 
    type='password' 
    name='$name'   
    id='$name' 
    placeholder=\"$placeholder\" 
    class='$css'>";
}
function html_textbox($name, $placeholder, $value = '', $css='form-control') {
    return
    "<input 
    name='$name' 
    id='$name' 
    placeholder=\"$placeholder\" 
    value ='$value' 
    class='$css'>";
}
function html_Hidden($name, $value) {
    return "<input type='hidden' name='$name' value='$value'>";
}
function html_checkbox($name, $caption, $css='') {
    return
    "<input 
    type='checkbox' 
    name='$name' 
    id='$name' 
    value='$caption' 
    class='$css'>".
    html_label('&nbsp;'.$caption, $name);
}
function html_orderedList($values, $css=''){
    $html = "<ol class='$css'>";
    foreach($values as $value){
        $html .= "<li>$value</li>";
    }
    $html .= '</ol>';
    return $html;
}
function html_selectOption($value, $caption, $disabled=false){
    return '<option '.($disabled?'selected disabled':'')." value='$value'>$caption</option>";
}
function html_combobox($caption, $values, $css='form-control'){
    $html = "<select class='$css'>";
    $html .= html_selectOption('',$caption, true);
    foreach($values as $key => $value){
        $html .= html_selectOption($key,$value);
    }
    $html .= '</select>';
    return $html;
}
function html_tableCell($content, $css=''){
    return "<td class='$css'>$content</td>";
}
function html_table($values, $css='table'){
    $html = "<table class='$css'>";
    foreach($values as $key => $value){
        $html .= '<tr>';
        $html .= html_tableCell($key);
        $html .= html_tableCell($value);
        $html .= '</tr>';
    }
    $html .= '</table>';
    return $html;
}
function html_errorMessage($message){
    return "<span style='color:red'>$message</span><br>";
}
function html_image($imageFile, $css=''){
    return "<img 
    src='images/$imageFile' 
    alt='$imageFile' 
    class='$css'/>";
}
function html_link($link, $caption, $target = '_self'){
    return "<a href='$link' target='$target'>$caption</a>";
}
function html_icon($imageFile, $link, $tooltip, $position = 'top', $css='icon'){
    $html = "<a href='$link' tooltip=\"$tooltip\" tooltip-position='$position'>";
    $html .= html_image($imageFile, $css);
    $html .= '</a>';
    return $html;
}
function html_frame($content, $css=''){
    return "<iframe src='$content' class='$css'></iframe>";
}
function html_beginForm($action, $id, $method = 'POST', $enctype = null){
    $html = "<form  id='$id' action='$action' method='$method'";
    if (isset($enctype))
        $html .= "enctype='$enctype'";
    $html .= '>';
    return $html;
}
function html_closeForm() {
    return '</form>';
}
function html_submit($name, $caption, $css='form-control') {
    return"<input type='submit' name='$name' id='$name'value='$caption' class='$css'>";
}
function html_faviconLinkFromUrl($url){
    $urlFavicon = 'http://www.google.com/s2/favicons?sz=64&domain='.$url;
    $html  = '<a href="'.$url.'" target="_blank"><img class="favicon" src="'.$urlFavicon.'"/></a>';
    return $html;
 }

 function html_fittedImage($url, $class=''){
    return <<<HTML
    <div    class='$class' 
            style='background:url($url) no-repeat center;  background-size: cover; float:left; margin-right:5px;'>
            </div>
    HTML;
 }

 function html_flashButtonLink($flashButtonType, $link, $tooltip, $position = 'top'){
    $html = "<a href='$link' class='flashButton $flashButtonType 'tooltip=\"$tooltip\" tooltip-position='$position'>";
    $html .= '</a>';
    return $html;
}

function html_flashButton($flashButtonType, $id, $tooltip, $position = 'top'){
    $html = "<div id='$id' class='flashButton $flashButtonType' tooltip=\"$tooltip\" tooltip-position='$position'>";
    $html .= '</div>';
    return $html;
}

function html_Confirm($title, $message, $link) {
    $html = <<<HTML
    <div class='flashButton iconDelete' 
         tooltip='Effacer' 
         tooltip-position='bottom'
         onclick='$.confirm({title:"$title",content:"$message",buttons:{confirmer:function(){document.location="$link";},annuler:{}}});'>
    </div>
    HTML;
    return $html;
}

function html_makeRating($name, $value, $readOnly = true){
    $disableAttribute = $readOnly?"disabled":"";
    $html = "<input type='radio' name='$name' class='RatingBar' value='$value' $disableAttribute/>";
    return $html;
}

function html_makeRatingSummary($name, $value, $nbRatings){
    $html = html_makeRating($name, $value);
    $html.= "<span class='ratingSummary'>($nbRatings)</span>";
    return $html;
}
?>