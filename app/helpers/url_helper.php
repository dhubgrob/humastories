<?php

// simple page redirect
function redirect($page){
    header('location: '. URLROOT . '/' . $page);
}

// get story id from URL
function getLastElementOfUrl() {
  $array = explode("/", $_GET['url']);
 
 return $array[count($array) -1 ];
}