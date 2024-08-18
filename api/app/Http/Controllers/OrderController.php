<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderInfoMail;
use Sprain\SwissQrBill as QrBill;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function order(Request $request)
    {

        $validated = $request->validate([
            'pfadiname' => 'nullable',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'delivery_first_name' => 'required',
            'delivery_last_name' => 'required',
            'delivery_street' => 'required',
            'delivery_zip' => 'required',
            'delivery_town' => 'required',
            'quantity' => 'required|integer|in:20,50,100',
        ]);
        $validated['order_nr'] = uniqid("Pfaditechnik_");
        $validated['amount'] = $this->callculatePrice($validated['quantity']);


        $order = Order::create($validated);

        
        $qrBill = $this->generateQrBill($order);


        $filePath = 'QR_Bill-' . $order->order_nr . '.pdf';
        $storagePath = Storage::path($filePath);
        $fpdf = new \Fpdf\Fpdf('P', 'mm', 'A4');
        $fpdf->AddPage();
        $output = new QrBill\PaymentPart\Output\FpdfOutput\FpdfOutput($qrBill, 'de', $fpdf);
        $output->setPrintable(false)->getPaymentPart();
        $fpdf->Output($storagePath, 'F');



        Mail::to($order->email)->send(new OrderConfirmationMail($order, $filePath));
        Mail::to(config('app.creditor.email'))->send(new OrderInfoMail($order));


        return response()->json(['message' => 'Order placed successfully and confirmation email sent.'], 201);
    }

    private function generateQrBill(Order $order)
    {

        $qrBill = QrBill\QrBill::create();


        $qrBill->setCreditor(
            QrBill\DataGroup\Element\CombinedAddress::create(
                config('app.creditor.name'),
                config('app.creditor.street'),
                config('app.creditor.zip'). " ".config('app.creditor.town'),
                config('app.creditor.country')
            )
        );

        $qrBill->setCreditorInformation(
            QrBill\DataGroup\Element\CreditorInformation::create(
                config('app.creditor.iban'),
            )
        );


        $qrBill->setUltimateDebtor(
            QrBill\DataGroup\Element\CombinedAddress::create(
                $order->first_name . ' ' . $order->last_name,
                $order->delivery_street,
                $order->delivery_zip . " " . $order->delivery_town,
                config('app.creditor.country')
            )
        );


        $qrBill->setPaymentAmountInformation(
            QrBill\DataGroup\Element\PaymentAmountInformation::create(
                'CHF',
                $order->amount
            )
        );
        $qrBill->setPaymentReference(
            QrBill\DataGroup\Element\PaymentReference::create(
                QrBill\DataGroup\Element\PaymentReference::TYPE_NON
            )
        );

        $qrBill->setAdditionalInformation(
            QrBill\DataGroup\Element\AdditionalInformation::create(
                $order->order_nr
            )
        );

        return $qrBill;
    }

    private function callculatePrice($quantity){
        switch ($quantity) {
            case 20:
                return 440;
            case 50:
                return 1000;
            case 100:
                return 1800;
        }
    }
}