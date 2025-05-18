

<div class="container py-5">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 mb-4">Système de Tirage Multi-Universitaire</h1>
                <p class="lead text-muted">Plateforme de gestion des confrontations et challenges entre universités</p>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Nouveau :</strong> Système de tirage amélioré pour une meilleure équité entre les équipes
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h3 class="h4 mb-3">Gestion des Équipes</h3>
                        <p class="text-muted">Créez et gérez vos équipes universitaires pour les challenges</p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-outline-primary btn-block">Gérer les équipes</a>
                            <a href="#" class="btn btn-link btn-sm mt-2">Voir les statistiques</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-warning">
                    <div class="card-body text-center">
                        <div class="ribbon ribbon-top-right"><span class="bg-warning">Nouveau</span></div>
                        <i class="fas fa-trophy fa-3x text-warning mb-3"></i>
                        <h3 class="h4 mb-3">Challenges Actifs</h3>
                        <p class="text-muted">Participez aux challenges en cours et suivez les classements en temps réel</p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-warning btn-block">Voir les challenges</a>
                            <a href="#" class="btn btn-link btn-sm mt-2">Historique des résultats</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-success">
                    <div class="card-body text-center">
                        <i class="fas fa-random fa-3x text-success mb-3"></i>
                        <h3 class="h4 mb-3">Tirage Intelligent</h3>
                        <p class="text-muted">Système de tirage équitable basé sur les performances et les statistiques</p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-success btn-block">Nouveau tirage</a>
                            <a href="#" class="btn btn-link btn-sm mt-2">Consulter les confrontations</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-8 mx-auto text-center">
                <h4 class="mb-4">Statistiques Globales</h4>
                <div class="row">
                    <div class="col-4">
                        <div class="h2 mb-0 text-primary">12</div>
                        <small class="text-muted">Universités</small>
                    </div>
                    <div class="col-4">
                        <div class="h2 mb-0 text-warning">24</div>
                        <small class="text-muted">Challenges actifs</small>
                    </div>
                    <div class="col-4">
                        <div class="h2 mb-0 text-success">156</div>
                        <small class="text-muted">Équipes</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }
    .ribbon {
        position: absolute;
        right: -5px; top: -5px;
        z-index: 1;
        overflow: hidden;
        width: 75px; height: 75px;
    }
    .ribbon span {
        position: absolute;
        padding: 0.25rem 0;
        width: 75px;
        text-align: center;
        font-size: 0.75rem;
        font-weight: bold;
        color: white;
        transform: rotate(45deg);
        right: -20px;
        top: 15px;
    }
    </style>
