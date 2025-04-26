<?php
/**
 * Fetch all emails from dbpersons matching a given type.
 *
 * @param string $type  e.g. 'volunteer', 'admin', 'board', 'donator', 'participant'
 * @return array       List of email strings
 */
function getEmailsByType(string $type): array {
    include_once('database/dbinfo.php');
    $conn = connect();
    $stmt = $conn->prepare("SELECT email FROM dbpersons WHERE type = ?");
    $stmt->bind_param('s', $type);
    $stmt->execute();
    $res = $stmt->get_result();
    $emails = [];
    while ($row = $res->fetch_assoc()) {
        $emails[] = $row['email'];
    }
    $stmt->close();
    $conn->close();
    return $emails;
}

/**
 * Fetch every email in dbpersons.
 *
 * @return array
 */
function getAllEmails(): array {
    include_once('database/dbinfo.php');
    $conn = connect();
    $res  = $conn->query("SELECT email FROM dbpersons");
    $emails = [];
    while ($row = $res->fetch_assoc()) {
        $emails[] = $row['email'];
    }
    $conn->close();
    return $emails;
}

/**
 * Send emails to all volunteers.
 */
function emailVolunteer(string $fromUser, string $subject, string $body): array {
    $list = getEmailsByType('volunteer');
    return sendEmails($list, $fromUser, $subject, $body);
}

/**
 * Send emails to all admins.
 */
function emailAdmin(string $fromUser, string $subject, string $body): array {
    $list = getEmailsByType('admin');
    return sendEmails($list, $fromUser, $subject, $body);
}

/**
 * Send emails to all board members.
 */
function emailBoardMember(string $fromUser, string $subject, string $body): array {
    $list = getEmailsByType('board');
    return sendEmails($list, $fromUser, $subject, $body);
}

/**
 * Send emails to all donors.
 */
function emailDonor(string $fromUser, string $subject, string $body): array {
    $list = getEmailsByType('donor');
    return sendEmails($list, $fromUser, $subject, $body);
}

/**
 * Send emails to all participants.
 */
function emailParti(string $fromUser, string $subject, string $body): array {
    $list = getEmailsByType('participant');
    return sendEmails($list, $fromUser, $subject, $body);
}

/**
 * Send emails to every email in the table.
 */
function emailAll(string $fromUser, string $subject, string $body): array {
    $list = getAllEmails();
    return sendEmails($list, $fromUser, $subject, $body);
}

/**
 * Send emails to each address in the supplied list.
 *
 * @param array  $emails   List of recipient email addresses.
 * @param string $fromUser Local-part for the From address.
 * @param string $subject  Email subject.
 * @param string $body     Email body.
 * @return array           Returns an  array where keys are emails and values are boolean statuses.
 */
function sendEmails(array $emails, string $fromUser, string $subject, string $body): array {
    //not sure which one is correct
    //$domain = 'jenniferp161.sg-host.com';
    $domain = 'gvam1012.siteground.biz';
    $fromAddress = "{$fromUser}@{$domain}";
    
    // Simplified headers – only include essential information.
       $headers = "From: {$fromAddress}\r\n";
    
    $results = [];
    foreach ($emails as $email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Pass the composed headers to the mail() function
            $results[$email] = mail($email, $subject, $body, $headers);
        } else {
            $results[$email] = false;
        }
    }
    return $results;
}

/**
 * Send a verification code email to the given address and store it in the database.
 */
function sendVerification(string $emailAddress): bool {
    include_once('database/dbinfo.php');
    $conn = connect();

    $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

    // Insert code into verification table
    $stmt = $conn->prepare("INSERT INTO verification (email, code, confirmed) VALUES (?, ?, false)");
    $stmt->bind_param("ss", $emailAddress, $code);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();

    if (!$success) {
        return false;
    }

    // Use sendEmails to deliver the verification message
    $subject = "NAMIRAPP VERIFICATION CODE";
    $body = "Your code to submit an application is {$code}.";
    $result = sendEmails([$emailAddress], "noreply", $subject, $body);

    return $result[$emailAddress] ?? false;
}



/**
 * Send an account approval email to the given address.
 *
 * @param string $emailAddress  The recipient’s email address.
 * @param string $id            The user’s account name or ID.
 * @return bool                 True on success, false on failure.
 */
function sendApproval(string $emailAddress, string $id): bool {
    // Subject line for the approval email
    $subject = "Your NAMIRAPP Account Is Approved";

    // Email body
    $body = "Congrats, your NAMIRAPP account is approved. We hope we can do great work together!\n\n"
          . "Your account name is: {$id}" . " \n Trouble logging in? Contact info@namirapp.org for help.\n\n";

    // Use your existing sendEmails helper to deliver this message
    $results = sendEmails([$emailAddress], "noreply", $subject, $body);

    // Return the boolean result for this address
    return $results[$emailAddress] ?? false;
}



?>
