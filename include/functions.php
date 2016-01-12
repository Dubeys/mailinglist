<?php
function display_error($array, $err){
  if(isset($array[$err]) && $array[$err] != ""){
    return '<p class="alert-error">'.$array[$err].'</p>';
  }
}

function redirectTo($url)
{
  header('Location: '.$url);
  exit;
}
