<?php class Transaxion {

    public function initialiser(PDO &$pcnx) {
        $OK = true;
        try {
            $pcnx->beginTransaction();
        } catch (PDOException $e) {
            $OK = false;
        }
        return $OK;
    }
    /**
     *
     * @param PDO $pcnx
     */
    public function valider(PDO &$pcnx) {
        $OK = true;
        try {
            $pcnx->commit();
        } catch (PDOException $e) {
            $OK = false;
        }
        return $OK;
    }

    /**
     *
     * @param PDO $pcnx
     */
    public function annuler(PDO &$pcnx) {
        $OK = true;
        try {
            $pcnx->rollback();
        } catch (PDOException $e) {
            $OK = false;
        }
        return $OK;
    }
}
