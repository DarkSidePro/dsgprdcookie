<?php

    namespace DarkSide\DsGprdCookie\Exception;

    use PrestaShopExceptionCore;

    class WrongCommandOutputException extends PrestaShopExceptionCore
    {

        public function __construct()
        {
            $message = 'Command dsgprd:build return wrong output';
            parent::__construct($message);
        }
    }
