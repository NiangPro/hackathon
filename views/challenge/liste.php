<div class="container"  style="margin-top: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-trophy mr-2"></i>Gestion des Challenges</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addChallengeModal">
            <i class="fas fa-plus mr-2"></i>Nouveau Challenge
        </button>
    </div>
    <?php require_once('views/partials/_getmessage.php'); ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Statut</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Participants</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        require_once('models/Challenge.php');
                        $challengeModel = new Challenge();
                        $challenges = $challengeModel->getAllChallenges();
                        
                        foreach($challenges as $challenge): 
                            $statut_class = [
                                'en_attente' => 'warning',
                                'en_cours' => 'primary',
                                'termine' => 'success'
                            ][$challenge['statut']];
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($challenge['nom']) ?></td>
                            <td><?= htmlspecialchars(substr($challenge['description'], 0, 50)) ?>...</td>
                            <td>
                                <span class="badge badge-<?= $statut_class ?>">
                                    <?= ucfirst(str_replace('_', ' ', $challenge['statut'])) ?>
                                </span>
                            </td>
                            <td><?= date('d/m/Y', strtotime($challenge['date_debut'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($challenge['date_fin'])) ?></td>
                            <td>
                                <?php 
                                $participants = $challengeModel->getParticipants($challenge['id']);
                                echo count($participants);
                                ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            onclick="editChallenge(<?= $challenge['id'] ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="deleteChallenge(<?= $challenge['id'] ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout Challenge -->
<div class="modal fade" id="addChallengeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau Challenge</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="addChallengeForm" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nom du challenge</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Date de début</label>
                            <input type="date" class="form-control" name="date_debut" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date de fin</label>
                            <input type="date" class="form-control" name="date_fin" required>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="action" value="create">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>