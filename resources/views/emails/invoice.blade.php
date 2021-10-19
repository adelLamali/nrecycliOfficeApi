@component('mail::message')

Suite de l'installation du Nrecycli Office Pack éffectué le {{ $invoice['to_be_delivered_at'] }} et
 correspendant au devis numéro {{ $invoice['number'] }} 
 nous vous adressons ci-joint une facture d'un montant de {{ $invoice['total'] }} DA.
 Il est possible de régler ce montant par chèque ou virement bancaire.
 En vous remerciant par avance,
 cordialement.

@endcomponent
