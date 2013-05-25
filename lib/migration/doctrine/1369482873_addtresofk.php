<?php

class Addtresofk extends Doctrine_Migration_Base
{
  public function up()
  {
        $this->createForeignKey('budget', 'budget_semestre_id_semestre_id', array(
             'name' => 'budget_semestre_id_semestre_id',
             'local' => 'semestre_id',
             'foreign' => 'id',
             'foreignTable' => 'semestre',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('budget_categorie', 'budget_categorie_asso_id_asso_id', array(
             'name' => 'budget_categorie_asso_id_asso_id',
             'local' => 'asso_id',
             'foreign' => 'id',
             'foreignTable' => 'asso',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->addIndex('budget', 'budget_semestre_id', array(
             'fields' => 
             array(
              0 => 'semestre_id',
             ),
             ));
        $this->addIndex('budget_categorie', 'budget_categorie_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->createForeignKey('budget', 'budget_asso_id_asso_id', array(
             'name' => 'budget_asso_id_asso_id',
             'local' => 'asso_id',
             'foreign' => 'id',
             'foreignTable' => 'asso',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->addIndex('budget', 'budget_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->createForeignKey('avance_treso', 'avance_treso_asso_id_asso_id', array(
             'name' => 'avance_treso_asso_id_asso_id',
             'local' => 'asso_id',
             'foreign' => 'id',
             'foreignTable' => 'asso',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('avance_treso', 'avance_treso_transaction_id_transaction_id', array(
             'name' => 'avance_treso_transaction_id_transaction_id',
             'local' => 'transaction_id',
             'foreign' => 'id',
             'foreignTable' => 'transaction',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('budget_poste', 'budget_poste_budget_id_budget_id', array(
             'name' => 'budget_poste_budget_id_budget_id',
             'local' => 'budget_id',
             'foreign' => 'id',
             'foreignTable' => 'budget',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('budget_poste', 'budget_poste_budget_categorie_id_budget_categorie_id', array(
             'name' => 'budget_poste_budget_categorie_id_budget_categorie_id',
             'local' => 'budget_categorie_id',
             'foreign' => 'id',
             'foreignTable' => 'budget_categorie',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('budget_poste', 'budget_poste_asso_id_asso_id', array(
             'name' => 'budget_poste_asso_id_asso_id',
             'local' => 'asso_id',
             'foreign' => 'id',
             'foreignTable' => 'asso',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('compte_banquaire', 'compte_banquaire_asso_id_asso_id', array(
             'name' => 'compte_banquaire_asso_id_asso_id',
             'local' => 'asso_id',
             'foreign' => 'id',
             'foreignTable' => 'asso',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('note_de_frais', 'note_de_frais_asso_id_asso_id', array(
             'name' => 'note_de_frais_asso_id_asso_id',
             'local' => 'asso_id',
             'foreign' => 'id',
             'foreignTable' => 'asso',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('note_de_frais', 'note_de_frais_transaction_id_transaction_id', array(
             'name' => 'note_de_frais_transaction_id_transaction_id',
             'local' => 'transaction_id',
             'foreign' => 'id',
             'foreignTable' => 'transaction',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('subvention', 'subvention_asso_id_asso_id', array(
             'name' => 'subvention_asso_id_asso_id',
             'local' => 'asso_id',
             'foreign' => 'id',
             'foreignTable' => 'asso',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('transaction', 'transaction_budget_poste_id_budget_poste_id', array(
             'name' => 'transaction_budget_poste_id_budget_poste_id',
             'local' => 'budget_poste_id',
             'foreign' => 'id',
             'foreignTable' => 'budget_poste',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('transaction', 'transaction_moyen_id_transaction_moyen_id', array(
             'name' => 'transaction_moyen_id_transaction_moyen_id',
             'local' => 'moyen_id',
             'foreign' => 'id',
             'foreignTable' => 'transaction_moyen',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('transaction', 'transaction_asso_id_asso_id', array(
             'name' => 'transaction_asso_id_asso_id',
             'local' => 'asso_id',
             'foreign' => 'id',
             'foreignTable' => 'asso',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('transaction', 'transaction_compte_id_compte_banquaire_id', array(
             'name' => 'transaction_compte_id_compte_banquaire_id',
             'local' => 'compte_id',
             'foreign' => 'id',
             'foreignTable' => 'compte_banquaire',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('transaction', 'transaction_note_de_frais_id_note_de_frais_id', array(
             'name' => 'transaction_note_de_frais_id_note_de_frais_id',
             'local' => 'note_de_frais_id',
             'foreign' => 'id',
             'foreignTable' => 'note_de_frais',
             ));
        $this->addIndex('avance_treso', 'avance_treso_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->addIndex('avance_treso', 'avance_treso_transaction_id', array(
             'fields' => 
             array(
              0 => 'transaction_id',
             ),
             ));
        $this->addIndex('budget_poste', 'budget_poste_budget_id', array(
             'fields' => 
             array(
              0 => 'budget_id',
             ),
             ));
        $this->addIndex('budget_poste', 'budget_poste_budget_categorie_id', array(
             'fields' => 
             array(
              0 => 'budget_categorie_id',
             ),
             ));
        $this->addIndex('budget_poste', 'budget_poste_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->addIndex('compte_banquaire', 'compte_banquaire_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->addIndex('note_de_frais', 'note_de_frais_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->addIndex('note_de_frais', 'note_de_frais_transaction_id', array(
             'fields' => 
             array(
              0 => 'transaction_id',
             ),
             ));
        $this->addIndex('subvention', 'subvention_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->addIndex('transaction', 'transaction_budget_poste_id', array(
             'fields' => 
             array(
              0 => 'budget_poste_id',
             ),
             ));
        $this->addIndex('transaction', 'transaction_moyen_id', array(
             'fields' => 
             array(
              0 => 'moyen_id',
             ),
             ));
        $this->addIndex('transaction', 'transaction_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->addIndex('transaction', 'transaction_compte_id', array(
             'fields' => 
             array(
              0 => 'compte_id',
             ),
             ));
        $this->addIndex('transaction', 'transaction_note_de_frais_id', array(
             'fields' => 
             array(
              0 => 'note_de_frais_id',
             ),
             ));
        $this->createForeignKey('document', 'document_transaction_id_transaction_id', array(
             'name' => 'document_transaction_id_transaction_id',
             'local' => 'transaction_id',
             'foreign' => 'id',
             'foreignTable' => 'transaction',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->createForeignKey('document', 'document_auteur_sf_guard_user_id', array(
             'name' => 'document_auteur_sf_guard_user_id',
             'local' => 'auteur',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             ));
        $this->createForeignKey('document', 'document_type_id_document_type_id', array(
             'name' => 'document_type_id_document_type_id',
             'local' => 'type_id',
             'foreign' => 'id',
             'foreignTable' => 'document_type',
             ));
        $this->addIndex('document', 'document_transaction_id', array(
             'fields' => 
             array(
              0 => 'transaction_id',
             ),
             ));
        $this->addIndex('document', 'document_auteur', array(
             'fields' => 
             array(
              0 => 'auteur',
             ),
             ));
        $this->addIndex('document', 'document_type_id', array(
             'fields' => 
             array(
              0 => 'type_id',
             ),
             ));
        $this->createForeignKey('document', 'document_asso_id_asso_id', array(
             'name' => 'document_asso_id_asso_id',
             'local' => 'asso_id',
             'foreign' => 'id',
             'foreignTable' => 'asso',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
        $this->addIndex('document', 'document_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
  }

  public function down()
  {
        $this->dropForeignKey('budget', 'budget_semestre_id_semestre_id');
        $this->dropForeignKey('budget_categorie', 'budget_categorie_asso_id_asso_id');
        $this->removeIndex('budget', 'budget_semestre_id', array(
             'fields' => 
             array(
              0 => 'semestre_id',
             ),
             ));
        $this->removeIndex('budget_categorie', 'budget_categorie_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->dropForeignKey('budget', 'budget_asso_id_asso_id');
        $this->removeIndex('budget', 'budget_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->dropForeignKey('avance_treso', 'avance_treso_asso_id_asso_id');
        $this->dropForeignKey('avance_treso', 'avance_treso_transaction_id_transaction_id');
        $this->dropForeignKey('budget_poste', 'budget_poste_budget_id_budget_id');
        $this->dropForeignKey('budget_poste', 'budget_poste_budget_categorie_id_budget_categorie_id');
        $this->dropForeignKey('budget_poste', 'budget_poste_asso_id_asso_id');
        $this->dropForeignKey('compte_banquaire', 'compte_banquaire_asso_id_asso_id');
        $this->dropForeignKey('note_de_frais', 'note_de_frais_asso_id_asso_id');
        $this->dropForeignKey('note_de_frais', 'note_de_frais_transaction_id_transaction_id');
        $this->dropForeignKey('subvention', 'subvention_asso_id_asso_id');
        $this->dropForeignKey('transaction', 'transaction_budget_poste_id_budget_poste_id');
        $this->dropForeignKey('transaction', 'transaction_moyen_id_transaction_moyen_id');
        $this->dropForeignKey('transaction', 'transaction_asso_id_asso_id');
        $this->dropForeignKey('transaction', 'transaction_compte_id_compte_banquaire_id');
        $this->dropForeignKey('transaction', 'transaction_note_de_frais_id_note_de_frais_id');
        $this->removeIndex('avance_treso', 'avance_treso_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->removeIndex('avance_treso', 'avance_treso_transaction_id', array(
             'fields' => 
             array(
              0 => 'transaction_id',
             ),
             ));
        $this->removeIndex('budget_poste', 'budget_poste_budget_id', array(
             'fields' => 
             array(
              0 => 'budget_id',
             ),
             ));
        $this->removeIndex('budget_poste', 'budget_poste_budget_categorie_id', array(
             'fields' => 
             array(
              0 => 'budget_categorie_id',
             ),
             ));
        $this->removeIndex('budget_poste', 'budget_poste_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->removeIndex('compte_banquaire', 'compte_banquaire_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->removeIndex('note_de_frais', 'note_de_frais_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->removeIndex('note_de_frais', 'note_de_frais_transaction_id', array(
             'fields' => 
             array(
              0 => 'transaction_id',
             ),
             ));
        $this->removeIndex('subvention', 'subvention_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->removeIndex('transaction', 'transaction_budget_poste_id', array(
             'fields' => 
             array(
              0 => 'budget_poste_id',
             ),
             ));
        $this->removeIndex('transaction', 'transaction_moyen_id', array(
             'fields' => 
             array(
              0 => 'moyen_id',
             ),
             ));
        $this->removeIndex('transaction', 'transaction_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
        $this->removeIndex('transaction', 'transaction_compte_id', array(
             'fields' => 
             array(
              0 => 'compte_id',
             ),
             ));
        $this->removeIndex('transaction', 'transaction_note_de_frais_id', array(
             'fields' => 
             array(
              0 => 'note_de_frais_id',
             ),
             ));
        $this->dropForeignKey('document', 'document_transaction_id_transaction_id');
        $this->dropForeignKey('document', 'document_auteur_sf_guard_user_id');
        $this->dropForeignKey('document', 'document_type_id_document_type_id');
        $this->removeIndex('document', 'document_transaction_id', array(
             'fields' => 
             array(
              0 => 'transaction_id',
             ),
             ));
        $this->removeIndex('document', 'document_auteur', array(
             'fields' => 
             array(
              0 => 'auteur',
             ),
             ));
        $this->removeIndex('document', 'document_type_id', array(
             'fields' => 
             array(
              0 => 'type_id',
             ),
             ));
        $this->dropForeignKey('document', 'document_asso_id_asso_id');
        $this->removeIndex('document', 'document_asso_id', array(
             'fields' => 
             array(
              0 => 'asso_id',
             ),
             ));
  }
}
