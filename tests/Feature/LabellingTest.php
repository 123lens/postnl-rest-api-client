<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Customer;
use Budgetlens\PostNLApi\Entities\Shipment;
use Budgetlens\PostNLApi\Messages\Responses\Labelling\GenerateLabelResponse;
use Tests\TestCase;

class LabellingTest extends TestCase
{
    /**
     * @testx
     */
    public function generateLabelNoConfirm()
    {

        $barcode = '3STBJG243556367';
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
        $response = $request->send();
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

        $request = $this->getClient()->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->setDownPartnerID('PNPNL-01')
            ->setDownPartnerLocation('162060')
            ->addAddress((new Address())
                ->setAddressType(Address::DELIVERY_ADDRES)
                ->setName('S. Blaas')
                ->setCompanyName('Plus Bos Naarden')
                ->setZipcode('1411TC')
                ->setHouseNr(78)
                ->setCity('Naarden')
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
            ->setProductCodeDelivery(3533)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
        );
        $response = $request->send();
        $this->assertInstanceOf(GenerateLabelResponse::class, $response);
        $this->assertIsArray($response->getShipments());
        $this->assertArrayHasKey('Labels', $response->getShipments()[0]);
        $this->assertSame($barcode, $response->getShipments()[0]['Barcode']);
//        $filename = 'label.pdf';
//        file_put_contents($filename, base64_decode($response->getShipments()[0]['Labels'][0]['Content']));
    }

    /**
     * @testx
     */
    public function generateLabelPickupBE()
    {

        $barcode = '3SDEVC0013543';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient()->labelling()->generateLabelWithoutConfirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->setDownPartnerID('PNPBE-01')
            ->setDownPartnerLocation('BE0Q82')
            ->addAddress((new Address())
                ->setAddressType(Address::DELIVERY_ADDRES)
                ->setName('S. Blaas')
                ->setCompanyName('PostNL')
                ->setZipcode('2018')
                ->setHouseNr(4)
                ->setCity('Antwerpen')
                ->setCountryCode('BE')
            )
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setName('S. Blaas')
                ->setZipcode('2000')
                ->setStreetHouseNrExt('Klapdorp 15')
                ->setCountryCode('BE')
                ->setCity('Antwerpen')
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
            ->setProductCodeDelivery(4932)
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
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
            ->setCustomerOrderNumber('1234test')
            ->setReference('1234testref')
            ->setRemark('remark')
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
    public function generateLabelSundayDelivery()
    {
        $barcode = '3STBJG243556377';
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

        $request = $this->getClient()->labelling()->generateLabelWithoutConfirm();
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

        $request = $this->getClient()->labelling()->generateLabelWithoutConfirm();
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

        $request = $this->getClient()->labelling()->generateLabelWithoutConfirm();
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
     * @test
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
                ->setCompanyName('123 Lens')
                ->setCity('Gouda')
                ->setCountryCode("NL")
                ->setHouseNr(3)
                ->setZipcode('2802AC')
                ->setStreet('Industriestraat')
            )
            ->setCollectionLocation(getenv('COLLECTION_LOCATION'))
            ->setCustomerCode(getenv('CUSTOMER_CODE'))
            ->setCustomerNumber(getenv('CUSTOMER_NUMBER'))
            ->setEmail('info@123lens.nl');
    }
}
