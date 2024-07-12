<?php

return [
	
	//спецификации по рынку
	'country_specifics' => ["0","1","7","11"],
	//идентификатор языка вывода информации
	'lang_id' => "16",
	//персональный=0, коммерческий=1, все типы=2
	'ctype' => "0",
	//фильтр по годам производства
	'models_from' => "1998",
	//фильтр по годам производства
	'hide_trade' => true,
	//фильтр по моделям для usa "0" - не фильтровать, "1" - фильтровать
	'notusa' => "1",
	//фильтр по моделям для usa - страница моделей
	'hide_usa' => "1",
	//сервер изображений
	'images_server' => "boschautoparts.pp.ua/images/",
	//скрыть товар без цен
	'hide_noprices' => "0",
	//скрыть товар которого нет в наличии
	'hide_prices_noavail' => "0",
	//аналоги аналогов
	'hide_analogs_of_analogs' => "1",
	//показывать свойства
	'show_item_props' => "1",
	//скрывать цены товаров не из tecdoc
	'hide_notecdoc_online_prices' => "1",
	//получать цены только запрашиваемых номеров
	'request_ws_only_searched' => "1",
	//поиск в кроссах
	'search_in_crosses' => "1",
	//показывать фильтр брендов
	'show_filter_brands' => "1",
	//показывать фильтр брендов
	'filter_brands_letters_limit' => "30",
	//пересохранение картинок
	'img_resave' => "1",
	//x_base
	'tdmxbaseisused' => false,	
	//скрывать оригинальные номера
	'hide_originals' => false,
	//счет количества параметров единицы товара
	'items_props_count' => true,
	//сортировка в поиске, задается через сессию
	'search_sorting' => "1",
	
	//избранные бренды
	'favorite_items' => ["VW", "FORD", "AUDI", "BMW", "OPEL", "RENAULT",
	"PEUGEOT", "MAZDA", "HONDA", "TOYOTA", "SEAT", "MERCEDES-BENZ", "FIAT",
	"MITSUBISHI", "NISSAN", "SUZUKI", "CHEVROLET", "SUBARU", "KIA", "HYUNDAI", "SKODA", "CHERY", "CITROEN", "VOLVO"],
	
];
