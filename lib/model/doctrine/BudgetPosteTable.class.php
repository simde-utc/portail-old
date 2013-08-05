<?php

/**
 * BudgetPosteTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class BudgetPosteTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object BudgetPosteTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('BudgetPoste');
    }
    
    public function getAllForAsso($asso)
    {
        $q = $this->createQuery('q')->select('q.id, q.nom, b.nom, b.id')
               ->leftJoin('q.Budget b')
               ->where('q.asso_id = ?', $asso->getPrimaryKey())
               ->andWhere('q.deleted_at IS NULL')
               ->orderBy('q.budget_id DESC');
      
      return $q;
    }
    
}