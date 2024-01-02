<?php

    namespace DarkSide\DsGprdCookie\Exception;

    use PrestaShopExceptionCore;

    class MissingServiceException extends PrestaShopExceptionCore
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
