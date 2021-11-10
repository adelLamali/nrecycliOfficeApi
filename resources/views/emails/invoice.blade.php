@component('mail::message')

Suite a l'installation du " Nrecycli Office Pack " éffectué le {{ $invoice['to_be_delivered_at'] }} et
 correspendant au devis numéro " {{ $invoice['number'] }} " 
 nous vous adressons ci-joint une facture d'un montant de {{ $invoice['total'] }} DA.<br>
 Il est possible de régler ce montant par chèque ou virement bancaire.<br>
 En vous remerciant par avance,<br>
 cordialement.

@endcomponent
