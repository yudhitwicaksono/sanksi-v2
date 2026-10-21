<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'admin@sman8bandung.sch.id';
    public string $fromName   = 'Bagian Kedisiplinan SMAN 8 Bandung';
    public string $recipients = '';

    /**
     * The "user agent"
     */
    public string $userAgent = 'CodeIgniter 4 SMAN8';

    /**
     * The mail sending protocol: mail, sendmail, smtp
     */
    public string $protocol = 'smtp';

    /**
     * The server path to Sendmail.
     */
    public string $mailPath = '/usr/sbin/sendmail';

    /**
     * SMTP Server Hostname
     */
    public string $SMTPHost = 'smtp.gmail.com';

    /**
     * SMTP Username
     */
    public string $SMTPUser = '';

    /**
     * SMTP Password
     */
    public string $SMTPPass = '';

    /**
     * SMTP Port
     */
    public int $SMTPPort = 587;

    /**
     * SMTP Timeout (in seconds)
     */
    public int $SMTPTimeout = 15;

    /**
     * Enable persistent SMTP connections
     */
    public bool $SMTPKeepAlive = false;

    /**
     * SMTP Encryption.
     *
     * @var string '', 'tls' or 'ssl'. 'tls' will issue a STARTTLS command
     *             to the server. 'ssl' means implicit SSL. Connection on port
     *             465 should set this to ''.
     */
    public string $SMTPCrypto = 'tls';

    /**
     * Enable word-wrap
     */
    public bool $wordWrap = true;

    /**
     * Character count to wrap at
     */
    public int $wrapChars = 76;

    /**
     * Type of mail, either 'text' or 'html'
     */
    public string $mailType = 'html';

    /**
     * Character set (utf-8, iso-8859-1, etc.)
     */
    public string $charset = 'UTF-8';

    /**
     * Whether to validate the email address
     */
    public bool $validate = true;

    /**
     * Email Priority. 1 = highest. 5 = lowest. 3 = normal
     */
    public int $priority = 3;

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $CRLF = "\r\n";

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $newline = "\r\n";

    /**
     * Enable BCC Batch Mode.
     */
    public bool $BCCBatchMode = false;

    /**
     * Number of emails in each BCC batch
     */
    public int $BCCBatchSize = 200;

    /**
     * Enable notify message from server
     */
    public bool $DSN = false;

    public function __construct()
    {
        parent::__construct();

        // Otomatis membaca konfigurasi dari .env jika tersedia
        if ($fromEmail = env('email.fromEmail')) {
            $this->fromEmail = $fromEmail;
        }
        if ($fromName = env('email.fromName')) {
            $this->fromName = $fromName;
        }
        if ($protocol = env('email.protocol')) {
            $this->protocol = $protocol;
        }
        if ($host = env('email.SMTPHost')) {
            $this->SMTPHost = $host;
        }
        if ($user = env('email.SMTPUser')) {
            $this->SMTPUser = $user;
        }
        if ($pass = env('email.SMTPPass')) {
            $this->SMTPPass = $pass;
        }
        if ($port = env('email.SMTPPort')) {
            $this->SMTPPort = (int)$port;
        }
        if ($crypto = env('email.SMTPCrypto')) {
            $this->SMTPCrypto = $crypto;
        }
        if ($mailType = env('email.mailType')) {
            $this->mailType = $mailType;
        }
        if ($timeout = env('email.SMTPTimeout')) {
            $this->SMTPTimeout = (int)$timeout;
        }
    }
}
