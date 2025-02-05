-- Création de la base de données
CREATE DATABASE cabinet_medical;

-- Connexion à la base de données
\c cabinet_medical

-- Table des utilisateurs
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL CHECK (role IN ('admin', 'patient', 'medecin')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des rendez-vous
CREATE TABLE appointments (
    id SERIAL PRIMARY KEY,
    patient_id INTEGER REFERENCES users(id),
    medecin_id INTEGER REFERENCES users(id),
    date_time TIMESTAMP NOT NULL,
    status VARCHAR(20) DEFAULT 'scheduled' CHECK (status IN ('scheduled', 'completed', 'cancelled')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des disponibilités des médecins
CREATE TABLE availabilities (
    id SERIAL PRIMARY KEY,
    medecin_id INTEGER REFERENCES users(id),
    day_of_week INTEGER CHECK (day_of_week BETWEEN 0 AND 6),
    start_time TIME NOT NULL,
    end_time TIME NOT NULL
);

-- Insertion d'un utilisateur admin pour les tests
INSERT INTO users (name, email, password, role) VALUES ('Admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');