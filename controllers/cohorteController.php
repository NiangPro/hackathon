<?php
require_once('models/Cohorte.php');

$cohorte = new Cohorte();
$message = '';
$type = '';
$cohorteToEdit = null;

// Traitement des actions
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            if ($cohorte->add($_POST['nom'])) {
                $message = 'Cohorte ajoutée avec succès';
                $type = 'success';
            } else {
                $message = 'Erreur lors de l\'ajout de la cohorte';
                $type = 'danger';
            }
            break;

        case 'edit':
            if ($cohorte->update($_POST['id'], $_POST['nom'])) {
                $message = 'Cohorte modifiée avec succès';
                $type = 'success';
            } else {
                $message = 'Erreur lors de la modification de la cohorte';
                $type = 'danger';
            }
            break;

        case 'delete':
            if ($cohorte->delete($_POST['id'])) {
                $message = 'Cohorte supprimée avec succès';
                $type = 'success';
            } else {
                $message = 'Erreur lors de la suppression de la cohorte';
                $type = 'danger';
            }
            break;
    }
}

// Récupération de la cohorte à éditer si demandé
if (isset($_GET['edit'])) {
    $cohorteToEdit = $cohorte->getById($_GET['edit']);
}

// Récupération de toutes les cohortes
$cohortes = $cohorte->getAll();

require_once('views/partials/_header.php');
require_once('views/cohorte.php');
?>