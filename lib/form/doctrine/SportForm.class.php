<?php

/**
 * Sport form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SportForm extends BaseSportForm {
    public function configure() {
    }

    public function addNewFields($number) {
        $new_occurrences = new BaseForm();

        $occurrence = new UserSport();
        $occurrence->setSport($this->getObject());
        $occurrence_form = new UserSportForm($occurrence);

        $new_occurrences->embedForm($number, $occurrence_form);


        $this->embedForm('new', $new_occurrences);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {

        if (array_key_exists('new', $taintedValues)) {
            $new_occurrences = new BaseForm();
            foreach ($taintedValues['new'] as $key => $new_occurrence) {
                $occurrence = new UserSport();
                $occurrence->setSport($this->getObject());
                $occurrence_form = new UserSportForm($occurrence);

                $new_occurrences->embedForm($key, $occurrence_form);
            }
        }
        $this->embedForm('new', $new_occurrences);

        parent::bind($taintedValues, $taintedFiles);
    }
}
