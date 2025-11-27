<?php

namespace Drupal\dmf_mail\Registry\EventSubscriber;

use DigitalMarketingFramework\Mail\MailInitialization;
use Drupal\dmf_core\Registry\EventSubscriber\AbstractCoreRegistryUpdateEventSubscriber;

class CoreRegistryUpdateEventSubscriber extends AbstractCoreRegistryUpdateEventSubscriber
{
    public function __construct()
    {
        parent::__construct(new MailInitialization('dmf_mail'));
    }
}