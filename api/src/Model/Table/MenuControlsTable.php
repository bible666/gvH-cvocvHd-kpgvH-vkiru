<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 * 
 */

class MenuControlsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('menu_controls');
        $this->setPrimaryKey('id');

        $this->belongsTo('menues',[
            'foreignKey' => 'menu_id',
            'joinType' => 'INNER'
        ]);

    }
}
 ?>