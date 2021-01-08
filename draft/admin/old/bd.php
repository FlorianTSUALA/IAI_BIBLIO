<?php

/* lecture des parametres de configuration   */

$ini = parse_ini_file("conf/start.ini", true);
//ini_set('max_execution_time', 0); //0 seconds = illimité
 set_time_limit (0);


$server = $ini["base de donnees"]["server"];
$user = $ini["base de donnees"]["user"];
$password = $ini["base de donnees"]["password"];
$database = $ini["base de donnees"]["database"];
$version = $ini["system"]["version"];

/* connexion a la base   */

$connect = mysqli_connect($server, $user, $password);
$db = mysqli_select_db($connect, $database);

/* requetes usuelles */

$sql_sections = "SELECT * FROM  `t_sections` ";
$sql_sens = "SELECT * FROM  `t_sens` ";
$sql_types = "SELECT * FROM  t_types WHERE etat = '1' ";
$sql_mac = "SELECT * FROM  t_mac WHERE etat = '1'";
$sql_mou = "SELECT * FROM  t_log";
$sql_sections = "SELECT * FROM  t_sections WHERE etat = '1' ";
$sql_params = "SELECT * FROM  `t_parametres` ";
$sql_profils = "SELECT * FROM t_profils WHERE etat = '1' ";
$sql_users = "SELECT login, pwd, nom, email, telephone, notif_user, profil as code_profil, libelle as lib_profil " .
                "FROM t_users u, t_profils " .
                "WHERE profil=code " .
                "AND u.etat = '1'";
$sql_taches_admin = "SELECT * FROM t_taches_admin ";

/* recuperation du repertoire de stockage des courriers */

function getCourrier($id) {
    global $connect;

    $sql = "SELECT cou.id id, cou.annee_section, cou.section, cou.type_c, sc.libelle lib_section, cou.sens, ss.libelle lib_sens, cou.type_c type, tp.libelle lib_type, cou.reference, 
                   cou.objet, cou.date_enr date, cou.nom_fichier, cou.rep_physique, cou.type_mime, cou.user, us.nom utilisateur, cou.reponse_attendue, cou.est_associe, cou.courrier_associe 
            FROM t_courriers cou, t_sections sc, t_sens ss, t_types tp, t_users us  
            WHERE id = '$id' AND cou.section = sc.code AND cou.sens = ss.code AND cou.type_c = tp.code AND cou.user = us.login";
    $rs = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    if (mysqli_num_rows($rs) == 0) {
        return false;
    } else {
        $row = mysqli_fetch_assoc($rs);
        return $row;
    }
}

function getIdCourrierByWF($id_wf) {
    global $connect;

    $sql = "SELECT document FROM t_wf_document WHERE workflow = '$id_wf'";
    $rs = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_assoc($rs);
    
    return $row['document'];
}

function getSections($code) {
    global $connect;

    $sql = "SELECT * FROM t_sections WHERE code = '$code'";
    $rs = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    
    return mysqli_fetch_assoc($rs);
}

function getSens($code) {
    global $connect;

    $sql = "SELECT * FROM t_sens WHERE code = '$code'";
    $rs = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    
    return mysqli_fetch_assoc($rs);
}

function getTypes($code) {
    global $connect;

    $sql = "SELECT * FROM t_types WHERE code = '$code'";
    $rs = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    
    return mysqli_fetch_assoc($rs);
}

 
function getParam($paramName) {
    global $connect;

    $sql = "SELECT * FROM t_parametres WHERE nom = '$paramName'";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if ($row = mysqli_fetch_assoc($rs)) {
        return $row['valeur'];
    } else {
        return -1;
    }
}

function getParamDesc($paramName) {
    global $connect;

    $sql = "SELECT * FROM t_parametres WHERE nom = '$paramName'";
    $rs = mysqli_query($connect, $sql) or die($sql);
    $row = mysqli_fetch_assoc($rs);
    return $row['description'];
}

function getAdminRigths($profil) {
    global $connect;
    $t = array();

    $sql = "SELECT * FROM t_droits_admin WHERE profil = '" . $profil . "' AND droit = '1' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['tache'];
    }
    return $t;
}

function getNDRigths($user_login, $user_profil) {
    global $connect;
    $t = array();

    $sql = "SELECT * FROM t_preferences WHERE login_user = '$user_login' AND login_profil = '$user_profil' AND is_default = '1' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['login_user_n'];
    }
    return $t;
}

function getNDPRigths($user_login, $user_profil) {
    global $connect;
    $t = array();

    $sql = "SELECT DISTINCT profil_user_n FROM t_preferences WHERE login_user = '$user_login' AND login_profil = '$user_profil' AND is_default = '1' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['profil_user_n'];
    }
    return $t;
}

function getCorrespondants($code, $annee) {
    global $connect;

    $t = array();
	$sql = "SELECT profil FROM t_correspondants WHERE code_section = '" . $code . "' AND annee_section = '$annee'" ;
    $rs = mysqli_query($connect, $sql) or die($sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['profil'];
    }
    return $t;
}


//THITY

function getCorrespSearchRigths($profil, $annee) {
    global $connect;
    $t = array();
    
    $sql = "SELECT code_section FROM t_correspondants WHERE profil = '$profil' AND annee_section = '$annee' AND recherche = 1";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['code_section'];
    }
    return $t;
}

function getCorrespArchiveRigths($profil, $annee) {
    global $connect;
    $t = array();
    
    $sql = "SELECT code_section FROM t_correspondants WHERE profil = '$profil' AND annee_section = '$annee' AND archivage = 1";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['code_section'];
    }
    return $t;
}

function getCorrespNotifyRigths($profil, $annee) {
    global $connect;
    $t = array();
    
    $sql = "SELECT code_section FROM t_correspondants WHERE profil = '$profil' AND annee_section = '$annee' AND notification = 1";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = trim($row['code_section']);
    }
    return $t;
}

function getCorrespEtreNotifyRigths($profil, $annee) {
    global $connect;
    $t = array();
    
    $sql = "SELECT code_section FROM t_correspondants WHERE profil = '$profil' AND annee_section = '$annee' AND e_notification = 1";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = trim($row['code_section']);
    }
    return $t;
}


function getArchiveRigths($profil) {
    global $connect;
    $t = array();

    $sql = "SELECT * FROM t_droits_types t1, t_types t2 WHERE etat = 1 AND t2.code = t1.type AND profil = '" . $profil . "' AND droit_a = '1' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['type'];
    }
    return $t;
}

function getSearchRigths($profil) {
    global $connect;
    $t = array();

    $sql = "SELECT * FROM t_droits_types WHERE profil = '" . $profil . "' AND droit_r = '1' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['type'];
    }
    return $t;
}

function getEditRigths($profil) {
    global $connect;
    $t = array();

    $sql = "SELECT * FROM t_droits_types WHERE profil = '" . $profil . "' AND droit_e = '1' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['type'];
    }
    return $t;
}

function getEtreNotifTypeRigths($profil) {
    global $connect;
    $t = array();

    $sql = "SELECT * FROM t_droits_types WHERE profil = '" . $profil . "' AND droit_en = '1' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['type'];
    }
    return $t;
}

function getNotifTypeRigths($profil) {
    global $connect;
    $t = array();

    $sql = "SELECT * FROM t_droits_types WHERE profil = '" . $profil . "' AND droit_n = '1' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
    if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['type'];
    }
    return $t;
}




function getUsersProfils($login, $profil) {
	global $connect;
    $t = array();
	
	$sql = "SELECT * FROM t_users_profils WHERE login = '$login' AND profil = '$profil' AND etat = '1'";
    $rs = mysqli_query($connect, $sql) or die($sql);
	
	if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['profil'];
    }
    return $t;
}


//Retourne la liste des profils que le profil courant est autorisé à notifier
function getNotifyProfil($profil) {
	global $connect;
    $t = array();
	
	$sql = "SELECT * FROM t_profil_notify WHERE profil = '" . $profil . "' AND droit_notify = '1' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
	
	if (mysqli_num_rows($rs) == 0) {
        return $t;
    }
    while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['profil_notify'];
    }
    return $t;
}

function getLibProfil($code) {
    global $connect;

    $sql = "SELECT * FROM t_profils WHERE code = '" . $code . "' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
    $row = mysqli_fetch_assoc($rs);
    return $row['libelle'];
}

function getLibType($code) {
    global $connect;

    $sql = "SELECT * FROM t_types WHERE code = '" . $code . "' ";
    $rs = mysqli_query($connect, $sql) or die($sql);
    $row = mysqli_fetch_assoc($rs);
    return $row['libelle'];
}

function getLibSection($code, $annee) {
    global $connect;
    
    if (!is_numeric($code)) {
        $code = "'".$code."'";
    }

    $sql = "SELECT DISTINCT(libelle) FROM t_sections WHERE code = $code " . ( $annee ? "AND annee = '$annee' " : "" );
    $rs = mysqli_query($connect, $sql) or die($sql);
    $row = mysqli_fetch_assoc($rs);
    return $row['libelle'];
}

function getCourrierByPath($path) {
    global $connect;

    $sql = "SELECT * FROM t_courriers WHERE nom_fichier = '$path'";
    $rs = mysqli_query($connect, $sql) or die($sql);
    $row = mysqli_fetch_assoc($rs);
    return $row;
}

//Renvoie la liste des profils à notifier pour un profil donné
function getProfilANotifier($profil){
	global $connect;
	
	$t = array();
	$sql = "SELECT profil_notify FROM t_profil_notify WHERE profil = '". $profil . "' AND droit_notify = 1";
	$rs = mysqli_query($connect, $sql) or die($sql);
	while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row['profil_notify'];
    }
    return $t;
}


//Renvoie le nombre de profils à notifier pour un profil donné
function isAllUserNonNotifier($profil, $id_workflow){
	
    $bool = 0;
	$_USR = getUserByProfil($profil);					
	   foreach($_USR as $k => $val) {
	       if (!aDejaCeWorkflow($val['login'], $id_workflow)) {
	           $bool = $bool + 1;
	       }
    }
    return $bool;
}


//Renvoie la liste des profils à notifier pour un profil donné en fonction du type de courrier et de la section
function getProfilRestantANotifierBySectionAndType($profil, $section, $an_section, $type, $id_workflow){
	global $connect;
	
	$t = array();
	$sql = "SELECT profil_notify as profil, libelle 
            FROM t_profil_notify, t_profils 
            WHERE profil = '$profil' 
            AND droit_notify = 1 
            AND code = profil_notify";
	$rs = mysqli_query($connect, $sql) or die($sql);
	//
    while ($row = mysqli_fetch_assoc($rs)) {
        
        $profil_notify = $row['profil'];
        
        if (isProfilANotifierBySection($profil_notify, $section, $an_section) && isProfilANotifierByType($profil_notify, $type)) {
            
            //recuperer les profils ayant des agents
            $sql2 = "SELECT * FROM t_users WHERE etat = 1 AND profil = '$profil_notify'";
    	    $rs2 = mysqli_query($connect, $sql2) or die($sql2);
            $nbre = mysqli_num_rows($rs2);
            
            while ($row2 = mysqli_fetch_assoc($rs2)) {
                if (!aDejaCeWorkflow($row2['login'], $id_workflow)) {
                    $t[] = $row;
                }
            }
        }  
    }
    return $t;
}


//Renvoie vrai si le profil peut notifier en fonction du type de courrier et de la section
function isProfilAEtreNotifierBySectionAndType($profil, $section, $an_section, $type){
	
    $bool_1 = isProfilAEtreNotifierBySection($profil, $section, $an_section);
    $bool_2 = isProfilAEtreNotifierByType($profil, $type);
    
    $result = $bool_1 && $bool_2;
    $cause = "";
    
    if (!$result) {
        if ($bool_1) {
            $cause = "Vous ne pouvez pas notifier ce type de courrier";
        }
        else if ($bool_2) {
            $cause = "Vous ne pouvez pas notifier un courrier de cette section";
        }
        else {
            $cause = "Vous ne pouvez notifier ni ce type de courrier, ni un courrier de cette section";
        }
    }
    
    return array($result, $cause);
}


//Renvoie la liste des profils à notifier pour un profil donné en fonction du type de courrier et de la section
function getProfilANotifierBySectionAndType($profil, $section, $an_section, $type){
	global $connect;
	
	$t = array();
	$sql = "SELECT profil_notify as profil, libelle FROM t_profil_notify, t_profils WHERE profil = '$profil' AND droit_notify = 1 AND code = profil_notify";
	$rs = mysqli_query($connect, $sql) or die($sql);
	//
    while ($row = mysqli_fetch_assoc($rs)) {
        
        $profil_notify = $row['profil'];
        
        if (isProfilANotifierBySection($profil_notify, $section, $an_section) && isProfilANotifierByType($profil_notify, $type)) {
            
            //recuperer les profils ayant des agents
            $sql2 = "SELECT * FROM t_users WHERE etat = 1 AND profil = '$profil_notify'";
    	    $rs2 = mysqli_query($connect, $sql2) or die($sql2);
            $nbre = mysqli_num_rows($rs2);
            
            if ($nbre > 0) {
                $t[] = $row;
            }
        }  
    }
    return $t;
}


//Renvoie vrai si un profil donné est notifiable  en fonction du type de courrier et de la section
function isProfilANotifierBySectionAndType($profil, $section, $an_section, $type){
	
    $bool_1 = isProfilANotifierBySection($profil, $section, $an_section);
    $bool_2 = isProfilANotifierByType($profil, $type);
    
    $result = $bool_1 && $bool_2;
    $cause = "";
    
    if (!$result) {
        if ($bool_1) {
            $cause = "Vous ne pouvez pas être notifié pour ce type de courrier";
        }
        else if ($bool_2) {
            $cause = "Vous ne pouvez pas être notifié pour un courrier de cette section";
        }
        else {
            $cause = "Vous ne pouvez être notifié ni pour ce type de courrier, ni un courrier de cette section";
        }
    }
    
    return array($result, $cause);        
 
}


//Renvoie vrai si un profil donné est notifiable  en fonction du type de courrier et de la section
function afficher_workflow($profil, $an_section){
	global $connect;
	$bool = false;
    
    //$sql = "SELECT * FROM t_correspondants  WHERE e_notification = '1' AND annee_section = '$an_section' AND profil = '$profil'";
    $sql1 = "SELECT * FROM t_correspondants  WHERE e_notification = '1' AND profil = '$profil'";
	$r1 = mysqli_query($connect, $sql1);
    
    //$sql = "SELECT * FROM t_droits_types  WHERE droit_n = '1' AND profil = '$profil'";
    $sql2 = "SELECT * FROM t_droits_types  WHERE droit_n = '1' AND profil = '$profil'";
	$r2 = mysqli_query($connect, $sql2);
    
    //echo mysqli_num_rows($r1)."-".mysqli_num_rows($r2)." - ".$profil." ".$sql1;
    
    if (mysqli_num_rows($r1)>0 && mysqli_num_rows($r1)>0) {
        $bool = true;
    }
    
    return $bool;
}


//Renvoie vrai si le type de courrier est utilisé
function isTypeUsed($type){
	global $connect;
	
    $sql = "SELECT * FROM t_droits_types  WHERE type = '$type' AND (droit_a = '1' OR droit_r = '1' OR droit_e = '1' OR droit_n = '1' OR droit_en = '1')";
	$rs = mysqli_query($connect, $sql) or die($sql);
    
    return mysqli_num_rows($rs) != 0;
}

//Renvoie vrai si la section de courrier est utilisée
function isSectionUsed($section){
	global $connect;
	
    $sql = "SELECT * FROM t_correspondants WHERE code_section = '$section' AND (recherche = '1'OR archivage = '1' OR notification = '1' OR e_notification = '1')";
	$rs = mysqli_query($connect, $sql) or die($sql);
    
    return mysqli_num_rows($rs) != 0;
}

//Renvoie la liste des profils à notifier pour un profil donné
function getUserANotifier($profil, $section, $an_section, $type){
	global $connect;
	
	$t = array();
	$sql = "SELECT profil_notify as profil, libelle FROM t_profil_notify, t_profils WHERE profil = '$profil' AND droit_notify = 1 AND code = profil_notify";
	$rs = mysqli_query($connect, $sql) or die($sql);
	//
    while ($row = mysqli_fetch_assoc($rs)) {
        
        $profil_notify = $row['profil'];
        
            //recuperer les profils ayant des agents
            $sql2 = "SELECT * FROM t_users WHERE etat = 1 AND profil = '$profil_notify'";
    	    $rs2 = mysqli_query($connect, $sql2);
            $nbre = mysqli_num_rows($rs2);
            
            if ($nbre > 0) {
                $t[] = $row;
            }
          
    }
    return $t;
}

//Renvoie vrai si le profil peut notifier par rapport a une section pour une annee , et faux sinon
function isProfilANotifierBySection($profil, $section, $an_section){
	global $connect;
	
	$bool = false;
    
    $sql = "SELECT * 
            FROM t_correspondants 
            WHERE annee_section = '$an_section' 
            AND code_section = '$section' 
            AND  profil = '$profil' and notification = '1'";
	
    $rs = mysqli_query($connect, $sql) or die($sql);
    $nbre = mysqli_num_rows($rs);
    
    if ($nbre > 0){
        $bool = true;
    }
    
    return $bool;
}


//Renvoie vrai si le profil est notifiable par rapport a une section pour une annee , et faux sinon
function isProfilAEtreNotifierBySection($profil, $section, $an_section){
	global $connect;
	
	$bool = false;
    
    $sql = "SELECT * 
            FROM t_correspondants 
            WHERE annee_section = '$an_section' 
            AND code_section = '$section' 
            AND  profil = '$profil' and e_notification = '1'";
	
    $rs = mysqli_query($connect, $sql) or die($sql);
    $nbre = mysqli_num_rows($rs);
    
    if ($nbre > 0){
        $bool = true;
    }
    return $bool;
}


//Renvoie vrai si le profil est  notifiable par rapport a un type de courrier , et faux sinon
function isProfilANotifierByType($profil, $code_type){
	global $connect;
	
	$bool = false;
    
	$sql = "SELECT * FROM t_droits_types WHERE profil = '$profil' AND type = '$code_type' AND droit_n = 1";
	$rs = mysqli_query($connect, $sql) or die($sql);
    $nbre = mysqli_num_rows($rs);
    
    if ($nbre > 0){
        $bool = true;
    }
    
    return $bool;
}


//Renvoie vrai si le profil peut notifier par rapport a un type de courrier , et faux sinon
function isProfilAEtreNotifierByType($profil, $code_type){
	global $connect;
	
	$bool = false;
    
	$sql = "SELECT * FROM t_droits_types WHERE profil = '$profil' AND type = '$code_type' AND droit_en = 1";
	$rs = mysqli_query($connect, $sql) or die($sql);
    $nbre = mysqli_num_rows($rs);
    
    if ($nbre > 0){
        $bool = true;
    }
    
    return $bool;
}


//Renvoie vrai si le profil est notifiable , et faux sinon
function isProfilANotifier($profil){
	global $connect;
	
	$bool = false;
    
	$sql = "SELECT * FROM t_profil_notify WHERE profil_notify = '$profil' AND droit_notify = 1";
	$rs = mysqli_query($connect, $sql) or die($sql);
    $nbre = mysqli_num_rows($rs);
    
    if ($nbre > 0){
        $bool = true;
    }
    
    return $bool;
}

//Renvoie la liste des profils à notifier par defaut pour un profil donné
function getProfilAllUser($profil, $section, $an_section){
	global $connect;	
	$t = array();	
	$sql = "SELECT DISTINCT a.profil, c.libelle
	FROM t_correspondants a, t_courriers b, t_profils c
	WHERE b.annee_section = '$an_section' AND b.section='$section'
	AND a.annee_section = b.annee_section
	AND a.code_section = b.section
	AND c.code = a.profil AND a.profil IN 
	(SELECT profil_notify FROM t_profil_notify, t_profils 
	 WHERE t_profil_notify.profil_notify=t_profils.code 
	 AND t_profil_notify.profil= '$profil' AND droit_notify = 1)";

	$rs = mysqli_query($connect, $sql) or die($sql);
	while ($row = mysqli_fetch_assoc($rs)) {
 	   
        //recuperer les profils ayant des agents
        $sql2 = "SELECT * FROM t_users WHERE profil = '". $row['profil'] . "'";
	    $rs2 = mysqli_query($connect, $sql2) or die($sql2);
        $nbre = mysqli_num_rows($rs2);
        
        if ($nbre > 0) {
            $t[] = $row;
        }
    }
    return $t;	    
}


//Renvoie la liste des autres profils à notifier pour un profil donné
function getProfilOtherUser($profil, $tab){
	global $connect;	
	$t = array();		
	$sql = "SELECT profil_notify as profil, libelle 
	FROM t_profil_notify, t_profils 
	WHERE t_profil_notify.profil_notify=t_profils.code 
	AND profil = '$profil' AND droit_notify = 1 AND t_profil_notify.profil_notify NOT IN ($tab)";	
	$rs = mysqli_query($connect, $sql) or die($sql);
	
        while ($row = mysqli_fetch_assoc($rs)) {
            
            //recuperer les profils ayant des agents
            $sql2 = "SELECT * FROM t_users WHERE etat = 1 AND profil = '". $row['profil'] . "'";
    	    $rs2 = mysqli_query($connect, $sql2) or die($sql2);
            $nbre = mysqli_num_rows($rs2);
            
            if ($nbre > 0) {
                $t[] = $row;
            }
                    
        }
    return $t;	    
}

function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}

function getColCourriers($id, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_courriers WHERE id='$id'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getColMac($id, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_mac WHERE id='$id'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getColMacHost($mac, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_mac WHERE mac='$mac'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getColDetails($id, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_courriers tc, t_wf_document tw WHERE tc.id = tw.document AND tw.workflow ='$id'";                                       
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getColAttached($id, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_wf_attach WHERE id='$id'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getNBAttachs($idtask) {
	global $connect;
	$sql = "SELECT count(id_task) FROM t_wf_attach WHERE id_task='$idtask'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getAllNBAttachs($id_worflow, $idtask) {
	global $connect;
    $sql = "(SELECT * FROM t_wf_attach WHERE id_task='$idtask')
            UNION
            (select * from t_wf_attach where id_task in (SELECT id FROM t_wf_task t WHERE  due_date is not null and  workflow = '$id_worflow'))";
    $rs = mysqli_query($connect, $sql) or die($sql);
    return mysqli_num_rows($rs);
}

function getTaskNextId() {
	global $connect;
	$sql = "SELECT MAX(id) FROM t_wf_task";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0) + 1;
}


function getColWorkflow($id, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_wf_workflow WHERE id='$id'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getColTask($id, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_wf_task WHERE id='$id'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getColState($id, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_wf_state WHERE id='$id'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getColUsers($id, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_users WHERE login='$id'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getColSection($code, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_sections WHERE code='$code'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getColType($code, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_types WHERE code='$code'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function getColSens($code, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_sens WHERE code='$code'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}


function getColProfil($id, $col) {
	global $connect;
	$sql = "SELECT ".$col." FROM t_profils WHERE code='$id'";
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_result($rs,0,0);
}

function isSaveInWorkflow($table, $user) {	
	foreach ($table as $i => $val) {
		if (trim($user)==trim($val['notifier'])){
			return true;
		}		
	}
	return false;
}

function getSaveWorkflow($login, $task, $type) {
	global $connect;
	
	$t = array();	
	if ($type==1) {
		$sql = "SELECT notifier FROM t_wf_save WHERE owner = '$login' AND id_task='$task' AND type='1'";	
	} else {
		$sql = "SELECT notifier FROM t_wf_save WHERE owner = '$login' AND id_task='$task' AND type='2'";
	}
	$rs = mysqli_query($connect, $sql) or die($sql);
	while ($row = mysqli_fetch_assoc($rs)) {
        $t[] = $row;
    }
    return $t;
}

function aUneEmisUneNotificationAuto($task) {
	global $connect;
		
	$sql = "SELECT id FROM t_wf_task  WHERE id='$task' AND due_date IS NOT NULL";	
	$rs = mysqli_query($connect, $sql) or die($sql);
    
	return mysqli_num_rows($rs)!=0;
}


function aDejaCeWorkflow($login, $workflow) {
	global $connect;
		
	$sql = "SELECT id FROM t_wf_task WHERE assignee ='$login' AND workflow='$workflow'";	
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_num_rows($rs)!=0;
}

function aDejaCeWorkflowProfil($login, $workflow, $profil) {
	global $connect;
		
	$sql = "SELECT id FROM t_wf_task WHERE assignee ='$login' AND workflow='$workflow' AND description='$profil'";	
	$rs = mysqli_query($connect, $sql) or die($sql);
	return mysqli_num_rows($rs)!=0;
}


function isSectionExistBy($col, $section, $annee) {
    global $connect;
    
    $rs = mysqli_query($connect, "SELECT * FROM t_sections 
                                   WHERE ".$col." = '$section' 
                                   AND annee = '$annee'
                                   AND etat = '1'") or die(mysqli_error($connect));
    
    return mysqli_num_rows($rs)!=0;
}


//Renvoie la liste des profils à notifier pour un profil donné
function getUserByProfil($profil){
	global $connect;
	
	$t = array();	
	
    //$sql = "SELECT * FROM t_users WHERE profil = '$profil'";	
    $sql = "SELECT login FROM t_users WHERE profil = '$profil' AND etat = '1'
            UNION
            SELECT login FROM t_users_profils WHERE profil = '$profil' AND etat = '1'";	
    $rs = mysqli_query($connect, $sql) or die($sql);
    
	while ($row = mysqli_fetch_assoc($rs)) {
	   
       $login = $row['login'];
       $sql2 = "SELECT * FROM t_users WHERE login = '$login'";
       $rs2 = mysqli_query($connect, $sql2) or die($sql2);
       $ligne = mysqli_fetch_assoc($rs2);
       
       $t[] = $ligne;
    }
    return $t;	    
}

//------------------------
/* fonction de sauvegarde de la trace du courrier en base de donnees */

function save_log($user, $mac, $action) {
    global $connect;
    $date = date('Y-m-d H:i:s');
    
    $sql_save = "INSERT INTO t_log VALUES ('', '" . $date . "', '" . $user . "', '" . $mac . "', '" . $action . "')";
    mysqli_query($connect, $sql_save) or die(mysqli_error($connect) . " <br/>" . $sql_save);
}

function is_machine_exist($mac) {
    global $connect;
    
	$sql = "SELECT *  FROM t_mac WHERE mac = '$mac' AND etat = 1";
    $rs = mysqli_query($connect, $sql);
    
    return mysqli_num_rows($rs)!=0; //return TRUE if machine exists, else return FALSE
}

function is_mac_exist($mac) {
	$bool = false;
	
	$logs_file = file('template/js/mac.txt');
	$tab_mac = array();
	
	foreach ($logs_file as $line) {
		$tab_mac[] = trim($line);
    }
	
	if (in_array($mac, $tab_mac)) {
		$bool = true;
	}
	
	return $bool;
}

function kv_read_word($input_file){	
	 $kv_strip_texts = ''; 
         $kv_texts = ''; 	
	if(!$input_file || !file_exists($input_file)) return false;
		
	$zip = zip_open($input_file);
		
	if (!$zip || is_numeric($zip)) return false;
	
	
	while ($zip_entry = zip_read($zip)) {
			
		if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
			
		if (zip_entry_name($zip_entry) != "word/document.xml") continue;

		$kv_texts .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
			
		zip_entry_close($zip_entry);
	}
	
	zip_close($zip);
		

	$kv_texts = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $kv_texts);
	$kv_texts = str_replace('</w:r></w:p>', "\r\n", $kv_texts);
	@$kv_strip_texts = nl2br(strip_tags($kv_texts,’‘));

	return $kv_strip_texts;
}



function decodeAsciiHex($input) {
    $output = "";

    $isOdd = true;
    $isComment = false;

    for($i = 0, $codeHigh = -1; $i < strlen($input) && $input[$i] != '>'; $i++) {
        $c = $input[$i];

        if($isComment) {
            if ($c == '\r' || $c == '\n')
                $isComment = false;
            continue;
        }

        switch($c) {
            case '\0': case '\t': case '\r': case '\f': case '\n': case ' ': break;
            case '%': 
                $isComment = true;
            break;

            default:
                $code = hexdec($c);
                if($code === 0 && $c != '0')
                    return "";

                if($isOdd)
                    $codeHigh = $code;
                else
                    $output .= chr($codeHigh * 16 + $code);

                $isOdd = !$isOdd;
            break;
        }
    }

    if($input[$i] != '>')
        return "";

    if($isOdd)
        $output .= chr($codeHigh * 16);

    return $output;
}
function decodeAscii85($input) {
    $output = "";

    $isComment = false;
    $ords = array();
    
    for($i = 0, $state = 0; $i < strlen($input) && $input[$i] != '~'; $i++) {
        $c = $input[$i];

        if($isComment) {
            if ($c == '\r' || $c == '\n')
                $isComment = false;
            continue;
        }

        if ($c == '\0' || $c == '\t' || $c == '\r' || $c == '\f' || $c == '\n' || $c == ' ')
            continue;
        if ($c == '%') {
            $isComment = true;
            continue;
        }
        if ($c == 'z' && $state === 0) {
            $output .= str_repeat(chr(0), 4);
            continue;
        }
        if ($c < '!' || $c > 'u')
            return "";

        $code = ord($input[$i]) & 0xff;
        $ords[$state++] = $code - ord('!');

        if ($state == 5) {
            $state = 0;
            for ($sum = 0, $j = 0; $j < 5; $j++)
                $sum = $sum * 85 + $ords[$j];
            for ($j = 3; $j >= 0; $j--)
                $output .= chr($sum >> ($j * 8));
        }
    }
    if ($state === 1)
        return "";
    elseif ($state > 1) {
        for ($i = 0, $sum = 0; $i < $state; $i++)
            $sum += ($ords[$i] + ($i == $state - 1)) * pow(85, 4 - $i);
        for ($i = 0; $i < $state - 1; $i++)
            $ouput .= chr($sum >> ((3 - $i) * 8));
    }

    return $output;
}
function decodeFlate($input) {
    return @gzuncompress($input);
}

function getObjectOptions($object) {
    $options = array();
    if (preg_match("#<<(.*)>>#ismU", $object, $options)) {
        $options = explode("/", $options[1]);
        @array_shift($options);

        $o = array();
        for ($j = 0; $j < @count($options); $j++) {
            $options[$j] = preg_replace("#\s+#", " ", trim($options[$j]));
            if (strpos($options[$j], " ") !== false) {
                $parts = explode(" ", $options[$j]);
                $o[$parts[0]] = $parts[1];
            } else
                $o[$options[$j]] = true;
        }
        $options = $o;
        unset($o);
    }

    return $options;
}
function getDecodedStream($stream, $options) {
    $data = "";
    if (empty($options["Filter"]))
        $data = $stream;
    else {
        $length = !empty($options["Length"]) ? $options["Length"] : strlen($stream);
        $_stream = substr($stream, 0, $length);

        foreach ($options as $key => $value) {
            if ($key == "ASCIIHexDecode")
                $_stream = decodeAsciiHex($_stream);
            if ($key == "ASCII85Decode")
                $_stream = decodeAscii85($_stream);
            if ($key == "FlateDecode")
                $_stream = decodeFlate($_stream);
        }
        $data = $_stream;
    }
    return $data;
}
function getDirtyTexts(&$texts, $textContainers) {
    for ($j = 0; $j < count($textContainers); $j++) {
        if (preg_match_all("#\[(.*)\]\s*TJ#ismU", $textContainers[$j], $parts))
            $texts = array_merge($texts, @$parts[1]);
        elseif(preg_match_all("#Td\s*(\(.*\))\s*Tj#ismU", $textContainers[$j], $parts))
            $texts = array_merge($texts, @$parts[1]);
    }
}
function getCharTransformations(&$transformations, $stream) {
    preg_match_all("#([0-9]+)\s+beginbfchar(.*)endbfchar#ismU", $stream, $chars, PREG_SET_ORDER);
    preg_match_all("#([0-9]+)\s+beginbfrange(.*)endbfrange#ismU", $stream, $ranges, PREG_SET_ORDER);

    for ($j = 0; $j < count($chars); $j++) {
        $count = $chars[$j][1];
        $current = explode("\n", trim($chars[$j][2]));
        for ($k = 0; $k < $count && $k < count($current); $k++) {
            if (preg_match("#<([0-9a-f]{2,4})>\s+<([0-9a-f]{4,512})>#is", trim($current[$k]), $map))
                $transformations[str_pad($map[1], 4, "0")] = $map[2];
        }
    }
    for ($j = 0; $j < count($ranges); $j++) {
        $count = $ranges[$j][1];
        $current = explode("\n", trim($ranges[$j][2]));
        for ($k = 0; $k < $count && $k < count($current); $k++) {
            if (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+<([0-9a-f]{4})>#is", trim($current[$k]), $map)) {
                $from = hexdec($map[1]);
                $to = hexdec($map[2]);
                $_from = hexdec($map[3]);

                for ($m = $from, $n = 0; $m <= $to; $m++, $n++)
                    $transformations[sprintf("%04X", $m)] = sprintf("%04X", $_from + $n);
            } elseif (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+\[(.*)\]#ismU", trim($current[$k]), $map)) {
                $from = hexdec($map[1]);
                $to = hexdec($map[2]);
                $parts = preg_split("#\s+#", trim($map[3]));
                
                for ($m = $from, $n = 0; $m <= $to && $n < count($parts); $m++, $n++)
                    $transformations[sprintf("%04X", $m)] = sprintf("%04X", hexdec($parts[$n]));
            }
        }
    }
}
function getTextUsingTransformations($texts, $transformations) {
    $document = "";
    for ($i = 0; $i < count($texts); $i++) {
        $isHex = false;
        $isPlain = false;

        $hex = "";
        $plain = "";
        for ($j = 0; $j < strlen($texts[$i]); $j++) {
            $c = $texts[$i][$j];
            switch($c) {
                case "<":
                    $hex = "";
                    $isHex = true;
                break;
                case ">":
                    $hexs = str_split($hex, 4);
                    for ($k = 0; $k < count($hexs); $k++) {
                        $chex = str_pad($hexs[$k], 4, "0");
                        if (isset($transformations[$chex]))
                            $chex = $transformations[$chex];
                        $document .= html_entity_decode("&#x".$chex.";");
                    }
                    $isHex = false;
                break;
                case "(":
                    $plain = "";
                    $isPlain = true;
                break;
                case ")":
                    $document .= $plain;
                    $isPlain = false;
                break;
                case "\\":
                    $c2 = $texts[$i][$j + 1];
                    if (in_array($c2, array("\\", "(", ")"))) $plain .= $c2;
                    elseif ($c2 == "n") $plain .= '\n';
                    elseif ($c2 == "r") $plain .= '\r';
                    elseif ($c2 == "t") $plain .= '\t';
                    elseif ($c2 == "b") $plain .= '\b';
                    elseif ($c2 == "f") $plain .= '\f';
                    elseif ($c2 >= '0' && $c2 <= '9') {
                        $oct = preg_replace("#[^0-9]#", "", substr($texts[$i], $j + 1, 3));
                        $j += strlen($oct) - 1;
                        $plain .= html_entity_decode("&#".octdec($oct).";");
                    }
                    $j++;
                break;

                default:
                    if ($isHex)
                        $hex .= $c;
                    if ($isPlain)
                        $plain .= $c;
                break;
            }
        }
        $document .= "\n";
    }

    return $document;
}

function pdf2text($filename) {
    $infile = @file_get_contents($filename, FILE_BINARY);
    if (empty($infile))
        return "";

    $transformations = array();
    $texts = array();

    preg_match_all("#obj(.*)endobj#ismU", $infile, $objects);
    $objects = @$objects[1];

    for ($i = 0; $i < count($objects); $i++) {
        $currentObject = $objects[$i];

        if (preg_match("#stream(.*)endstream#ismU", $currentObject, $stream)) {
            $stream = ltrim($stream[1]);

            $options = getObjectOptions($currentObject);
            if (!(empty($options["Length1"]) && empty($options["Type"]) && empty($options["Subtype"])))
                continue;

            $data = getDecodedStream($stream, $options); 
            if (strlen($data)) {
                if (preg_match_all("#BT(.*)ET#ismU", $data, $textContainers)) {
                    $textContainers = @$textContainers[1];
                    getDirtyTexts($texts, $textContainers);
                } else
                    getCharTransformations($transformations, $data);
            }
        }
    }

    return getTextUsingTransformations($texts, $transformations);
}


function save_courrier($profil, $section, $sens, $type, $reference, $objet, $date, $nom_fichier, $type_mime, $login, $annee_section, $chemin="", $reponse_attendue, $est_associe, $courrier_associe, $active_wf, $file_name) {
    global $connect;

    $dir = getParam('repertoire');	
	
	$tab = explode(".", $nom_fichier);
	$nbre = count($tab);
	$ext = $tab[$nbre-1];

	if (in_array($ext, array('doc', 'docx'))) {
		$content = kv_read_word($dir.$nom_fichier);
		$content = str_replace("'", "''", trim($content));
		$content = preg_replace("/[^A-Za-z0-9\. 'àáâèéêëìíîïòóôõöùúûü -]/", '', $content); 
	}
	else {
		$content = utf8_encode(pdf2text($dir.$nom_fichier));
        $content = str_replace("'", "''", trim($content));
        $content = preg_replace("/[^A-Za-z0-9\. 'àáâèéêëìíîïòóôõöùúûü -]/", '', $content);
    }
	
    /*$sql_save = "INSERT INTO `t_courriers` " .
            "(`section`, `sens`, `type_c`, `reference`, `objet`, `date_enr`, `nom_fichier`, `rep_physique`, `type_mime`, `user`, `annee_section`) " .
            " VALUES ('" . $section . "', '" . $sens . "', '" . $type . "', '" . $reference . "', '" . $objet . "', '" . $date . "', '" . $nom_fichier . "', '" . getParam("repertoire") . "', '" . $type_mime . "', '" . $login . "', '" . $annee_section . "' ) ; ";
	*/
	$sql_save = "INSERT INTO `t_courriers` " .
            "(`section`, `sens`, `type_c`, `reference`, `objet` , `content`, `date_enr`, `nom_fichier`, `rep_physique`, `type_mime`, `user`, `annee_section`, `reponse_attendue`, `est_associe`, `courrier_associe`, `nom_origine`) " .
            " VALUES ('" . $section . "', '" . $sens . "', '" . $type . "', '" . $reference . "', '" . $objet . "', '" . $content . "', '" . $date . "', '" . $nom_fichier . "', '" . getParam("repertoire") . "', '" . $type_mime . "', '" . $login . "', '" . $annee_section . "', '" . $reponse_attendue . "', '" . $est_associe . "', '" . $courrier_associe . "', '" . $file_name . "' ) ; ";

				
    if (!mysqli_query($connect, $sql_save)) {
        echo "<br>" . "requ&ecirc;te: " . $sql_save . "<br>";
        die("Erreur: archivage  " . mysqli_error($connect) . " <br/>" . $sql_save);
    }
    // sauvegarde de l'ID du nouveau courrier archive ainsi
    $idCourrier = mysqli_insert_id($connect);
    
    /*
     * Creation du workflow pour le traitement du nouveau courrier
     */
     
    if ($sens == 'CD' && $est_associe == 1) {
        $val = mysqli_insert_id($connect);
        $sql_update = "update `t_courriers` set `est_associe` = 1, `courrier_associe` = '{$val}' where id = '{$courrier_associe}'";
        mysqli_query($connect, $sql_update) or die($sql_update);
    }

    // Verification du sens du courrier [limitation aux courriers entrants]
    if ($sens !== 'CA') {
        return false;
    }
    
    
    if ($active_wf == 1) {
    
        // On verifie que le parametre workflow Master (Profil Maitre) est defini et qu'il existe bien
        $master = getParam('workflow_master');
        if (!$master){
            echo '<script type="text/javascript">' . '$(function(){$("<div>").dialog({modal: true, title:"Error"}).html("Impossible de cr&eacute;er le workflow; Param&egrave;tre syst&egrave;me incorrect: Workflow Master");});' . '</script>';
    		return false;
        }
        // On verifie que la section du courrier est assignee a un Correspondant Budgetaire
        $tcor = getCorrespArchiveRigths($profil, $annee_section);
        if (count($tcor) == 0){
            $val = count($tcor);
            echo '<script type="text/javascript">' . '$(function(){$("<div>").dialog({modal: true, title:"Erreur"}).html("Impossible de cr&eacute;er le workflow; La section n\'est pas assign&eacute;e '.$val.' '.$section.' '.$annee_section.' ");});' . '</script>';
            return false;
        }
        //Recherche de l'annotation
        $user = getUserByProfil($master);
        $titre = @$user[1]['notif_user'];
      
        
        // Definition des autres parametres du workflow
        $owner = $master;
        $createDate = date('Y-m-d');
        $dueDate = 'NULL';
        $priority = 1;
        $state = 1;
        $wfType = 1;
        //$annotation = @iconv('UTF-8', 'ISO-8859-15', $titre);
        $annotation = mysqli_real_escape_string($connect, $titre);
        $currentTask = 'NULL';
    
        // requete de creation du workflow
        
            //$sql = "INSERT INTO t_wf_workflow (owner, create_date, due_date, priority, state, type_wf, annotation, current_task) VALUES(NULL, '2012-03-29', NULL, 1, 1, 1, NULL, NULL)";
            $sql = "INSERT INTO t_wf_workflow (owner, create_date, annotation) VALUES ('$owner', '$createDate', '$annotation')";
            $res = mysqli_query($connect, $sql) or die(mysqli_error($connect) . '<br />' . $sql);
            $workflowId = mysqli_insert_id($connect);
            
        	//echo "<br />workflow created id is: $workflowId";
            
            // Le courrier nouvellement archive est attache au nouveau workflow ainsi cree
            $sqlWfDoc = "INSERT INTO t_wf_document (workflow, document) VALUES ('$workflowId', '$idCourrier')";
            $resWfDoc = mysqli_query($connect, $sqlWfDoc) or die(mysqli_error($connect) . '<br />' . $sqlWfDoc);
            
        	//echo "<br />doc of id:  $idCourrier attached to the workflow of id:  $workflowId ";
            
                // creation de la tache initiale
                //$sqlTask = "INSERT INTO `t_wf_task` (`id`, `description`, `assignee`, `due_date`, `priority`, `state`, `workflow`) VALUES (1, NULL, 5, NULL, 1, 1, 2)";
            	
            	// Recherche des utilisateurs ayant le profil Master
            	//$sql = "SELECT * FROM t_users WHERE profil = '$master' AND etat = '1' ";
                
                $sql = "SELECT login FROM t_users WHERE profil = '$master'
                        UNION
                        SELECT login FROM t_users_profils WHERE profil = '$master'";
                
                $rs = mysqli_query($connect, $sql) or die(mysqli_error($connect) . '<br />' . $sql);
            	if (!mysqli_num_rows($rs)){
                    echo '<script type="text/javascript">' . '$(function(){$("<div>").dialog({modal: true, title:"Erreur"}).html("Impossible de cr&eacute;er le workflow; <br/> Aucun utilisateur Ma&icirc;tre d&eacute;fini ");});' . '</script>';
            		return false;
            	}
        	
            
            //fichier attaché et courrier
            $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', substr($nom_fichier, 5, 4)));
            $courrier = getCourrier($idCourrier);
            //echo $chemin;
            if ($chemin != "") {
                copy($chemin, $uploadfile);
            }
            
            $startDate = date('Y-m-d H:i:s');
            $tab_email = array();
            $tab_tel = array();
                                
        	while ($row = mysqli_fetch_assoc($rs)){
        		$login = mysqli_real_escape_string($connect, $row['login']);
                //echo $login."<br />";
                
                //$profil_n = getColUsers($row['login'],'profil');
                $profil_n = $master;
                
                $res_n = isProfilANotifierBySectionAndType($profil_n, $section, $annee_section, $type);
                
                //echo $res_n[1]."<br />";
                
                if ($res_n[0]) {
            		$id_task = getTaskNextId();
            		$sqlTask = "INSERT INTO t_wf_task (id, description, assignee, start_date, workflow, annotation, annot_go) 
                                VALUES ('$id_task', '$master', '$login', '$startDate', '$workflowId', '".getColUsers($row['login'],'notif_user')."', '$annotation')";
            		$resTask = mysqli_query($connect, $sqlTask) or die(mysqli_error($connect) . '<br />' . $sqlTask);		
            	   
                    //--------------------------------------------------------------------------//
                        //inserer un nouveau circuit pour le master
                        $nom = getColUsers($row['login'],'nom');
                        $create_at = date('Y-m-d H:i:s');
                        $fils = $login."-".$master;
                        
                        $query= "INSERT INTO t_circuit(agent, nom, task, parent, workflow, create_at) 
                                 VALUES ('$fils', '$nom', '$id_task', 'root', '$workflowId', '$create_at')";
                        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                     //-------------------------------------------------------------------------//
                }
                
                
                                
                                
                                
                                
                //------------------------ Email and SMS ------------------------------//
                $email = getColUsers($row['login'],'email');
                if (!is_null($email)) {
                    $tab_email[] = $email;
                    
                }
                
                //SMS
                $telephone = getColUsers($row['login'],'telephone');
                if (!is_null($telephone)) {
                    $tab_tel[] = $telephone;
                }
    
                //------------------------ Email and SMS ------------------------------//
                
            }
            
            $_SESSION['email_archive'] = $tab_email;
            $_SESSION['tel_archive'] = $tab_tel;
            $_SESSION['infos_archive'] = array($section, $sens, $type, $reference, $objet, $date, $nom_fichier, $annee_section, $chemin, $reponse_attendue, $est_associe, $uploadfile);
    
    }
}

function haveUsersToNotify($user_profil, $id, $sc, $an, $type) {
	$_PROFIL = getProfilANotifierBySectionAndType($user_profil, $sc, $an, $type);
	$nb1 = 0;
	foreach($_PROFIL as $ky => $valeur) {
		$_USR = getUserByProfil($valeur['profil']);					
		foreach($_USR as $k => $val) {
			if (!aDejaCeWorkflow($val['login'], $id) && $val['etat']==1) {
				$nb1++;
			}
		}
	}
}


function get_delais($date_due, $date_start) {
        
        $d1 = new DateTime($date_due); 
        $d2 = new DateTime($date_start); 
        
        $diff = $d1->diff($d2); 
        $diffa = $d1->diff($d2); 
        $diffm = $d1->diff($d2); 
        $diffh = $d1->diff($d2); 
        $diffi= $d1->diff($d2); 
        $diffs = $d1->diff($d2); 
        
        $nb_jours = $diff->d; 
        $nb_mois = $diffm->m; 
        $nb_an = $diffa->y; 
        $nb_heure = $diffh->h; 
        $nb_min = $diffi->i; 
        $nb_sec = $diffs->s;
        
        
        if ($nb_an >= 1) {
            $return = $diffa->y." ans ";
        }
        else if ($nb_mois >= 1) {
            $return = $diffm->m." mois ";
        }
        else if ($nb_jours >= 1) {
            $return = $diff->d." jrs ";
        }
        else if ($nb_heure > 1) {
            $return = $diffh->h." h ";
        }
        else if ($nb_min >= 1){
            $return = $diffi->i." min ";
        }
        else {
            $return = $diffs->s." sec ";
        }
        
        return $return;
}



//Renvoie la liste des circuit d'un workflow
function getCircuit($workflow){
	global $connect;
	
	$t = array();	
	$sql = "SELECT * FROM t_circuit WHERE workflow = '$workflow' ORDER BY id ASC";	
	$rs = mysqli_query($connect, $sql) or die($sql);
	while ($row = mysqli_fetch_assoc($rs)) {
        
        if ($row['parent'] == 'root') {
            $agent = explode("-", $row['agent']);
            $task = $row['task'];
            
            if (isset($agent[1]))  {
                $sql = "SELECT * FROM t_wf_task WHERE id = '$task' AND description = '$agent[1]' AND assignee = '$agent[0]' AND due_date IS NOT NULL";	
    	        $r = mysqli_query($connect, $sql);
                if (mysqli_num_rows($r) > 0) {
                    $t[] = $row;
                }
            }
            
        }
        else {
            $t[] = $row;
        }
        
        
    }
    return $t;	    
}



function get_nombre_star($id_task){
    global $connect;
	
	//$sql = "SELECT * FROM t_wf_task WHERE id = '$id_task' AND due_date IS NOT NULL AND is_delete = 0";	
    $sql = "SELECT * FROM t_wf_task WHERE id = '$id_task' AND is_delete = 0";	
	$rs = mysqli_query($connect, $sql);
    $return = -1;
     
    if (mysqli_num_rows($rs) > 0) {
        
        $row = mysqli_fetch_assoc($rs);
        
        $lecture = ($row['end_date'] ? "Lu" : "Non lu");
        $traitement = ($row['due_date'] ? "Trait&eacute" : "Non trait&eacute");
        
        if ($row['due_date']) {
            
            $d1 = new DateTime($row['due_date']); 
            $d2 = new DateTime($row['start_date']); 
            
            $diff = $d1->diff($d2); 
            $diffh = $d1->diff($d2); 
            
            $nb_jours = $diff->d; 
            $nb_heure = $diffh->h;
            
            if ($nb_heure < 4) {
                $return = 0;
            }
            else if ($nb_heure < 8) {
                $return = 0.5;
            }
            else if ($nb_heure > 8) {
                $return = 1;
            }
            else {
                $return = $nb_jours;
            }
        }
    }
    return array($return, $lecture." et ".$traitement);
}
    
    
function afficher_menu($parent, $niveau, $array) {
    
    $html = "";
    $niveau_precedent = 0;
     
    if (!$niveau && !$niveau_precedent) $html .= "\n<ul style=\"display: none\" id=\"organisation\">\n";
     
    foreach ($array AS $noeud) {
     
    	if ($parent == $noeud['parent']) {
     
        	if ($niveau_precedent < $niveau) $html .= "\n<ul>\n";
                
                $detail = get_nombre_star($noeud['task']);
                $html .= "<li>" . $noeud['nom']."<br />";
                
                if ($detail[0] == -1) {
                    $html .= "";
                }
                else if ($detail[0] == 0) {
                    $html .= "<img class='star' src='orgchart/star-zero.png'>";
                }
                else if($detail[0] == 0.5) {
                    $html .= "<img class='star' src='orgchart/star-half.png'>";
                }
                else {
                    if ($detail[0] > 5) {
                        for($i=0; $i<5; $i++) {
                            $html .= "<img class='star' src='orgchart/star-one.png'>";
                        }
                    }
                    else {
                        for($i=0; $i<$detail[0]; $i++) {
                            $html .= "<img class='star' src='orgchart/star-one.png'>";
                        }
                    }
                }
                
                $html .= "<br /><span style='font-size: 8.5px'>{$detail[1]}</span>";
                
            	$niveau_precedent = $niveau;
                $html .= afficher_menu($noeud['agent'], ($niveau + 1), $array);
             
        	}
    }
     
    if (($niveau_precedent == $niveau) && ($niveau_precedent != 0)) $html .= "</ul>\n</li>\n";
    else if ($niveau_precedent == $niveau) $html .= "</ul>\n";
    else $html .= "</li>\n";
     
    return $html;

}




?>
