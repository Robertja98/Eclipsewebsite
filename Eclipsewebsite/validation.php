function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidPhone($phone) {
    return preg_match('/^\+?[0-9\s\-]{7,15}$/', $phone);
}

function validateContact($row) {
    return isset($row['first_name'], $row['last_name'], $row['email']) &&
           isValidEmail($row['email']) &&
           isValidPhone($row['phone']);
}
