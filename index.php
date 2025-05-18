<?php 


if(isset($_GET['page'])){
    switch ($_GET['page']) {
        case 'cohorte':
            require_once('controllers/cohorteController.php');
            break;
        default:
            require_once('controllers/homeController.php');
            break;
    }
}else{

    require_once('controllers/homeController.php');
}



require_once('views/partials/_footer.php');