<?php

use App\Models\Orders\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('en attente de paiement');
            $table->timestamps();
        });

        Status::create(['status' => 'en attente de paiement']);
        Status::create(['status' => 'annulé']);
        Status::create(['status' => 'paiement accepté']);
        Status::create(['status' => 'en cours de préparation']);
        Status::create(['status' => 'prêt pour livraison']);
        Status::create(['status' => 'en cours de livraison']);
        Status::create(['status' => 'livré']);
        Status::create(['status' => 'remboursé']);

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Status::class)->default(1)->constrained('order_status');
            $table->foreignIdFor(\App\Models\Users\User::class)->constrained();
            $table->string('ref_order'); // pour le lien SAP/EBP
            $table->integer('total_ttc')->nullable();
            $table->integer('delivery_id')->nullable();
            $table->integer('delivery_price')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('delivery_slot')->nullable();
            $table->integer('user_loyality_used')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_delivery_address')->nullable();
            $table->string('user_delivery_address2')->nullable();
            $table->string('user_delivery_cities')->nullable();
            $table->string('user_delivery_phone')->nullable();
            $table->string('user_delivery_other_phone')->nullable();
            $table->string('user_civilite')->nullable();
            $table->string('user_first_name')->nullable();
            $table->string('user_last_name')->nullable();
            $table->date('user_birthday')->nullable();
            $table->string('user_invoice_address')->nullable();
            $table->string('user_invoice_address2')->nullable();
            $table->string('user_invoice_cities')->nullable();
            $table->string('user_invoice_phone')->nullable();
            $table->string('user_invoice_other_phone')->nullable();
            $table->string('user_invoice_civilite')->nullable();
            $table->string('user_invoice_first_name')->nullable();
            $table->string('user_invoice_last_name')->nullable();
            $table->timestamps();
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Catalog\Product::class)->constrained('catalog_products');
            $table->string('weight_unit')->default('kg')->nullable(); // Kilogramme ou Litre
            $table->double('weight')->default('0.00');
            $table->string('stock_unit')->default('unit'); // Unité de vente. valeurs possibles: Unité, ou  ou Litre, pour le vrac
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
