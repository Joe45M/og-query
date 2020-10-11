# OgQuery - Effortlessly fetch page meta
OgQuery is a simple, expressive & fluent interface, used to fetch meta from an HTML page.

## Usage
Using OgQuery is *really* simple. 

Instantiate the Class:
```php
$Query = new $OgQuery();
```

Set your target endpoint:
```php
$Query->endpoint('https://joemoses.dev');
```

Now, select the meta tags you'd like to return:

```php
$Query->meta_tags(['og:title', 'og:image']);
```

Now, execute the request and get results:
```php
$Query->execute();
```

It's that simple.

## Class Methods
The methods within the OgQuery class are all chain-able, to keep the syntax small and concise.

### endpoint(fqdn)
#### Paramaters
**fqdn** - *String* - the fully qualified domain name you wish to target.

#### Return
**$this** - *Object*  - Class instance

### meta_tags(tags)
#### Paramaters
**tags** - *Array* - An array of meta keys you'd like to fetch - must be either a `name` or `property` value.

#### Return
**$this** - *Object*  - Class instance

### execute()
#### Paramaters
*None*.

#### Return
**results** - *Array*  - An associative array of found meta data, where the key is the `name`/`property` value, and value is `content` value.