<?php
namespace Magento\Framework\App\AreaList;

/**
 * Proxy class for @see \Magento\Framework\App\AreaList
 */
class Proxy extends \Magento\Framework\App\AreaList implements \Magento\Framework\ObjectManager\NoninterceptableInterface
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \Magento\Framework\App\AreaList
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magento\\Framework\\App\\AreaList', $shared = true)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_subject', '_isShared', '_instanceName'];
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \Magento\Framework\App\AreaList
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function getCodeByFrontName($frontName)
    {
        return $this->_getSubject()->getCodeByFrontName($frontName);
    }

    /**
     * {@inheritdoc}
     */
    public function getFrontName($areaCode)
    {
        return $this->_getSubject()->getFrontName($areaCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getCodes()
    {
        return $this->_getSubject()->getCodes();
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultRouter($areaCode)
    {
        return $this->_getSubject()->getDefaultRouter($areaCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getArea($code)
    {
        return $this->_getSubject()->getArea($code);
    }
}
