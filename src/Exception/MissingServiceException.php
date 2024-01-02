<?php

    namespace DarkSide\DsGprdCookie\Exception;

    use PrestaShop\PrestaShop\Core\Exception\PrestaShopException;

    class MissingServiceException extends PrestaShopException
    {
        /**
         * @param string $service
         */
        public function __construct($service)
        {
            $message = 'Can\'t find the service:' . $service;
            parent::__construct($message);
        }
    }
