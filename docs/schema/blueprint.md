# Blueprint

 - [Construct](#construct)
 - [Building Table](#building-table)
 - [Column Declaration](#column-declaration)
 - [Constraint Declaration](#constraint-declaration)
 - [Relationship Declaration](#relationship-declaration)
 - [Table Option Declaration](#table-option-declaration)

## Construct

Initialize a `Blueprint` instance requires inputting the table name;

```php
$table = new Blueprint('table_name');
```

## Building Table

Since all methods return self, method calling can be in series.

```php
$table->int('column_name')->primary()->autoIncrement();
```

## Column Declaration

Adding columns by calling the data type methods with column name:

```php
$table->int('column_name');
```

### Available Column Data Types

#### String

```php
Blueprint::string(string $columnName [, int $length]): self
```

#### Int

```php
Blueprint::int(string $columnName [, int $length]): self
```

#### Text

```php
Blueprint::text(string $columnName [, int $length]): self
```

#### Json

```php
Blueprint::json(string $columnName): self
```

#### Enum

```php
Blueprint::enum(string $columnName, array $values): self
```

#### Timestamp

```php
Blueprint::timestamp(string $columnName [, int $fsp]): self
```

#### Float

```php
Blueprint::float(string $columnName [, int $length [, int $decimals]]): self
```

#### Double

```php
Blueprint::double(string $columnName [, int $length [, int $decimals]]): self
```

#### Decimal

```php
Blueprint::decimal(string $columnName [, int $length [, int $decimals]]): self
```

## Constraint Declaration

Column constraints can be declared in two places:

1. When declaring column type

```php
$table->int('column_name')->primary();
```

2. Declaring separately

```php
$table->primary('column_name');
```

Note: for some compound constraints, only separately declaration is allowed

```php
$table->primary(['column_name_1', 'column_name_2'])
```

### Available Column Constraints

#### Not Null

```php
Blueprint::notNull([array|string $columnName]): self
```

#### Null

```php
Blueprint::null([array|string $columnName]): self
```

#### Primary Key

```php
Blueprint::primary([array|string $columnName]): self
```

#### Unique Key

```php
Blueprint::unique([array|string $columnName]): self
```

#### Auto Increment

```php
Blueprint::autoIncrement([array|string $columnName]): self
```

#### Default

```php
Blueprint::default(string $value [, array|string $columnName]): self
```

#### Index

```php
Blueprint::index([array|string $columnName]): self
```

#### Unsigned

```php
Blueprint::unsigned([array|string $columnName]): self
```

## Relationship Declaration

Relationship declaration is simple, a fully declaration is like:

```php
$table->foreign('local_column', 'constraint_name')->references('foreign_table', 'foreign_column')
    ->onDelete(Blueprint::CASCADE)->onUpdate(Blueprint::CASCADE);
```

Some method arguments are not required, check [available relationship methods](#available-relationship-methods) for details. 

Note: In a foreign key declaration, methods `foreign` and `references` are required.

### Available Relationship Methods

#### Foreign

```php
Blueprint::foreign(string $columnName [, string $constraintName]): self
```

#### References

```php
Blueprint::references(string $foreignTable, string $foreignColumn): self
```

#### On Delete

```php
Blueprint::onDelete(string $action): self
```

#### On Update

```php
Blueprint::onUpdate(string $action): self
```

### Available Relationship Actions

#### Restrict

```php
Blueprint::RESTRICT /* RESTRICT */
```

#### Cascade

```php
Blueprint::CASCADE /* CASCADE */
```

#### Set Null

```php
Blueprint::SET_NULL /* SET NULL */
```

#### No Action

```php
Blueprint::NO_ACTION /* NO ACTION */
```

#### Set Default

```php
Blueprint::SET_DEFAULT /* SET DEFAULT */
```

## Table Option Declaration

Set table options.

Example:

```php
$table->engine('InnoDB');
$table->characterSet('utf8mb4');
```

### Available Table Options

#### Auto Increment

```php
Blueprint::tableAutoIncrement(int $value): self
```

#### Character Set

```php
Blueprint::characterSet(string $charsetName): self
```

#### Comment

```php
Blueprint::comment(string $comment): self
```

#### Engine

```php
Blueprint::engine(string $engineName): self
```

#### Max Rows

```php
Blueprint::maxRows(int $value): self
```

#### Min Rows

```php
Blueprint::minRows(int $value): self
```
