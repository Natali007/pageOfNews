<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\module\admin\models\News;
use yii\data\Pagination;

class SiteController extends Controller
{
		/*Выводит список всех нововстей
		Actionindex вызывает News::find(). Данный метод строит запрос к БД и извлекает все данные из таблицы.
		Чтобы ограничить количество новостей, возвращаемых каждым запросом, запрос разбивается на страницы с помощью объекта Pagination:
		устанавливает пункты offset и limit для SQL инструкции,чтобы она возвращала только одну страницу данных за раз
		(в нашем случае максимум 5 строк на страницу).
		Сортируем новости по дате, самие "свежые" в начале
		В конце кода actionindex выводит view с именем index, и передаёт в него данные из таблицы новостей вместе c информацией о пагинации*/
	public function actionIndex()
    {
        $query = News::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $allnews = $query->orderBy('data DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'allnews' => $allnews,
            'pagination' => $pagination,
        ]);
    }	
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
	
	/*Выводит на экран новость
		actionOnenews вызывает findOne($_GET['id']). Данный метод строит запрос к БД и извлекает строку с ключем id.
		В конце кода actionindex выводит view с именем onenews, и передаёт в него данные с запрашиваемой строкой*/
	public function actionOnenews()
    {
		$query = News::findOne($_GET['id']);

        return $this->render('onenews', [
            'query' => $query,
        ]);
    }
}
