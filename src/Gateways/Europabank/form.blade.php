{{--do not use Form::open because we don't want the hidden token field --}}
<form 
    method="POST"
    action="{{ config('payment.gateways.europabank.mpiUrl') }}"
    accept-charset="UTF-8"
    @foreach($attributes as $attribute => $value)
    {{ $attribute }}="{{ $value }}"
    @endforeach
>

{{ Form::hidden('Uid', config('payment.gateways.europabank.uid'))}}
{{ Form::hidden('Orderid', $order->getPaymentOrderId()) }}
{{ Form::hidden('Amount', $order->getPaymentAmount()) }}
{{ Form::hidden('Description', $order->getPaymentDescription()) }}
{{ Form::hidden('Hash', $hash) }}
{{ Form::hidden('Beneficiary', config('app.name')) }}
{{ Form::hidden('Redirecttype', 'DIRECT') }}
{{ Form::hidden('Redirecturl', URL::route(config('payment.gateways.europabank.paymentLandingPageRoute'))) }}
{{ Form::hidden('Chemail', $order->getCustomerEmail()) }}
{{ Form::hidden('Chlanguage', $order->getCustomerLanguage()) }}

@if (config('payment.gateways.europabank.formCss'))
    {{ Form::hidden('Css', config('payment.gateways.europabank.formCss')) }}
@endif

@if (config('payment.gateways.europabank.template'))
    {{ Form::hidden('Template', config('payment.gateways.europabank.template')) }}
@endif


@if (config('payment.gateways.europabank.formTitle'))
    {{ Form::hidden('Title', config('payment.gateways.europabank.formTitle')) }}
@endif

@if (config('payment.gateways.europabank.merchantEmail'))
    {{ Form::hidden('MerchantEmail', config('payment.gateways.europabank.merchantEmail')) }}
@endif

@if (config('payment.gateways.europabank.secondChanceEmailSender'))
    {{ Form::hidden('Emailfrom', config('payment.gateways.europabank.secondChanceEmailSender')) }}
@endif

{{ Form::button(Lang::get('payment::form.submitButtonText'), ["type"=>"submit", "class"=> config('payment.form.submitButtonClass')]) }}


</form>
