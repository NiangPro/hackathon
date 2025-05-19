<?php
require_once('models/Challenge.php');

$challengeModel = new Challenge();

// Traitement des actions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                // Validation des données
               if (empty($_POST['nom']) || empty($_POST['description']) || 
                    empty($_POST['date_debut']) || empty($_POST['date_fin'])) {
                    setmessage("Tous les champs sont obligatoires.", "danger");
                    return header('Location:?page=challenge');
                }

                // Validation des dates
                $date_debut = strtotime($_POST['date_debut']);
                $date_fin = strtotime($_POST['date_fin']);
                if ($date_fin < $date_debut) {
                    setmessage("La date de fin doit être postérieure à la date de début.", "danger");
                    return header('Location:?page=challenge');
                }

                // Validation du format des dates
                if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['date_debut']) || 
                    !preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['date_fin'])) {
                    setmessage("Le format des dates doit être YYYY-MM-DD.", "danger");
                   return header('Location:?page=challenge');
                }

                try {
                    if ($challengeModel->createChallenge(
                        htmlspecialchars(trim($_POST['nom'])),
                        htmlspecialchars(trim($_POST['description'])),
                        $_POST['date_debut'],
                        $_POST['date_fin']
                    )) {
                        setmessage("Le challenge a été créé avec succès.", "success");
                        header('Location: ?page=challenge');
                        exit;
                    } else {
                        setmessage("Une erreur est survenue lors de la création du challenge.", "danger");
                        return header('Location:?page=challenge');
                    }
                } catch (Exception $e) {
                    setmessage("Erreur : " . $e->getMessage(), "danger");
                    return header('Location:?page=challenge');
                }
                break;

            case 'update':
                if (!isset($_POST['id']) || empty($_POST['id'])) {
                    setmessage("ID du challenge manquant.", "danger");
                    break;
                }

                if (empty($_POST['nom']) || empty($_POST['description']) || 
                    empty($_POST['date_debut']) || empty($_POST['date_fin'])) {
                    setmessage("Tous les champs sont obligatoires.", "danger");
                    break;
                }

                try {
                    if ($challengeModel->updateChallenge(
                        $_POST['id'],
                        htmlspecialchars(trim($_POST['nom'])),
                        htmlspecialchars(trim($_POST['description'])),
                        $_POST['statut'],
                        $_POST['date_debut'],
                        $_POST['date_fin']
                    )) {
                        setmessage("Le challenge a été mis à jour avec succès.", "success");
                    } else {
                        setmessage("Erreur lors de la mise à jour du challenge.", "danger");
                    }
                } catch (Exception $e) {
                    setmessage("Erreur : " . $e->getMessage(), "danger");
                }
                break;

            case 'delete':
                if (!isset($_POST['id']) || empty($_POST['id'])) {
                    setmessage("ID du challenge manquant.", "danger");
                    break;
                }

                try {
                    if ($challengeModel->deleteChallenge($_POST['id'])) {
                        setmessage("Le challenge a été supprimé avec succès.", "success");
                    } else {
                        setmessage("Erreur lors de la suppression du challenge.", "danger");
                    }
                } catch (Exception $e) {
                    setmessage("Erreur : " . $e->getMessage(), "danger");
                }
                break;

            case 'inscrire':
                if (!isset($_POST['challenge_id']) || !isset($_POST['apprenant_id'])) {
                    setmessage("Informations d'inscription incomplètes.", "danger");
                    break;
                }

                try {
                    if ($challengeModel->inscrireParticipant(
                        $_POST['challenge_id'],
                        $_POST['apprenant_id']
                    )) {
                        setmessage("Inscription au challenge réussie.", "success");
                    } else {
                        setmessage("Erreur lors de l'inscription au challenge.", "danger");
                    }
                } catch (Exception $e) {
                    setmessage("Erreur : " . $e->getMessage(), "danger");
                }
                break;
        }
        
        // Redirection pour éviter la resoumission du formulaire
        header('Location: ?page=challenge');
        exit;
    }
}

// Affichage de la vue
require_once('views/partials/_header.php');
require_once('views/challenge/liste.php');