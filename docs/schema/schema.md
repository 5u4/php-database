# Schema

## Methods

See examples in [Schema](../../examples/Schema/Schema.php)

### Create

Create a table on database

```php
Schema::create(string $tableName, callback $tableBuildingFunction [, bool $ifNotExists [, string $database]]): void
```

### Drop

Drop a table on database

```php
Schema::drop(string $tableName [, bool $ifExists [, string $database]]): void
```
