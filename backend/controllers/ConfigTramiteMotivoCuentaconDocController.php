<?php

namespace backend\controllers;

use common\models\ConfigTramiteMotivoCuentaconDoc;
use common\ConfigTramiteMotivoCuentaconDocSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConfigTramiteMotivoCuentaconDocController implements the CRUD actions for ConfigTramiteMotivoCuentaconDoc model.
 */
class ConfigTramiteMotivoCuentaconDocController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ConfigTramiteMotivoCuentaconDoc models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ConfigTramiteMotivoCuentaconDocSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ConfigTramiteMotivoCuentaconDoc model.
     * @param int $id_Documento Id Documento
     * @param int $id_MotivoConstruccion Id Motivo Construccion
     * @param int $id_SolicitudGenericaCuentaCon Id Solicitud Generica Cuenta Con
     * @param int $id_TipoTramite Id Tipo Tramite
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_Documento, $id_MotivoConstruccion, $id_SolicitudGenericaCuentaCon, $id_TipoTramite)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_Documento, $id_MotivoConstruccion, $id_SolicitudGenericaCuentaCon, $id_TipoTramite),
        ]);
    }

    /**
     * Creates a new ConfigTramiteMotivoCuentaconDoc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ConfigTramiteMotivoCuentaconDoc();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_Documento' => $model->id_Documento, 'id_MotivoConstruccion' => $model->id_MotivoConstruccion, 'id_SolicitudGenericaCuentaCon' => $model->id_SolicitudGenericaCuentaCon, 'id_TipoTramite' => $model->id_TipoTramite]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ConfigTramiteMotivoCuentaconDoc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_Documento Id Documento
     * @param int $id_MotivoConstruccion Id Motivo Construccion
     * @param int $id_SolicitudGenericaCuentaCon Id Solicitud Generica Cuenta Con
     * @param int $id_TipoTramite Id Tipo Tramite
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_Documento, $id_MotivoConstruccion, $id_SolicitudGenericaCuentaCon, $id_TipoTramite)
    {
        $model = $this->findModel($id_Documento, $id_MotivoConstruccion, $id_SolicitudGenericaCuentaCon, $id_TipoTramite);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_Documento' => $model->id_Documento, 'id_MotivoConstruccion' => $model->id_MotivoConstruccion, 'id_SolicitudGenericaCuentaCon' => $model->id_SolicitudGenericaCuentaCon, 'id_TipoTramite' => $model->id_TipoTramite]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ConfigTramiteMotivoCuentaconDoc model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_Documento Id Documento
     * @param int $id_MotivoConstruccion Id Motivo Construccion
     * @param int $id_SolicitudGenericaCuentaCon Id Solicitud Generica Cuenta Con
     * @param int $id_TipoTramite Id Tipo Tramite
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_Documento, $id_MotivoConstruccion, $id_SolicitudGenericaCuentaCon, $id_TipoTramite)
    {
        $this->findModel($id_Documento, $id_MotivoConstruccion, $id_SolicitudGenericaCuentaCon, $id_TipoTramite)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ConfigTramiteMotivoCuentaconDoc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_Documento Id Documento
     * @param int $id_MotivoConstruccion Id Motivo Construccion
     * @param int $id_SolicitudGenericaCuentaCon Id Solicitud Generica Cuenta Con
     * @param int $id_TipoTramite Id Tipo Tramite
     * @return ConfigTramiteMotivoCuentaconDoc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_Documento, $id_MotivoConstruccion, $id_SolicitudGenericaCuentaCon, $id_TipoTramite)
    {
        if (($model = ConfigTramiteMotivoCuentaconDoc::findOne(['id_Documento' => $id_Documento, 'id_MotivoConstruccion' => $id_MotivoConstruccion, 'id_SolicitudGenericaCuentaCon' => $id_SolicitudGenericaCuentaCon, 'id_TipoTramite' => $id_TipoTramite])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
