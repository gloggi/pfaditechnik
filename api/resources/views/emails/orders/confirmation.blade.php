@component('mail::message')
# Bestellbestätigung

Hallo {{ $order->pfadiname ?? $order->first_name }}

Vielen Dank für deine Sammelbestellung von {{ $order->quantity}} Büchern Pfaditechnik!

Im Anhang findest du die QR-Rechnung für deine Bestellung. Sobald du die Rechnung bezahlt hast, verschieben wir deine Bestellung.

Liebe Grüsse,<br>
Das Pfaditechnik Team
@endcomponent