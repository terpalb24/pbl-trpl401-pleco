<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$account = App\Models\Account::where('email', 'operator@pleco.com')->first();
if ($account) {
    echo "Role: '" . $account->role . "'\n";
    echo "Role type: " . gettype($account->role) . "\n";
} else {
    echo "Account not found.\n";
}
