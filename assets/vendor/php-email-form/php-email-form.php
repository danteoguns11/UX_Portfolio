<?php
class PHP_Email_Form {
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $ajax;
    private $messages = array();
    public $smtp = array();

    public function add_message($message, $label, $priority = 0) {
        $this->messages[] = array(
            'message' => $message,
            'label' => $label,
            'priority' => $priority
        );
    }

    public function send() {
        $message_body = "";

        usort($this->messages, function($a, $b) {
            return $a['priority'] <=> $b['priority'];
        });

        foreach ($this->messages as $message) {
            $message_body .= $message['label'] . ": " . $message['message'] . "\n";
        }

        $headers = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n" .
                   "Reply-To: " . $this->from_email . "\r\n" .
                   "Content-Type: text/plain; charset=UTF-8\r\n";

        if (!empty($this->smtp)) {
            // Configure and use SMTP if set
            ini_set("SMTP", $this->smtp['host']);
            ini_set("smtp_port", $this->smtp['port']);
            ini_set("sendmail_from", $this->smtp['username']);
            ini_set("auth_username", $this->smtp['username']);
            ini_set("auth_password", $this->smtp['password']);
        }

        $success = mail($this->to, $this->subject, $message_body, $headers);

        if ($success) {
            return "Your message has been sent successfully.";
        } else {
            return "There was an error sending your message.";
        }
    }
}
?>
