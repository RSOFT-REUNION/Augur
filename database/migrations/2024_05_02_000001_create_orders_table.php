<?php

use App\Models\Orders\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        //['en attente de paiement',
        // 'paiement accepté',
        // 'en cours de préparation',
        // 'prêt pour livraison',
        // 'en cours de livraison',
        // 'annulé',
        // 'livré',
        // 'remboursé']
        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('en attente de paiement');
            $table->timestamps();
        });


        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->enum('delivery_type', ['livraison à domicile', 'retrait en magasin'])->default('retrait en magasin');
            $table->string('delivery_location');
            $table->foreignIdFor(Status::class)->default(1)->constrained('order_status');
            $table->foreignIdFor(\App\Models\Users\User::class)->constrained();
            $table->string('total');
            $table->timestamps();
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Catalog\Product::class)->constrained('catalog_products');
            $table->string('weight_unit')->default('Kilogramme')->nullable(); // Kilogramme ou Litre
            $table->double('weight')->default('0.00');
            $table->string('unite_vente')->default('Unité'); // Unité de vente. valeurs possibles: Unité, ou  ou Litre, pour le vrac
            $table->integer('price_ht')->nullable();
            $table->integer('tva')->nullable();
            $table->integer('price_ttc')->nullable();
            $table->integer('quantity')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_status');
    }
};
