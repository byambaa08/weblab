<?php

    $GLOBALS['hash'] = 'byambaabyambaabyambaabyambaabyam';

    function encrypt($string){
        $word = unpack("C*", $string);
        $hash= unpack("C*",$GLOBALS['hash']);
        foreach ($hash as $key => $value) {
            if( $key<=sizeof($word))
                $hash[$key] += $word[$key];
            else
                $hash[$key] += $hash[$key];
            }
        return call_user_func_array('pack', array_merge(array('C*'), $hash ));
    }

    function decrypt($string){
        if(encrypted($string)==False){
            header("Location: index.php?error=2");
            die();
        }
        $decrypt_word = unpack("C*",$string);
        $hash= unpack("C*",$GLOBALS['hash']);
        $decrypted_word = array();
        foreach ($hash as $key => $value) {
            $decrypted_word[$key] = $decrypt_word[$key] - $hash[$key];
            if($hash[$key] == $decrypt_word[$key] )
                break;
        }  
        $decrypted_word = array_slice($decrypted_word, 0, 12, true);
        return  call_user_func_array('pack', array_merge(array('C*'), $decrypted_word));

    }
    function encrypted($string){
        return (strlen($string)==32);
    }

    function menus($id, $access_lvl){
        echo'<a class="btn btn-secondary btn-lg" role="button" href="welcome.php?id='.md5($id).'">өөрийн мэдээлэл</a>';
        if($access_lvl>0)
            echo'<a class="btn btn-secondary btn-lg" role="button" href="list.php?id='.md5($id).'">Оюутнуудын жагсаалт</a>'; 
        
        if($access_lvl>1)
            echo'<a class="btn btn-secondary btn-lg" role="button" href="list_staff.php?id='.md5($id).'">Ажилчдын жагсаалт</a>'; 
        
        if($access_lvl>2)
            echo'<a class="btn btn-secondary btn-lg" role="button" href="list_users.php?id='.md5($id).'">Хэрэглэгчдийн жагсаалт</a>'; 
        }
    function checkPassword($pwd) {
        if (strlen($pwd) < 6 || !preg_match("#[0-9]+#", $pwd) || !preg_match("#[A-Z]+#", $pwd) || !preg_match("#[a-z]+#", $pwd) ) {
            return False;
        }     

    return True;
}
?>