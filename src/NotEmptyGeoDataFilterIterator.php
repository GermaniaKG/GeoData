<?php
namespace Germania\GeoData;

class NotEmptyGeoDataFilterIterator extends \FilterIterator
{

    /**
     * @var boolean
     */
    public $not_empty_status = true;


    /**
     * @param \Traversable $collection       GeoDataProviderInterface instances
     * @param boolean      $not_empty_status
     */
    public function __construct(  \Traversable $collection, $not_empty_status = true )
    {
        $this->not_empty_status = $not_empty_status;

        // Take care of Traversable's two faces,
        // since both IteratorAggregate and Iterator implement Traversable
        parent::__construct( $collection instanceOf \IteratorAggregate ? $collection->getIterator() : $collection );
    }


    /**
     * @uses $not_empty_status
     */
    public function accept( )
    {
        $item = $this->getInnerIterator()->current();

        // Get geodata from Provider
        if ($item instanceOf GeoDataProviderInterface) {
            $item = $item->getGeoData();
        }

        // Disclose items not implementing GeoDataProviderInterface
        if ($item instanceOf GeoDataInterface) {
            $status = (!empty($item->getLatitude()) and !empty($item->getLongitude()));
            return ($status == $this->not_empty_status);
        }

        // brainfuck: If filter-for-falsy is wanted, just invert the true
        return !$this->not_empty_status;

    }
}
