# Articles API


Articles API is an API through which we can

  - login
  - insert an article
  - update an article
  - delete an article
  - read an article
  - get a list of all the available articles

# Salient Features!

  - MVC architecture
  - Autherization
  - Automation scripts to insert initial required data
  - Postman documentation
  - ER diagram
  - automated migrations
  - exception handling
  - form validations
  - HTTP response codes
  - comments
  - PDOs

### Tech

Articles api uses a number of open source projects to work properly:

* [PHP](https://www.php.net/docs.php) - Backend
* [Mysql](https://dev.mysql.com/doc/) - relation databases
* [markdown](https://dillinger.io/) - Dillinger, Markdown parser done right. Fast and easy to extend.

### ER diagram

![N|Solid](https://s3.ap-south-1.amazonaws.com/www.heyitshitesh.com/images/Screenshot+from+2021-02-11+09-25-16.png)]

### POSTMAN
[Click here](https://www.getpostman.com/collections/a415639c0654fca6f14c) to download the collection.
[Click here](https://documenter.getpostman.com/view/8531207/TW77hPGL) for published api documentation.

steps,
1. import the collection in postman 
2. create and change the deicated working environment for project
3. specify a variable called local baseurl under that environment


### Testing

Articles api requires [PHP](https://www.php.net/docs.php) v5+ to run.

Clone the folder in hosted directory and start the server.

```sh
$ cd companyM
$ cd database
$ php Migrations.php
$ cd ../tests/
$ cd php main_insertion.php
```

Once done, start with testing of articles module
```sh
$ cd php articles_test.php

Logging in...
Array
(
    [0] => Array
        (
            [auther_id] => 1
            [auther_name] => J.K. Rowling
        )

    [1] => Array
        (
            [auther_id] => 2
            [auther_name] => Jeffery Archer
        )

    [2] => Array
        (
            [auther_id] => 3
            [auther_name] => Sidney Sheldon
        )

    [3] => Array
        (
            [auther_id] => 4
            [auther_name] => Agatha Cristie
        )

)
Enter auther id: 1
Array
(
    [0] => Array
        (
            [language_id] => 1
            [language_abbreviation] => en-US
        )

    [1] => Array
        (
            [language_id] => 2
            [language_abbreviation] => en-UK
        )

)
Enter language id: 1
Array
(
    [0] => Array
        (
            [location_id] => 1
            [city] => Mumbai
            [location_abbreviation] => Mumbai, MH
        )

    [1] => Array
        (
            [location_id] => 2
            [city] => Bangalore
            [location_abbreviation] => Banagalre, KT
        )

    [2] => Array
        (
            [location_id] => 3
            [city] => Hyderabad
            [location_abbreviation] => Hyderabad, TL
        )

    [3] => Array
        (
            [location_id] => 4
            [city] => Atlanta
            [location_abbreviation] => Atlanta, GA
        )

)
Enter location id: 1
Array
(
    [0] => Array
        (
            [section_id] => 1
            [section_name] => Sports
        )

    [1] => Array
        (
            [section_id] => 2
            [section_name] => Fashion
        )

    [2] => Array
        (
            [section_id] => 3
            [section_name] => Tech
        )

    [3] => Array
        (
            [section_id] => 4
            [section_name] => Finance
        )

)
Enter section id: 1
Array
(
    [0] => Array
        (
            [publisher_id] => 1
            [publisher_name] => Penguin Random House
        )

    [1] => Array
        (
            [publisher_id] => 2
            [publisher_name] => Hachette Livre
        )

    [2] => Array
        (
            [publisher_id] => 3
            [publisher_name] => HarperCollins
        )

    [3] => Array
        (
            [publisher_id] => 4
            [publisher_name] => Macmillan Publishers
        )

)
Enter Publihser id: 1
Enter Article Image URL: https://upload.wikimedia.org/wikipedia/en/9/95/Test_image.jpg
Enter headline: New article
Enter article url: https://www.base64decode.org/
Enter Publish date: 2021-02-11 02:58:05
Enter content: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, pulvinar facilisis justo mollis, auctor consequat urna. Morbi a bibendum metus. Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, in pretium orci vestibulum eget. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis pharetra luctus lacus ut vestibulum. Maecenas ipsum lacus, lacinia quis posuere ut, pulvinar vitae dolor. Integer eu nibh at nisi ullamcorper sagittis id vel leo. Integer feugiat faucibus libero, at maximus nisl suscipit posuere. Morbi nec enim nunc. Phasellus bibendum turpis ut ipsum egestas, sed sollicitudin elit convallis. Cras pharetra mi tristique sapien vestibulum lobortis. Nam eget bibendum metus, non dictum mauris. Nulla at tellus sagittis, viverra est a, bibendum metus.
Enter keywords saperated by |: ipsum|Lorem|mollis
Array
(
    [response] => Array
        (
            [status] => Success
            [status_code] => 200
            [payload] => 16
        )

    [err] => 200
    [time] => 0.735411
)

```


### Todos

  - Hosting
  - composer
  - logger


[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)


   [dill]: <https://github.com/shellbot97/legendary-waffle/blob/master/README.md>
   [git-repo-url]: <https://github.com/shellbot97/legendary-waffle>
   [Hitesh Ingale]: <https://www.linkedin.com/in/hitesh-ingale/t>

