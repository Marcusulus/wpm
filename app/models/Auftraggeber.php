<?php

class Auftraggeber extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    public $strasse;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=true)
     */
    public $hausnummer;

    /**
     *
     * @var string
     * @Column(type="string", length=5, nullable=true)
     */
    public $plz;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $ort;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("wpm");
        $this->setSource("auftraggeber");
        $this->hasMany('id', 'Person', 'auftraggeber_id', ['alias' => 'Person']);
        $this->hasMany('id', 'Projekte', 'auftraggeber_id', ['alias' => 'Projekte']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'auftraggeber';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Auftraggeber[]|Auftraggeber|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Auftraggeber|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
