<?php

include_once(CLASSFOLDER . "/email_message.php");  // Including the mail class

class sendmailclass {

    var $mailObj;

    /* ----------------------------------------------------------- */

    function __construct() {
        $this->mailObj = new email_message_class;
    }

    /* ----------------------------------------------------------- */

    function sendHtmlEMail($from_address, $from_name, $to_name, $to_address, $subject, $html_message, $text_message, $cc_address = null, $cc_name = null, $bcc_address = null, $bcc_name = null) {
        $reply_name = $from_name;
        $reply_address = $from_address;
        $error_delivery_name = $from_name;
        $error_delivery_address = $from_address;
        $this->mailObj->SetEncodedEmailHeader("To", $to_address, $to_name);
        !empty($bcc_address) ? $this->mailObj->SetEncodedEmailHeader("Bcc", $bcc_address, $bcc_name) : '';
        !empty($cc_address) ? $this->mailObj->SetEncodedEmailHeader("cc", $cc_address, $cc_name) : '';
        $this->mailObj->SetEncodedEmailHeader("From", $from_address, $from_name);
        $this->mailObj->SetEncodedEmailHeader("Reply-To", $reply_address, $reply_name);
        $this->mailObj->SetHeader("Sender", $from_address);

        if (defined("PHP_OS") && strcmp(substr(PHP_OS, 0, 3), "WIN"))
            $this->mailObj->SetHeader("Return-Path", $error_delivery_address);

        $this->mailObj->SetEncodedHeader("Subject", $subject);

        $this->mailObj->CreateQuotedPrintableHTMLPart($html_message, "", $html_part);

        $this->mailObj->CreateQuotedPrintableTextPart($this->mailObj->WrapText($text_message), "", $text_part);

        $alternative_parts = array(
            $text_part,
            $html_part
        );
        $this->mailObj->AddAlternativeMultipart($alternative_parts);
        $error = $this->mailObj->Send();       
        $error = $this->mailObj->Send();echo "testmail";
        var_dump($error);
        if (strcmp($error, ""))
            return $error;
        else
            return true;
    }

    /* ------------------------------------------------------ */
}