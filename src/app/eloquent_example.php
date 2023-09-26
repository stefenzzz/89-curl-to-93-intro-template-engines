<?php

declare(strict_types = 1);





use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ .'/../vendor/autoload.php';
require __DIR__.'/../eloquent.php';


$invoiceId = 7;


$invoices = Capsule::table('invoices')->where('status', InvoiceStatus::Paid)->get()->each(function(stdClass $invoice){
    echo $invoice->id .', '. $invoice->status. ', '. $invoice->created_at;

});



echo PHP_EOL;
// === check the sql
echo Invoice::query()->where('status','=',InvoiceStatus::Paid)->toSql(). PHP_EOL;



// ============ updates the status to paid
//  echo Invoice::query()->where('id','=',$invoiceId)->update(['status' => InvoiceStatus::Paid]);

Invoice::query()->where('status','=',InvoiceStatus::Paid)->get()->each(function(Invoice $invoice){
 
    echo $invoice->id .', '. $invoice->status->toString(). ', '. $invoice->created_at->format('m/d/Y'). PHP_EOL;

    var_dump('ID ='.$invoice->items->first()->id);
});



// ============ add 3 invoice_items and associate each with 1 invoice


// Capsule::connection()->transaction(function(){

//     $invoice = new Invoice();

//     $invoice->amount = 45;
//     $invoice->invoice_number = '1';
//     $invoice->status = InvoiceStatus::Pending;
//     $invoice->due_date = (new Carbon())->addDays(10);
//     $invoice->save();

//     $items = [['item 1', 1 ,15], ['item 2', 2, 7.5], ['item 3', 4, 3.75]];

//     foreach($items as [$description, $quantity, $unitPrice]){
//         $item = new InvoiceItem();

//         $item->description = $description;
//         $item->quantity = $quantity;
//         $item->unit_price = $unitPrice;

//         $item->invoice()->associate($invoice);
//         $item->save();
//     }


// });


