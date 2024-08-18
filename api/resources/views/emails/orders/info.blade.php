@component('mail::message')
# Pfaditechnik in Wort und Bild
## Bestellinfo

Eine neue Bestellung wurde aufgegeben:
- **Bestellnummer**: {{ $order->order_nr }}
- **Name**: {{ $order->first_name }} {{ $order->last_name }}
- **E-Mail**: [{{ $order->email }}](mailto:{{ $order->email }})
- **Anzahl:** {{ $order->quantity}}
- **Kosten:** CHF {{ $order->amount }}


Alle Details zur Bestellung findest hier [hier]({{ config('app.url') }}/admin/orders/{{ $order->id }}/edit).
@endcomponent