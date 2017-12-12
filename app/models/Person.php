<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Person extends \Phalcon\Mvc\Model
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
    public $vorname;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    public $nachname;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $telefon;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $mobil;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $auftraggeber_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $bemerkung;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("wpm");
        $this->setSource("person");
        $this->belongsTo('auftraggeber_id', '\Auftraggeber', 'id', ['alias' => 'Auftraggeber']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'person';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Person[]|Person|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Person|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
