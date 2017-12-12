<?php

class Webpages extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $parent_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */
    public $status_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $projekt_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("wpm");
        $this->setSource("webpages");
        $this->hasMany('id', 'WebpageBild', 'webpage_id', ['alias' => 'WebpageBild']);
        $this->hasMany('id', 'WebpageText', 'webpage_id', ['alias' => 'WebpageText']);
        $this->hasMany('id', 'WebpageTextdaten', 'webpage_id', ['alias' => 'WebpageTextdaten']);
        $this->belongsTo('status_id', '\Webpagestatus', 'id', ['alias' => 'Webpagestatus']);
        $this->belongsTo('projekt_id', '\Projekte', 'id', ['alias' => 'Projekte']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'webpages';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Webpages[]|Webpages|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Webpages|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
