<?php


namespace Magenest\Movie\Plugin\Cart;


class CartImage
{
    private $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
//    public function afterGetImage($product, $imageId, $attributes = []){
////        $this->logger->debug('done!!!!!!!!!!!!!1');
////        return $this->imageBuilder->create($product, $imageId, $attributes);
//    }
}
