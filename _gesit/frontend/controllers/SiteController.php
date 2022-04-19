<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\Donasi;
use backend\models\DonasiTemp;
use backend\models\ProgramDonasi;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDetail()
    {   

        $model = new DonasiTemp();
        $idx = $_GET['id'];
        $model->buktitf_id =  time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/bayar','invoice'=>$model->id_invoice,'program' => $idx, ]);
        }else {
            $model->loadDefaultValues();
        }
       

        return $this->render('detail', [
            'model' => $model,
        ]);
    }

    public function actionBayar(){
        
        $idprogram = $_GET['program'];
        $idinvoice = $_GET['invoice'];
        $donasitemp = DonasiTemp::find()
            ->where(['id_invoice'=>$idinvoice])
            ->orderBy(['id' => SORT_DESC])
            ->one();
        $program = ProgramDonasi::find()
            ->where(['id' => $idprogram ])
            //->groupBy('userid')
            ->orderBy(['id' => SORT_DESC])
            ->one();
        \Midtrans\Config::$serverKey = 'SB-Mid-server-OUlRGsIuhdzdZ5FT54YST1T8';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $items = array(
            array(
            
                'id'       => 'item1',
                'price'    => $donasitemp->jumlah,
                'quantity' => 1,
                'name'     => $program->title,
            )
        );
        
        // Populate customer's info
        $customer_details = array(
            'first_name'       => $donasitemp->nama,
            'email'            => $donasitemp->email,
        );

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $donasitemp->jumlah,
            ),

            'customer_details' => $customer_details,
            'item_details'=>$items
            
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        

        return $this->render('bayar',[
            'snapToken' => $snapToken,
        ]);
    }

    public function actionFinish(){


        
        if (Yii::$app->request->isAjax){
            $idprogram = $_POST['idprogram'];
            $invoice = $_POST['invoice'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pesan = $_POST['pesan'];
            $jumlah = $_POST['jumlah'];
            $order_id = $_POST['order_id'];
            $payment_type = $_POST['payment_type'];
            $transaction_time = $_POST['transaction_time'];
            $transaction_status = $_POST['transaction_status'];
           
            $donasi = new Donasi();
            Yii::$app->db->createCommand()->insert('donasi', [
                'id_program' => $idprogram,
                'id_invoice' => $invoice,
                'nama' => $name,
                'email' => $email,
                'pesan' => $email,
                'jumlah' => $jumlah,
                'order_id' => $order_id, 
                'payment_type' => $payment_type, 
                'transaction_time' => $transaction_time, 
                'transaction_status' => $transaction_status, 
                
            ])->execute();

            Yii::$app->db->createCommand()->delete('donasi_temp', 'id_invoice ='.$invoice)->execute();
           


        }

    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
