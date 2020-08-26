<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Client\Middleware\ErrorResponseException;
use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Customer;
use Budgetlens\PostNLApi\Entities\Shipment;
use Budgetlens\PostNLApi\Messages\Responses\Shipping\GenerateShipmentResponse;
use Tests\TestCase;
use Faker\Factory;

class ShippingTest extends TestCase
{
    // mostly used in tests
    const PRODUCT_CODE = "3085";
    const REMARK = "UNIT TEST";

    /**
     * @test
     */
    public function generateShipmentNoConfirm()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateShipmentSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity())
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(self::PRODUCT_CODE)
            ->setCustomerOrderNumber('CustomerOrderNumber')
            ->setReference('Reference')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateShipmentOwnBarcodeNoConfirm()
    {
        $barcode = '3STBJG243556367';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateShipmentWithCustomBarcodeSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity())
            ->setBarcode($barcode)
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(self::PRODUCT_CODE)
            ->setCustomerOrderNumber('CustomerOrderNumber')
            ->setReference('Reference')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @test
     */
    public function generateShipmentConfirm()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateShipmentConfirmedSuccess.json')->shipping()->generateShipment();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity())
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(self::PRODUCT_CODE)
            ->setCustomerOrderNumber('CustomerOrderNumber')
            ->setReference('Reference')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }
    /**
     * @test
     */
    public function generateLabelPickup()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateShipmentPickupPointSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->setDownPartnerID('PNPNL-01')
            ->setDownPartnerLocation('162060')
            ->addAddress($this->getReceiverEntity([
                'type' => Address::DELIVERY_ADDRES
            ]))
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3533)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelPickupBE()
    {
        $request = $this->getClient('Shipping/GenerateShipmentPickupBESuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($this->getCustomerEntity());

        $request->addShipment((new Shipment())
            ->setDownPartnerID('PNPBE-01')
            ->setDownPartnerLocation('BE0Q82')
            ->addAddress($this->getReceiverEntity([
                'type' => Address::DELIVERY_ADDRES,
                'country' => "BE",
                'postcode' => '2000'
            ]))
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER,
                'country' => "BE",
                'postcode' => '2018'
            ]))
            ->setDeliveryDate(new \DateTime('Next Thursday'))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(4932)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelEveningDelivery()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateShipmentEveningDeliverySuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setDeliveryDate(new \DateTime('Next Wednesday 18:00:00'))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3089)
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('006')
                ->setCharacteristic('118')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelSundayDelivery()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateShipmentSundayDeliverySuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setDeliveryDate(new \DateTime('next Sunday'))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3089)
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('008')
                ->setCharacteristic('101')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelSamedayDelivery()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateShipmentSameDayDeliverySuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setDeliveryDate(new \DateTime('20:00:00'))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3089)
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('006')
                ->setCharacteristic('118')
            )
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('015')
                ->setCharacteristic('118')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelDeliveryOnDemand()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateShipmentDeliveryOnDemandSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setDeliveryTimeStampStart(new \DateTime('Next Thursday 14:00:00'))
            ->setDeliveryTimeStampEnd(new \DateTime('Next Thursday 18:00:00'))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3089)
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('014')
                ->setCharacteristic('118')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelGuaranteedDelivery()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelDeliveryGuaranteedSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setDeliveryDate(new \DateTime('next Wednesday'))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3089)
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('007')
                ->setCharacteristic('118')
            )

            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelIdCheckAtDoor()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelIdCheckAtDoorSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setDeliveryDate(new \DateTime('next Wednesday'))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3440)
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('016')
                ->setCharacteristic('002')
            )
            ->setReceiverDateOfBirth(new \DateTime('1980-04-07'))
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelDangerousGoods()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelDangerousGoodsSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setDeliveryDate(new \DateTime('next Wednesday'))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3096)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('136')
                ->setOption('006')
            )
            ->setReceiverDateOfBirth(new \DateTime('1980-04-07'))
            ->setCustomerOrderNumber('1234test')
            ->setReference('ADR/LQ - Reference')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelExtraAtHome()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelExtraAtHomeSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->addContact($this->getContactEntity())
            ->setContent('Media player')
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3628)
            ->setReference('2016014567')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelExtraAtHomeCOD()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelExtraAtHomeCODSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->addContact($this->getContactEntity())
            ->addAmount((new Shipment\Amounts())
                ->setAmountType(Shipment\Amounts::TYPE_COD)
                ->setCurrency('EUR')
                ->setValue('10.00')
                ->setIBAN('NL91ABNA0417164300')
            )
            ->setContent('Media player')
            ->setDimension($this->getDimensionEntity([
                'weight' => 4500,
                'volume' => 30000
            ]))
            ->setProductCodeDelivery(3792)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('003')
                ->setOption('003')
            )
            ->setReference('2016014567')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelExtraAtHomeMultiCollo()
    {
        $barcode = '3STBJG243556390';
        $barcode2 = '3STBJG243556391';

        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelExtraAtHomeMultiColloSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' =>Address::RECEIVER
            ]))
            ->setBarcode($barcode)
            ->addContact($this->getContactEntity())
            ->setContent('Media player')
            ->setDimension($this->getDimensionEntity([
                'weight' => 4500,
                'volume' => 30000
            ]))
            ->addGroup((new Shipment\Group())
                ->setGroupCount(2)
                ->setGroupSequence(1)
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setMainBarcode($barcode)
            )
            ->setProductCodeDelivery(3628)
            ->setReference('2016014567')
            ->setRemark(self::REMARK)
        );
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setBarcode($barcode2)
            ->addContact($this->getContactEntity())
            ->setContent('Chair')
            ->setDimension($this->getDimensionEntity([
                'weight' =>5200,
                'volume' =>40000
            ]))
            ->addGroup((new Shipment\Group())
                ->setGroupCount(2)
                ->setGroupSequence(2)
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setMainBarcode($barcode)
            )
            ->setProductCodeDelivery(3628)
            ->setReference('2016014567')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @test
     */
    public function generateLabelReturnLabel()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelReturnLabelSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RETURN_ADDRESS
            ]))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3085)
            ->setReturnBarcode('3SRETR12345678')
            ->setReference('2016014567')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);

        $this->assertSame('Return Label', $response->getShipments()[0]['Labels'][1]['Labeltype']);
    }

    /**
     * @test
     */
    public function generateSingleReturnLabel()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelSingleReturnLabelSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(2285)
            ->setReference('Return Reference')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame('Return Label', $response->getShipments()[0]['Labels'][0]['Labeltype']);
    }

    /**
     * @test
     */
    public function generateSmartReturnLabel()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelSmartReturnLabelSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(2285)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('152')
                ->setOption('025')
            )
            ->setReference('Return Reference')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame('Return Label', $response->getShipments()[0]['Labels'][0]['Labeltype']);
    }


    /**
     * @test
     */
    public function generateLabelMultiCollo()
    {

        $barcode = '3STBJG243556369';
        $barcode2 = '3STBJG243556370';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelMultiColloSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addGroup((new Shipment\Group())
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setGroupSequence(1)
                ->setGroupCount(2)
                ->setMainBarcode($barcode)
            )
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setBarcode($barcode)
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3085)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        // 2nd collo
        $request->addShipment((new Shipment())
            ->addGroup((new Shipment\Group())
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setGroupSequence(2)
                ->setGroupCount(2)
                ->setMainBarcode($barcode2)
            )
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setBarcode($barcode2)
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3085)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertCount(2, $response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
        $this->assertSame($barcode2, $response->getShipments()[1]['Barcode']);
    }

    /**
     * @test
     */
    public function generateMultiLabel()
    {
        $barcode = '3STBJG243556390';
        $barcode2 = '3STBJG243556391';
        $barcode3 = '3STBJG243556392';

        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelMultiLabelSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF|MergeA');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setBarcode($barcode)
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3085)
            ->setReference('Return Reference')
            ->setRemark(self::REMARK)
        );
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setBarcode($barcode2)
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3085)
            ->setReference('Return Reference')
            ->setRemark(self::REMARK)
        );
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setBarcode($barcode3)
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3085)
            ->setReference('Return Reference')
            ->setRemark(self::REMARK)
        );

        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getMergedLabels());
        $this->assertArrayHasKey('Barcodes', $response->getMergedLabels()[0]);
        $this->assertArrayHasKey('Labels', $response->getMergedLabels()[0]);
        $this->assertCount(3, $response->getMergedLabels()[0]['Barcodes']);
        $this->assertSame($barcode, $response->getMergedLabels()[0]['Barcodes'][0]);
        $this->assertSame($barcode2, $response->getMergedLabels()[0]['Barcodes'][1]);
        $this->assertSame($barcode3, $response->getMergedLabels()[0]['Barcodes'][2]);
    }

    /**
     * @test
     */
    public function generateLabelCargoPickup()
    {
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelCargoPickupSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->addAddress($this->getReceiverEntity([
                'type' => Address::COLLECTION_ADDRESS
            ]))
            ->setCollectionTimeStampStart(new \DateTime("12:00:00"))
            ->setCollectionTimeStampEnd(new \DateTime("12:00:00"))
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3610)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('135')
                ->setOption('001')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertCount(1, $response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
    }

    /**
     * @test
     */
    public function generateLabelCargoPickupMultiCollo()
    {
        $barcode = '3STBJG243556369';
        $barcode2 = '3STBJG243556389';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelCargoPickupMultiColloSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->addAddress($this->getReceiverEntity([
                'type' => Address::COLLECTION_ADDRESS
            ]))
            ->setBarcode($barcode)
            ->setCollectionTimeStampStart(new \DateTime("12:00:00"))
            ->setCollectionTimeStampEnd(new \DateTime("12:00:00"))
            ->addContact($this->getContactEntity())
            ->addGroup((new Shipment\Group())
                ->setGroupCount(2)
                ->setGroupSequence(1)
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setMainBarcode($barcode)
            )
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3610)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('135')
                ->setOption('001')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->addAddress($this->getReceiverEntity([
                'type' => Address::COLLECTION_ADDRESS
            ]))
            ->setBarcode($barcode2)
            ->setCollectionTimeStampStart(new \DateTime("12:00:00"))
            ->setCollectionTimeStampEnd(new \DateTime("12:00:00"))
            ->addContact($this->getContactEntity())
            ->addGroup((new Shipment\Group())
                ->setGroupCount(2)
                ->setGroupSequence(2)
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setMainBarcode($barcode)
            )
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3610)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('135')
                ->setOption('001')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertCount(2, $response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
        $this->assertSame($barcode2, $response->getShipments()[1]['Barcode']);
    }

    /**
     * @test
     */
    public function generateLabelGLobalpackCombilabel()
    {
        $barcode = '3STBJG243556369';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Shipping/GenerateLabelGLobalpackCombilabelSuccess.json')->shipping()->generateShipmentWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER,
                'country' => 'CN',
                'city' => 'Shanghai',
                'address' => 'Nanjinglu 137',
                'postcode' => '310000'
            ]))
            ->addAddress($this->getReceiverEntity([
                'type' => Address::COLLECTION_ADDRESS
            ]))
            ->setBarcode($barcode)
            ->setCustoms((new Shipment\Customs())
                ->setCurrency('EUR')
                ->setHandleAsNonDeliverable(false)
                ->setInvoice(true)
                ->setInvoiceNr('12345')
                ->setShipmentType(Shipment\Customs::TYPE_COMMERCIAL_GOODS)
                ->addItem((new Shipment\Customs\Item())
                    ->setCountryOfOrigin('NL')
                    ->setDescription('Powdered milk')
                    ->setHSTariffNr('100878')
                    ->setQuantity(2)
                    ->setValue('20.00')
                    ->setWeight(4300)
                    ->setEAN('0231231232124')
                )
            )
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setDownPartnerBarcode('CC123456785NL')
            ->setProductCodeDelivery(4947)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateShipmentResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertCount(1, $response->getShipments());
        $this->assertCount(3, $response->getShipments()[0]['Labels']);
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
        $this->assertNotNull($response->getShipments()[0]['DownPartnerBarcode']);
        $this->assertNotNull($response->getShipments()[0]['DownPartnerID']);
    }

    private function writeLabel($response, $mergedLabels = false)
    {
        $teller = 0;
        $labels = ($mergedLabels)
            ? $response->getMergedLabels()
            : $response->getShipments();

        foreach ($labels as $shipment) {
            foreach ($shipment['Labels'] as $label) {
                $teller++;
                $barcode = isset($label['Barcode']) ? $label['Barcode'] : 'label';
                $filename = "label-{$barcode}-{$teller}.pdf";
                file_put_contents($filename, base64_decode($label['Content']));
            }
        }
    }
    private function getCustomerEntity()
    {
        return (new Customer())
            ->setAddress((new Address())
                ->setAddressType(Address::SENDER)
                ->setCompanyName('Sender CompanyName')
                ->setFirstName('Frank')
                ->setName('Peeters')
                ->setCity('Hoofddorp')
                ->setCountryCode("NL")
                ->setHouseNr(42)
                ->setHouseNrExt('A')
                ->setZipcode('2132WT')
                ->setStreet('Siriusdreef')
            )
            ->setCollectionLocation(getenv('COLLECTION_LOCATION'))
            ->setCustomerCode(getenv('CUSTOMER_CODE'))
            ->setCustomerNumber(getenv('CUSTOMER_NUMBER'))
            ->setEmail('some@email.nl');
    }

    private function getReceiverEntity(array $data = [])
    {
        $faker = Factory::create('nl_NL');

        return (new Address())
            ->setAddressType($data['type'] ?? Address::RECEIVER)
            ->setFirstName($data['firstname'] ?? $faker->firstName)
            ->setName($data['lastname'] ?? $faker->lastName)
            ->setZipcode($data['postcode'] ?? $faker->postcode)
            ->setStreetHouseNrExt($data['address'] ?? $faker->streetAddress)
            ->setCity($data['city'] ?? $faker->city)
            ->setCompanyName($data['company'] ?? $faker->company)
            ->setCountryCode($data['country'] ?? "NL");
    }

    private function getContactEntity()
    {
        $faker = Factory::create('nl_NL');
        return (new Shipment\Contact())
            ->setEmail($faker->email)
            ->setContactType('01')
            ->setSMSNr('0612345678');
    }

    public function getDimensionEntity(array $params = [])
    {
        $weight = $params['weight'] ?? null;
        $volume = $params['volume'] ?? null;
        $height = $params['height'] ?? null;
        $length = $params['length'] ?? null;
        $width = $params['width'] ?? null;

        $dimension = (new Shipment\Dimension())
            ->setWeight($params['weight'] ?? 450);
        if (!is_null($volume)) {
            $dimension->setVolume($volume);
        }
        if (!is_null($height)) {
            $dimension->setHeight($height);
        }
        if (!is_null($length)) {
            $dimension->setLength($length);
        }
        if (!is_null($width)) {
            $dimension->setWidth($width);
        }
        return $dimension;
    }
}
