<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 15.08.2019
 * Time: 15:11
 */

namespace app\services;

use app\models\Employees;
use app\models\Experience;
use Da\QrCode\QrCode;
use kartik\mpdf\Pdf;
use Yii;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\widgets\Spaceless;

class EmployeeService
{

    const IMAGE_PATH = '/uploads/images/';
    const QR_PATH = '/uploads/qr/';
    const PDF_PATH = '/uploads/pdf/';

    public function create(){

        $controller = Yii::$app->controller;

        $model = new Employees();
        $experience = new Experience();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $experience->load(Yii::$app->request->post());

            $eucationData = is_array($experience->name) ? $experience->name : [];
            $workData = is_array($experience->specialty) ? $experience->specialty : [];
            $data = array_merge($eucationData,$workData);

            foreach ($data as $item){
                $experience = new Experience();
                $experience->load($item,'');
                $experience->employee_id = $model->id;
                $experience->save();
            }
            $this->createQr($model);
            $model->save();
            return $controller->redirect(['view', 'id' => $model->id]);
        }

        return $controller->render('create', [
            'model' => $model,
            'experience' => $experience,
        ]);
    }

    public static function uploadImage(Employees &$model)
    {

        $image = UploadedFile::getInstance($model,'image');

        if(!$image)
            return false;

        $path = Yii::getAlias('@app/web');
        $name = uniqid(time() . '_') . '.' . $image->extension;
        $image_path = static::IMAGE_PATH . $name;

        if(!is_dir($path . self::IMAGE_PATH))
            mkdir($path . self::IMAGE_PATH,0777,true);

        if(!$image->saveAs($path . $image_path))
            return false;

        static::deletePhoto($model);

        $model->photo = $image_path;

        return true;

    }

    public function createQr(Employees &$model)
    {

        $path = Yii::getAlias('@app/web');

        if(!is_dir($path . self::QR_PATH))
            mkdir($path . self::QR_PATH,0777,true);

        $qr = self::QR_PATH . uniqid(time().'_') . '.png';
        $url = Url::to(['/employee/view','id'=>$model->id]);

        $qrCode = (new QrCode($url))
            ->setSize(250)
            ->setMargin(5)
            ->writeFile($path . $qr);

        if(!$qrCode)
            return false;

        $model->qr = $qr;
        return true;

    }

    public function getPdf($id)
    {
        $model = $this->findModel($id);

        $works = Experience::findAll(['employee_id'=>$id,'type' => Experience::TYPE_WORK]);
        $education = Experience::findAll(['employee_id'=>$id,'type' => Experience::TYPE_EDUCATION]);

        $content = Yii::$app->controller->renderPartial('view',[
            'model' => $model,
            'works' => $works,
            'education' => $education,
        ]);


        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssInline' => file_get_contents(Yii::getAlias('@app/web/css/resume.css')),
        ]);

        return $pdf->render();
    }

    public static function deletePhoto(Employees $model)
    {
        $path = Yii::getAlias('@app/web');
        if($model->photo && is_file($path . $model->photo))
            unlink($path . $model->photo);
    }

    public static function deleteQr(Employees $model)
    {
        $path = Yii::getAlias('@app/web');
        if($model->qr && is_file($path . $model->qr))
            unlink($path . $model->qr);
    }

    public function render(string $view, array $params){
        return Yii::$app->controller->render('layout', [
            'view' => $view,
            'params' => $params,
        ]);
    }

    public function redirect($url){
        return Yii::$app->controller->redirect($url);
    }

    public function view($id)
    {
        $model = $this->findModel($id);
        $works = Experience::findAll(['employee_id'=>$id,'type' => Experience::TYPE_WORK]);
        $education = Experience::findAll(['employee_id'=>$id,'type' => Experience::TYPE_EDUCATION]);

        return $this->render('view',[
            'model' => $model,
            'works' => $works,
            'education' => $education,
        ]);
    }

    public function update($id){
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if(!$model->qr)
                $this->createQr($model);
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function updateExperience($id,$type,$title){
        $model = $this->findModel($id);
        $education = Experience::findAll(['employee_id'=>$id,'type' => $type]);
        $educationModel = new Experience();

        if($model->load(Yii::$app->request->post())){
            $data = is_array($model->firstname) ? $model->firstname : [];
            Experience::deleteAll(['employee_id'=>$id,'type' => $type]);
            foreach ($data as $item){

                $emodel = new Experience();

                if(!$emodel->load($item,''))
                    continue;

                $emodel->employee_id = $id;
                $emodel->type = $type;
                $emodel->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update-experience',[
            'model' => $model,
            'title' => $title,
            'education' => $education,
            'educationModel' => $educationModel,
        ]);
    }

    public function updateEducation($id){
        return $this->updateExperience($id,Experience::TYPE_EDUCATION,Yii::t('app','Update education data'));
    }

    public function updateWork($id){
        return $this->updateExperience($id,Experience::TYPE_WORK,Yii::t('app','Update working data'));
    }

    protected function findModel($id)
    {
        if (($model = Employees::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}