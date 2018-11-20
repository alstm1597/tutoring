<?php
if (isset($_FILES['upload']) && $_FILES['upload']['error'] == 0) {
        $tname = $_FILES["upload"]["tmp_name"];
        $fname = $_FILES["upload"]["name"];
        $fsize = $_FILES["upload"]["size"];

        $save_name = iconv("utf-8", "cp949", $fname);

    if (move_uploaded_file($fname,"upload/$save_name")) {
        echo "upload 성공!!";
        var_dump($_FILES);
    }else{
        echo "upload fail##1";
        var_dump($_FILES);
    }
}else{
    echo "upload fail##2";
    var_dump($_FILES);
}
?>