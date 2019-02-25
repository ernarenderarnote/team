@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => url('/')])
            <img src="{{ asset('/images/mail-logo.png') }}" alt="{{ config('app.name') }}" />
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @if (isset($subcopy))
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endif

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
             You are receiving this email because you registered at Team.Education and agreed to receive email from us regarding new features, events and special offers from Team.Education. If you wish to be unsubscribed from receiving these emails please
             <a href="{{ url('/') }}"> click</a>
            {{-- &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved. --}}
        @endcomponent
    @endslot
@endcomponent
