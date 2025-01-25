namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 应用程序引导任何应用服务。
     *
     * @return void
     */
    public function boot()
    {
        // 在 AppServiceProvider 中加载支付插件
        $files = glob(app_path('Payments/*/CustomPayment.php'));
        foreach ($files as $file) {
            require_once $file;
        }
    }

    /**
     * 注册任何应用服务。
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
