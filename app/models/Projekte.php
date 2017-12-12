<?php

class Projekte extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=20, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $start;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $abschluss;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $deadline;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $auftraggeber_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("wpm");
        $this->setSource("projekte");
        $this->hasMany('id', 'Bilddateien', 'projekt_id', ['alias' => 'Bilddateien']);
        $this->hasMany('id', 'Textdateien', 'projekt_id', ['alias' => 'Textdateien']);
        $this->hasMany('id', 'Webpages', 'projekt_id', ['alias' => 'Webpages']);
        $this->belongsTo('auftraggeber_id', '\Auftraggeber', 'id', ['alias' => 'Auftraggeber']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'projekte';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Projekte[]|Projekte|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Projekte|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
