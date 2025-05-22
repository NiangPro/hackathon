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
                            $statut_classes = [
                                'en_attente' => 'warning',
                                'en_cours' => 'primary',
                                'termine' => 'success'
                            ];
                            $statut_class = isset($statut_classes[$challenge['statut']]) ? $statut_classes[$challenge['statut']] : 'secondary';
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

<script>
function editChallenge(id) {
    // Récupérer les données du challenge
    const row = document.querySelector(`button[onclick="editChallenge(${id})"]`).closest('tr');
    const cells = row.getElementsByTagName('td');
    
    // Remplir le formulaire d'édition
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nom').value = cells[0].textContent;
    document.getElementById('edit_description').value = cells[1].textContent.replace('...', '');
    
    // Convertir les dates du format dd/mm/yyyy au format yyyy-mm-dd
    const dateDebut = cells[3].textContent.split('/').reverse().join('-');
    const dateFin = cells[4].textContent.split('/').reverse().join('-');
    document.getElementById('edit_date_debut').value = dateDebut;
    document.getElementById('edit_date_fin').value = dateFin;
    
    // Afficher le modal
    $('#editChallengeModal').modal('show');
}

function deleteChallenge(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce challenge ?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.innerHTML = `
            <input type="hidden" name="id" value="${id}">
            <input type="hidden" name="action" value="delete">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Validation des dates pour le formulaire d'édition
document.getElementById('editChallengeForm').addEventListener('submit', function(e) {
    const dateDebut = new Date(document.getElementById('edit_date_debut').value);
    const dateFin = new Date(document.getElementById('edit_date_fin').value);
    
    if (dateFin < dateDebut) {
        e.preventDefault();
        alert('La date de fin doit être postérieure à la date de début.');
    }
});
</script>

<!-- Modal Édition Challenge -->
<div class="modal fade" id="editChallengeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le Challenge</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editChallengeForm" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nom du challenge</label>
                        <input type="text" class="form-control" name="nom" id="edit_nom" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" id="edit_description" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Date de début</label>
                            <input type="date" class="form-control" name="date_debut" id="edit_date_debut" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date de fin</label>
                            <input type="date" class="form-control" name="date_fin" id="edit_date_fin" required>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="edit_id">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editChallenge(id) {
    // Récupérer les données du challenge
    const row = document.querySelector(`button[onclick="editChallenge(${id})"]`).closest('tr');
    const cells = row.getElementsByTagName('td');
    
    // Remplir le formulaire d'édition
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nom').value = cells[0].textContent;
    document.getElementById('edit_description').value = cells[1].textContent.replace('...', '');
    
    // Convertir les dates du format dd/mm/yyyy au format yyyy-mm-dd
    const dateDebut = cells[3].textContent.split('/').reverse().join('-');
    const dateFin = cells[4].textContent.split('/').reverse().join('-');
    document.getElementById('edit_date_debut').value = dateDebut;
    document.getElementById('edit_date_fin').value = dateFin;
    
    // Afficher le modal
    $('#editChallengeModal').modal('show');
}

function deleteChallenge(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce challenge ?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.innerHTML = `
            <input type="hidden" name="id" value="${id}">
            <input type="hidden" name="action" value="delete">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Validation des dates pour le formulaire d'édition
document.getElementById('editChallengeForm').addEventListener('submit', function(e) {
    const dateDebut = new Date(document.getElementById('edit_date_debut').value);
    const dateFin = new Date(document.getElementById('edit_date_fin').value);
    
    if (dateFin < dateDebut) {
        e.preventDefault();
        alert('La date de fin doit être postérieure à la date de début.');
    }
});
</script>

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

<script>
function editChallenge(id) {
    // Récupérer les données du challenge
    const row = document.querySelector(`button[onclick="editChallenge(${id})"]`).closest('tr');
    const cells = row.getElementsByTagName('td');
    
    // Remplir le formulaire d'édition
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nom').value = cells[0].textContent;
    document.getElementById('edit_description').value = cells[1].textContent.replace('...', '');
    
    // Convertir les dates du format dd/mm/yyyy au format yyyy-mm-dd
    const dateDebut = cells[3].textContent.split('/').reverse().join('-');
    const dateFin = cells[4].textContent.split('/').reverse().join('-');
    document.getElementById('edit_date_debut').value = dateDebut;
    document.getElementById('edit_date_fin').value = dateFin;
    
    // Afficher le modal
    $('#editChallengeModal').modal('show');
}

function deleteChallenge(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce challenge ?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.innerHTML = `
            <input type="hidden" name="id" value="${id}">
            <input type="hidden" name="action" value="delete">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Validation des dates pour le formulaire d'édition
document.getElementById('editChallengeForm').addEventListener('submit', function(e) {
    const dateDebut = new Date(document.getElementById('edit_date_debut').value);
    const dateFin = new Date(document.getElementById('edit_date_fin').value);
    
    if (dateFin < dateDebut) {
        e.preventDefault();
        alert('La date de fin doit être postérieure à la date de début.');
    }
});
</script>