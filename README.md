# Каталог компаний

Это тестовое задание, в рамках которого необходимо было сделать REST API сервер справочника компаний. В файле `config.php` необходимо вписать параметры соединения с базой данных. Также необходимо выполнить файл `database.sql`, который создаст базу данных и заполнит её тестовыми данными.

## Выдача всех организаций находящихся в конкретном здании

    GET /index.php?controller=companiesByBuilding&buildId=1

Пример ответа:

    [
        {
            "id":"1",
            "buildingId":"1",
            "name":"Planet Express"
        },
        {
            "id":"2",
            "buildingId":"1",
            "name":"\u0420\u0430\u0437\u043d\u043e\u0435"
        }
    ]

## Список всех организаций, которые относятся к указанной рубрике

    GET /index.php?controller=companiesByCategory&categoryId=1

Формат ответа такой-же как у предыдущего метода.

## Список организаций, которые находятся в заданном радиусе относительно указанной точки на карте

    GET /index.php?controller=companiesByCoordinate&latitude=55.001&longitude=82.001&distance=200

`distance` указывается в метрах.

Пример ответа:

    [
        {
            "id":"1",
            "buildingId":"1",
            "name":"Planet Express",
            "distance":"0"
        },
        {
            "id":"2",
            "buildingId":"1",
            "name":"\u0420\u0430\u0437\u043d\u043e\u0435",
            "distance":"0"
        },
        {
            "id":"3",
            "buildingId":"2",
            "name":"\u041e\u0434\u0438\u043d\u0430\u043a\u043e\u0432\u043e\u0435",
            "distance":"112.26599367793361"
        }
    ]

## Список зданий

    GET /index.php?controller=buildings

Пример ответа:

    [
        {
            "id":"1",
            "address":"\u041a\u0440\u0430\u0441\u043d\u044b\u0439 \u041f\u0440\u043e\u0441\u043f\u0435\u043a\u0442 1",
            "coordinate":"55.001,82.001"
        },
        {
            "id":"2",
            "address":"\u041a\u0440\u0430\u0441\u043d\u044b\u0439 \u041f\u0440\u043e\u0441\u043f\u0435\u043a\u0442 2",
            "coordinate":"55.002,82.002"
        },
        {
            "id":"3",
            "address":"\u041a\u0440\u0430\u0441\u043d\u044b\u0439 \u041f\u0440\u043e\u0441\u043f\u0435\u043a\u0442 3",
            "coordinate":"55.003,82.003"
        }
    ]

## Выдача информации об организациях по их идентификаторам

    GET /http://localhost/companies/www/index.php?controller=company&id=1

Пример ответа:

    {
        "id":"1",
        "buildingId":"1",
        "name":"Planet Express"
    }
