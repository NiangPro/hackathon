-- Structure de la table challenges
CREATE TABLE IF NOT EXISTS challenges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    statut ENUM('en_attente', 'en_cours', 'termine') NOT NULL DEFAULT 'en_attente',
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Structure de la table challenge_participants
CREATE TABLE IF NOT EXISTS challenge_participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    challenge_id INT NOT NULL,
    apprenant_id INT NOT NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('inscrit', 'abandonne', 'complete') DEFAULT 'inscrit',
    FOREIGN KEY (challenge_id) REFERENCES challenges(id) ON DELETE CASCADE,
    FOREIGN KEY (apprenant_id) REFERENCES apprenants(id) ON DELETE CASCADE,
    UNIQUE KEY unique_participation (challenge_id, apprenant_id)
);