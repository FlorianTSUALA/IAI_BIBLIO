<?php

session_start();


require_once(dirname(__FILE__).'/../config/global.php');
require_once('../web/functions/functions.php');


    $img_data = explode('adiza', $_POST['img_data']);
    $sdos_assuree = $_POST['assure'];
    $code_regime = $_POST['code_regime'];

    $bool = true;
    $i = 0;



    $imgspath = "../img/$sdos_assuree/";
    $files = scandir($imgspath);
    $total = count($files);
    $images = array();


    //Get a list of file paths using the glob function.
    $fileList = glob("$imgspath*");


    //Trier par date croissant
    usort($fileList, function ($a, $b) {
        return filemtime($a) > filemtime($b);
    });


    //Loop through the array that glob returned.
    foreach ($fileList as $filename) {
        $image_data = $filename;
        $tab_properties = getimagesize($image_data);


        $result = '';
        $zbar_lib = '..\\lib\\zbar\\zbarimg -q ';
        exec($zbar_lib." ".$image_data, $result);

        $code_bar = 0;

        $lotd['ID_LOTDESC'] = 0;
        $lotd['NUMLOT'] = 0;
        $lotd['LIBELLE'] = 0;

        //var_dump($result);

        if (count($result) > 0) {
            $code_iso = explode(':', $result[0]);
            $code_bar = $code_iso[1];


            $num_lot = intval(substr($code_bar, -2));

            $sql = "SELECT * FROM \"lotd\" WHERE CODEREG = '$code_regime' AND NUMLOT = $num_lot";

            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $lotd = $stmt->fetch(PDO::FETCH_ASSOC);

            //var_dump($lotd);

            $_SESSION['lotd'] = $lotd;
        }


        if (count($result) == 0) {
            $w = $tab_properties[0];
            $h = $tab_properties[1];

            $filesize = filesize($image_data);
            $filedate = date('Y-m-d H:i:s');

            $mime = $tab_properties['mime'];
            $hash = "";

            $computeruser = 'CPPF_USER';
            $computername = 'CPPF_PC';

            $numeriseur = $_SESSION['user_log'];

            $data = $img_data;

            $valid = 'T';
            $tag = 0;

            $scan_mod = 2;
            $id_appform = 1;

            $type = pathinfo($image_data, PATHINFO_EXTENSION);
            $file_name = pathinfo($image_data, PATHINFO_FILENAME);

            $filename = $file_name.'.'.$type;

            $resolution_scan = 200;
            $resolution_img = 130;

            $blob = fopen($image_data, 'rb');

            //Insert into DIMG
            $sql = "INSERT INTO \"dimg\"(W, H, FILESIZE, FILEDATE, MIME, HASH, COMPUTERUSER, COMPUTERNAME,
                                         MATR_NUMERISEUR, DATA, VALID, TAG, ID_SCANMODE, ID_APPFORM,
                                         FILENAME, SCANRESOLUTION, IMAGERESOLUTION)
                        VALUES (:w, :h, :filesize, :filedate, :mime, :hash, :computeruser,
                                :computername, :numeriseur, :data, :valid, :tag, :scan_mod,
                                :id_appform, :filename, :resolution_scan, :resolution_img)";

            $stmt = $connexion->prepare($sql);

            $stmt->bindParam(':w', $w);
            $stmt->bindParam(':h', $h);
            $stmt->bindParam(':filesize', $filesize);
            $stmt->bindParam(':filedate', $filedate);
            $stmt->bindParam(':mime', $mime);
            $stmt->bindParam(':hash', $hash);
            $stmt->bindParam(':computeruser', $computeruser);
            $stmt->bindParam(':computername', $computername);
            $stmt->bindParam(':numeriseur', $numeriseur);
            $stmt->bindParam(':data', $blob, PDO::PARAM_LOB);
            $stmt->bindParam(':valid', $valid);
            $stmt->bindParam(':tag', $tag);
            $stmt->bindParam(':scan_mod', $scan_mod);
            $stmt->bindParam(':id_appform', $id_appform);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':resolution_scan', $resolution_scan);
            $stmt->bindParam(':resolution_img', $resolution_img);


            $stmt->execute();





            $id_img = $connexion->lastInsertId();
            $thnldate = date('Y-m-d H:i:s');
            $thnlsize = filesize($image_data);

            $w = $tab_properties[0]/10;
            $h = $tab_properties[1]/10;

            $mime = $tab_properties['mime'];
            $data = fopen($image_data, 'rb');
            $tag = 0;

            //Insert into DIMG
            $sql = "INSERT INTO \"thnl\"(ID_IMG, THNLDATE, THNLSIZE, W, H, MIME, DATA, TAG)
                        VALUES (:id_img, :thnldate, :thnlsize, :w, :h, :mime, :data, :tag)";

            $stmt = $connexion->prepare($sql);

            $stmt->bindParam(':id_img', $id_img);
            $stmt->bindParam(':thnldate', $thnldate);
            $stmt->bindParam(':thnlsize', $thnlsize);

            $stmt->bindParam(':w', $w);
            $stmt->bindParam(':h', $h);

            $stmt->bindParam(':mime', $mime);
            $stmt->bindParam(':data', $data, PDO::PARAM_LOB);
            $stmt->bindParam(':tag', $tag);

            $stmt->execute();




            $id_img = $id_img;
            $sdos = $sdos_assuree;

            $lotd = $_SESSION['lotd'];

            $id_lot = $lotd['ID_LOTDESC'];
            $num_lot = $lotd['NUMLOT'];
            $libelle_lot = $lotd['LIBELLE'];

            $position = "";
            $matr_classeur = $_SESSION['user_log'];
            $id_classeur = 0;

            $ndospp = substr($sdos_assuree, 0, -2); //Ce qui reste quand on enleve les deux derniers caract�res
                $ndosa = substr($sdos_assuree, -2); //les deux derniers caract�res

                //Insert into LIMG
            $sql = "INSERT INTO \"limg\" VALUES (0, '$id_img', '$sdos', '$id_lot', '$num_lot', '$libelle_lot', '$position', '$matr_classeur', '$id_classeur', '$ndospp', '$ndosa')";
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
        }
    }


    echo utf8_encode(' Courrier archiv� avec succ�s');

?>

