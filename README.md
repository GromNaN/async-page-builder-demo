# Build Symfony pages, with async blocks

A media website is full of reusable components and building those 
components is challenging. With our designers we start by creating 
wireframes defining reusable components used by the backend developers.

Using async PHP, is a solution to organize PHP code by Component.

This demo app contains 2 pages:
- The home with a list of last published articles.
- The article page with a single article, a list of related articles 
and the same list of last published articles used in the home page.

We define a table to specify which blocks are used by each page.

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
