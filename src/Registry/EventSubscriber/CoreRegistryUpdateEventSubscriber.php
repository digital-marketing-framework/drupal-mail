<?php

namespace Drupal\dmf_mail\Registry\EventSubscriber;

use DigitalMarketingFramework\Mail\MailInitialization;
use DigitalMarketingFramework\Mail\Manager\MailManagerInterface;
use Drupal\dmf_core\Registry\EventSubscriber\AbstractCoreRegistryUpdateEventSubscriber;

class CoreRegistryUpdateEventSubscriber extends AbstractCoreRegistryUpdateEventSubscriber
{
    public function __construct(MailManagerInterface $mailManager)
    {
        parent::__construct(new MailInitialization($mailManager, 'dmf_mail'));
    }
}
