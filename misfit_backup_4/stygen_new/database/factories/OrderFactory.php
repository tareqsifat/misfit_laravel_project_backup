<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\DateTime;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'orderId'        => $this->faker->randomDigit(),
            'shipping_id'       => $this->faker->randomDigit(),
            'user_id'          => function(){
                return User::all()->random();
            },
            'customer_id'      => $this->faker->randomDigit(),
            'ship_to_gift'          => function(){
                return rand(1, 2);
            },
            'shipping_agent_id'       => $this->faker->randomDigit(),
            'invoice_last_digit' => $this->faker->randomDigit(),
            'invoice_no'  => $this->faker->randomDigit(),
            'invoice_no_old'  => $this->faker->randomDigit(),
            'invoice_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'delivery_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'payment_type'  => function(){
                return rand(1, 7);
            },
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'notes' => $this->faker->text(),
            'admin_note' => $this->faker->text(),
            'personal_notes' => $this->faker->text(),
            'card_id' => function(){
                return rand(1, 7);
            },
            'card_price' => function(){
                return rand(50, 250);
            },
            'packaging_id' => function(){
                return rand(1, 7);
            },
            'packaging_price' => function(){
                return rand(50, 250);
            },
            'total_amount' => function() {
                return rand(150, 10550);
            },
            'coupon_code' => Str::random(8),
            'coupon_amount' => function () {
                return rand(50, 550);
            },
            'discount_amount' => function () {
                return rand(50, 550);
            },
            'shipping_charge_id' => function () {
                return rand(1, 10);
            },
            'shipping_charge' => function () {
                return rand(50, 150);
            },
            'total_vat' => function () {
                return rand(0, 5);
            },
            'net_receiveable_amount' => function(){
                return rand(150, 10550);
            },
            'collect_amount' => function(){
                return rand(150, 10550);
            },
            'return_amount' => function(){
                return rand(150, 10550);
            },
            'due_amount' => function(){
                return rand(150, 10550);
            },
            'transaction_id' => Str::random(8),
            'currency' => 'BDT',
            'status' => 'Pending',
            'shipping_status_id' => function(){
                return rand(1, 7);
            },
        ];
    }
}
