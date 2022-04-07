# Build Symfony pages, with async blocks

Building media website with reusable components is challenging.
With Design System, we define reusable components from template to
backend.

Using async PHP, is a solution to organize PHP code by Component.

This demo app contains 2 pages. The home lists last published articles.
The article page shows a single article, a list of related articles
and the same list as of last published articles from the home page.

We use such table to specify witch blocks are used on with pages.

| Blocks/Page 	| LastArticles 	| ArticleContent 	| RelatedArticles 	|
|-------------	|--------------	|----------------	|-----------------	|
| app_index   	| X            	|                	|                 	|
| app_article 	| X            	| X              	| X               	|

Technical stack:
- PHP 8.1+
- Symfony 6
- AMP v3+ (dev) with Fibers
- Contents from HTTP API

## Installation

Requires PHP 8.1 and [Symfony CLI](https://symfony.com/download). 

```console
symfony composer install
symfony server:start -d
```

## Credits

This demo have been created by [Jérôme TAMARELLE](https://jerome.tamarelle.net).

It is inpired by how websites are build at [Prisma Media](https://www.prismamedia.com/).
