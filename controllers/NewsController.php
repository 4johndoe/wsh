<?php 

/**
* 
*/
class NewsController
{
	
	function actionIndex()
	{
		echo 'Список новостей';
		return true;
	}

	function actionView()
	{
		echo 'Просмотр одной новости';
		return true;
	}
}