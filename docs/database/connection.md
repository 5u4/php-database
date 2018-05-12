# Connection

## Query

```php
Connection::query(string $query [, bool $parse]): array|mysqli_result
```

`$query`: the query 
`$parse`: if true, return parsed array result, else return mysqli_result
