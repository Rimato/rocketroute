<?php

namespace app\services\base;

use yii\base\Component;
use yii\di\Container;

abstract class AbstractService extends Component
{
    /**
     * @var Container
     */
    protected $_container;

    /**
     * @inheritdoc
     */
    public function __construct(array $config = [])
    {
        $this->_container = new Container();
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setDependencies();
        parent::init();
    }

    /**
     * Sets dependencies to DI container from getDependencyList method
     */
    protected function setDependencies()
    {
        $dependencies = $this->getDependencyList();
        foreach ($dependencies as $class => $dependency) {
            $this->setDependency($class, $dependency);
        }
    }

    /**
     * Sets single dependency to DI container
     *
     * @param $class
     * @param $dependency
     * @param array $params
     */
    public function setDependency($class, $dependency, array $params = [])
    {
        $this->_container->set($class, $dependency, $params);
    }

    /**
     * Gets dependency from DI container
     *
     * @param $dependencyName
     * @param array $params
     * @param array $config
     * @return object
     * @throws \yii\base\InvalidConfigException
     */
    protected function getDependency($dependencyName, $params = [], $config = [])
    {
        return $this->_container->get($dependencyName, $params, $config);
    }

    /**
     * Returns array of dependencies to set to DI container while initialization the object
     * By default method returns empty array, that means current object depends of nothing
     * Override this method to set object dependencies while initialization
     *
     * @return array
     */
    protected function getDependencyList()
    {
        return [];
    }
}