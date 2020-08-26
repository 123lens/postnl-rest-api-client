<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Labelling;

/**
 * Abstract Labelling Request
 *
 */
use Budgetlens\PostNLApi\Messages\Requests\AbstractRequest;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\Barcode\GenerateBarcodeResponse;
use Budgetlens\PostNLApi\Entities\Message;

abstract class AbstractLabellingRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    private $availablePrinters = [
        'GraphicFile|GIF 200 dpi',
        'GraphicFile|GIF 300 dpi',
        'GraphicFile|GIF 600 dpi',
        'GraphicFile|JPG 200 dpi',
        'GraphicFile|JPG 300 dpi',
        'GraphicFile|JPG 600 dpi',
        'GraphicFile|PDF',
        'GraphicFile|PDF|MergeA',
        'GraphicFile|PDF|MergeB',
        'GraphicFile|PDF|MergeC',
        'GraphicFile|PDF|MergeD',
        'Zebra|Generic ZPL II 200 dpi',
        'Zebra|Generic ZPL II 300 dpi',
        'Zebra|Generic ZPL II 600 dpi'
    ];

    /**
     * Get Printer Type
     * @return string
     */
    public function getPrinter(): string
    {
        return $this->getParameter('printer');
    }

    /**
     * Set Printer
     * @param string $printer
     * @return GenerateLabelRequest
     */
    public function setPrinter(string $printer)
    {
        $this->validOption($printer, $this->availablePrinters);
        return $this->setParameter('printer', $printer);
    }

    /**
     * Get Message Entity
     * @return Message
     */
    public function getMessage(): Message
    {
        $message = new Message();
        $message->setPrinterType($this->getPrinter());
        return $message;
    }
}
