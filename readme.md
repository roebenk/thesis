# SME cybersecurity risk assessment tool
This tool was developed in combination with a master thesis on Delft University of Technology.
For more information on the inner workings of the tool, the master thesis can be consulted.

## Installation guide
The tool is web-based and built with Laravel. The requirements are a web-server with PHP7 and a MySQL server. To install the tool, clone the repository and run `composer install` and `npm install`. Change `config/database.php` and configure with the correct database keys. After this, the command `php artisan migrate` needs to be run in order to create the database structure.
When all these steps are done, the tool can be used via the browser.

## Knowledge base
The knowledge base consists of two tables in the database; `policytypes` and `policyvalues` . These two tables have some population, but they are in no way extensive (as can be read in the research).
To extend or change the knowledgebase, the data in these two tables has to be changed.

### Policytypes
In this table the different policy types are defined.
Each of the columns will be shortly explained:
- name; Name of the type
- works_on; actor of device
- icon; optional icon from the fontawesome set
- updated_at; timestamp
- created_at; timestamp

### Policyvalues
The different variants that can be used for the different policy types need to be defined in this table.
The different columns are:
- policytype_id; id of the policytype that this variant is relevant for
- variant; name of the variant
- value; impact on the breach probability if implemented (higher is better)
- updated_at; timestamp
- created_at; timestamp