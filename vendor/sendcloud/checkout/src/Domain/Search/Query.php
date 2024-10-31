<?php

namespace SendCloud\Checkout\Domain\Search;

/**
 * Class Query
 *
 * @package SendCloud\Checkout\Domain\Search
 */
class Query
{
    /**
     * ISO 2 Country code.
     *
     * @var string | null
     */
    private $country;

    /**
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
}