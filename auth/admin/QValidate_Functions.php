<?php
// String Splitter that takes a string and a character or character array to be its delimiter
// Outputs a string array

function split_string($string, array $limiters){

    $arr = array();
    $temp = "";
    $chars = str_split($string);

    foreach($chars as  $char){

        
        //check
        $append = false;
        foreach($limiters as $limiter){
            if($char == $limiter){
                if($temp != "")
                array_push($arr,$temp);
                $temp = "";
                $append = false;
                break;
                
            }else{
                $append = true; 
            }
        }
        if($append == true){
            $temp = $temp.$char;
        }
    }
    //push last
    array_push($arr,$temp);
    return $arr;
}
function like_query($string, array $limiters){

    $likes = split_string($string, $limiters);
    $like_query = "";
    foreach($likes as $like){
        if($like === end($likes)){
            $like_query = $like_query.'courseID LIKE "%'.$like . '"';
        }
        else
            $like_query = $like_query.'courseID LIKE "%'.$like .'%" AND ';
    }
    return $like_query;
}
// example:
// $foo = "BS Ed English";
// $bar = array("-"," ");

// print_r(split_string($foo,$bar));

// $likes = split_string($foo,$bar);
// //create Query of Like Operators
// $like_query = "";
// foreach($likes as $like){
//     if($like === end($likes)){
//         $like_query = $like_query.'courseID LIKE "%'.$like . '%"';
//     }
//     else
// 	    $like_query = $like_query.'courseID LIKE "%'.$like .'%" AND ';
// }
// print_r($like_query);

function replace_query($name){
    $chars = array("-","_"," ","/");
    $str = $name;
    foreach($chars as $char){
        $str = "REPLACE(".$str.",'".$char."','')";
    }
    return $str;
}
//

// $name = "courseID";
// $chars = array("-","_"," ","/");

// $temp = replace_query($name, $chars);
function clean($string){
    $string = str_replace('-', '', $string);
    $string = str_replace(' ', '', $string);
    $string = str_replace('_', '', $string);
    $string = str_replace('/', '', $string);
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}
// $temp = clean("asdsakd08123!@#$%^&*()_-asd\/?");
// print_r($temp);

?>