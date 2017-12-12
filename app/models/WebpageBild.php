<?php

class WebpageBild extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    public $bild_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    public $webpage_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("wpm");
        $this->setSource("webpage_bild");
        $this->belongsTo('bild_id', '\Bilddateien', 'id', ['alias' => 'Bilddateien']);
        $this->belongsTo('webpage_id', '\Webpages', 'id', ['alias' => 'Webpages']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'webpage_bild';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return WebpageBild[]|WebpageBild|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return WebpageBild|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
