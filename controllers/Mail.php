<?php
/**
 * This file defines the class controllers\Mail.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tools
 */

namespace controllers;

/**
 * This class simplifies the creation and sending of an email.
 */
class Mail {

  /**
   * Receiver, or receivers of the mail.
   * @var string
   */
  private $to;

  /**
   * Subject of the email to be sent.
   * @var string
   */
  private $subject;

  /**
   * Mail HTML message.
   * @var string
   */
  private $message;

  /**
   * Mail adresse of the recipient(s).
   * @var string
   */
  private $from;

  /**
   * Mail signature.
   * @var string
   */
  private $signature;

  /**
   * Send the email.
   * @return void
   */
  public function send() {
    $html = $this->message . "\n" . $this->signature;
    $text = preg_replace("/\n\s+/", "\n", rtrim(html_entity_decode(strip_tags($html))));
    $boundary = md5(uniqid(rand()));
    $message = "This is multipart message using MIME\n";
    $message .= "------=_NextPart_" . $boundary . "\n";
    $message .= "Content-Type: text/plain; charset=utf-8\n";
    $message .= "Content-Transfer-Encoding: 7bit". "\n\n";
    $message .= $text . "\n\n";
    $message .= "------=_NextPart_" . $boundary . "\n";
    $message .= "Content-Type: text/html; charset=utf-8\n";
    $message .= "Content-Transfer-Encoding: 7bit". "\n\n";
    $message .= $html . "\n";
    $message .= "------=_NextPart_" . $boundary . "--";
    $headers = 'MIME-Version: 1.0' .  "\r\n" .
               "Content-Type: multipart/alternative; boundary=\"----=_NextPart_" . $boundary . "\"" .  "\r\n" .
               "List-Unsubscribe: <mailto: " . $this->from . "?subject=unsubscribe>" . "\r\n" .
               'From: ' . $this->from . "\r\n" .
               'Return-Path: ' . $this->from . "\r\n" .
               'Reply-To: ' . $this->from . "\r\n" ;
    if (filter_var($this->to, FILTER_VALIDATE_EMAIL) == FALSE) {
      throw new \Exception("Wrong format");
    }
    $domain = substr($this->to, strpos($this->to, '@') + 1);
    if  (checkdnsrr($domain) == FALSE) {
      throw new \Exception("Wrong DNS");
    }
    if (!mail($this->to, $this->subject, $message, $headers)) {
      throw new \Exception("Erro while sending email.");
    };
  }

  /**
   * Create the mail object.
   * @param string $to Receiver, or receivers of the mail.
   * @param string $subject Subject of the email to be sent.
   * @param string $html HTML message.
   * @return self
   */
  public function __construct($to, $subject, $message) {
    $this->to = $to;
    $this->subject = $subject;
    $this->message = $message;
    $this->from = 'contact@' . $_SERVER['HTTP_HOST'];
    $this->signature = $signature = <<<END
    <br><br>
    <a href="https://{$_SERVER['HTTP_HOST']}">
      <img style="margin:0.5em 0 0 0; padding:0; border:none; background:none; width:13em;"
           src="https://{$_SERVER['HTTP_HOST']}/permanent/signature.png"
           alt="Signature"
           moz-do-not-send="true">
    </a>
    END;
  }

}
