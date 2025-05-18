<?php
require_once('models/Cohorte.php');
require_once('models/Apprenant.php');

$cohorte = new Cohorte();
$apprenant = new Apprenant();
$message = '';
$type = '';
$cohorteToEdit = null;
$apprenantToEdit = null;

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

        case 'add_apprenant':
            $data = $_POST;
            
            // Gestion de l'upload de l'image
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/apprenants/';
                $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $newFileName = uniqid() . '.' . $fileExtension;
                $uploadFile = $uploadDir . $newFileName;

                // Vérifier si c'est une image valide
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileExtension, $allowedTypes) && move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $data['image'] = $uploadFile;
                }
            }

            if ($apprenant->add($data)) {
                setmessage('Apprenant ajouté avec succès');
               return header('Location: ?page=cohorte&cohorte_id='.$_POST['cohorte_id']); // Rediriger vers la même cohort

            } else {
                setmessage('Erreur lors de l\'ajout de l\'apprenant');
            }
            break;

        case 'edit_apprenant':
            $data = $_POST;
            
            // Gestion de l'upload de l'image
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/apprenants/';
                $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $newFileName = uniqid() . '.' . $fileExtension;
                $uploadFile = $uploadDir . $newFileName;

                // Vérifier si c'est une image valide
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileExtension, $allowedTypes) && move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    // Supprimer l'ancienne image si elle existe
                    $oldApprenant = $apprenant->getById($_POST['id']);
                    if ($oldApprenant && $oldApprenant->image && file_exists($oldApprenant->image)) {
                        unlink($oldApprenant->image);
                    }
                    $data['image'] = $uploadFile;
                }
            }

            if ($apprenant->update($_POST['id'], $data)) {
                setmessage('Apprenant modifié avec succès');
                return header('Location: ?page=cohorte&cohorte_id='.$_POST['cohorte_id']); // Rediriger vers la même cohort
            } else {
                setmessage('Erreur lors de la modification de l\'apprenant');
            }
            break;

        case 'delete_apprenant':
            if ($apprenant->delete($_POST['id'])) {
               setmessage('Apprenant supprimé avec succès');
               return header('Location:?page=cohorte&cohorte_id='.$_POST['cohorte_id']); // Rediriger vers la même cohort
            } else {
               setmessage('Erreur lors de la suppression de l\'apprenant');
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

// Récupération des apprenants si une cohorte est sélectionnée
if (isset($_GET['cohorte_id'])) {
    $apprenants = $apprenant->getByCohorteId($_GET['cohorte_id']);
    $cohorte_active = $cohorte->getById($_GET['cohorte_id']);
}

// Récupération de l'apprenant à éditer si demandé
if (isset($_GET['edit_apprenant'])) {
    $apprenantToEdit = $apprenant->getById($_GET['edit_apprenant']);
}

require_once('views/partials/_header.php');
require_once('views/cohorte/cohorte.php');
?>