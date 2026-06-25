<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Account;
use Illuminate\Support\Facades\Hash;

$email = 'admin.test11@pleco.com';
$account = Account::where('email', $email)->first();

if ($account) {
    $account->password = Hash::make('Password123!');
    $account->save();
    echo "SUCCESS: Password for {$email} has been updated to 'Password123!'\n";
} else {
    echo "ERROR: Account with email {$email} not found.\n";
}
