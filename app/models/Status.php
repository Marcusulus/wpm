<?php

class Status extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=5, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $bezeichnung;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    public $iststandard;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("wpm");
        $this->setSource("status");
        $this->hasMany('id', 'Bilddateien', 'status_id', ['alias' => 'Bilddateien']);
        $this->hasMany('id', 'Textdateien', 'status_id', ['alias' => 'Textdateien']);
        $this->hasMany('id', 'Texte', 'status_id', ['alias' => 'Texte']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'status';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Status[]|Status|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Status|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
