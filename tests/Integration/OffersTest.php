<?php

declare(strict_types=1);

namespace Tests\Integration;

use Rojtjo\Bol\Types\BundlePrice;
use Rojtjo\Bol\Types\BundlePriceCollection;
use Rojtjo\Bol\Types\Condition;
use Rojtjo\Bol\Types\ConditionCategory;
use Rojtjo\Bol\Types\ConditionName;
use Rojtjo\Bol\Types\CreateOfferRequest;
use Rojtjo\Bol\Types\DeliveryCode;
use Rojtjo\Bol\Types\Fulfilment;
use Rojtjo\Bol\Types\FulfilmentMethod;
use Rojtjo\Bol\Types\Pricing;
use Rojtjo\Bol\Types\StockCreate;
use Rojtjo\Bol\Types\UpdateOfferPriceRequest;
use Rojtjo\Bol\Types\UpdateOfferRequest;
use Rojtjo\Bol\Types\UpdateOfferStockRequest;

final class OffersTest extends IntegrationTestCase
{
    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v9-OFFERS.html#_create_an_offer_export_csv_file
     */
    public function create_an_offer_export_csv_file(): void
    {
        $processStatus = $this->bol
            ->offers()
            ->requestOfferExportFile();

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v9-OFFERS.html#_retrieve_an_offer_export_csv_file
     */
    public function retrieve_an_offer_export_csv_file(): void
    {
        $offerExportFile = $this->bol
            ->offers()
            ->retrieveOfferExportFile('73985e00-d461-4461-80e7-d3fea8d23ef4');

        $this->assertMatchesObjectSnapshot($offerExportFile);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v9-OFFERS.html#_retrieve_an_offer
     */
    public function retrieve_an_offer(): void
    {
        $offer = $this->bol
            ->offers()
            ->offer('13722de8-8182-d161-5422-4a0a1caab5c8');

        $this->assertMatchesObjectSnapshot($offer);
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v9-OFFERS.html#_update_of_an_already_existing_offer_with_offerid_13722de8_8182_d161_5422_4a0a1caab5c8
     */
    public function create_fbr_offer_for_ean_9780471117094_with_condition_new_with_vvb_proposition(): void
    {
        $request = new CreateOfferRequest(
            '9780471117094',
            new Condition(
                ConditionName::New,
                ConditionCategory::New,
            ),
            'RefCode',
            true,
            'Title',
            new Pricing(
                new BundlePriceCollection([
                    new BundlePrice(1, 9.99),
                    new BundlePrice(6, 8.99),
                    new BundlePrice(12, 7.99),
                ]),
            ),
            new StockCreate(1, false),
            new Fulfilment(
                FulfilmentMethod::ByRetailer,
                DeliveryCode::VVB,
            ),
        );

        $processStatus = $this->bol
            ->offers()
            ->createOffer($request);

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v9-OFFERS.html#_create_fbr_offer_for_ean_0045496420253_with_condition_moderate
     */
    public
    function create_fbr_offer_for_ean_0045496420253_with_condition_moderate(): void
    {
        $request = new CreateOfferRequest(
            '0045496420253',
            new Condition(
                ConditionName::Moderate,
                ConditionCategory::Secondhand,
                'Description'
            ),
            'RefCode',
            true,
            'Title',
            new Pricing(
                new BundlePriceCollection([
                    new BundlePrice(1, 9.99),
                    new BundlePrice(6, 8.99),
                    new BundlePrice(12, 7.99),
                ]),
            ),
            new StockCreate(1, true),
            new Fulfilment(
                FulfilmentMethod::ByRetailer,
                DeliveryCode::_24uurs_21,
            ),
        );

        $processStatus = $this->bol
            ->offers()
            ->createOffer($request);

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v9-OFFERS.html#_delete_an_already_existing_offer_that_is_known_with_offerid_13722de8_8182_d161_5422_4a0a1caab5c8
     */
    public
    function delete_an_already_existing_offer_that_is_known_with_offerid_13722de8_8182_d161_5422_4a0a1caab5c8(): void
    {
        $processStatus = $this->bol
            ->offers()
            ->deleteOffer('13722de8-8182-d161-5422-4a0a1caab5c8');

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v9-OFFERS.html#_update_the_price_for_a_specific_offer
     */
    public
    function update_the_price_for_a_specific_offer(): void
    {
        $request = new UpdateOfferPriceRequest(
            new Pricing(
                new BundlePriceCollection([
                    new BundlePrice(1, 49.99),
                    new BundlePrice(6, 44.99),
                    new BundlePrice(12, 39.99),
                ])
            ),
        );

        $processStatus = $this->bol
            ->offers()
            ->updateOfferPrice('13722de8-8182-d161-5422-4a0a1caab5c8', $request);

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v9-OFFERS.html#_update_the_current_stock_level_for_offerid_13722de8_8182_d161_5422_4a0a1caab5c8
     */
    public
    function update_the_current_stock_level_for_offerid_13722de8_8182_d161_5422_4a0a1caab5c8(): void
    {
        $request = new UpdateOfferStockRequest(25, false);

        $processStatus = $this->bol
            ->offers()
            ->updateOfferStock('13722de8-8182-d161-5422-4a0a1caab5c8', $request);

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v9-OFFERS.html#_update_of_an_already_existing_offer_with_offerid_13722de8_8182_d161_5422_4a0a1caab5c8
     */
    public
    function update_of_an_already_existing_offer_with_offerid_13722de8_8182_d161_5422_4a0a1caab5c8(): void
    {
        $request = new UpdateOfferRequest(
            'RefCode',
            true,
            'Title',
            new Fulfilment(
                FulfilmentMethod::ByRetailer,
                DeliveryCode::_24uurs_21,
            ),
        );

        $processStatus = $this->bol
            ->offers()
            ->updateOffer('13722de8-8182-d161-5422-4a0a1caab5c8', $request);

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }

    /**
     * @test
     * @see https://api.bol.com/retailer/public/Retailer-API/demo/v9-OFFERS.html#_update_of_an_already_existing_offer_with_offerid_13722de8_8182_d161_5422_4a0a1caab5c8_2
     */
    public
    function update_of_an_already_existing_offer_with_offerid_13722de8_8182_d161_5422_4a0a1caab5c8_2(): void
    {
        $request = new UpdateOfferRequest(
            'RefCode',
            true,
            'Title',
            new Fulfilment(
                FulfilmentMethod::ByRetailer,
                DeliveryCode::VVB,
            ),
        );

        $processStatus = $this->bol
            ->offers()
            ->updateOffer('13722de8-8182-d161-5422-4a0a1caab5c8', $request);

        $this->assertMatchesObjectSnapshot($processStatus->withFixedTimestamp());
    }
}
