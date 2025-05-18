<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Apprenants de la <?= htmlspecialchars($cohorte_active->nom ?? '') ?></h4>
        <?php if (!isset($_GET['edit_apprenant'])): ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addApprenantModal">
                <i class="fas fa-plus mr-1"></i>Nouvel Apprenant
            </button>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Photo</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                // Filtrer les apprenants par cohorte
                $apprenants_cohorte = array_filter($apprenants, function($a) {
                    return $a->cohorte_id == $_GET['cohorte_id'];
                });
                foreach ($apprenants_cohorte as $a): ?>
                        <tr>
                            <td>
                                <img src="<?= $a->image ? htmlspecialchars($a->image) : 'assets/img/default-profile.png' ?>" 
                                        alt="Photo de profil" 
                                        class="rounded-circle"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td><?= htmlspecialchars($a->nom) ?></td>
                            <td><?= htmlspecialchars($a->prenom) ?></td>
                            <td><?= htmlspecialchars($a->tel) ?></td>
                            <td><?= htmlspecialchars($a->email) ?></td>
                            <td>
                                <a href="?page=cohorte&cohorte_id=<?= $_GET['cohorte_id'] ?>&edit_apprenant=<?= $a->id ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteApprenantModal<?= $a->id ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal de suppression pour chaque apprenant -->
                        <div class="modal fade" id="deleteApprenantModal<?= $a->id ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmer la suppression</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer l'apprenant "<?= htmlspecialchars($a->prenom . ' ' . $a->nom) ?>" ?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $a->id ?>">
                                            <input type="hidden" name="action" value="delete_apprenant">
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

 <!-- Modal d'ajout d'apprenant -->
 <div class="modal fade" id="addApprenantModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un nouvel apprenant</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label for="apprenant_nom">Nom</label>
                        <input type="text" class="form-control" id="apprenant_nom" name="nom" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apprenant_prenom">Prénom</label>
                        <input type="text" class="form-control" id="apprenant_prenom" name="prenom" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apprenant_tel">Téléphone</label>
                        <input type="tel" class="form-control" id="apprenant_tel" name="tel" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apprenant_email">Email</label>
                        <input type="email" class="form-control" id="apprenant_email" name="email" required>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="apprenant_adresse">Adresse</label>
                        <textarea class="form-control" id="apprenant_adresse" name="adresse" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="cohorte_id" value="<?= $_GET['cohorte_id'] ?>">
                    <input type="hidden" name="redirect" value="?page=cohorte&cohorte_id=<?= $_GET['cohorte_id'] ?>">
                    <div class="form-group">
                        <label for="apprenant_image">Photo de profil</label>
                        <input type="file" class="form-control-file" id="apprenant_image" name="image" accept="image/*">
                    </div>
                    <input type="hidden" name="action" value="add_apprenant">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>