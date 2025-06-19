<?php

namespace Models\Database;

use Config\Config;
use PDO;
use PDOException;
use PDOStatement;

class BasePDODAO
{
    private PDO|null $db = null;

    /**
     * Récupère l'instance de PDO ou l'initialise si elle est inexistante
     * @return PDO
     */
    public function getDb(): PDO
    {
        // Vérifie si $db est null, sinon crée une nouvelle instance de PDO
        if ($this->db === null) {
            try {
                // Instanciation de PDO avec les paramètres de connexion
                $this->db = new PDO(
                    Config::get('dsn'),    // DSN de connexion
                    Config::get('user'),   // Nom d'utilisateur
                    Config::get('pass')    // Mot de passe
                );

                // Configuration des options PDO (lève des exceptions en cas d'erreur)
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                // Renvoie une erreur si impossible de se connecter
                throw new PDOException("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        // Retourne l'instance PDO existante ou nouvellement créée
        return $this->db;
    }

    /**
     * Exécute une requête passée en paramètre avec ses paramètres si besoin
     * @param string $sql
     * @param array $params
     * @return PDOStatement|false
     */
    protected function execRequest(string $sql, array $params = []): PDOStatement|false
    {
        //Préparation de la requête
        $req = $this->getDb()->prepare($sql);

        //On gère si l'exécution ne se fait pas, on fait un rollback et on envoie une exception
        if (!$req->execute($params)) {
            $this->getDb()->rollBack();
            throw new PDOException($req->errorInfo()[2]);
        }

        //On retourne l'exécution
        return $req;
    }
}