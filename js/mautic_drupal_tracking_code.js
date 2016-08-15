(function () {
    'use strict';
    var settingsElement = document.querySelector('head > script[type="application/json"][data-drupal-selector="drupal-settings-json"], body > script[type="application/json"][data-drupal-selector="drupal-settings-json"]');
    window.drupalSettings = (settingsElement !== null) ? JSON.parse(settingsElement.textContent) : {} ;
})();
url = drupalSettings.mautic_drupal.mautic_drupal_tracking_code.base_url + '/mtc.js';
(function(w,d,t,u,n,a,m){w['MauticTrackingObject']=n;
    w[n]=w[n]||function(){(w[n].q=w[n].q||[]).push(arguments)},a=d.createElement(t),
        m=d.getElementsByTagName(t)[0];a.async=1;a.src=u;m.parentNode.insertBefore(a,m)
})(window,document,'script',url,'mt');

mt('send', 'pageview');