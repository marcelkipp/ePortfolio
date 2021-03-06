<?php

require __DIR__.'/../vendor/autoload.php';

class AddSemClassConfigEntry extends Migration
{
    public function description () {
        return 'add PORTFOLIO_VORLAGE SemClass configEntry';
    }


    public function up () {
        
        $sem_type_id;
        
        if(!Config::get()->getValue('SEM_CLASS_PORTFOLIO_VORLAGE')){
        
            foreach ($GLOBALS['SEM_TYPE'] as $id => $sem_type){ //get the id of ePortfolio Seminarclass
                if ($sem_type['name'] == 'ePortfolio-Vorlage') {
                    $sem_type_id = $id;
                }
            }

            if($sem_type_id){
                Config::get()->create('SEM_CLASS_PORTFOLIO_VORLAGE', array(
                    'value'       => $sem_type_id,
                    'is_default'  => 0,
                    'type'        => 'integer',
                    'range'       => 'global',
                    'section'     => 'global',
                    'description' => 'ID der Veranstaltungsklasse für Portfolio-Vorlagen'
                    ));
            }
        }
        
        if(!Config::get()->getValue('SEM_CLASS_PORTFOLIO')){
            foreach ($GLOBALS['SEM_TYPE'] as $id => $sem_type){ //get the id of ePortfolio Seminarclass
                if ($sem_type['name'] == 'ePortfolio') {
                    $sem_type_id = $id;
                }
            }
            if($sem_type_id){
                Config::get()->create('SEM_CLASS_PORTFOLIO', array(
                    'value'       => $sem_type_id,
                    'is_default'  => 0,
                    'type'        => 'integer',
                    'range'       => 'global',
                    'section'     => 'global',
                    'description' => 'ID der Veranstaltungsklasse für Portfolios'
                    ));
            }
        }
    }


    public function down () {
       
    }

    

}
