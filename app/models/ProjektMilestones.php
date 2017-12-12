<?php

class ProjektMilestones extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    public $projekt_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    public $milestone_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $start_geplant;

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
    public $ende_geplant;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $ende;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("wpm");
        $this->setSource("projekt_milestones");
        $this->belongsTo('projekt_id', '\Projekte', 'id', ['alias' => 'Projekte']);
        $this->belongsTo('milestone_id', '\Milestones', 'id', ['alias' => 'Milestones']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'projekt_milestones';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProjektMilestones[]|ProjektMilestones|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProjektMilestones|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
