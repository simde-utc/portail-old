<?php

/**
 * TransactionTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TransactionTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object TransactionTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Transaction');
    }
    
    public function getAllForAsso($asso)
    {
      $q = $this->createQuery('q')
              ->where('q.asso_id = ?',$asso->getPrimaryKey())
              ->andWhere('q.deleted_at IS NULL');
      return $q;
    }
    
    public function getActiveCount($asso)
    {
        $q = $this->getAllForAsso($asso);
        $a = $q->count();
        return $a;
    }
}