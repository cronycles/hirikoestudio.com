@if(config('custom.analytics.googleAnalyticsKey') != '')
    <script>

        const gaKey = document.getElementById("cl-srv").getAttribute('data-ga-key');
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga('create', gaKey, 'auto');
        ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
@endif
