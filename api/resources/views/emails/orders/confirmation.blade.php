@component('mail::message')
# Pfaditechnik in Wort und Bild
## Bestellbestätigung

Hallo {{ $order->pfadiname ?? $order->first_name }}

Vielen Dank für deine Sammelbestellung von {{ $order->quantity}} Exemplaren des Buches “Pfaditechnik in Wort und Bild”!

Im Anhang findest du die QR-Rechnung für deine Bestellung. Nach Zahlungseingang werden wir deine Bestellung umgehend bearbeiten und versenden.

Liebe Grüsse,<br>
Das Pfaditechnik Team
@endcomponent