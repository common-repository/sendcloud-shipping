<?php

namespace Sendcloud\Shipping\Checkout\Storage;

use SendCloud\Checkout\Contracts\Storage\CheckoutStorage;
use SendCloud\Checkout\Domain\Delivery\DeliveryMethod;
use SendCloud\Checkout\Domain\Delivery\DeliveryZone;
use Sendcloud\Shipping\Repositories\Delivery_Methods_Repository;
use Sendcloud\Shipping\Repositories\Delivery_Zones_Repository;
use Sendcloud\Shipping\Utility\Logger;

/**
 * Class Checkout_Storage
 *
 * @package Sendcloud\Shipping\Checkout\Storage
 */
class Checkout_Storage implements CheckoutStorage {
	/**
	 * Delivery_Zones_Repository
	 *
	 * @var Delivery_Zones_Repository
	 */
	private $delivery_zones_repository;
	/**
	 * Delivery_Methods_Repository
	 *
	 * @var Delivery_Methods_Repository
	 */
	private $delivery_methods_repository;

	/**
	 * Checkout_Storage constructor.
	 *
	 * @param Delivery_Zones_Repository $delivery_zones_repository
	 * @param Delivery_Methods_Repository $delivery_methods_repository
	 */
	public function __construct( $delivery_zones_repository, $delivery_methods_repository ) {
		$this->delivery_zones_repository   = $delivery_zones_repository;
		$this->delivery_methods_repository = $delivery_methods_repository;
	}

	/**
	 * Provides all delivery zone configurations.
	 *
	 * @return DeliveryZone[]
	 */
	public function findAllZoneConfigs() {
        $zones = $this->delivery_zones_repository->find_all();
        Logger::info('Checkout_Storage::findAllZoneConfigs(): ' . 'zones:' . json_encode($zones) );

        return $zones;
	}

	/**
	 * Provides delivery zones with specified ids.
	 *
	 * @param array $ids
	 *
	 * @return DeliveryZone[]
	 */
	public function findZoneConfigs( array $ids ) {
		$zones = $this->delivery_zones_repository->find( $ids );
        Logger::info('Checkout_Storage::findZoneConfigs(): ' . 'ids:' . json_encode($ids) . ', zones: ' . json_encode($zones) );

        return $zones;
	}

	/**
	 * Deletes specified zone configurations.
	 *
	 * @param array $ids
	 *
	 * @return void
	 */
	public function deleteSpecificZoneConfigs( array $ids ) {
        Logger::info('Checkout_Storage::deleteSpecificZoneConfigs(): ' . 'ids:' . json_encode($ids) );
		$this->delivery_zones_repository->delete( $ids );
	}

	/**
	 * Deletes all saved zone configurations.
	 *
	 * @return void
	 */
	public function deleteAllZoneConfigs() {
		$this->delivery_zones_repository->delete_all();
	}

	/**
	 * Creates delivery zones.
	 *
	 * @param DeliveryZone[] $zones
	 *
	 * @return void
	 */
	public function createZoneConfigs( array $zones ) {
        Logger::info('Checkout_Storage::createZoneConfigs(): ' . 'zones:' . json_encode($zones) );
		$this->delivery_zones_repository->create( $zones );
	}

	/**
	 * Updates saved zone configurations.
	 *
	 * @param DeliveryZone[] $zones
	 *
	 * @return void
	 */
	public function updateZoneConfigs( array $zones ) {
        Logger::info('Checkout_Storage::updateZoneConfigs(): ' . 'zones:' . json_encode($zones) );
		$this->delivery_zones_repository->update( $zones );
	}

	/**
	 * Provides all delivery method configurations.
	 *
	 * @return DeliveryMethod[]
	 */
	public function findAllMethodConfigs() {
		$methods = $this->delivery_methods_repository->find_all();
        Logger::info('Checkout_Storage::findAllMethodConfigs(): ' . 'methods:' . json_encode($methods) );

        return $methods;
	}

	/**
	 * Deletes methods identified by the provided batch of ids.
	 *
	 * @param array $ids
	 *
	 * @return void
	 */
	public function deleteSpecificMethodConfigs( array $ids ) {
        Logger::info('Checkout_Storage::deleteSpecificMethodConfigs(): ' . 'ids:' . json_encode($ids) );
		$this->delivery_methods_repository->delete( $ids );
	}

	/**
	 * Deletes all delivery method configurations.
	 *
	 * @return void
	 */
	public function deleteAllMethodConfigs() {
		$this->delivery_methods_repository->delete_all();
	}

	/**
	 * Updates saved delivery methods.
	 *
	 * @param DeliveryMethod[] $methods
	 *
	 * @return void
	 */
	public function updateMethodConfigs( array $methods ) {
        Logger::info('Checkout_Storage::updateMethodConfigs(): ' . 'methods:' . json_encode($methods) );
		$this->delivery_methods_repository->update( $methods );
	}

	/**
	 * Creates method configurations.
	 *
	 * @param DeliveryMethod[] $methods
	 *
	 * @return void
	 */
	public function createMethodConfigs( array $methods ) {
        Logger::info('Checkout_Storage::createMethodConfigs(): ' . 'methods:' . json_encode($methods) );
		$this->delivery_methods_repository->create( $methods );
	}

	/**
	 * Deletes all delivery method data generated by the integration.
	 *
	 * @return void
	 */
	public function deleteAllMethodData() {
		// Intentionally left empty.
	}

	/**
	 * Finds delivery methods for specified zone ids.
	 *
	 * @param array $zoneIds
	 *
	 * @return DeliveryMethod[]
	 */
	public function findMethodInZones( array $zoneIds ) {
        $methods = $this->delivery_methods_repository->find_in_zones( $zoneIds );
        Logger::info('Checkout_Storage::createMethodConfigs(): ' . 'zone ids:' . json_encode($zoneIds) . ', methods: ' . json_encode($methods));

        return $methods;
	}

	/**
	 * Delete delivery method configs for delivery methods that no longer exist in system.
	 *
	 * @return void
	 */
	public function deleteObsoleteMethodConfigs() {
		$this->delivery_methods_repository->delete_obsolete_method_configs();
	}

	/**
	 * Delete delivery zone configs for delivery zones that no longer exist in system.
	 *
	 * @return void
	 */
	public function deleteObsoleteZoneConfigs() {
		$this->delivery_zones_repository->delete_obsolete_zone_configs();
	}
}