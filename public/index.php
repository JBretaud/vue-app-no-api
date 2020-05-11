<?php
require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'header.php';

if(isset($path)){
    if ($path[0]=="account"){
        if ($path[1]=="new"){
            if(!isset($path[2])){
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'newAccount'.DIRECTORY_SEPARATOR.'etape1.php';
            }else{
                if ($path[2]=="etape1"){
                    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'newAccount'.DIRECTORY_SEPARATOR.'etape1.php';
                }else if ($path[2]=="etape1R"){
                    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'createAccount.php';
                }else if ($path[2]=="etape2"){
                    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'newAccount'.DIRECTORY_SEPARATOR.'etape2.php';
                }else if ($path[2]=="etape2R"){
                    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'createPatient.php';
                }else if($path[2]=="etape2RExiste"){
                    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'updatePatient.php';
                }else if ($path[2]=="abort"){
                    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'createAbort.php';
                }else if ($path[2]=="updated"){
                    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'newAccount'.DIRECTORY_SEPARATOR.'updated.php';
                }else if ($path[2]=="complete"){
                    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'newAccount'.DIRECTORY_SEPARATOR.'complete.php';
                }
            }
        }else if($path[1]=="modify"){
            if(empty($path[2])){
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'newAccount'.DIRECTORY_SEPARATOR.'etape2.php';
            }elseif ($path[2]=="complete"){
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'modify'.DIRECTORY_SEPARATOR.'complete.php';
            }elseif ($path[2]=="update"){
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'updatePatient.php';
            }
        }else{
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'error404.php';
        }
        
    }elseif ($path[0]=='admin'&&$_SESSION['type']==3){
        if ($path[1]=='recherche'&&$path[2]=='patient'){
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'recherchePatient.php';
        }elseif($path[1]=='fiche'){
            if(isset($path[2])){
                if($path[2]=='update'){
                    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'updatePatient.php';
                }
            }else{
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'fichePatient.php';
            }
        }elseif ($path[1]=='rdv'){
            if ($path[2]=='new'){
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'patient'.DIRECTORY_SEPARATOR.'priseRdv.php';
            }elseif($path[2]=='book'){
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'patient'.DIRECTORY_SEPARATOR.'formRdv.php';
            }elseif($path[2]=='finalize'){
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'bookRdv.php';
            }else{
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'error404.php';
            }
        }else{
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'error404.php';
        }
    }elseif($path[0]=='patient'&&$_SESSION['type']==1){
        if ($path[1]=='rdv'){
            if ($path[2]=='new'){
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'patient'.DIRECTORY_SEPARATOR.'priseRdv.php';
            }elseif($path[2]=='book'){
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'patient'.DIRECTORY_SEPARATOR.'formRdv.php';
            }elseif($path[2]=='finalize'){
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'bookRdv.php';
            }else{
                require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'error404.php';
            }
        }else{
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'error404.php';
        }
    }elseif ($path[0]=="logout"){
        require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'logout.php';
    }elseif ($path[0]=="login"){
        require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'login.php';
    }elseif($path[0]=='profil'){
        require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'profil.php';
    }elseif ($path[0]=="accueil"){
        require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'accueil.php';
    }elseif ($path[0]=="calendar"){
        
        if (empty($path[1])){
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'calendrier'.DIRECTORY_SEPARATOR.'calendrierSemaine.php';
        }elseif($path[1]=="month"){
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'calendrier'.DIRECTORY_SEPARATOR.'calendrierMois.php';
        }elseif($path[1]=="week"){
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'calendrier'.DIRECTORY_SEPARATOR.'calendrierSemaine.php';
        }else{
            
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'error404.php';
        }
    }else{
        require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'error404.php';
    }
}else{
    
    require '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'accueil.php';
}
require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'footer.php';
        