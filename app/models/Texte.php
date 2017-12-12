<?php

class Texte extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=20, nullable=true)
     */
    public $titel;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $textdaten;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=true)
     */
    public $textlaenge;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $status_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $bemerkung;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("wpm");
        $this->setSource("texte");
        $this->hasMany('id', 'WebpageText', 'text_id', ['alias' => 'WebpageText']);
        $this->belongsTo('status_id', '\Status', 'id', ['alias' => 'Status']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'texte';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Texte[]|Texte|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Texte|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
