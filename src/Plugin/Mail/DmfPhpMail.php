<?php

namespace Drupal\dmf_mail\Plugin\Mail;

use Drupal\Core\Mail\Attribute\Mail;
use Drupal\Core\Mail\MailFormatHelper;
use Drupal\Core\Mail\Plugin\Mail\PhpMail;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Extends the default Drupal mail backend to support HTML email.
 *
 * This mail plugin preserves HTML content when the 'html' parameter is set,
 * instead of converting it to plain text like the default PhpMail plugin.
 */
#[Mail(
  id: 'dmf_php_mail',
  label: new TranslatableMarkup('Anyrel PHP mailer'),
  description: new TranslatableMarkup("Sends the message as plain text or HTML, using PHP's native mail() function."),
)]
class DmfPhpMail extends PhpMail {

  /**
   * {@inheritdoc}
   */
  public function format(array $message) {
    // Join the body array into one string.
    $message['body'] = implode("\n\n", $message['body']);

    // If HTML flag is set, preserve HTML content.
    if (!empty($message['params']['html'])) {
      return $message;
    }

    // For plain text emails, wrap the body for proper formatting.
    $message['body'] = MailFormatHelper::wrapMail($message['body']);

    return $message;
  }

}
