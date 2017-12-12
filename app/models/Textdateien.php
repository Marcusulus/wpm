<?php

class Textdateien extends \Phalcon\Mvc\Model
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
    public $titel;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $dateiname;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $daten;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $status_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $projekt_id;

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
        $this->setSource("textdateien");
        $this->hasMany('id', 'WebpageTextdaten', 'text_id', ['alias' => 'WebpageTextdaten']);
        $this->belongsTo('status_id', '\Status', 'id', ['alias' => 'Status']);
        $this->belongsTo('projekt_id', '\Projekte', 'id', ['alias' => 'Projekte']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'textdateien';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Textdateien[]|Textdateien|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Textdateien|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
