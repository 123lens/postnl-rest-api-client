<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Customer;
use Budgetlens\PostNLApi\Entities\Shipment;
use Budgetlens\PostNLApi\Messages\Responses\Labelling\GenerateLabelResponse;
use Tests\TestCase;
use Faker\Factory;

class LabellingTest extends TestCase
{
    // mostly used in tests
    const PRODUCT_CODE = "3085";
    const REMARK = "UNIT TEST";

    /**
     * @testx
     */
    public function generateLabelNoConfirm()
    {
        $r = $this->getReceiverEntity();
        $barcode = '3STBJG243556367';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelNoConfirmSuccess.json')->labelling()->generateLabelWithoutConfirm();
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
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelPickup()
    {

        $barcode = '3STBJG243556368';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelPickupNoConfirmSuccess.json')->labelling()->generateLabelWithoutConfirm();
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
            ->setBarcode($barcode)
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(3533)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelPickupBE()
    {

        $barcode = '3SDEVC0013543';
        $request = $this->getClient('Labelling/GenerateLabelPickupBeNoConfirmSuccess.json')->labelling()->generateLabelWithoutConfirm();
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
            ->setBarcode($barcode)
            ->addContact($this->getContactEntity())
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(4932)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark(self::REMARK)
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelEveningDelivery()
    {
        $barcode = '3STBJG243556367';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelEveningNoConfirmSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress($this->getReceiverEntity([
                'type' => Address::RECEIVER
            ]))
            ->setDeliveryDate(new \DateTime('Next Wednesday 18:00:00'))
            ->setBarcode($barcode)
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
//        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelSundayDelivery()
    {
        $barcode = '3STBJG243556377';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelSundaySuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setDeliveryDate(new \DateTime('next Sunday'))
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(450)
            )
            ->setProductCodeDelivery(3089)
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('008')
                ->setCharacteristic('101')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelSamedayDelivery()
    {
        $barcode = '3STBJG243556387';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelSameDaySuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setDeliveryDate(new \DateTime('20:00:00'))
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(450)
            )
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
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelDeliveryOnDemand()
    {
        $barcode = '3STBJG243556388';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelDeliveryOnDemandSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setDeliveryTimeStampStart(new \DateTime('14:00:00'))
            ->setDeliveryTimeStampEnd(new \DateTime('18:00:00'))
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(450)
            )
            ->setProductCodeDelivery(3089)
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('014')
                ->setCharacteristic('118')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelGuaranteedDelivery()
    {
        $barcode = '3STBJG243556388';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelDeliveryGuaranteedSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setDeliveryDate(new \DateTime('next Wednesday'))
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(450)
            )
            ->setProductCodeDelivery(3089)
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('007')
                ->setCharacteristic('118')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelIdCheckAtDoor()
    {
        $barcode = '3STBJG243556388';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelIdCheckAtDoorSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setDeliveryDate(new \DateTime('next Wednesday'))
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(450)
            )
            ->setProductCodeDelivery(3440)
            ->addProductOption((new Shipment\ProductOption())
                ->setOption('016')
                ->setCharacteristic('002')
            )
            ->setReceiverDateOfBirth(new \DateTime('1980-04-07'))
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelDangerousGoods()
    {
        $barcode = '3STBJG243556388';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelDangerousGoodsSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setDeliveryDate(new \DateTime('next Wednesday'))
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(450)
            )
            ->setProductCodeDelivery(3096)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('136')
                ->setOption('006')
            )
            ->setReceiverDateOfBirth(new \DateTime('1980-04-07'))
            ->setCustomerOrderNumber('1234test')
            ->setReference('ADR/LQ - Reference')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelExtraAtHome()
    {
        $barcode = '3STBJG243556388';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelExtraAtHomeSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setContent('Media player')
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
                ->setVolume(30000)
            )
            ->setProductCodeDelivery(3628)
            ->setReference('2016014567')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelExtraAtHomeCOD()
    {
        $barcode = '3STBJG243556390';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelExtraAtHomeCODSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->addAmount((new Shipment\Amounts())
                ->setAmountType(Shipment\Amounts::TYPE_COD)
                ->setCurrency('EUR')
                ->setValue('10.00')
                ->setIBAN('NL91ABNA0417164300')
            )
            ->setContent('Media player')
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
                ->setVolume(30000)
            )
            ->setProductCodeDelivery(3792)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('003')
                ->setOption('003')
            )
            ->setReference('2016014567')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelExtraAtHomeMultiCollo()
    {
        $barcode = '3STBJG243556390';
        $barcode2 = '3STBJG243556391';

        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelExtraAtHomeMultiColloSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setContent('Media player')
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
                ->setVolume(30000)
            )
            ->addGroup((new Shipment\Group())
                ->setGroupCount(2)
                ->setGroupSequence(1)
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setMainBarcode($barcode)
            )
            ->setProductCodeDelivery(3628)
            ->setReference('2016014567')
            ->setRemark('remark')
        );
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode2)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setContent('Chair')
            ->setDimension((new Shipment\Dimension())
                ->setWeight(5200)
                ->setVolume(40000)
            )
            ->addGroup((new Shipment\Group())
                ->setGroupCount(2)
                ->setGroupSequence(2)
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setMainBarcode($barcode)
            )
            ->setProductCodeDelivery(3628)
            ->setReference('2016014567')
            ->setRemark('remark')
        );


        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelReturnLabel()
    {
        $barcode = '3STBJG243556390';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelReturnLabelSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->addAddress((new Address())
                ->setAddressType(Address::RETURN_ADDRESS)
                ->setName('Retour Partij')
                ->setZipcode('1402VV')
                ->setStreetHouseNrExt('Keizer ottostraat 86')
                ->setCity('Bussum')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
            )
            ->setProductCodeDelivery(3085)
            ->setReturnBarcode('3SRETR12345678')
            ->setReference('2016014567')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);

        $this->assertSame('Return Label', $response->getShipments()[0]['Labels'][1]['Labeltype']);
    }

    /**
     * @testx
     */
    public function generateSingleReturnLabel()
    {
        $barcode = '3STBJG243556390';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelSingleReturnLabelSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Retour Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
            )
            ->setProductCodeDelivery(2285)
            ->setReference('Return Reference')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
        $this->assertSame('Return Label', $response->getShipments()[0]['Labels'][0]['Labeltype']);
    }

    /**
     * @testx
     */
    public function generateSmartReturnLabel()
    {
        $barcode = '3STBJG243556390';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelSmartReturnLabelSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Retour Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
            )
            ->setProductCodeDelivery(2285)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('152')
                ->setOption('025')
            )
            ->setReference('Return Reference')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
        $this->assertSame('Return Label', $response->getShipments()[0]['Labels'][0]['Labeltype']);
    }


    /**
     * @testx
     */
    public function generateLabelMultiCollo()
    {

        $barcode = '3STBJG243556369';
        $barcode2 = '3STBJG243556370';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Labelling/GenerateLabelMultiColloSuccess.json')->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addGroup((new Shipment\Group())
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setGroupSequence(1)
                ->setGroupCount(2)
                ->setMainBarcode($barcode)
            )
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(450)
            )
            ->setProductCodeDelivery(3085)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        // 2nd collo
        $request->addShipment((new Shipment())
            ->addGroup((new Shipment\Group())
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setGroupSequence(2)
                ->setGroupCount(2)
                ->setMainBarcode($barcode2)
            )
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode2)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(450)
            )
            ->setProductCodeDelivery(3085)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertCount(2, $response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
        $this->assertSame($barcode2, $response->getShipments()[1]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateMultiLabel()
    {
        $barcode = '3STBJG243556390';
        $barcode2 = '3STBJG243556391';
        $barcode3 = '3STBJG243556392';

        $customer = $this->getCustomerEntity();

        $request = $this->getClient()->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF|MergeA');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Retour Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
            )
            ->setProductCodeDelivery(3085)
            ->setReference('Return Reference')
            ->setRemark('remark')
        );
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Another Shipment')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode2)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
            )
            ->setProductCodeDelivery(3085)
            ->setReference('Return Reference')
            ->setRemark('remark')
        );
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('And Another Shipment')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode3)
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
            )
            ->setProductCodeDelivery(3085)
            ->setReference('Return Reference')
            ->setRemark('remark')
        );

        $response = $request->send();
        $this->writeLabel($response, true);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getMergedLabels());
        $this->assertArrayHasKey('Barcodes', $response->getMergedLabels()[0]);
        $this->assertArrayHasKey('Labels', $response->getMergedLabels()[0]);
        $this->assertCount(3, $response->getMergedLabels()[0]['Barcodes']);
        $this->assertSame($barcode, $response->getMergedLabels()[0]['Barcodes'][0]);
        $this->assertSame($barcode2, $response->getMergedLabels()[0]['Barcodes'][1]);
        $this->assertSame($barcode3, $response->getMergedLabels()[0]['Barcodes'][2]);
    }

    /**
     * @testx
     */
    public function generateLabelCargoPickup()
    {
        $barcode = '3STBJG243556369';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient()->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->addAddress((new Address())
                ->setAddressType(Address::COLLECTION_ADDRESS)
                ->setName('Pickup adres')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode)
            ->setCollectionTimeStampStart(new \DateTime("12:00:00"))
            ->setCollectionTimeStampEnd(new \DateTime("12:00:00"))
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
            )
            ->setProductCodeDelivery(3610)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('135')
                ->setOption('001')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertCount(1, $response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelCargoPickupMultiCollo()
    {
        $barcode = '3STBJG243556369';
        $barcode2 = '3STBJG243556389';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient()->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->addAddress((new Address())
                ->setAddressType(Address::COLLECTION_ADDRESS)
                ->setName('Pickup adres')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode)
            ->setCollectionTimeStampStart(new \DateTime("12:00:00"))
            ->setCollectionTimeStampEnd(new \DateTime("12:00:00"))
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->addGroup((new Shipment\Group())
                ->setGroupCount(2)
                ->setGroupSequence(1)
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setMainBarcode($barcode)
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
            )
            ->setProductCodeDelivery(3610)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('135')
                ->setOption('001')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->addAddress((new Address())
                ->setAddressType(Address::COLLECTION_ADDRESS)
                ->setName('Pickup adres')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
            ->setBarcode($barcode2)
            ->setCollectionTimeStampStart(new \DateTime("12:00:00"))
            ->setCollectionTimeStampEnd(new \DateTime("12:00:00"))
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->addGroup((new Shipment\Group())
                ->setGroupCount(2)
                ->setGroupSequence(2)
                ->setGroupType(Shipment\Group::GROUPTYPE_MULTICOLLO)
                ->setMainBarcode($barcode)
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
            )
            ->setProductCodeDelivery(3610)
            ->addProductOption((new Shipment\ProductOption())
                ->setCharacteristic('135')
                ->setOption('001')
            )
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertCount(2, $response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
        $this->assertSame($barcode2, $response->getShipments()[1]['Barcode']);
    }

    /**
     * @testx
     */
    public function generateLabelGLobalpackCombilabel()
    {
        $barcode = '3STBJG243556369';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient()->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('Ontvangende Partij')
                ->setZipcode('310000')
                ->setStreetHouseNrExt('Nanjinglu 137')
                ->setCity('Shanghai')
                ->setCountryCode('CN')
                ->setRemark('3x bellen')
            )
            ->addAddress((new Address())
                ->setAddressType(Address::COLLECTION_ADDRESS)
                ->setName('Pickup adres')
                ->setZipcode('1411XC')
                ->setStreetHouseNrExt('Churchillstraat 22')
                ->setCity('Naarden')
                ->setRemark('3x bellen')
            )
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
            ->addContact((new Shipment\Contact())
                ->setEmail('sebastiaan@123lens.nl')
                ->setContactType('01')
                ->setSMSNr('0647128052')
            )
            ->setDimension((new Shipment\Dimension())
                ->setWeight(4500)
            )
            ->setDownPartnerBarcode('CC123456785NL')
            ->setProductCodeDelivery(4947)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->writeLabel($response);
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
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

    public function getDimensionEntity()
    {
        return (new Shipment\Dimension())
            ->setWeight(450)
        ;
    }
}
