<div class="container" style="margin-top: 100px;">
    <?php require_once('views/partials/_getmessage.php'); ?>
    <!-- Fil d'Ariane -->

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=cohorte">Cohortes</a></li>
            <?php if (isset($_GET['cohorte_id'])): ?>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($cohorte_active->nom ?? '') ?></li>
            <?php endif; ?>
        </ol>
    </nav>
      <!-- Formulaire de modification de cohorte -->
      <?php if (isset($_GET['edit']) && $cohorteToEdit): ?>
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Modifier la cohorte</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom de la cohorte</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($cohorteToEdit->nom) ?>" required>
                    </div>
                    <input type="hidden" name="id" value="<?= $cohorteToEdit->id ?>">
                    <input type="hidden" name="action" value="edit">
                    <div class="form-group">
                        <a href="?page=cohorte" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>

    <!-- Formulaire de modification d'apprenant -->
    <?php elseif (isset($_GET['edit_apprenant']) && $apprenantToEdit): ?>
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Modifier l'apprenant</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center mb-3">
                                <img src="<?= $apprenantToEdit->image ? htmlspecialchars($apprenantToEdit->image) : 'assets/img/default-profile.png' ?>" 
                                     alt="Photo de profil actuelle" 
                                     class="rounded-circle img-thumbnail"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">

                            <div class="form-group col-md-6">
                                <label for="edit_apprenant_nom">Nom</label>
                                <input type="text" class="form-control" id="edit_apprenant_nom" name="nom" value="<?= htmlspecialchars($apprenantToEdit->nom) ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_apprenant_prenom">Prénom</label>
                                <input type="text" class="form-control" id="edit_apprenant_prenom" name="prenom" value="<?= htmlspecialchars($apprenantToEdit->prenom) ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_apprenant_tel">Téléphone</label>
                                <input type="tel" class="form-control" id="edit_apprenant_tel" name="tel" value="<?= htmlspecialchars($apprenantToEdit->tel) ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_apprenant_email">Email</label>
                                <input type="email" class="form-control" id="edit_apprenant_email" name="email" value="<?= htmlspecialchars($apprenantToEdit->email) ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_apprenant_adresse">Adresse</label>
                                <textarea class="form-control" id="edit_apprenant_adresse" name="adresse" rows="3" required><?= htmlspecialchars($apprenantToEdit->adresse) ?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_apprenant_cohorte">Cohorte</label>
                                <select class="form-control" id="edit_apprenant_cohorte" name="cohorte_id" required>
                                    <?php foreach ($cohortes as $c): ?>
                                        <option value="<?= $c->id ?>" <?= $c->id == $apprenantToEdit->cohorte_id ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($c->nom) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_apprenant_image">Nouvelle photo de profil</label>
                                <input type="file" class="form-control-file" id="edit_apprenant_image" name="image" accept="image/*">
                                <small class="form-text text-muted">Laissez vide pour conserver l'image actuelle</small>
                            </div>
                        </div>

                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $apprenantToEdit->id ?>">
                    <input type="hidden" name="action" value="edit_apprenant">
                    <div class="form-group mt-3">
                        <a href="?page=cohorte&cohorte_id=<?= $_GET['cohorte_id'] ?>" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    <?php elseif (isset($_GET['cohorte_id'])): ?>
        <!-- Gestion des Apprenants de la cohorte -->
        <?php require_once('views/cohorte/apprenant.php'); ?>

    <?php else: ?>
    <div class="container col-md-8">
        <!-- Gestion des Cohortes -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Gestion des Cohortes</h4>
                <?php if (!isset($_GET['edit'])): ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCohorteModal">
                        <i class="fas fa-plus mr-1"></i>Nouvelle Cohorte
                    </button>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cohortes as $c): ?>
                                <tr class="<?= isset($_GET['cohorte_id']) && $_GET['cohorte_id'] == $c->id ? 'table-active' : '' ?>">
                                    <td>
                                        <a href="?page=cohorte&cohorte_id=<?= $c->id ?>" class="text-decoration-none">
                                            <?= htmlspecialchars($c->nom) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a title="Apprenants" href="?page=cohorte&cohorte_id=<?= $c->id ?>" class="btn btn-sm btn-success">
                                            <i class="fas fa-users"></i>
                                        </a>
                                        <a href="?page=cohorte&edit=<?= $c->id ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?= $c->id ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal de suppression pour chaque cohorte -->
                                <div class="modal fade" id="deleteModal<?= $c->id ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmer la suppression</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer la cohorte "<?= htmlspecialchars($c->nom) ?>" ?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id" value="<?= $c->id ?>">
                                                    <input type="hidden" name="action" value="delete">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'ajout de cohorte -->
    <div class="modal fade" id="addCohorteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une nouvelle cohorte</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nom">Nom de la cohorte</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <input type="hidden" name="action" value="add">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>