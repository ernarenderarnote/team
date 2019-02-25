<?php

namespace App\Providers;

use App\Services\CommonService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bladeDirectives();
        Schema::defaultStringLength(191);
        View::share('commonService', new CommonService);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helper/functions.php';
    }

    public function bladeDirectives(){

    
        Blade::directive('hasError', function ($expression) {

            $msg = '<?php if($errors->has('.$expression.')) : ?> has-error<?php endif ?>';
            return $msg;
            
        });


        Blade::directive('hasErrorMsg', function ($expression) {

            $msg = '<?php if($errors->has('.$expression.')): ?>
                        <span class="help-block error">
                            <span><?php echo $errors->first('.$expression.') ; ?></span>
                        </span>
                    <?php endif  ?>';

            return $msg;

        });

        Blade::directive('deleteBtn', function ($expression) {


            $default = ['','','\'Are you sure? you want to delete?\''];
            $setDefault = array_replace($default, explode(',',$expression));

            list($route , $params, $msg) = $setDefault;

            $params = str_replace("&",",",$params);

            $msg = "<form class=\"pull-left\" action=\"{{ route({$route}, {$params}) }}\" method=\"POST\" onsubmit=\"return confirm({$msg})\">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type=\"submit\" class=\"btn red \"
                            <i class=\"fa fa-trash\"></i> Delete
                        </button>
                    </form>";

            return $msg;
        });

    }
}
