<footer>
   <span class="footer-link" style="color: white">1 XMR = {{ \App\Tools\Converter::currencyConverter(\App\Tools\Converter::moneroLastPrice(), auth()->user()->currency) }} {{ \App\Tools\Converter::getSymbol(auth()->user()->currency) }} | </span><a href="{{ config('general.wiki_link') }}">Wiki</a> | <a href="{{ asset('pgp.txt') }}" target="_blank">PGP key</a> | <a href="{{ route('support') }}" class="footer-link">Support</a>
</footer>

