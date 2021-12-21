# Tests

To ensure that the site is functioning properly after major changes, perform the following checkpoints.

* Set the browser in every language (available in settings.php) and try with and without the language in the URL.
* Try to access via the URL to a picture, a directory, and an unknown controller and action.
* Test all the external links.
* Check every stylesheets and their variables.
* Test every page with [W3C validator](https://validator.w3.org).
* Test the mails with [mail tester](https://www.mail-tester.com).

# Documentation

To generate the documentation download [phpDocumentor](https://www.phpdoc.org) and run the following command:

```
phpdoc -d ./ -t documentation
```

# Translations

To update the translation files in `views/locale/...` run the following command:

```
msgfmt messages.po
```
