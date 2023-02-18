<?php

namespace backend\controllers;

use Yii;
use common\models\TipoTramiteHasDocumento;
use common\models\TipoTramiteHasDocumentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
/**
 * TipoTramiteHasDocumentoController implements the CRUD actions for TipoTramiteHasDocumento model.
 */
class TipoTramiteHasDocumentoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [ 
            'access'=> [   
                'class' => AccessControl::class,
                'rules'=> [
                    [
                        'actions' => ['view','create','update','delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TipoTramiteHasDocumento models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TipoTramiteHasDocumentoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoTramiteHasDocumento model.
     * @param int $id_Documento Id Documento
     * @param int $id_TipoTramite Id Tipo Tramite
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
/*     public function actionView($id_Documento, $id_TipoTramite)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_Documento, $id_TipoTramite),
        ]);
    } */

    /**
     * Creates a new TipoTramiteHasDocumento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TipoTramiteHasDocumento();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_Documento' => $model->id_Documento, 'id_TipoTramite' => $model->id_TipoTramite]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TipoTramiteHasDocumento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_Documento Id Documento
     * @param int $id_TipoTramite Id Tipo Tramite
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_Documento, $id_TipoTramite)
    {
        $model = $this->findModel($id_Documento, $id_TipoTramite);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            ///return $this->redirect(['view', 'id_Documento' => $model->id_Documento, 'id_TipoTramite' => $model->id_TipoTramite]);
            Yii::$app->session->setFlash('success', "Registro actualizado correctamente.");

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TipoTramiteHasDocumento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_Documento Id Documento
     * @param int $id_TipoTramite Id Tipo Tramite
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_Documento, $id_TipoTramite)
    {
        $this->findModel($id_Documento, $id_TipoTramite)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TipoTramiteHasDocumento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_Documento Id Documento
     * @param int $id_TipoTramite Id Tipo Tramite
     * @return TipoTramiteHasDocumento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_Documento, $id_TipoTramite)
    {
        if (($model = TipoTramiteHasDocumento::findOne(['id_Documento' => $id_Documento, 'id_TipoTramite' => $id_TipoTramite])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
