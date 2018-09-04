The Number abbreviation Extension
=================================

The Number abbreviation extension provides the following filters:

* ``exact_abbr``
* ``general_abbr``

Installation
------------


Showing exact abbreviation of a number
--------------------------------------

Use the ``exact_abbr`` filter if you are willing to display exactly the abbreviation
of the providen number. This means, displaying the abbreviation with decimals.

.. code-block:: jinja

    {{ "18298547"|exact_abbr }}

This example would output ``18.5M``, as ``18298547`` is the providen number.


Showing general abbreviation of a number
----------------------------------------

Use the ``general_abbr`` filter if you are willing to display only the important part
of the providen number (without exact group of thousand). Instead of generating an
abbreviation with "decimals", the snippet will add the main number and a plus symbol.

.. code-block:: jinja

    {{ "18298547"|general_abbr }}

This example would output ``18M+``, as ``18298547`` is the providen number.
