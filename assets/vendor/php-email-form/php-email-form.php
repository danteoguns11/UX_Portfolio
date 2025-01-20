<?php

class PHP_Email_Form {
  public $ajax = false;
  public $to = '';
  public $from_name = '';
  public $from_email = '';
  public $subject = '';
  public $smtp = array();
  private $messages = array();

  public function add_message($content, $label = '', $length = 0) {
    $this->messages[] = array('content' => $content, 'label' => $label, 'length' => $length);
  }

  public function send() {
    if (empty($this->to) || empty($this->from_email)) {
      return false;
    }

    $email_content = "";
    foreach ($this->messages as $message) {
      $email_content .= $message['label'] . ": " . $message['content'] . "\n";
    }

    $headers = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n";
    $headers .= "Reply-To: " . $this->from_email . "\r\n";

    if ($this->ajax) {
      return mail($this->to, $this->subject, $email_content, $headers);
    } else {
      return mail($this->to, $this->subject, $email_content, $headers);
    }
  }
}

?>
