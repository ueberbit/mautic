Mautic Drupal 8.x module
========================

This Drupal 8 module lets you add the Mautic tracking code to your Drupal website.

### Installation

1. Download module
4. Enable Mautic module.
5. Configure Mautic module - insert Mautic Base URL. Save Confuguration.

### Mautic Tracking Code

Module will insert a javascript linked to your Mautic instance. You can check HTML source code (CTRL + U) of your Drupal website to make sure the plugin works. You should be able to find something like this:

` ... ['MauticTrackingObject'] ...`

There will be probably longer URL query string at the end of the tracking URL. It is encoded additional data about the page (title, url, referrer, language).
