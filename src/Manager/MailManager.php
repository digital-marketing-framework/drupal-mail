<?php

namespace Drupal\dmf_mail\Manager;

use DigitalMarketingFramework\Mail\Manager\MailManagerInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Mail\MailManagerInterface as DrupalMailManagerInterface;
use Symfony\Component\Mime\Email;

class MailManager implements MailManagerInterface
{
    public const MODULE = 'dmf_mail';

    public const KEY = 'dmf_mail';

    public function __construct(
        protected DrupalMailManagerInterface $mailManager,
        protected LanguageManagerInterface $languageManager,
    ) {
    }

    public function createMessage(): Email
    {
        return new Email();
    }

    public function sendMessage(Email $message): void
    {
        $toAddresses = $message->getTo();
        $to = implode(', ', array_map(fn($addr) => $addr->getAddress(), $toAddresses));

        // Use default language as fallback for CLI context where current language may not be set
        $langcode = $this->languageManager->getDefaultLanguage()->getId();

        $params = [
            'email' => $message,
        ];

        // Pass reply-to for Drupal API compatibility.
        $reply = null;
        $replyTo = $message->getReplyTo();
        if (!empty($replyTo)) {
            $reply = $replyTo[0]->toString();
        }

        $this->mailManager->mail(self::MODULE, self::KEY, $to, $langcode, $params, $reply);
    }
}
