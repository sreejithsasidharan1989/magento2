<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

use Magento\Catalog\Api\Data\ProductTierPriceExtensionFactory;
use Magento\Catalog\Api\Data\ProductTierPriceInterfaceFactory;
use Magento\Customer\Model\Group;
use Magento\Store\Api\WebsiteRepositoryInterface;

require __DIR__ . '/product_simple_without_price_configurations.php';

/** @var WebsiteRepositoryInterface $websiteRepository */
$websiteRepository = $objectManager->get(WebsiteRepositoryInterface::class);
/** @var ProductTierPriceInterfaceFactory $tierPriceFactory */
$tierPriceFactory = $objectManager->get(ProductTierPriceInterfaceFactory::class);
/** @var ProductTierPriceExtensionFactory $tpExtensionAttributeFactory */
$tpExtensionAttributeFactory = $objectManager->get(ProductTierPriceExtensionFactory::class);
$adminWebsite = $websiteRepository->get('admin');
$tierPriceExtensionAttribute = $tpExtensionAttributeFactory->create(
    [
        'data' => [
            'website_id' => $adminWebsite->getId(),
        ]
    ]
);
$tierPrices[] = $tierPriceFactory->create(
    [
        'data' => [
            'customer_group_id' => 1,
            'qty' => 1,
            'value' => 10
        ]
    ]
)->setExtensionAttributes($tierPriceExtensionAttribute);
$product->setTierPrices($tierPrices);
$productRepository->save($product);
