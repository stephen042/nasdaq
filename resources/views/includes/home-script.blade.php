<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5LDTCTPX" height="0" width="0"
        style="display:none;visibility:hidden"></iframe>
</noscript>

<script>
    //This code changes tabs when switch button is clicked.
    let stepone = $('.stepone');
    let steptwo = $('.steptwo');

    $('.switch').click(function() {
        if (stepone.hasClass('w--tab-active')) {
            stepone.removeClass('w--tab-active');
            steptwo.addClass('w--tab-active');
        } else if (steptwo.hasClass('w--tab-active')) {
            steptwo.removeClass('w--tab-active');
            stepone.addClass('w--tab-active');
        }
    });


    //This code changes tables tabs when switch button is clicked.
    let tableone = $('.table-one');
    let tabletwo = $('.table-two');

    $('.switch-table').click(function() {
        if (tableone.hasClass('w--tab-active')) {
            tableone.removeClass('w--tab-active');
            tabletwo.addClass('w--tab-active');
        } else if (tabletwo.hasClass('w--tab-active')) {
            tabletwo.removeClass('w--tab-active');
            tableone.addClass('w--tab-active');
        }
    });


    //This code changes dollars to percent when switch button is clicked.
    let profitdol = $('.profit-dol');
    let profitpro = $('.profit-pro');

    $('.switch-percent').click(function() {
        if (profitdol.hasClass('w--tab-active')) {
            profitdol.removeClass('w--tab-active');
            profitpro.addClass('w--tab-active');
        } else if (profitpro.hasClass('w--tab-active')) {
            profitpro.removeClass('w--tab-active');
            profitdol.addClass('w--tab-active');
        }
    });
    window.intercomSettings = {
        api_base: "https://api-iam.intercom.io",
        app_id: "mul370gq"
    };

    // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/mul370gq'
    (function() {
        var w = window;
        var ic = w.Intercom;
        if (typeof ic === "function") {
            ic('reattach_activator');
            ic('update', w.intercomSettings);
        } else {
            var d = document;
            var i = function() {
                i.c(arguments);
            };
            i.q = [];
            i.c = function(args) {
                i.q.push(args);
            };
            w.Intercom = i;
            var l = function() {
                var s = d.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                var x = d.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            };
            if (document.readyState === 'complete') {
                l();
            } else if (w.attachEvent) {
                w.attachEvent('onload', l);
            } else {
                w.addEventListener('load', l, false);
            }
        }
    })();
</script>

<!-- Elfsight WhatsApp Chat | Untitled WhatsApp Chat -->
{{-- <script src="https://static.elfsight.com/platform/platform.js" async></script>
<div class="elfsight-app-79cfadb4-781e-4b74-b759-f11a2501218e" data-elfsight-app-lazy></div> --}}

{{-- <div style="position: fixed; bottom: 20px; left: 20px; z-index: 999;">
  <a href="https://wa.me/447944350625?text=Hello%2C%20I'm%20interested%20in%20your%20services" target="_blank" style="
    background-color: #25D366;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-family: sans-serif;
    font-size: 14px;
    text-decoration: none;
    display: flex;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  ">
    <img src="https://img.icons8.com/ios-filled/29/ffffff/whatsapp.png" alt="WhatsApp" style="width: 29px; height: 29px; margin-right: 8px;" />
    Chat
  </a>
</div> --}}

