<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_settings = array(
            array('id' => '12', 'key' => 'paypal_status', 'value' => 'active', 'created_at' => '2024-03-16 12:36:46', 'updated_at' => '2024-03-16 12:36:46'),
            array('id' => '13', 'key' => 'paypal_mode', 'value' => 'sandbox', 'created_at' => '2024-03-16 12:36:46', 'updated_at' => '2024-03-16 12:36:46'),
            array('id' => '14', 'key' => 'paypal_country', 'value' => 'US', 'created_at' => '2024-03-16 12:36:46', 'updated_at' => '2024-03-16 12:36:46'),
            array('id' => '15', 'key' => 'paypal_currency', 'value' => 'USD', 'created_at' => '2024-03-16 12:36:46', 'updated_at' => '2024-03-16 12:36:46'),
            array('id' => '16', 'key' => 'paypal_currency_rate', 'value' => '1', 'created_at' => '2024-03-16 12:36:46', 'updated_at' => '2024-03-16 12:36:46'),
            array('id' => '17', 'key' => 'paypal_client_id', 'value' => 'Ad9LOhEMaye0PPEUZOAE0aUE6wixnsEbebC1ykVy0iBJ48RWqBw5LGiKUvCoFMg-nDpXUzY12vxlK70M', 'created_at' => '2024-03-16 12:36:46', 'updated_at' => '2024-03-16 12:36:46'),
            array('id' => '18', 'key' => 'paypal_secret_key', 'value' => 'EMHmQpnCv9DFGrlX9_DAgaSzFdbo--QHjXabBHSd5B9SvBFGmu3NwMatCt60LpS08kyiHUriQUmvL5te', 'created_at' => '2024-03-16 12:36:46', 'updated_at' => '2024-03-16 12:36:46'),
            array('id' => '19', 'key' => 'paypal_app_key', 'value' => 'paypal_app_key', 'created_at' => '2024-03-16 12:36:46', 'updated_at' => '2024-03-16 12:36:46'),
            array('id' => '20', 'key' => 'stripe_status', 'value' => 'active', 'created_at' => '2024-03-17 01:37:17', 'updated_at' => '2024-03-17 01:37:17'),
            array('id' => '21', 'key' => 'stripe_country', 'value' => 'US', 'created_at' => '2024-03-17 01:37:17', 'updated_at' => '2024-03-17 01:37:17'),
            array('id' => '22', 'key' => 'stripe_currency', 'value' => 'USD', 'created_at' => '2024-03-17 01:37:17', 'updated_at' => '2024-03-17 01:37:17'),
            array('id' => '23', 'key' => 'stripe_currency_rate', 'value' => '1', 'created_at' => '2024-03-17 01:37:17', 'updated_at' => '2024-03-17 01:37:17'),
            array('id' => '24', 'key' => 'stripe_key', 'value' => 'pk_test_51Ov8K8P4KxxV8fqeFK0ywxzQJ6pdFYycWTCbMKDCdK5YIcVpxf31baDI7PhkCyh6WR7Ckq7SrjMlamK76eEsHjrQ00XQAX4PWE', 'created_at' => '2024-03-17 01:37:17', 'updated_at' => '2024-03-17 01:37:17'),
            array('id' => '25', 'key' => 'stripe_secret_key', 'value' => 'sk_test_51Ov8K8P4KxxV8fqe27iMFHeRpNjpwtBuGVeF8fN6K6kLXyMYmPsL9uNtQJQDgTRM39zkL9jxChQwqFr0Mu1iqcG400DzT44S2z', 'created_at' => '2024-03-17 01:37:17', 'updated_at' => '2024-03-17 01:37:17'),
            array('id' => '26', 'key' => 'razorpay_status', 'value' => 'active', 'created_at' => '2024-03-17 12:31:00', 'updated_at' => '2024-03-17 12:31:00'),
            array('id' => '27', 'key' => 'razorpay_country', 'value' => 'NG', 'created_at' => '2024-03-17 12:31:00', 'updated_at' => '2024-03-17 12:31:00'),
            array('id' => '28', 'key' => 'razorpay_currency', 'value' => 'NGN', 'created_at' => '2024-03-17 12:31:00', 'updated_at' => '2024-03-17 12:31:00'),
            array('id' => '29', 'key' => 'razorpay_currency_rate', 'value' => '1611.12', 'created_at' => '2024-03-17 12:31:00', 'updated_at' => '2024-03-17 12:31:00'),
            array('id' => '30', 'key' => 'razorpay_key', 'value' => 'app_key', 'created_at' => '2024-03-17 12:31:00', 'updated_at' => '2024-03-17 12:31:00'),
            array('id' => '31', 'key' => 'razorpay_secret_key', 'value' => 'secret_key', 'created_at' => '2024-03-17 12:31:00', 'updated_at' => '2024-03-17 12:31:00'),
            array('id' => '32', 'key' => 'razorpay_key', 'value' => 'rzp_test_K7CipNQYyyMPiS', 'created_at' => '2024-03-17 15:23:55', 'updated_at' => '2024-03-17 15:23:55'),
            array('id' => '33', 'key' => 'razorpay_secret_key', 'value' => 'zSBmNMorJrirOrnDrbOd1ALO', 'created_at' => '2024-03-17 15:23:55', 'updated_at' => '2024-03-17 15:23:55')
        );

        \DB::table('payment_settings')->insert($payment_settings);
    }
}
