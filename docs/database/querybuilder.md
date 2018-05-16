# Query Builder

## Select

Example:

```php
<?php

use Senhung\DB\Database\QueryBuilder;

$query = new QueryBuilder();

/* SELECT * FROM `users` WHERE `name`='alex' */
print $query->select('*')->from('users')->where(['name', '=', 'alex']);
```

## Insert

Example:

```php
<?php

use Senhung\DB\Database\QueryBuilder;

$query = new QueryBuilder();

/* INSERT INTO `users` (`name`) VALUES ('alex') */
print $query->insertInto('users', ['name'])->values(['alex']);
```

Or you can do it like:

```php
<?php

use Senhung\DB\Database\QueryBuilder;

$query = new QueryBuilder();

/* INSERT INTO `users` (`name`) SELECT 'alex' SELECT 'senhung' */
print $query->insertInto('users', ['name'])->select(['alex'])->select(['senhung']);
```

## Update

Example:

```php
<?php

use Senhung\DB\Database\QueryBuilder;

$query = new QueryBuilder();

/* UPDATE `users` SET `name`='senhung' WHERE `name`='alex' */
print $query->update('users')->set(['name' => 'senhung'])->where(['name', '=', 'alex']);
```

## Clear

```php
<?php

use Senhung\DB\Database\QueryBuilder;

$query = new QueryBuilder();

/* ... */

/* Set query to empty */
$query->clear();
```
