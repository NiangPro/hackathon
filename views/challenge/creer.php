<?php require_once('views/partials/_header.php'); ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Créer un nouveau challenge</h4>
                </div>
                <div class="card-body">
                    <form action="?page=challenge" method="POST">
                        
                        <div class="form-group">
                            <label for="nom">Nom du challenge</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="date_debut">Date de début</label>
                            <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                        </div>

                        <div class="form-group">
                            <label for="date_fin">Date de fin</label>
                            <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                        </div>

                        <input type="hidden" name="action" value="create">

                        <div class="form-group text-right">
                            <a href="?page=challenge" class="btn btn-secondary mr-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Créer le challenge</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validation des dates
document.querySelector('form').addEventListener('submit', function(e) {
    const dateDebut = new Date(document.getElementById('date_debut').value);
    const dateFin = new Date(document.getElementById('date_fin').value);
    
    if (dateFin < dateDebut) {
        e.preventDefault();
        alert('La date de fin doit être postérieure à la date de début.');
    }
});
</script>