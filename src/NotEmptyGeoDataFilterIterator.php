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

        // Disclose items not implementing GeoDataProviderInterface
        if (!$item instanceOf GeoDataProviderInterface) {
            return false;
        }

        $status = (!empty($item->getLatitude()) and !empty($item->getLongitude()));

        return $status == $this->not_empty_status;
    }
}
