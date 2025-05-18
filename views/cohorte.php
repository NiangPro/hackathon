<div class="container" style="margin-top: 100px;">
    <?php if ($message): ?>
        <div class="alert alert-<?= $type ?>" role="alert">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="container col-md-8">
        <div class="card">
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
                                <tr>
                                    <td><?= htmlspecialchars($c->nom) ?></td>
                                    <td>
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

    <!-- Modal d'ajout -->
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

    <!-- Formulaire de modification -->
    <?php if (isset($_GET['edit']) && $cohorteToEdit): ?>
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Modifier la cohorte</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom de la cohorte</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($cohorteToEdit['nom']) ?>" required>
                    </div>
                    <input type="hidden" name="id" value="<?= $cohorteToEdit['id'] ?>">
                    <input type="hidden" name="action" value="edit">
                    <div class="form-group">
                        <a href="?page=cohorte" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>