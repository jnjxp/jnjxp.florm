<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Florm;

class Container
{

    protected $readerClass      = Data\Fs\Reader::class;
    protected $gatewayClass     = Data\Gateway::class;
    protected $locatorClass     = MapperLocator::class;
    protected $relationClass    = Mapper\Relation\RelatedFactory::class;
    protected $identityMapClass = Mapper\IdentityMap::class;

    protected $reader;

    protected $mapperLocator;

    protected $relatedFactory;

    /**
     * Create an Florm container
     *
     * @param Gateway $gateway to data
     *
     * @access public
     */
    public function __construct($root, array $mappers)
    {
        $this->reader = ($root instanceof Data\Fs\ReaderInterface)
            ? $root
            : new $this->readerClass($root);

        $this->mapperLocator  = new $this->locatorClass;
        $this->relatedFactory = new $this->relationClass($this->mapperLocator);
        $this->setMappers($mappers);
    }

    /**
     * SetMappers
     *
     * @param array $mappers DESCRIPTION
     *
     * @return mixed
     *
     * @access protected
     */
    protected function setMappers(array $mappers)
    {
        foreach ($mappers as $name => $class) {
            $factory = function () use ($class, $name) {
                return new $class(
                    $this->newGateway($name),
                    $this->newIdentityMap(),
                    $this->getRelatedFactory()
                );
            };
        }

        $this->mapperLocator->set($name, $factory);
    }

    /**
     * GetMaperLocator
     *
     * @return mixed
     *
     * @access public
     */
    public function getMaperLocator()
    {
        return $this->mapperLocator;
    }

    /**
     * GetRelatedFactory
     *
     * @return mixed
     *
     * @access public
     */
    public function getRelatedFactory()
    {
        return $this->relatedFactory;
    }

    /**
     * NewGateway
     *
     * @param mixed $name DESCRIPTION
     *
     * @return mixed
     *
     * @access public
     */
    public function newGateway($name)
    {
        return new $this->gatewayClass($this->reader, $name);
    }

    /**
     * NewIdentityMap
     *
     * @return mixed
     *
     * @access public
     */
    public function newIdentityMap()
    {
        return new $this->identityMapClass;
    }
}
