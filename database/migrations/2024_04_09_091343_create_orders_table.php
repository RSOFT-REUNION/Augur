<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->enum('delivery_type', ['livraison à domicile', 'retrait en magasin'])->default('retrait en magasin');
            $table->string('delivery_location');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->string('total');
            $table->enum('status', ['en attente de paiement', 'paiement accepté', 'en cours de préparation', 'prêt pour livraison', 'en cours de livraison', 'annulé', 'livré', 'remboursé'])->default('en attente de paiement');
            $table->timestamps();
        });

        /*** Ajout des permisions **/
        $permissions = [
            [
                'category' => 'Orders',
                'group_name' => 'Orders',
                'permissions' => [
                    'orders.orders.create',
                    'orders.orders.update',
                    'orders.orders.delete',
                ],
            ]
        ];
        addPermissions($permissions);
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
